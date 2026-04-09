<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Manajemen Risiko</title>
    
    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background: white;
            width: 100%;
            max-width: 400px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        /* PERBAIKAN: Box biru dirampingkan (padding dikurangi) */
        .header-section {
            background: linear-gradient(135deg, #003049 0%, #003049 100%);
            padding: 20px 20px; /* Diperkecil dari 30px ke 20px */
            text-align: center;
            color: white;
        }

        /* Box Logo Transparan */
        .logo-box {
            background: transparent;
            width: 80px; /* Sedikit dikecilkan agar box biru ramping */
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px; /* Jarak bawah dikurangi */
            padding: 0;
            box-shadow: none;
        }

        .logo-box img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
        }

        .header-section h1 {
            font-size: 16px; /* Dikecilkan sedikit */
            font-weight: 700;
            margin-bottom: 3px;
            letter-spacing: 0.5px;
        }

        .header-section p {
            font-size: 11px; /* Dikecilkan sedikit */
            opacity: 0.85;
            font-weight: 300;
        }

        .form-section {
            padding: 30px;
        }

        .form-title {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-title h2 {
            font-size: 20px;
            color: #1f2937;
            font-weight: 700;
        }

        .form-title p {
            font-size: 13px;
            color: #6b7280;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 6px;
        }

        .input-relative {
            position: relative;
        }

        .input-relative i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 13px;
        }

        .input-relative input {
            width: 100%;
            padding: 11px 15px 11px 42px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s;
            background: #f9fafb;
        }

        .input-relative input:focus {
            border-color: #4338ca;
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 56, 202, 0.1);
        }

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 11px;
        }

        .btn-login {
            width: 100%;
            background-color: #003049;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background-color: #3730a3;
            transform: translateY(-1px);
            box-shadow: 0 8px 15px rgba(67, 56, 202, 0.2);
        }

        .error-msg {
            color: #dc2626;
            font-size: 11px;
            margin-top: 4px;
            list-style: none;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 10px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="header-section">
            <div class="logo-box">
                <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo AdminLTE">
            </div>
            <h1>Manajemen Risiko</h1>
            <p>Danum Taka Safety</p>
        </div>

        <div class="form-section">
            <div class="form-title">
                <h2>Sign In</h2>
                <p>Silakan masuk ke akun Anda</p>
            </div>

            @if (session('status'))
                <div style="background: #ecfdf5; color: #059669; padding: 10px; border-radius: 8px; font-size: 12px; margin-bottom: 15px; text-align: center;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label>Alamat Email</label>
                    <div class="input-relative">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan Email Anda">
                    </div>
                    @error('email')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Kata Sandi</label>
                    <div class="input-relative">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" required placeholder="Masukkan Password">
                    </div>
                    @error('password')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <div class="options-row">
                    <label style="display: flex; align-items: center; cursor: pointer; color: #6b7280;">
                        <input type="checkbox" name="remember" style="margin-right: 6px;">
                        Ingat saya
                    </label>

                </div>

                <button type="submit" class="btn-login">
                    MASUK SEKARANG
                    <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

            <div class="footer">
                &copy; 2026 Danum Taka Safety. All rights reserved.
            </div>
        </div>
    </div>

</body>
</html>