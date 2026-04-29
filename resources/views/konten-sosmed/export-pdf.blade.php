<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Konten BPMSPH</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
        }
        h1 {
            font-size: 16px;
            margin-bottom: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background: #f3f4f6;
        }
    </style>
</head>
<body>
    <h1>Rekap Konten Sosmed</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Platform</th>
                <th>Judul</th>
                <th>Link</th>
                <th>Tanggal Upload</th>
                <th>Screenshot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konten as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->platform }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        @if (!empty($item->link_konten))
                            <a href="{{ $item->link_konten }}">{{ $item->link_konten }}</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->tanggal_upload->format('Y-m-d') }}</td>
                    <td>
                        @if ($item->screenshot && file_exists(public_path('storage/' . $item->screenshot)))
                            <img src="{{ public_path('storage/' . $item->screenshot) }}" alt="Screenshot" width="80">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
