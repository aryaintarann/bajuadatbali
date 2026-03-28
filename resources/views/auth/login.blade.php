<?php
use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first() ?? (object)[
    'instansi_setting'   => 'Baju Adat Bali',
    'logo_setting'       => null,
    'logo_login_setting' => null,
    'favicon_setting'    => null,
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ $konf->instansi_setting }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @if($konf->favicon_setting)
    <link rel="icon" href="{{ asset('logo/' . $konf->favicon_setting) }}">
    @endif
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        :root {
            --primary: #7d2ae8;
            --primary-dark: #5b13b9;
            --primary-light: #a85cf9;
            --danger: #e74c3c;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 24px;
        }

        /* ===== WRAPPER ===== */
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        }

        /* ===== LEFT PANEL (banner) ===== */
        .left-panel {
            flex: 1;
            background: linear-gradient(145deg, var(--primary) 0%, #4a0080 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .left-panel .panel-logo {
            max-height: 80px;
            object-fit: contain;
            margin-bottom: 24px;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
            position: relative;
            z-index: 1;
        }

        .left-panel .brand-name {
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
        }

        .left-panel .brand-tagline {
            font-size: 14px;
            color: rgba(255,255,255,0.75);
            line-height: 1.6;
            position: relative;
            z-index: 1;
            max-width: 220px;
        }

        .left-panel .decorative-dots {
            position: absolute;
            bottom: 30px;
            right: 30px;
            display: grid;
            grid-template-columns: repeat(4, 8px);
            gap: 6px;
            z-index: 1;
        }

        .left-panel .decorative-dots span {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
        }

        /* ===== RIGHT PANEL (form) ===== */
        .right-panel {
            width: 420px;
            flex-shrink: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 44px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #888;
            margin-bottom: 36px;
        }

        /* ===== ERROR ALERT ===== */
        .alert-error {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: #fdecea;
            border-left: 3px solid var(--danger);
            border-radius: 8px;
            font-size: 13px;
            color: #a62117;
            margin-bottom: 20px;
        }

        /* ===== FORM FIELDS ===== */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #e8e8e8;
            transition: border-color 0.25s;
        }

        .input-wrapper:focus-within {
            border-color: var(--primary);
        }

        .input-wrapper i {
            color: #bbb;
            font-size: 15px;
            width: 18px;
            flex-shrink: 0;
            transition: color 0.25s;
        }

        .input-wrapper:focus-within i {
            color: var(--primary);
        }

        .input-wrapper input {
            flex: 1;
            border: none;
            outline: none;
            padding: 10px 12px;
            font-size: 15px;
            font-weight: 500;
            color: #333;
            background: transparent;
        }

        .input-wrapper input::placeholder {
            color: #ccc;
            font-weight: 400;
        }

        .toggle-pwd {
            background: none;
            border: none;
            cursor: pointer;
            color: #ccc;
            font-size: 14px;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-pwd:hover { color: var(--primary); }

        /* ===== FORGOT PASSWORD ===== */
        .forgot-link {
            display: flex;
            justify-content: flex-end;
            margin-top: 6px;
        }

        .forgot-link a {
            font-size: 12.5px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-login {
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: all 0.3s;
            margin-top: 28px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            box-shadow: 0 10px 30px rgba(125, 42, 232, 0.4);
            transform: translateY(-1px);
        }

        .btn-login:active { transform: translateY(0); }

        /* ===== BACK LINK ===== */
        .back-to-site {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 13px;
            color: #aaa;
            text-decoration: none;
            margin-top: 24px;
            transition: color 0.2s;
        }

        .back-to-site:hover { color: var(--primary); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 720px) {
            .login-wrapper { flex-direction: column; max-width: 440px; min-height: auto; }
            .left-panel { padding: 36px 32px; min-height: auto; }
            .right-panel { width: 100%; padding: 36px 32px; }
            .brand-name { font-size: 20px; }
            .left-panel .brand-tagline { display: none; }
        }

        @media (max-width: 480px) {
            .right-panel { padding: 30px 24px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; animation: none !important; }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">

        {{-- ===== LEFT BANNER PANEL ===== --}}
        <div class="left-panel">
            @if($konf->logo_login_setting)
                <img src="{{ asset('logo/' . $konf->logo_login_setting) }}" alt="Logo" class="panel-logo">
            @elseif($konf->logo_setting)
                <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo" class="panel-logo">
            @endif
            <div class="brand-name">{{ $konf->instansi_setting }}</div>
            <p class="brand-tagline">Platform busana adat Bali terpercaya.<br>Silakan masuk untuk melanjutkan.</p>

            <div class="decorative-dots">
                @for ($i = 0; $i < 16; $i++)
                    <span></span>
                @endfor
            </div>
        </div>

        {{-- ===== RIGHT FORM PANEL ===== --}}
        <div class="right-panel">
            <h1 class="form-title">Selamat Datang 👋</h1>
            <p class="form-subtitle">Masuk ke akun Anda untuk melanjutkan</p>

            {{-- Error notification --}}
            @if ($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Success session (e.g., setelah reset password) --}}
            @if (session('status'))
                <div style="padding:12px 14px; background:#d4edda; border-left:3px solid #28a745; border-radius:8px; font-size:13px; color:#155724; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input
                            id="login-email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="contoh@email.com"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input
                            id="login-password"
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-pwd" onclick="togglePwd()" tabindex="-1">
                            <i class="fas fa-eye" id="pwd-eye"></i>
                        </button>
                    </div>
                    <div class="forgot-link">
                        <a href="{{ route('password.request') }}">Lupa Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="btn-login-submit">
                    <i class="fas fa-sign-in-alt" style="margin-right:8px;"></i>Masuk
                </button>
            </form>

            <a href="{{ url('/') }}" class="back-to-site">
                <i class="fas fa-arrow-left"></i> Kembali ke Website
            </a>
        </div>

    </div>

    <script>
        function togglePwd() {
            const input = document.getElementById('login-password');
            const icon  = document.getElementById('pwd-eye');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>