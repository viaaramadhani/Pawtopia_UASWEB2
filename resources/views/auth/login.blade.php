<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

</html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login - Pawtopia</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-pink-50">
  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
      <h2 class="text-3xl font-bold text-center text-pink-500 mb-6">Login</h2>

      @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
      {{ session('success') }}
      </div>
    @endif

      @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
      {{ session('error') }}
      </div>
    @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf <!-- This is crucial for CSRF protection -->

        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-pink-700 mb-1">Email</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" required
            class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300" />
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-pink-700 mb-1">Password</label>
          <input type="password" name="password" id="password" required
            class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300" />
        </div>

        <div class="mb-6">
          <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
            {{ __('Login as Role') }}
          </label>
          <select name="role" id="role"
            class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300">
            <option value="user" selected>{{ __('Regular User') }}</option>
            <option value="admin">{{ __('Admin') }}</option>
          </select>
          <p class="text-xs text-gray-500 mt-1">{{ __('Choose the role you want to login as') }}</p>
        </div>

        <div class="flex items-center mb-4">
          <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-pink-600 rounded" />
          <label for="remember" class="ml-2 block text-sm text-pink-700">Remember Me</label>
        </div>

        <button type="submit"
          class="w-full bg-pink-400 hover:bg-pink-500 text-white font-bold py-3 rounded-lg transition duration-300">
          Login
        </button>

        @if ($errors->any())
        <div class="mt-4 text-red-500 text-sm">
          <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
          </ul>
        </div>
    @endif

        <div class="mt-6 text-center">
          <p class="text-sm text-pink-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-pink-500 hover:underline font-semibold">Daftar di sini</a>
          </p>
        </div>
      </form>
    </div>
  </div>
</body>

</html>