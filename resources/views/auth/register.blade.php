<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <form method="POST" action="/register" class="max-w-sm mx-auto mt-16 bg-white p-6 rounded-xl shadow space-y-3">
        @csrf
        <h1 class="text-xl font-bold">Daftar Akun</h1>

        @foreach ($errors->all() as $error)
            <p class="text-red-600 text-sm">{{ $error }}</p>
        @endforeach

        <input name="name" value="{{ old('name') }}" placeholder="Nama" class="w-full border rounded p-2">
        <input name="email" type="email" value="{{ old('email') }}" placeholder="Email" class="w-full border rounded p-2">
        <input name="password" type="password" placeholder="Password (min. 6 karakter)" class="w-full border rounded p-2">
        <input name="password_confirmation" type="password" placeholder="Ulangi password" class="w-full border rounded p-2">

        <button class="w-full bg-teal-700 text-white rounded p-2">Daftar</button>
        <p class="text-sm text-center">Sudah punya akun? <a href="/login" class="text-teal-700 underline">Login</a></p>
    </form>
</body>
</html>