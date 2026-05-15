<!DOCTYPE html>
<html>
<head>

    <title>Register</title>

    <style>

        body{
            margin:0;
            font-family:Arial;
            background:#cce7ff;
        }

        .container{
            width:350px;
            margin:40px auto;
            background:white;
            border-radius:30px;
            padding:30px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            color:#1f2d5a;
        }

        .role-group{
            display:flex;
            gap:10px;
            margin-bottom:15px;
        }

        .role-btn{
            flex:1;
            border:1px solid #1f2d5a;
            border-radius:10px;
            padding:10px;
            background:white;
            cursor:pointer;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:12px;
            border-radius:12px;
            border:1px solid #999;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:12px;
            margin-top:20px;
            border:none;
            border-radius:20px;
            background:#1f2d5a;
            color:white;
            cursor:pointer;
        }

        .remember{
            margin-top:15px;
            font-size:14px;
        }

    </style>

</head>
<body>

<div class="container">

    <h2>Mendaftar</h2>

    <form method="POST" action="/register">

        @csrf

        <input
            type="hidden"
            name="role"
            id="roleInput"
            value="guru"
        >

        <div class="role-group">

            <button
                type="button"
                class="role-btn"
                onclick="setRole('guru')"
            >
                Guru
            </button>

            <button
                type="button"
                class="role-btn"
                onclick="setRole('siswa')"
            >
                Siswa
            </button>

        </div>

        <input
            type="text"
            name="name"
            placeholder="Nama Pengguna"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Kata Sandi"
            required
        >

        <input
            type="text"
            id="dynamicField"
            name="school"
            placeholder="Nama Sekolah"
            required
        >

        <div class="remember">

            <label>

                <input
                    type="checkbox"
                    name="remember_me"
                    value="1"
                >

                Ingatkan saya

            </label>

        </div>

        <button type="submit">
            Mendaftar
            
        </button>

    </form>

    <div class="register">

        Sudah Punya Akun ?

        <a href="/login">
            Masuk Sekarang
        </a>

    </div>

</div>

<script>

function setRole(role){

    document
        .getElementById('roleInput')
        .value = role;

    const field =
        document.getElementById(
            'dynamicField'
        );

    if(role == 'guru'){

        field.placeholder =
            'Nama Sekolah';

        field.name = 'school';

    } else {

        field.placeholder =
            'NIS';

        field.name = 'nis';
    }
}

</script>

</body>
</html>