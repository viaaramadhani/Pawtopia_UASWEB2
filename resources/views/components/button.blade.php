<button type="submit"
  {{ $attributes->merge(['class' => 'w-full bg-green-400 text-white py-2 px-4 rounded hover:bg-pink-500']) }}>
  {{ $slot }}
</button>
