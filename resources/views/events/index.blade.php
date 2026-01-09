<x-guest-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Upcoming Events</h1>

        @forelse ($events as $event)
            @php
                $remaining = $event->capacity - $event->registrations()->count();
            @endphp

            <div class="border p-4 rounded mb-4 shadow-sm hover:shadow-md transition">
                <h2 class="text-xl font-semibold">{{ $event->title }}</h2>

                <p class="text-gray-600">
                    📅 {{ \Carbon\Carbon::parse($event->date_time)->format('M d, Y H:i') }}
                </p>

                <p class="text-gray-600">
                    📍 {{ $event->location }}
                </p>

                <p class="mt-2">
                    {{ $event->description }}
                </p>

                {{-- Remaining capacity badge --}}
                <p class="mt-3">
                    @if($remaining > 0)
                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            🧑‍🤝‍🧑 {{ $remaining }} spots left
                        </span>
                    @else
                        <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                            ❌ Full
                        </span>
                    @endif
                </p>

                <a href="{{ route('events.show', $event) }}"
                   class="text-blue-600 mt-2 inline-block">
                    View Details →
                </a>
            </div>
        @empty
            <p>No upcoming events available.</p>
        @endforelse
    </div>
</x-guest-layout>
