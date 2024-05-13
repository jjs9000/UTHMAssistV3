@props(['disabled' => false, 'rows' => 3])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300    focus:border-indigo-500 focus:ring-indigo-500  rounded-md shadow-sm']) !!} rows="{{ $rows }}">{{ $slot }}</textarea>

@error($attributes->get('name'))
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror