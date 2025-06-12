<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPANDU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            margin: 0;
        }

        .header-bar {
            background: linear-gradient(135deg, #4a5acf, #6b73e8);
            height: 60px;
            width: 100%;
        }

        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 40px auto;
            max-width: 900px;
        }

        .left-panel {
            background: linear-gradient(135deg, #4a5acf, #6b73e8);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-50px, -50px);
            }
        }

        .welcome-title {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            z-index: 2;
            position: relative;
        }

        .welcome-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 40px;
            z-index: 2;
            position: relative;
        }

        .illustration {
            position: relative;
            z-index: 2;
            margin-bottom: 20px;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: rotate(-5deg);
            position: relative;
        }

        .chart-orange {
            background: linear-gradient(135deg, #ff9f43, #feca57);
            border-radius: 8px;
            padding: 15px;
            transform: rotate(10deg);
            margin-left: 30px;
            margin-top: -10px;
        }

        .person-illustration {
            width: 80px;
            height: 80px;
            background: #ff6b9d;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            position: relative;
            margin: 20px auto;
        }

        .person-illustration::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            width: 50px;
            height: 35px;
            background: #fff;
            border-radius: 50%;
        }

        .plants {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            z-index: 2;
        }

        .plant {
            width: 40px;
            height: 60px;
            background: #2ed573;
            border-radius: 50px 50px 0 0;
            position: relative;
        }

        .plant::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 15px;
            width: 10px;
            height: 20px;
            background: #5f27cd;
        }

        .tree {
            width: 60px;
            height: 80px;
            background: #ffa502;
            border-radius: 50%;
            position: relative;
        }

        .tree::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 25px;
            width: 10px;
            height: 20px;
            background: #8b4513;
        }

        .right-panel {
            padding: 60px 50px;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            background: #4a5acf;
            border: none;
            color: white;
            padding: 18px 20px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.8);
            font-weight: normal;
        }

        .form-control:focus {
            background: #3d4bc2;
            box-shadow: 0 0 0 3px rgba(74, 90, 207, 0.3);
            color: white;
        }

        .btn-login {
            background: linear-gradient(135deg, #4a5acf, #6b73e8);
            border: none;
            color: white;
            padding: 18px;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #3d4bc2, #5a65e5);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 90, 207, 0.4);
            color: white;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }

        .signup-link a {
            color: #4a5acf;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 20px;
            }

            .left-panel,
            .right-panel {
                padding: 40px 30px;
            }

            .welcome-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="header-bar"></div>

    <div class="container-fluid">
        <div class="main-container">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="left-panel">
                        <div class="welcome-title">SELAMAT DATANG DI SIPANDU</div>
                        <div class="welcome-subtitle">Website Pelabuhan untuk Pembelajaran Dosen dan Mahasiswa</div>

                        <div class="illustration">
                            <div class="chart-container">
                                <svg width="120" height="80" viewBox="0 0 120 80">
                                    <path d="M10 70 Q30 40 50 50 T90 30 L110 20" stroke="#4a5acf" stroke-width="3"
                                        fill="none" />
                                    <circle cx="90" cy="30" r="4" fill="#ff6b9d" />
                                    <circle cx="50" cy="50" r="3" fill="#2ed573" />
                                    <circle cx="110" cy="20" r="3" fill="#ffa502" />
                                </svg>
                            </div>
                            <div class="chart-orange">
                                <svg width="100" height="60" viewBox="0 0 100 60">
                                    <path d="M10 50 L30 30 L50 40 L70 20 L90 25" stroke="white" stroke-width="2"
                                        fill="none" />
                                    <rect x="10" y="45" width="4" height="10" fill="white" opacity="0.7" />
                                    <rect x="25" y="35" width="4" height="20" fill="white" opacity="0.7" />
                                    <rect x="45" y="40" width="4" height="15" fill="white" opacity="0.7" />
                                </svg>
                            </div>
                            <div class="person-illustration"></div>
                        </div>

                        <div class="plants">
                            <div class="plant"></div>
                            <div class="tree"></div>
                            <div class="plant" style="height: 50px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="right-panel">
                        <h2 class="login-title">LOGIN</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-login">Login</button>
                        </form>

                        <div class="signup-link">
                            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
