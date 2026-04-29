<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Konten BPMSPH - Tambah Konten</title>
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
            background: var(--surface-soft);
            margin: 0;
            padding: 2rem 1.5rem;
            color: var(--ink);
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
        .container {
            max-width: 980px;
            margin: 5rem auto 0;
        }
        .card {
            max-width: 760px;
            margin: 0 auto;
            background: var(--surface);
            padding: 2rem 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 25px 45px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--line);
        }
        .card h1 {
            margin: 0;
            font-size: 1.75rem;
            color: var(--ink);
        }
        .card p {
            margin: 0.35rem 0 2rem;
            color: var(--muted);
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 2.25rem 3rem;
            max-width: none;
            margin: 0;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: var(--ink);
        }
        input, select {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--line);
            background: var(--surface);
            font-size: 0.95rem;
            color: var(--ink);
            height: 46px;
            box-sizing: border-box;
        }
        input:focus, select:focus {
            outline: 2px solid rgba(15, 23, 42, 0.25);
            outline-offset: 2px;
        }
        input[type="file"] {
            border-radius: 0.75rem;
            padding: 0.45rem 0.9rem;
            background: var(--surface);
            height: 46px;
        }
        .full {
            grid-column: 1 / -1;
        }
        .actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }
        button {
            border: none;
            padding: 0.85rem 2.5rem;
            border-radius: 0.75rem;
            background: #0f172a;
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.14);
        }
        a.back-link {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.9rem;
            align-self: center;
        }
        .error {
            color: #991b1b;
            font-size: 0.85rem;
            margin-top: 0.35rem;
        }
        @media (max-width: 720px) {
            .grid {
                grid-template-columns: 1fr;
            }
            .card {
                padding: 1.5rem;
            }
            .actions {
                flex-direction: column;
                align-items: stretch;
            }
            button {
                width: 100%;
            }
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
    <div class="card">
        <h1>Tambah Konten Sosial Media</h1>
        <p>Lengkapi data konten yang akan diunggah untuk penjadwalan dan dokumentasi.</p>

        <form action="{{ route('konten-sosmed.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid">
                <div>
                    <label for="platform">Platform</label>
                    <input type="text" id="platform" name="platform" value="{{ old('platform') }}" required>
                    @error('platform')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="judul">Judul Konten</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="full">
                    <label for="link_konten">Link Konten</label>
                    <input type="url" id="link_konten" name="link_konten" value="{{ old('link_konten') }}" placeholder="https://..." required>
                    @error('link_konten')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_upload">Tanggal Upload</label>
                    <input type="date" id="tanggal_upload" name="tanggal_upload" value="{{ old('tanggal_upload') }}" required>
                    @error('tanggal_upload')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="screenshot">Screenshot (Opsional)</label>
                    <input type="file" id="screenshot" name="screenshot" accept="image/*">
                    @error('screenshot')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="actions">
                <button type="submit">Simpan</button>
                <a class="back-link" href="{{ route('konten-sosmed.index') }}">&larr; Kembali ke daftar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
