<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom,
                    #bfe5ff,
                    #dff1ff);
            height: 100vh;
        }

        .container {
            width: 340px;
            margin: 40px auto;
            background: white;
            border-radius: 30px;
            padding: 35px 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo h2 {
            margin: 10px 0 5px;
            color: #1f2d5a;
            font-size: 30px;
        }

        .logo p {
            color: #888;
            font-size: 13px;
            line-height: 20px;
        }

        .input-group {
            margin-top: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            border: 1px solid #1f2d5a;
            border-radius: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .options {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #999;
        }

        .login-btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 25px;
            background: #1f2d5a;
            color: white;
            font-size: 15px;
            margin-top: 25px;
            cursor: pointer;
        }

        .register {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }

        .register a {
            color: #1f2d5a;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="logo">

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" width="60">

            <h2>
                Selamat Datang di School Reminder!
            </h2>

            <p>
                permudah jadwal sekolah,
                tugas, dan ujian Anda.
            </p>

        </div>

        @if(session('error'))

            <div class="error">
                {{ session('error') }}
            </div>

        @endif

        <form method="POST" action="/login">

            @csrf

            <div class="input-group">

                <input type="name" name="name" placeholder="Email" required>

            </div>

            <div class="input-group">

                <input type="password" name="password" placeholder="Kata Sandi" required>

            </div>

            <div class="options">

                <label>

                    <input type="checkbox" name="remember_me" value="1">

                    Ingatkan Saya

                </label>

                <a href="#">
                    Lupa kata sandi?
                </a>

            </div>

            <button type="submit" class="login-btn">
                Masuk
            </button>

        </form>

        <div class="register">

            Belum Punya Akun ?

            <a href="/register">
                Daftar Sekarang
            </a>

        </div>

    </div>

</body>

</html>