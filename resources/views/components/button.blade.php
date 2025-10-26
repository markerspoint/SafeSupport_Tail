@props(['text' => '', 'href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge([
    'class' => 'inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background transition-all duration-200
          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2
          disabled:pointer-events-none disabled:opacity-50
          bg-green-600 text-white hover:bg-green-700 shadow-lg active:scale-[0.98] hover:shadow-md
          py-2 group h-10 rounded-lg border-b-4 border-green-900 px-6 text-base'
]) }}>
    {{ $text }}
    {{ $slot }}
</a>
