<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Konten BPMSPH - Akun</title>
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
            gap: 1rem;
            font-size: 0.95rem;
            align-items: center;
        }
        .nav-links a {
            color: rgba(15, 23, 42, 0.75);
            text-decoration: none;
            font-weight: 500;
        }
        .nav-links a:hover {
            color: #0f172a;
        }
        .nav-links button {
            border: 1px solid var(--line);
            background: #0f172a;
            color: #ffffff;
            border-radius: 0.65rem;
            padding: 0.5rem 0.9rem;
            font-weight: 700;
            cursor: pointer;
        }
        .wrap {
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
        .meta {
            margin-top: 1.25rem;
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 0.75rem 1rem;
            align-items: center;
        }
        .meta .k {
            color: var(--muted);
            font-weight: 600;
        }
        .meta .v {
            color: var(--ink);
            font-weight: 600;
        }

        .section {
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(15, 23, 42, 0.10);
        }
        .section h2 {
            margin: 0 0 0.75rem;
            font-size: 1.15rem;
            color: var(--ink);
        }
        .row {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 0.6rem 1rem;
            align-items: center;
            margin-top: 0.75rem;
        }
        .row label {
            color: var(--muted);
            font-weight: 600;
            font-size: 0.95rem;
        }
        .row input {
            width: 100%;
            padding: 0.7rem 0.9rem;
            border-radius: 0.85rem;
            border: 1px solid rgba(15, 23, 42, 0.22);
            background: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--ink);
        }
        .actions {
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
        }
        .btn {
            border: 1px solid rgba(15, 23, 42, 0.22);
            background: #0f172a;
            color: #fff;
            border-radius: 0.85rem;
            padding: 0.65rem 1.1rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }
        .alert {
            margin-top: 1.25rem;
            padding: 0.9rem 1rem;
            border-radius: 0.95rem;
            border: 1px solid rgba(15, 23, 42, 0.18);
            background: rgba(15, 23, 42, 0.04);
            color: var(--ink);
            font-weight: 600;
        }
        .alert.success {
            border-color: rgba(16, 185, 129, 0.35);
            background: rgba(16, 185, 129, 0.10);
            color: #065f46;
        }
        .field-error {
            margin-top: 0.35rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: #991b1b;
        }

        @media (max-width: 720px) {
            .meta {
                grid-template-columns: 1fr;
            }
            .row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<nav>
    <div class="brand">
        <img src="{{ asset('images/foto.png') }}" alt="Logo" class="nav-logo">
    </div>
    <div class="nav-links">
        <a href="{{ route('konten-sosmed.index') }}">Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</nav>

<div class="wrap">
    <div class="card">
        <h1>Profil</h1>

        @if (session('success_profile'))
            <div class="alert success">{{ session('success_profile') }}</div>
        @endif

        @if (session('success_password'))
            <div class="alert success">{{ session('success_password') }}</div>
        @endif

        <div class="meta">
            <div class="k">Nama</div>
            <div class="v">{{ $user?->name }}</div>
            <div class="k">Email</div>
            <div class="v">{{ $user?->email }}</div>
        </div>

        <div class="section">
            <h2>Ubah Nama & Email</h2>
            <form method="POST" action="{{ route('account.update') }}">
                @csrf
                <div class="row">
                    <label for="name">Nama</label>
                    <div>
                        <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}" required>
                        @error('name')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="email">Email</label>
                    <div>
                        <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}" required>
                        @error('email')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" class="btn">Simpan</button>
                </div>
            </form>
        </div>

        <div class="section">
            <h2>Ubah Password</h2>
            <form method="POST" action="{{ route('account.password') }}">
                @csrf
                <div class="row">
                    <label for="current_password">Password Saat Ini</label>
                    <div>
                        <input type="password" id="current_password" name="current_password" required>
                        @error('current_password')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="password">Password Baru</label>
                    <div>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" class="btn">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
