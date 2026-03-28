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
    <title>Reset Password — {{ $konf->instansi_setting }}</title>
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
            --success: #2ecc71;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0f2f5 0%, #e8e0f5 100%);
            padding: 30px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px rgba(125, 42, 232, 0.15);
            width: 100%;
            max-width: 460px;
        }

        .card-logo {
            text-align: center;
            margin-bottom: 24px;
        }

        .card-logo img {
            max-height: 70px;
            object-fit: contain;
        }

        .card-logo .brand-name {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
        }

        .card-logo .brand-sub {
            font-size: 13px;
            color: #888;
            margin-top: 2px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            position: relative;
            padding-bottom: 12px;
        }

        .card-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 30px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        .card-desc {
            font-size: 13.5px;
            color: #666;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-danger {
            background: #fdecea;
            color: #a62117;
            border-left: 4px solid var(--danger);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 13.5px;
            font-weight: 500;
            color: #444;
            margin-bottom: 8px;
        }

        .input-box {
            display: flex;
            align-items: center;
            height: 50px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.15);
            transition: border-color 0.3s;
            position: relative;
        }

        .input-box:focus-within {
            border-color: var(--primary);
        }

        .input-box i {
            color: var(--primary);
            font-size: 16px;
            width: 20px;
            flex-shrink: 0;
        }

        .input-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0 12px;
            font-size: 15px;
            font-weight: 500;
            color: #333;
            background: transparent;
        }

        .toggle-password {
            background: none;
            border: none;
            cursor: pointer;
            color: #aaa;
            font-size: 15px;
            padding: 0;
            line-height: 1;
            transition: color 0.2s;
        }

        .toggle-password:hover { color: var(--primary); }

        .password-strength {
            margin-top: 6px;
            height: 4px;
            border-radius: 2px;
            background: #eee;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .strength-weak   { width: 33%; background: #e74c3c; }
        .strength-medium { width: 66%; background: #f39c12; }
        .strength-strong { width: 100%; background: #2ecc71; }

        .btn-submit {
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: all 0.3s;
            margin-top: 4px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            box-shadow: 0 8px 25px rgba(125, 42, 232, 0.35);
            transform: translateY(-1px);
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 13.5px;
            color: #888;
            text-decoration: none;
            margin-top: 24px;
            transition: color 0.3s;
        }

        .back-link:hover { color: var(--primary); }

        @media (max-width: 500px) {
            .card { padding: 36px 24px; }
        }
    </style>
</head>
<body>
    <div class="card">
        {{-- Logo --}}
        <div class="card-logo">
            @if($konf->logo_login_setting)
                <img src="{{ asset('logo/' . $konf->logo_login_setting) }}" alt="Logo">
            @elseif($konf->logo_setting)
                <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo">
            @else
                <div class="brand-name">{{ $konf->instansi_setting }}</div>
            @endif
            <div class="brand-sub">Baju Adat Bali</div>
        </div>

        <div class="card-title">Reset Password</div>
        <p class="card-desc">Buat password baru yang kuat untuk melindungi akun Anda.</p>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        placeholder="contoh@email.com"
                        required
                        autofocus
                        autocomplete="username"
                        readonly
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Min. 8 karakter"
                        required
                        autocomplete="new-password"
                        oninput="checkStrength(this.value)"
                    >
                    <button type="button" class="toggle-password" onclick="toggleVis('password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" onclick="toggleVis('password_confirmation', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-key" style="margin-right:8px;"></i>
                Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke halaman login
        </a>
    </div>

    <script>
        function toggleVis(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function checkStrength(val) {
            const bar = document.getElementById('strengthBar');
            bar.className = 'password-strength-bar';
            if (!val) return;
            const strong = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(val);
            const medium = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/.test(val);
            if (strong) {
                bar.classList.add('strength-strong');
            } else if (medium) {
                bar.classList.add('strength-medium');
            } else if (val.length >= 4) {
                bar.classList.add('strength-weak');
            }
        }
    </script>
</body>
</html>
