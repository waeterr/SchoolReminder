@extends('layouts.app')

@section('content')
<style>
    /* Background Gradient Biru seperti di foto */
    body {
        background: linear-gradient(180deg, #BDE3FF 0%, #FFFFFF 100%);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    /* Container Profil */
    .profile-container {
        max-width: 450px;
        margin: auto;
        padding-top: 50px;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header h2 {
        font-weight: 700;
        color: #000;
    }

    /* Foto Profil & Tombol Edit */
    .avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 20px auto;
    }

    .avatar-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        background-color: #5DADE2; /* Warna placeholder biru di foto */
    }

    .edit-icon-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #2B3A67;
        color: white;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        cursor: pointer;
    }

    /* Badge Role */
    .role-badge {
        display: inline-block;
        padding: 5px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .role-siswa { background-color: #E8F5E9; color: #4CAF50; }
    .role-guru { background-color: #FFEBEE; color: #FF5252; }

    /* Gaya Input Field agar Mirip Screenshot */
    .info-card {
        background: #F2F2F2;
        border-radius: 15px;
        padding: 10px 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: none;
    }

    .info-card label {
        display: block;
        font-size: 11px;
        color: #A0A0A0;
        margin-bottom: 2px;
    }

    .info-card .value {
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .info-card input {
        border: none;
        background: transparent;
        width: 100%;
        font-weight: 600;
        color: #333;
        padding: 0;
    }

    .info-card input:focus {
        outline: none;
    }

    /* Tombol Update */
    .btn-update {
        background-color: #2B3A67;
        color: white;
        border-radius: 25px;
        padding: 12px;
        width: 100%;
        font-weight: bold;
        border: none;
        margin-top: 20px;
    }

    /* Navbar Bawah Simpel */
    .bottom-nav {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 400px;
        background: #5DADE2;
        border-radius: 30px;
        display: flex;
        justify-content: space-around;
        padding: 10px;
    }

    .nav-item { color: white; font-size: 24px; opacity: 0.7; }
    .nav-item.active { opacity: 1; }
</style>

<div class="profile-container">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        ...
        <div class="profile-header">
            <h2>Profil</h2>
            
            <div class="avatar-wrapper">
                <img src="{{ auth()->user()->photo ? asset('storage/'.auth()->user()->photo) : '' }}" class="avatar-image" id="preview">
                <label for="photo-input" class="edit-icon-btn">
                    <i class="fas fa-pencil-alt"></i>
                </label>
                <input type="file" id="photo-input" name="photo" style="display: none;" onchange="previewImage(event)">
            </div>

            <h4 class="fw-bold">{{ auth()->user()->name }}</h4>
            
            @if(auth()->user()->role == 'guru')
                <div class="role-badge role-guru">Guru</div>
            @else
                <div class="role-badge role-siswa">{{ auth()->user()->kelas }}</div>
            @endif
        </div>

        <div class="info-card">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}">
        </div>

        <div class="info-card">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="border-0 bg-transparent fw-bold w-100" style="font-size: 14px;">
                <option value="Laki-laki" {{ auth()->user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ auth()->user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="info-card">
            <label>Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}">
        </div>

        <div class="info-card">
            <label>Nama sekolah</label>
            <input type="text" name="nama_sekolah" value="{{ auth()->user()->nama_sekolah }}">
        </div>

        @if(auth()->user()->role == 'siswa')
        <div class="info-card">
            <label>Kelas</label>
            <input type="text" name="kelas" value="{{ auth()->user()->kelas }}">
        </div>
        @endif

        <button type="submit" class="btn-update shadow">Perbarui Profil</button>
    </form>
</div>

<div class="bottom-nav shadow">
    <a href="#" class="nav-item"><i class="fas fa-home"></i></a>
    <a href="#" class="nav-item"><i class="fas fa-clipboard-list"></i></a>
    <a href="#" class="nav-item"><i class="fas fa-bell"></i></a>
    <a href="#" class="nav-item active"><i class="fas fa-user-circle"></i></a>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection