<!-- @props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false])

<div class="mb-4">
  <label for="{{ $name }}" class="block text-sm font-medium text-pink-700">{{ $label }}</label>
  <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
         @if($required) required @endif
         class="mt-1 block w-full rounded-md border-pink-200 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-300 sm:text-sm" />
</div> -->
