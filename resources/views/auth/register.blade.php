@extends('layouts.app')

<div class="min-h-screen flex items-center justify-center bg-pink-50">
  <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold text-center text-pink-500 mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-pink-700 mb-1">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required
          class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300" />
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-pink-700 mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required
          class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300" />
      </div>

      <div class="mb-4">
        <label for="role" class="block text-sm font-medium text-pink-700 mb-1">Role</label>
        <select name="role" id="role"
          class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-pink-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300" />
      </div>

      <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-pink-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
          class="w-full p-3 rounded-lg border border-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-300" />
      </div>

      <button type="submit"
        class="w-full bg-pink-400 hover:bg-pink-500 text-white font-bold py-3 rounded-lg transition duration-300">
        Register
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
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-pink-500 hover:underline font-semibold">Login di sini</a>
        </p>
      </div>
    </form>
  </div>
</div>