{{-- resources/views/test.blade.php --}}
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>DatePicker Demo</title>

  {{-- Your Tailwind & Preline build --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="min-h-full bg-gray-50 text-gray-900 dark:bg-neutral-950 dark:text-neutral-100">

  <div class="max-w-3xl mx-auto p-6 space-y-8">
    <header class="space-y-2">
      <h1 class="text-2xl font-semibold">DatePicker Component Demo</h1>
      <p class="text-sm text-gray-600 dark:text-neutral-400">
        One popover picker + one inline picker. Submit to see values below.
      </p>
    </header>

    {{-- Demo form --}}
    <form method="POST" action="#" class="space-y-6 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-800 rounded-xl p-6">
      @csrf

      {{-- Popover mode --}}
      <div class="space-y-2">
        <x-date-picker
          name="due_date"
          label="Due date (popover)"
          :value="old('due_date')"
          min="2023-01-01"
          max="2030-12-31"
        />
        @error('due_date')
          <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Inline mode (always visible) --}}
      {{-- <div class="space-y-2">
        <x-date-picker
          name="start_date"
          label="Start date (inline)"
          inline
          :value="old('start_date')"
        />
        @error('start_date')
          <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div> --}}

      <div class="flex items-center gap-3">
        <button
          type="submit"
          class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-blue-600"
        >
          Submit
        </button>
        <a href="{{ url()->current() }}"
           class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 dark:border-neutral-700 dark:hover:bg-neutral-800">
          Reset
        </a>
      </div>
    </form>

    {{-- Show submitted values --}}
    @if(session('submitted'))
      <section class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-800 rounded-xl p-6">
        <h2 class="text-lg font-medium mb-3">Submitted</h2>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <dt class="text-sm text-gray-600 dark:text-neutral-400">due_date</dt>
            <dd class="text-base font-mono">{{ session('submitted')['due_date'] ?? '—' }}</dd>
          </div>
          <div>
            <dt class="text-sm text-gray-600 dark:text-neutral-400">start_date</dt>
            <dd class="text-base font-mono">{{ session('submitted')['start_date'] ?? '—' }}</dd>
          </div>
        </dl>
      </section>
    @endif
  </div>

  {{-- If your component pushes scripts --}}
  @stack('scripts')
</body>
</html>
