<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Konten BPMSPH</title>
    <link rel="icon" type="image/png" href="{{ asset('images/foto.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #64748b;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --line: rgba(15, 23, 42, 0.35);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
            margin: 0;
            padding: 2rem;
            color: var(--ink);
            min-height: 100vh;
        }
        nav {
            background: rgba(255, 255, 255, 0.92);
            color: #0f172a;
            padding: 1rem 2rem;
            border-radius: 0 0 1.25rem 1.25rem;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .brand {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .nav-logo {
            height: 32px;
            width: auto;
            object-fit: contain;
            background: transparent;
            padding: 0;
            margin: 0;
        }
        .nav-links {
            display: flex;
            gap: 0.5rem;
            font-size: 0.95rem;
            align-items: center;
        }
        .nav-links a {
            color: rgba(15, 23, 42, 0.75);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0.9rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .nav-links a:hover {
            color: #0f172a;
            background: rgba(15, 23, 42, 0.06);
        }
        .nav-links a.active {
            color: #0f172a;
            background: rgba(15, 23, 42, 0.1);
            font-weight: 600;
        }
        .nav-links form {
            margin: 0;
            padding-left: 0.5rem;
            border-left: 1px solid var(--line);
            margin-left: 0.5rem;
        }
        .nav-links button {
            border: 1px solid var(--line);
            background: #0f172a;
            color: #ffffff;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .nav-links button:hover {
            background: #1e293b;
        }
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--line);
        }
        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
            letter-spacing: -0.02em;
        }
        .page-header p {
            font-size: 0.95rem;
            color: var(--muted);
            margin: 0.25rem 0 0;
        }
        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            background: #0f172a;
            color: #ffffff;
            border-radius: 0.65rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.15);
        }
        .add-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -2px rgba(15, 23, 42, 0.2);
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            margin-top: 5rem;
            background: var(--surface);
            border-radius: 1.5rem;
            box-shadow: 
                0 4px 6px -1px rgba(15, 23, 42, 0.05),
                0 10px 15px -3px rgba(15, 23, 42, 0.08),
                0 20px 25px -5px rgba(15, 23, 42, 0.06);
            border: 1px solid var(--line);
            padding: 2.5rem;
            color: var(--ink);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--surface);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--line);
            color: var(--ink);
        }
        th, td {
            padding: 0.9rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--line);
        }
        th {
            background: #0f172a;
            font-size: 0.85rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #ffffff;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.06);
            color: var(--ink);
            font-size: 0.85rem;
        }
        .screenshot-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid rgba(15, 23, 42, 0.18);
            cursor: pointer;
        }
        .preview-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            padding: 2rem;
        }
        .preview-overlay.active {
            display: flex;
        }
        .preview-modal {
            position: relative;
            max-width: 90vw;
            max-height: 85vh;
            background: #0f172a;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
        }
        .preview-image {
            max-width: 85vw;
            max-height: 75vh;
            width: auto;
            height: auto;
            display: block;
            border-radius: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.22);
        }
        .preview-close {
            position: absolute;
            top: -12px;
            right: -12px;
            background: #ffffff;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-weight: 700;
            cursor: pointer;
            color: #1c1917;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
        }
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--line);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.12);
            border-color: rgba(34, 197, 94, 0.35);
            color: #166534;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.35);
            color: #991b1b;
        }
        .search-form {
            background: var(--surface);
            padding: 1.15rem 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--line);
            margin-bottom: 1.5rem;
            display: flex;
            gap: 2.25rem;
            align-items: end;
            flex-wrap: wrap;
        }
        .search-group {
            flex: 0 1 170px;
            min-width: 170px;
            max-width: 190px;
        }
        .search-group:first-child {
            flex: 0 1 260px;
            min-width: 220px;
            max-width: 260px;
        }
        .search-actions {
            flex: 0 0 auto;
        }
        .search-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: var(--ink);
            height: 20px;
        }
        .search-group input {
            width: 100%;
            padding: 0.55rem 0.75rem;
            height: 34px;
            border-radius: 0.65rem;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--ink);
            font-size: 0.92rem;
        }
        .search-group input:focus {
            outline: 2px solid rgba(15, 23, 42, 0.25);
            outline-offset: 2px;
        }
        .search-group select {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border-radius: 0.65rem;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--ink);
            font-size: 0.95rem;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.6)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.85rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
        .custom-select {
            position: relative;
            width: 100%;
        }
        .custom-select-toggle {
            width: 100%;
            padding: 0.55rem 0.75rem;
            height: 34px;
            border-radius: 0.65rem;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--ink);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        .custom-select-toggle:focus {
            outline: 2px solid rgba(15, 23, 42, 0.25);
            outline-offset: 2px;
        }
        .custom-select-toggle span {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .custom-select-menu {
            position: absolute;
            top: calc(100% + 0.35rem);
            left: 0;
            right: 0;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 0.75rem;
            box-shadow: 0 16px 30px rgba(15, 23, 42, 0.12);
            max-height: 260px;
            overflow-y: auto;
            padding: 0.35rem;
            display: none;
            z-index: 20;
        }
        .custom-select-menu.open {
            display: block;
        }
        .custom-select-option {
            padding: 0.55rem 0.75rem;
            border-radius: 0.55rem;
            color: var(--ink);
            font-size: 0.9rem;
            cursor: pointer;
        }
        .custom-select-option:hover,
        .custom-select-option.active {
            background: rgba(15, 23, 42, 0.06);
            color: var(--ink);
        }
        .search-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }
        .search-actions::before {
            content: "";
            display: block;
            height: calc(20px + 0.4rem);
        }
        .search-form button {
            border: none;
            padding: 0.55rem 1.05rem;
            border-radius: 0.65rem;
            background: #0f172a;
            color: #ffffff;
            font-weight: 700;
            cursor: pointer;
            font-size: 0;
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .search-form button::before {
            content: "🔍";
            font-size: 1.25rem;
        }
        .search-form a {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--ink);
            padding: 0.65rem 1.25rem;
            border-radius: 0.65rem;
            text-decoration: none;
            font-weight: 600;
        }
        .export-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 0.95rem 1.15rem;
            background: var(--surface);
            border-radius: 0.75rem;
            border: 1px solid var(--line);
        }
        .export-filters {
            display: flex;
            gap: 1.5rem;
            column-gap: 1.5rem;
            row-gap: 1rem;
            align-items: end;
            flex-wrap: wrap;
        }
        .export-filter {
            min-width: 160px;
            display: flex;
            flex-direction: column;
            max-width: 190px;
        }
        .export-filter:not(:last-child) {
            margin-right: 1.5rem;
        }
        .export-filter label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 0.35rem;
        }
        .export-filter .custom-select-toggle {
            height: 36px;
            border: 1px solid var(--line);
            background: var(--surface);
            font-size: 0.92rem;
        }
        .export-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .export-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.5rem 0.95rem;
            border-radius: 0.6rem;
            text-decoration: none;
            font-weight: 600;
            color: #ffffff;
            height: 36px;
            font-size: 0.88rem;
            border: none;
            background: #0f172a;
            transition: all 0.15s ease;
        }
        .export-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(15, 23, 42, 0.2);
        }
        .export-pdf {
            background: #0f172a;
            color: #fff;
        }
        .export-excel {
            background: #0f172a;
            color: #fff;
        }
        .export-word {
            background: #0f172a;
            color: #fff;
        }
        .search-active {
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: var(--muted);
        }
        .action-cell {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .action-link,
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.4rem 0.85rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .action-link {
            background: #0f172a;
        }
        .action-button {
            background: rgba(15, 23, 42, 0.72);
        }
        .action-icon {
            font-size: 0.9rem;
            line-height: 1;
        }
        .empty {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
            background: rgba(15, 23, 42, 0.02);
            border-radius: 1rem;
            border: 1px dashed var(--line);
        }
        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        .empty h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--ink);
            margin: 0 0 0.5rem;
        }
        .empty p {
            margin: 0 0 1.5rem;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
<nav>
    <div class="brand">
        <img src="{{ asset('images/foto.png') }}" alt="Logo BPMPH" class="nav-logo">
    </div>
    <div class="nav-links">
        <a href="{{ route('konten-sosmed.index') }}">Dashboard</a>
        <a href="{{ route('account') }}">Akun</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</nav>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="page-header">
        <div>
            <h1>Recap Konten</h1>
            <p>Kelola dan pantau konten sosial media BPMSPH</p>
        </div>
        <a href="{{ route('konten-sosmed.create') }}" class="add-btn">
            <span>+</span> Tambah Konten
        </a>
    </div>

    <form class="search-form" method="GET" action="{{ route('konten-sosmed.index') }}">
        <div class="search-group">
            <label for="search">Cari Judul</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Ketik judul konten...">
        </div>
        <div class="search-group">
            <label for="platform">Platform</label>
            <div class="custom-select" data-target="platform">
                <input type="hidden" id="platform" name="platform" value="{{ request('platform') }}">
                <div class="custom-select-toggle" role="button" aria-haspopup="listbox" aria-expanded="false">
                    <span class="custom-select-label">
                        {{ request('platform') ? request('platform') : 'Semua Platform' }}
                    </span>
                    <span aria-hidden="true">▼</span>
                </div>
                <div class="custom-select-menu" role="listbox">
                    <div class="custom-select-option {{ request('platform') ? '' : 'active' }}" data-value="">
                        Semua Platform
                    </div>
                    @foreach ($platformOptions as $option)
                        <div class="custom-select-option {{ request('platform') === $option ? 'active' : '' }}" data-value="{{ $option }}">
                            {{ $option }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="search-group">
            <label for="month">Bulan Upload</label>
            <div class="custom-select" data-target="month">
                <input type="hidden" id="month" name="month" value="{{ request('month') }}">
                <div class="custom-select-toggle" role="button" aria-haspopup="listbox" aria-expanded="false">
                    <span class="custom-select-label">
                        {{ request('month') ? \Carbon\Carbon::parse(request('month') . '-01')->translatedFormat('F') : 'Semua Bulan' }}
                    </span>
                    <span aria-hidden="true">▼</span>
                </div>
                <div class="custom-select-menu" role="listbox">
                    <div class="custom-select-option {{ request('month') ? '' : 'active' }}" data-value="">
                        Semua Bulan
                    </div>
                    @for ($m = 1; $m <= 12; $m++)
                        @php
                            $value = date('Y-m', strtotime(date('Y') . "-{$m}-01"));
                        @endphp
                        <div class="custom-select-option {{ request('month') === $value ? 'active' : '' }}" data-value="{{ $value }}">
                            {{ \Carbon\Carbon::create(date('Y'), $m)->translatedFormat('F') }}
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="search-group">
            <label for="year">Tahun</label>
            <div class="custom-select" data-target="year">
                <input type="hidden" id="year" name="year" value="{{ request('year') }}">
                <div class="custom-select-toggle" role="button" aria-haspopup="listbox" aria-expanded="false">
                    <span class="custom-select-label">
                        {{ request('year') ? request('year') : 'Semua Tahun' }}
                    </span>
                    <span aria-hidden="true">▼</span>
                </div>
                <div class="custom-select-menu" role="listbox">
                    <div class="custom-select-option {{ request('year') ? '' : 'active' }}" data-value="">
                        Semua Tahun
                    </div>
                    @foreach ($yearOptions as $year)
                        <div class="custom-select-option {{ request('year') == $year ? 'active' : '' }}" data-value="{{ $year }}">
                            {{ $year }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="search-actions">
            <button type="submit">Cari</button>
            @if(request('search') || request('platform') || request('month') || request('year'))
                <a href="{{ route('konten-sosmed.index') }}">Reset</a>
            @endif
        </div>
    </form>

    <div class="export-actions">
        <div class="export-filters">
            <div class="export-filter">
                <label for="export-month">Bulan Export</label>
                <div class="custom-select" data-target="export-month">
                    <input type="hidden" id="export-month" value="">
                    <div class="custom-select-toggle" role="button" aria-haspopup="listbox" aria-expanded="false">
                        <span class="custom-select-label">Pilih Bulan</span>
                        <span aria-hidden="true">▼</span>
                    </div>
                    <div class="custom-select-menu" role="listbox">
                        <div class="custom-select-option active" data-value="">Pilih Bulan</div>
                        @for ($m = 1; $m <= 12; $m++)
                            <div class="custom-select-option" data-value="{{ $m }}">
                                {{ \Carbon\Carbon::create(date('Y'), $m)->translatedFormat('F') }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="export-filter">
                <label for="export-year">Tahun Export</label>
                <div class="custom-select" data-target="export-year">
                    <input type="hidden" id="export-year" value="">
                    <div class="custom-select-toggle" role="button" aria-haspopup="listbox" aria-expanded="false">
                        <span class="custom-select-label">Pilih Tahun</span>
                        <span aria-hidden="true">▼</span>
                    </div>
                    <div class="custom-select-menu" role="listbox">
                        <div class="custom-select-option active" data-value="">Pilih Tahun</div>
                        @foreach ($yearOptions as $year)
                            <div class="custom-select-option" data-value="{{ $year }}">{{ $year }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="export-buttons">
            <a class="export-button export-pdf" data-base-href="{{ route('konten-sosmed.export.pdf') }}" href="{{ route('konten-sosmed.export.pdf') }}?{{ http_build_query(request()->query()) }}">PDF</a>
            <a class="export-button export-word" data-base-href="{{ route('konten-sosmed.export.word') }}" href="{{ route('konten-sosmed.export.word') }}?{{ http_build_query(request()->query()) }}">Word</a>
        </div>
    </div>

    @if(request('search') || request('platform') || request('month') || request('year'))
        <div class="search-active">
            Menampilkan:
            @if(request('search'))<strong>Pencarian: {{ request('search') }}</strong>@endif
            @if(request('search') && (request('platform') || request('month') || request('year'))) | @endif
            @if(request('platform'))<strong>Platform: {{ request('platform') }}</strong>@endif
            @if(request('platform') && (request('month') || request('year'))) | @endif
            @if(request('month'))<strong>Bulan: {{ \Carbon\Carbon::parse(request('month') . '-01')->translatedFormat('F') }}</strong>@endif
            @if(request('month') && request('year')) | @endif
            @if(request('year'))<strong>Tahun: {{ request('year') }}</strong>@endif
        </div>
    @endif

    @if ($konten->isEmpty())
        <div class="empty">
            <div class="empty-icon">📋</div>
            <h3>Belum Ada Data</h3>
            <p>Mulai tambahkan konten pertama Anda untuk mengelola dokumentasi sosial media.</p>
            <a href="{{ route('konten-sosmed.create') }}" class="add-btn">
                <span>+</span> Tambah Konten
            </a>
        </div>
    @else
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Platform</th>
                <th>Judul</th>
                <th>Link</th>
                <th>Tanggal Upload</th>
                <th>Screenshot</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($konten as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge">{{ $item->platform }}</span></td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        @if (!empty($item->link_konten))
                            <a href="{{ $item->link_konten }}" target="_blank" rel="noopener noreferrer">Buka</a>
                        @else
                            <span style="color:#94a3b8;">-</span>
                        @endif
                    </td>
                    <td>{{ $item->tanggal_upload->translatedFormat('d F Y') }}</td>
                    <td>
                        @if ($item->screenshot)
                            <img class="screenshot-thumb" src="{{ asset('storage/' . $item->screenshot) }}" data-full="{{ asset('storage/' . $item->screenshot) }}" alt="Screenshot {{ $item->judul }}">
                        @else
                            <span style="color:#94a3b8;">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-cell">
                            <a class="action-link" href="{{ route('konten-sosmed.edit', $item) }}">
                                <span class="action-icon">✏️</span>
                                Edit
                            </a>
                            <form action="{{ route('konten-sosmed.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus konten ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="action-button" type="submit">
                                    <span class="action-icon">🗑️</span>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
<div class="preview-overlay" id="previewOverlay">
    <div class="preview-modal">
        <button class="preview-close" type="button" aria-label="Tutup">×</button>
        <img class="preview-image" src="" alt="Preview Screenshot">
    </div>
</div>
<script>
    document.querySelectorAll('.custom-select').forEach(function (select) {
        const toggle = select.querySelector('.custom-select-toggle');
        const menu = select.querySelector('.custom-select-menu');
        const input = select.querySelector('input[type="hidden"]');
        const label = select.querySelector('.custom-select-label');
        const options = select.querySelectorAll('.custom-select-option');

        function closeMenu() {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', function (event) {
            event.stopPropagation();
            const isOpen = menu.classList.contains('open');
            document.querySelectorAll('.custom-select-menu.open').forEach(function (openMenu) {
                openMenu.classList.remove('open');
            });
            menu.classList.toggle('open', !isOpen);
            toggle.setAttribute('aria-expanded', String(!isOpen));
        });

        options.forEach(function (option) {
            option.addEventListener('click', function () {
                const value = option.getAttribute('data-value');
                input.value = value;
                label.textContent = option.textContent.trim();
                options.forEach(function (opt) {
                    opt.classList.remove('active');
                });
                option.classList.add('active');
                closeMenu();
            });
        });

        document.addEventListener('click', function () {
            closeMenu();
        });
    });

    const exportMonth = document.getElementById('export-month');
    const exportYear = document.getElementById('export-year');
    const baseQuery = @json(request()->query());

    document.querySelectorAll('.export-button').forEach(function (button) {
        button.addEventListener('click', function (event) {
            const month = exportMonth.value;
            const year = exportYear.value;

            if (!month || !year) {
                event.preventDefault();
                alert('Pilih bulan dan tahun terlebih dahulu sebelum export.');
                return;
            }

            const params = new URLSearchParams(baseQuery);
            params.set('month', month);
            params.set('year', year);
            button.href = `${button.dataset.baseHref}?${params.toString()}`;
        });
    });

    const previewOverlay = document.getElementById('previewOverlay');
    const previewImage = previewOverlay.querySelector('.preview-image');
    const previewClose = previewOverlay.querySelector('.preview-close');

    document.querySelectorAll('.screenshot-thumb').forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            previewImage.src = thumb.dataset.full || thumb.src;
            previewOverlay.classList.add('active');
        });
    });

    function closePreview() {
        previewOverlay.classList.remove('active');
        previewImage.src = '';
    }

    previewClose.addEventListener('click', closePreview);
    previewOverlay.addEventListener('click', function (event) {
        if (event.target === previewOverlay) {
            closePreview();
        }
    });
</script>
</body>
</html>
