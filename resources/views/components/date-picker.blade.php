@props([
  'name' => 'date',
  'id' => null,
  'value' => null,
  'format' => 'M d, Y',   // supports: 'M d, Y' | 'MM-DD-YYYY' | 'DD-MM-YYYY' | 'YYYY-MM-DD' | 'D d M, Y'
  'placeholder' => 'Select date',
  'class' => '',
])

@php
  // Ensure a unique id if not provided
  $inputId = $id ?: 'date-picker-'.Str::uuid();
@endphp

<div
  x-data="{
      datePickerOpen: false,
      datePickerValue: @js($value ?? ''),
      datePickerFormat: @js($format),
      datePickerMonth: '',
      datePickerYear: '',
      datePickerDay: '',
      datePickerDaysInMonth: [],
      datePickerBlankDaysInMonth: [],
      datePickerMonthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
      datePickerDays: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],

      datePickerDayClicked(day) {
        let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day);
        this.datePickerDay = day;
        this.datePickerValue = this.datePickerFormatDate(selectedDate);
        this.datePickerIsSelectedDate(day);
        this.datePickerOpen = false;
      },
      datePickerPreviousMonth(){
        if (this.datePickerMonth == 0) { this.datePickerYear--; this.datePickerMonth = 12; }
        this.datePickerMonth--;
        this.datePickerCalculateDays();
      },
      datePickerNextMonth(){
        if (this.datePickerMonth == 11) { this.datePickerMonth = 0; this.datePickerYear++; }
        else { this.datePickerMonth++; }
        this.datePickerCalculateDays();
      },
      datePickerIsSelectedDate(day) {
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return this.datePickerValue === this.datePickerFormatDate(d);
      },
      datePickerIsToday(day) {
        const today = new Date();
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return today.toDateString() === d.toDateString();
      },
      datePickerCalculateDays() {
        let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
        let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
        let blankdaysArray = [];
        for (let i = 1; i <= dayOfWeek; i++) blankdaysArray.push(i);
        let daysArray = [];
        for (let i = 1; i <= daysInMonth; i++) daysArray.push(i);
        this.datePickerBlankDaysInMonth = blankdaysArray;
        this.datePickerDaysInMonth = daysArray;
      },
      datePickerFormatDate(date) {
        let formattedDay = this.datePickerDays[date.getDay()];
        let dd = ('0' + date.getDate()).slice(-2);
        let monthName = this.datePickerMonthNames[date.getMonth()];
        let monShort = monthName.substring(0, 3);
        let mm = ('0' + (parseInt(date.getMonth()) + 1)).slice(-2);
        let yyyy = date.getFullYear();

        if (this.datePickerFormat === 'M d, Y')     return `${monShort} ${dd}, ${yyyy}`;
        if (this.datePickerFormat === 'MM-DD-YYYY') return `${mm}-${dd}-${yyyy}`;
        if (this.datePickerFormat === 'DD-MM-YYYY') return `${dd}-${mm}-${yyyy}`;
        if (this.datePickerFormat === 'YYYY-MM-DD') return `${yyyy}-${mm}-${dd}`;
        if (this.datePickerFormat === 'D d M, Y')   return `${formattedDay} ${dd} ${monShort} ${yyyy}`;

        return `${monthName} ${dd}, ${yyyy}`; // fallback
      },
  }"
  x-init="
      let currentDate = new Date();
      if (datePickerValue) {
          // try parse common formats
          const parsed = Date.parse(datePickerValue);
          if (!Number.isNaN(parsed)) currentDate = new Date(parsed);
      }
      datePickerMonth = currentDate.getMonth();
      datePickerYear = currentDate.getFullYear();
      datePickerDay = currentDate.getDay();
      datePickerValue = datePickerFormatDate(currentDate);
      datePickerCalculateDays();

      // keep hidden input in sync
      $watch('datePickerValue', (val) => {
        const hidden = document.getElementById('{{ $inputId }}-hidden');
        if (hidden) hidden.value = val;
        // also dispatch a native input event for Livewire/Alpine listeners
        const inputEl = document.getElementById('{{ $inputId }}');
        if (inputEl) {
          inputEl.value = val;
          inputEl.dispatchEvent(new Event('input', { bubbles: true }));
          inputEl.dispatchEvent(new Event('change', { bubbles: true }));
        }
      })
  "
  x-cloak
  class="inline-block {{ $class }}"
>
  <div class="relative w-[17rem]">
    {{-- visible text input (readonly) --}}
    <input
      id="{{ $inputId }}"
      type="text"
      @click="datePickerOpen=!datePickerOpen"
      x-model="datePickerValue"
      x-on:keydown.escape="datePickerOpen=false"
      class="flex px-3 py-2 w-full h-10 text-sm bg-white rounded-md border text-neutral-600 border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
      placeholder="{{ $placeholder }}"
      readonly
      autocomplete="off"
    />

    {{-- hidden input for form submit --}}
    <input id="{{ $inputId }}-hidden" type="hidden" name="{{ $name }}" value="{{ $value }}">

    <button type="button"
      @click="datePickerOpen=!datePickerOpen"
      class="absolute top-0 right-0 px-3 py-2 cursor-pointer text-neutral-400 hover:text-neutral-500"
      aria-label="Toggle calendar">
      <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
    </button>

    {{-- popup --}}
    <div
      x-show="datePickerOpen"
      x-transition
      @click.away="datePickerOpen=false"
      class="absolute top-0 left-0 max-w-lg p-4 mt-12 antialiased bg-white border rounded-lg shadow w-[17rem] border-neutral-200/70 z-50"
      role="dialog"
      aria-modal="true"
    >
      <div class="flex items-center justify-between mb-2">
        <div>
          <span x-text="datePickerMonthNames[datePickerMonth]" class="text-lg font-bold text-gray-800"></span>
          <span x-text="datePickerYear" class="ml-1 text-lg font-normal text-gray-600"></span>
        </div>
        <div class="flex gap-1">
          <button @click="datePickerPreviousMonth()" type="button" class="inline-flex p-1 rounded-full transition hover:bg-gray-100 focus:outline-none">
            <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
          </button>
          <button @click="datePickerNextMonth()" type="button" class="inline-flex p-1 rounded-full transition hover:bg-gray-100 focus:outline-none">
            <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-7 mb-3">
        <template x-for="(day, index) in datePickerDays" :key="index">
          <div class="px-0.5">
            <div x-text="day" class="text-xs font-medium text-center text-gray-800"></div>
          </div>
        </template>
      </div>

      <div class="grid grid-cols-7">
        <template x-for="blankDay in datePickerBlankDaysInMonth">
          <div class="p-1 text-sm text-center border border-transparent"></div>
        </template>

        <template x-for="(day, dayIndex) in datePickerDaysInMonth" :key="dayIndex">
          <div class="px-0.5 mb-1 aspect-square">
            <button
              type="button"
              x-text="day"
              @click="datePickerDayClicked(day)"
              :class="{
                'bg-neutral-200': datePickerIsToday(day),
                'text-gray-600 hover:bg-neutral-200': !datePickerIsToday(day) && !datePickerIsSelectedDate(day),
                'bg-neutral-800 text-white hover:bg-neutral-800/70': datePickerIsSelectedDate(day)
              }"
              class="flex justify-center items-center w-7 h-7 text-sm leading-none text-center rounded-full cursor-pointer"
            ></button>
          </div>
        </template>
      </div>
    </div>
  </div>
</div>
