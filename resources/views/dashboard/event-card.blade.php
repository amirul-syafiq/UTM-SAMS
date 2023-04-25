<style>
  /* Custom styles for the event card component */
.my-event-card .event-card {
  background-color: #f8f8f8;
  border: 2px solid #e2e8f0;
  
}

.my-event-card .event-image {
  background-image: url('https://via.placeholder.com/640x360');
  background-size: cover;
  background-position: center center;
}

.my-event-card .event-details {
 
  padding: 1.5rem;
  margin: 1rem;
}

.my-event-card .event-title {
  color: #4a5568;
}

.my-event-card .event-date,
.my-event-card .event-location {
  color: #718096;
}

.my-event-card .event-description {
  color: #1a202c;
}

/* Mobile responsiveness */
@media (max-width: 640px) {
  .my-event-card .event-image {
    height: 12rem;
  }

  .my-event-card .event-details {
    padding: 1rem;
  }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  .my-event-card .event-card {
    background-color: #2d3748;
    border-color: #4a5568;
  }

  .my-event-card .event-title {
    color: #cbd5e0;
  }

  .my-event-card .event-date,
  .my-event-card .event-location {
    color: #a0aec0;
  }

  .my-event-card .event-description {
    color: #cbd5e0;
  }
}

</style>

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
