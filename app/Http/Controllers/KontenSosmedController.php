<?php

namespace App\Http\Controllers;

use App\Models\KontenSosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class KontenSosmedController extends Controller
{
    public function index(Request $request)
    {
        $kontenQuery = $this->buildFilteredQuery($request)->latest('tanggal_upload');

        $platformOptions = KontenSosmed::select('platform')
            ->distinct()
            ->orderBy('platform')
            ->pluck('platform');

        // PostgreSQL compatible query
        $yearOptions = KontenSosmed::selectRaw('EXTRACT(YEAR FROM tanggal_upload) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $konten = $kontenQuery->get();

        return view('konten-sosmed.index', compact('konten', 'platformOptions', 'yearOptions'));
    }

    public function exportPdf(Request $request)
    {
        $konten = $this->buildFilteredQuery($request)
            ->latest('tanggal_upload')
            ->get();

        if ($konten->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak tersedia untuk export.');
        }

        $pdf = Pdf::loadView('konten-sosmed.export-pdf', compact('konten'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('konten-sosmed.pdf');
    }

    public function exportExcel(Request $request)
    {
        $konten = $this->buildFilteredQuery($request)
            ->latest('tanggal_upload')
            ->get();

        if ($konten->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak tersedia untuk export.');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Konten Sosmed');

        $sheet->fromArray([
            ['No', 'Platform', 'Judul', 'Tanggal Upload', 'Screenshot'],
        ], null, 'A1');

        $row = 2;
        foreach ($konten as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->platform);
            $sheet->setCellValue('C' . $row, $item->judul);
            $sheet->setCellValue('D' . $row, $item->tanggal_upload->format('Y-m-d'));
            $sheet->setCellValue('E' . $row, $item->screenshot ? 'Lihat Gambar' : '-');

            if ($item->screenshot) {
                $imagePath = public_path('storage/' . $item->screenshot);
                if (file_exists($imagePath)) {
                    $drawing = new Drawing();
                    $drawing->setPath($imagePath);
                    $drawing->setHeight(60);
                    $drawing->setCoordinates('F' . $row);
                    $drawing->setWorksheet($sheet);
                    $sheet->getRowDimension($row)->setRowHeight(60);
                }
            }
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        return response($excelOutput, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="konten-sosmed.xlsx"',
        ]);
    }

    public function exportWord(Request $request)
    {
        $konten = $this->buildFilteredQuery($request)
            ->latest('tanggal_upload')
            ->get();

        if ($konten->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak tersedia untuk export.');
        }

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(11);

        $section = $phpWord->addSection([
            'marginTop' => 900,
            'marginBottom' => 900,
            'marginLeft' => 900,
            'marginRight' => 900,
        ]);

        $section->addText('Rekap Konten Sosmed', [
            'bold' => true,
            'size' => 14,
        ], [
            'spaceAfter' => 200,
        ]);

        $tableStyleName = 'KontenSosmedTable';
        $phpWord->addTableStyle($tableStyleName, [
            'borderSize' => 8,
            'borderColor' => '9CA3AF',
            'cellMargin' => 110,
            'alignment' => JcTable::CENTER,
        ], [
            'bgColor' => 'F3F4F6',
        ]);

        $table = $section->addTable($tableStyleName);

        $headerTextStyle = ['bold' => true, 'color' => '111827', 'size' => 11];
        $headerCellStyle = ['valign' => 'center'];
        $cellStyle = ['valign' => 'center'];
        $textStyle = ['size' => 11, 'color' => '111827'];
        $centerParagraph = ['alignment' => Jc::CENTER];

        $colNo = 650;
        $colPlatform = 1700;
        $colJudul = 2900;
        $colLink = 2400;
        $colTanggal = 1900;
        $colScreenshot = 2200;

        $table->addRow(520);
        $table->addCell($colNo, $headerCellStyle)->addText('No', $headerTextStyle, $centerParagraph);
        $table->addCell($colPlatform, $headerCellStyle)->addText('Platform', $headerTextStyle, $centerParagraph);
        $table->addCell($colJudul, $headerCellStyle)->addText('Judul', $headerTextStyle, $centerParagraph);
        $table->addCell($colLink, $headerCellStyle)->addText('Link', $headerTextStyle, $centerParagraph);
        $table->addCell($colTanggal, $headerCellStyle)->addText('Tanggal Upload', $headerTextStyle, $centerParagraph);
        $table->addCell($colScreenshot, $headerCellStyle)->addText('Screenshot', $headerTextStyle, $centerParagraph);

        foreach ($konten as $index => $item) {
            $table->addRow(1150);

            $table->addCell($colNo, $cellStyle)->addText((string) ($index + 1), $textStyle, $centerParagraph);
            $table->addCell($colPlatform, $cellStyle)->addText((string) $item->platform, $textStyle, $centerParagraph);
            $table->addCell($colJudul, $cellStyle)->addText((string) $item->judul, $textStyle, $centerParagraph);

            $linkValue = (string) ($item->link_konten ?? '');
            $linkCell = $table->addCell($colLink, $cellStyle);
            if ($linkValue !== '') {
                $linkCell->addText($linkValue, $textStyle, $centerParagraph);
            } else {
                $linkCell->addText('-', $textStyle, $centerParagraph);
            }

            $table->addCell($colTanggal, $cellStyle)->addText($item->tanggal_upload->format('d-m-Y'), $textStyle, $centerParagraph);

            $imageCell = $table->addCell($colScreenshot, $cellStyle);
            $imagePath = $item->screenshot ? public_path('storage/' . $item->screenshot) : null;
            if ($imagePath && file_exists($imagePath)) {
                $imageCell->addImage($imagePath, [
                    'width' => 110,
                    'height' => 85,
                    'alignment' => Jc::CENTER,
                ]);
            } else {
                $imageCell->addText('-', $textStyle, $centerParagraph);
            }
        }

        $writer = IOFactory::createWriter($phpWord, 'Word2007');

        ob_start();
        $writer->save('php://output');
        $wordOutput = ob_get_clean();

        return response($wordOutput, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="konten-sosmed.docx"',
        ]);
    }

    private function buildFilteredQuery(Request $request)
    {
        $kontenQuery = KontenSosmed::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $kontenQuery->where('judul', 'like', "%{$search}%");
        }

        if ($request->filled('platform')) {
            $kontenQuery->where('platform', $request->input('platform'));
        }

        if ($request->filled('month')) {
            $monthInput = $request->input('month');
            $year = $request->input('year');
            $month = null;

            if (str_contains($monthInput, '-')) {
                [$parsedYear, $parsedMonth] = explode('-', $monthInput) + [null, null];
                $year = $year ?: $parsedYear;
                $month = $parsedMonth;
            } else {
                $month = $monthInput;
            }

            if ($year && $month) {
                $kontenQuery->whereYear('tanggal_upload', $year)
                    ->whereMonth('tanggal_upload', $month);
            }
        }

        if ($request->filled('year')) {
            $kontenQuery->whereYear('tanggal_upload', $request->input('year'));
        }

        return $kontenQuery;
    }

    public function create()
    {
        return view('konten-sosmed.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => ['required', 'string', 'max:50'],
            'judul' => ['required', 'string', 'max:255'],
            'link_konten' => ['required', 'url', 'max:2048'],
            'tanggal_upload' => ['required', 'date'],
            'screenshot' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('screenshot')) {
            $validated['screenshot'] = $request->file('screenshot')
                ->store('screenshot', 'public');
        }

        KontenSosmed::create($validated);

        return redirect()
            ->route('konten-sosmed.index')
            ->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(KontenSosmed $kontenSosmed)
    {
        return view('konten-sosmed.edit', compact('kontenSosmed'));
    }

    public function update(Request $request, KontenSosmed $kontenSosmed)
    {
        $validated = $request->validate([
            'platform' => ['required', 'string', 'max:50'],
            'judul' => ['required', 'string', 'max:255'],
            'link_konten' => ['required', 'url', 'max:2048'],
            'tanggal_upload' => ['required', 'date'],
            'screenshot' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('screenshot')) {
            if ($kontenSosmed->screenshot) {
                Storage::disk('public')->delete($kontenSosmed->screenshot);
            }

            $validated['screenshot'] = $request->file('screenshot')
                ->store('screenshot', 'public');
        }

        $kontenSosmed->update($validated);

        return redirect()
            ->route('konten-sosmed.index')
            ->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(KontenSosmed $kontenSosmed)
    {
        if ($kontenSosmed->screenshot) {
            Storage::disk('public')->delete($kontenSosmed->screenshot);
        }

        $kontenSosmed->delete();

        return redirect()
            ->route('konten-sosmed.index')
            ->with('success', 'Konten berhasil dihapus.');
    }
}
