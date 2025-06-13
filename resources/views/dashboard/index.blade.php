<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pawtopia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 flex flex-col items-center justify-center min-h-screen text-center">
    <div class="max-w-md p-6 bg-white rounded-xl shadow-md space-y-4">
        <h1 class="text-3xl font-bold text-pink-600">Annyeong admin, Selamat Datang di Pawtopia!</h1>
        <p class="text-gray-700">Semangat mengelola data kucing dan adopsi 💕</p>
        <img src="{{ asset('img/dashboardcat.jpeg') }}" alt="dashboard" class="rounded-lg shadow">
        <a href="{{ route('cats.index') }}" class="inline-block mt-4 bg-pink-500 text-white py-3 px-6 rounded-lg shadow hover:bg-pink-600">
            Lihat Daftar Kucing
        </a>
    </div>
</body>
</html>
