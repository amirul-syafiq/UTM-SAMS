<div class="event-card {{ $class }} bg-white rounded-lg shadow-lg overflow-hidden">
  <div class="event-image h-64 md:h-56 lg:h-64 xl:h-80 bg-gray-400" style="background-image: url('{{ $image }}')"></div>
  <div class="event-details p-4 md:p-6 lg:p-8 xl:p-10">
    <h3 class="event-title font-semibold text-lg md:text-xl lg:text-2xl mb-2">
      {{ $title ?? 'Event Title' }}
    </h3>
    <div class="event-date text-gray-600 text-sm md:text-base lg:text-lg mb-2">
      {{ $date ?? 'Event Date' }}
    </div>
    <div class="event-location text-gray-600 text-sm md:text-base lg:text-lg mb-2">
      {{ $location ?? 'Event Location' }}
    </div>
    <div class="event-description text-gray-700 text-sm md:text-base lg:text-lg">
      {{ $description ?? 'Event Description' }}
    </div>
  </div>
</div>
