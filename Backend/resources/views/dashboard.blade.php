# resources/views/dashboard.blade.php

```php
<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:linear-gradient(
                to bottom,
                #bfe5ff,
                #eaf6ff
            );
            min-height:100vh;
            padding:25px;
        }

        .container{
            max-width:1100px;
            margin:auto;
        }

        .navbar{
            background:white;
            border-radius:25px;
            padding:20px 25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
            flex-wrap:wrap;
            gap:15px;
        }

        .profile h2{
            color:#1f2d5a;
            margin-bottom:5px;
        }

        .profile p{
            color:#777;
        }

        .logout-btn{
            background:#ff4d4d;
            color:white;
            text-decoration:none;
            padding:12px 20px;
            border-radius:15px;
        }

        .card{
            background:white;
            border-radius:25px;
            padding:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            margin-bottom:25px;
        }

        .card h3{
            color:#1f2d5a;
            margin-bottom:15px;
        }

        input,
        textarea,
        button{
            width:100%;
            padding:14px;
            border-radius:15px;
            border:1px solid #d0d0d0;
            margin-top:12px;
            font-size:14px;
        }

        textarea{
            resize:none;
            min-height:100px;
        }

        button{
            background:#1f2d5a;
            color:white;
            border:none;
            cursor:pointer;
            transition:0.2s;
        }

        button:hover{
            opacity:0.9;
        }

        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
            gap:20px;
        }

        .class-card{
            background:white;
            border-radius:25px;
            padding:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        }

        .class-card h2{
            color:#1f2d5a;
            margin-bottom:10px;
        }

        .class-code{
            display:inline-block;
            background:#dcecff;
            color:#1f2d5a;
            padding:8px 15px;
            border-radius:12px;
            margin-top:10px;
            font-weight:bold;
        }

        .assignment{
            margin-top:20px;
            background:#f5f9ff;
            border-radius:18px;
            padding:18px;
        }

        .assignment h4{
            color:#1f2d5a;
            margin-bottom:8px;
        }

        .deadline{
            color:#ff4d4d;
            margin-top:8px;
            font-size:14px;
        }

        .section-title{
            margin-bottom:20px;
            color:#1f2d5a;
        }

        .empty{
            text-align:center;
            color:#888;
            margin-top:20px;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:15px;
            margin-bottom:20px;
        }

        .error{
            background:#f8d7da;
            color:#721c24;
            padding:15px;
            border-radius:15px;
            margin-bottom:20px;
        }

        @media(max-width:600px){

            body{
                padding:15px;
            }

            .navbar{
                flex-direction:column;
                align-items:flex-start;
            }

        }

    </style>

</head>
<body>

<div class="container">

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif

    <div class="navbar">

        <div class="profile">

            <h2>
                {{ session('user')->name }}
            </h2>

            <p>
                Role : {{ session('user')->role }}
            </p>

        </div>

        <a href="/logout" class="logout-btn">
            Logout
        </a>

    </div>

    @if(session('user')->role == 'guru')

        <div class="card">

            <h3>Buat Kelas</h3>

            <form method="POST" action="/create-class">

                @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="Nama Kelas"
                    required
                >

                <textarea
                    name="description"
                    placeholder="Deskripsi kelas"
                ></textarea>

                <button type="submit">
                    Buat Kelas
                </button>

            </form>

        </div>

    @endif

    @if(session('user')->role == 'siswa')

        <div class="card">

            <h3>Gabung Kelas</h3>

            <form method="POST" action="/join-class">

                @csrf

                <input
                    type="text"
                    name="class_code"
                    placeholder="Masukkan kode kelas"
                    required
                >

                <button type="submit">
                    Gabung Kelas
                </button>

            </form>

        </div>

    @endif

    <h2 class="section-title">
        Daftar Kelas
    </h2>

    @php

        use App\Models\Classroom;

        $classes = Classroom::with('assignments')->get();

    @endphp

    @if(count($classes) == 0)

        <div class="card empty">
            Belum ada kelas.
        </div>

    @endif

    <div class="grid">

        @foreach($classes as $class)

            <div class="class-card">

                <h2>
                    {{ $class->name }}
                </h2>

                <p>
                    {{ $class->description }}
                </p>

                <div class="class-code">
                    Kode : {{ $class->class_code }}
                </div>

                @if(session('user')->role == 'guru')

                    <div class="assignment">

                        <h4>Buat Tugas</h4>

                        <form method="POST" action="/create-assignment">

                            @csrf

                            <input
                                type="hidden"
                                name="classroom_id"
                                value="{{ $class->id }}"
                            >

                            <input
                                type="text"
                                name="title"
                                placeholder="Judul tugas"
                                required
                            >

                            <textarea
                                name="description"
                                placeholder="Deskripsi tugas"
                                required
                            ></textarea>

                            <input
                                type="date"
                                name="deadline"
                                required
                            >

                            <button type="submit">
                                Buat Tugas
                            </button>

                        </form>

                    </div>

                @endif

                @foreach($class->assignments as $assignment)

                    <div class="assignment">

                        <h4>
                            {{ $assignment->title }}
                        </h4>

                        <p>
                            {{ $assignment->description }}
                        </p>

                        <div class="deadline">
                            Deadline : {{ $assignment->deadline }}
                        </div>

                        @if(session('user')->role == 'siswa')

                            <form
                                method="POST"
                                action="/submit-assignment"
                                enctype="multipart/form-data"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="assignment_id"
                                    value="{{ $assignment->id }}"
                                >

                                <input
                                    type="file"
                                    name="file"
                                    required
                                >

                                <textarea
                                    name="note"
                                    placeholder="Catatan tugas"
                                ></textarea>

                                <button type="submit">
                                    Kirim Tugas
                                </button>

                            </form>

                        @endif

                    </div>

                @endforeach

            </div>

        @endforeach

    </div>

</div>

</body>
</html>
```
