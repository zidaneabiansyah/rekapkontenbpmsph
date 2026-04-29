<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Konten BPMSPH - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/foto.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #64748b;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --line: rgba(15, 23, 42, 0.18);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }
        .login-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 1.25rem;
        }
        .logo {
            width: 56px;
            height: 56px;
            object-fit: contain;
            margin-bottom: 0.75rem;
            filter: none;
        }
        .brand-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.02em;
        }
        .brand-tagline {
            font-size: 0.88rem;
            color: var(--muted);
            margin-top: 0.25rem;
        }
        .card {
            background: var(--surface);
            padding: 2rem;
            border-radius: 1.25rem;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--line);
        }
        .card-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .card-header h1 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 0.5rem;
        }
        .card-header p {
            font-size: 0.95rem;
            color: var(--muted);
            line-height: 1.5;
        }
        .field {
            margin-bottom: 1.25rem;
        }
        .field label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--ink);
        }
        .input-wrapper {
            position: relative;
        }
        .input-wrapper svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: var(--muted);
            transition: color 0.2s ease;
        }
        .input-wrapper input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 3rem;
            border-radius: 0.75rem;
            border: 1.5px solid var(--line);
            background: var(--surface);
            font-size: 0.95rem;
            color: var(--ink);
            font-family: inherit;
            transition: all 0.2s ease;
        }
        .input-wrapper input:focus {
            outline: none;
            border-color: rgba(15, 23, 42, 0.4);
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.05);
        }
        .input-wrapper input:focus + svg {
            color: var(--ink);
        }
        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .remember input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1.5px solid var(--line);
            cursor: pointer;
            accent-color: var(--ink);
        }
        .remember span {
            font-size: 0.9rem;
            color: var(--muted);
            font-weight: 500;
        }
        .submit-btn {
            width: 100%;
            padding: 0.9rem 1.5rem;
            border-radius: 0.75rem;
            border: none;
            background: #0f172a;
            color: #ffffff;
            font-weight: 600;
            font-size: 1rem;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.18);
        }
        .submit-btn:hover {
            background: #111c33;
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.22);
        }
        .submit-btn:active {
            transform: translateY(0);
        }
        .error {
            margin-top: 0.75rem;
            padding: 0.75rem 1rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.5rem;
            color: #dc2626;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: var(--muted);
        }
        @media (max-width: 480px) {
            .card {
                padding: 2rem 1.5rem;
            }
            .logo {
                width: 64px;
                height: 64px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset('images/foto.png') }}" alt="Logo BPMSPH" class="logo">
            <div class="brand-name">Rekap Konten BPMSPH</div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1>Selamat Datang</h1>
                <p>Silakan masukkan email dan password Anda untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="field">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@rekap.local" required autocomplete="email" autofocus>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    @error('email')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    @error('password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember" value="1">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="submit-btn">Masuk</button>
            </form>
        </div>

        <div class="footer-text">
            &copy; {{ date('Y') }} Rekap Konten BPMSPH. All rights reserved.
        </div>
    </div>
</body>
</html>
