
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#080e0b">

    <title>Sign In | HustleBoard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #080e0b;
            --panel: #101a14;
            --panel2: #142219;
            --border: #26382d;
            --green: #55df80;
            --green-light: #8df0a8;
            --muted: #98a99e;
            --white: #f2f7f3;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 30px 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            background:
                radial-gradient(ellipse at 15% 20%, rgba(42, 133, 72, .16), transparent 38%),
                radial-gradient(ellipse at 85% 85%, rgba(39, 105, 60, .13), transparent 35%),
                var(--bg);
            color: var(--white);
            font-family: 'Inter', sans-serif;
        }

        /* Background decoration */

        .ambient-glow {
            position: fixed;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: .13;
            pointer-events: none;
            z-index: 0;
        }

        .glow-one {
            background: #32bd68;
            top: -180px;
            left: -150px;
        }

        .glow-two {
            background: #1b7540;
            bottom: -200px;
            right: -130px;
        }

        .login-shell {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 960px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border: 1px solid #304638;
            border-radius: 24px;
            background: rgba(16, 26, 20, .94);
            box-shadow:
                0 30px 90px rgba(0, 0, 0, .45),
                0 0 45px rgba(85, 223, 128, .045);
        }

        /* Branding panel */

        .login-brand {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 42px;
            overflow: hidden;
            background:
                linear-gradient(145deg, rgba(16, 55, 31, .96), rgba(8, 22, 14, .98));
            border-right: 1px solid #26382d;
        }

        .login-brand::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border: 1px solid rgba(141, 240, 168, .12);
            border-radius: 50%;
            right: -150px;
            bottom: -110px;
            box-shadow:
                0 0 0 35px rgba(141, 240, 168, .025),
                0 0 0 75px rgba(141, 240, 168, .02);
        }

        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            border-radius: 17px;
            background: rgba(85, 223, 128, .13);
            border: 1px solid rgba(85, 223, 128, .28);
            color: var(--green-light);
            font-size: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }

        .brand-name {
            font-size: 25px;
            font-weight: 900;
            letter-spacing: -1.2px;
            margin: 17px 0 0;
        }

        .brand-name span {
            color: var(--green);
        }

        .brand-heading {
            max-width: 360px;
            margin-top: 65px;
            font-size: clamp(29px, 3.5vw, 40px);
            line-height: 1.18;
            font-weight: 800;
            letter-spacing: -1.6px;
        }

        .brand-heading span {
            color: var(--green-light);
        }

        .brand-description {
            max-width: 340px;
            margin-top: 17px;
            color: #a8bdb0;
            font-size: 13px;
            line-height: 1.9;
        }

        .brand-features {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 34px;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d6e6da;
            font-size: 12px;
        }

        .feature-icon {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 9px;
            background: rgba(85, 223, 128, .12);
            color: var(--green-light);
        }

        .brand-footer {
            margin-top: 65px;
            color: #819889;
            font-size: 11px;
        }

        /* Login panel */

        .login-panel {
            padding: 55px 43px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
        }

        .mobile-logo {
            display: none;
        }

        .login-heading {
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1.1px;
            margin: 0 0 9px;
        }

        .login-subheading {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .form-label {
            color: #dce8df;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #819889;
            font-size: 14px;
            pointer-events: none;
        }

        .login-input {
            width: 100%;
            min-height: 49px;
            padding: 12px 15px 12px 43px;
            border-radius: 10px;
            border: 1px solid #304237;
            outline: none;
            background: #080e0b;
            color: var(--white);
            font-size: 13px;
            transition: .2s;
        }

        .login-input::placeholder {
            color: #718579;
        }

        .login-input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(85, 223, 128, .10);
        }

        .password-input {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            border: 0;
            background: transparent;
            color: #98a99e;
            cursor: pointer;
            transition: .2s;
        }

        .password-toggle:hover {
            color: var(--green);
        }

        .password-toggle:focus-visible {
            outline: 2px solid var(--green);
            border-radius: 6px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 20px 0 25px;
        }

        .remember-row .form-check {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-row .form-check-input {
            width: 16px;
            height: 16px;
            margin: 0;
            background-color: #080e0b;
            border-color: #52665a;
            cursor: pointer;
        }

        .remember-row .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .remember-row .form-check-label {
            color: var(--muted);
            font-size: 11px;
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            min-height: 49px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(100deg, #55df80, #8df0a8);
            color: #07110a;
            font-size: 13px;
            font-weight: 800;
            transition: .25s;
            box-shadow: 0 8px 22px rgba(85, 223, 128, .13);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(85, 223, 128, .22);
            background: linear-gradient(100deg, #69e991, #a0f5b5);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            color: #718579;
            font-size: 11px;
            text-align: center;
            margin-top: 29px;
        }

        .login-footer i {
            color: var(--green);
            margin-right: 5px;
        }

        .login-alert {
            border-radius: 10px;
            font-size: 12px;
            padding: 12px 14px;
        }

        .login-alert ul {
            padding-left: 18px;
        }

        /* Responsive */

        @media(max-width: 767px) {
            body {
                padding: 20px 14px;
            }

            .login-shell {
                max-width: 440px;
                grid-template-columns: 1fr;
                border-radius: 20px;
            }

            .login-brand {
                display: none;
            }

            .login-panel {
                padding: 34px 25px;
            }

            .mobile-logo {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 32px;
            }

            .mobile-logo .brand-logo {
                width: 48px;
                height: 48px;
                border-radius: 13px;
                font-size: 21px;
            }

            .mobile-logo strong {
                font-size: 19px;
                font-weight: 900;
                letter-spacing: -.7px;
            }

            .mobile-logo strong span {
                color: var(--green);
            }

            .login-heading {
                font-size: 26px;
            }

            .login-subheading {
                margin-bottom: 25px;
            }
        }

        @media(max-width: 380px) {
            .login-panel {
                padding: 28px 19px;
            }

            .login-heading {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="ambient-glow glow-one"></div>
    <div class="ambient-glow glow-two"></div>

    <main class="login-shell">

        {{-- LEFT BRANDING PANEL --}}
        <section class="login-brand">

            <div class="brand-content">

                <div class="brand-logo">
                    <i class="fa-solid fa-chart-column"></i>
                </div>

                <h1 class="brand-name">
                    Hustle<span>Board.</span>
                </h1>

                <h2 class="brand-heading">
                    Build your goals.
                    <span>Track your progress.</span>
                    Own your growth.
                </h2>

                <p class="brand-description">
                    Your personal workspace to manage leads, job applications,
                    daily activities, skills and income — all in one place.
                </p>

                <div class="brand-features">

                    <div class="brand-feature">
                        <span class="feature-icon">
                            <i class="fa-solid fa-bullseye"></i>
                        </span>
                        Track your goals and daily progress
                    </div>

                    <div class="brand-feature">
                        <span class="feature-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </span>
                        Monitor your growth and performance
                    </div>

                    <div class="brand-feature">
                        <span class="feature-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        Your private personal workspace
                    </div>

                </div>

            </div>

            <div class="brand-footer">
                © {{ date('Y') }} HustleBoard. Built for your growth.
            </div>

        </section>


        {{-- RIGHT LOGIN PANEL --}}
        <section class="login-panel">

            <div class="mobile-logo">
                <div class="brand-logo">
                    <i class="fa-solid fa-chart-column"></i>
                </div>

                <strong>Hustle<span>Board.</span></strong>
            </div>

            <h2 class="login-heading">Welcome back<span style="color:#55df80">.</span></h2>

            <p class="login-subheading">
                Sign in to continue to your personal workspace.
            </p>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success login-alert mb-3">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
                <div class="alert alert-danger login-alert mb-3">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email Address
                    </label>

                    <div class="input-wrap">

                        <i class="fa-regular fa-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="login-input"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            required
                            autofocus
                        >

                    </div>

                </div>


                {{-- PASSWORD --}}
                <div class="mb-2">

                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="input-wrap">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="login-input password-input"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Show password"
                            aria-pressed="false"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>

                    </div>

                </div>


                {{-- REMEMBER ME --}}
                <div class="remember-row">

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <span style="font-size:10px;color:#718579;">
                        Private Access
                    </span>

                </div>


                {{-- SIGN IN --}}
                <button type="submit" class="login-button">
                    Sign In
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

            <div class="login-footer">
                <i class="fa-solid fa-shield-halved"></i>
                Private workspace · HustleBoard
            </div>

        </section>

    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');

            if (passwordInput && toggleButton) {

                toggleButton.addEventListener('click', function () {

                    const isHidden = passwordInput.type === 'password';
                    const icon = this.querySelector('i');

                    passwordInput.type = isHidden ? 'text' : 'password';

                    icon.classList.toggle('fa-eye', !isHidden);
                    icon.classList.toggle('fa-eye-slash', isHidden);

                    this.setAttribute(
                        'aria-label',
                        isHidden ? 'Hide password' : 'Show password'
                    );

                    this.setAttribute(
                        'aria-pressed',
                        isHidden ? 'true' : 'false'
                    );

                });

            }

        });
    </script>

</body>
</html>
