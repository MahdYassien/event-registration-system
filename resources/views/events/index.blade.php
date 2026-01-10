<x-guest-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Upcoming Events</h1>

        @forelse ($events as $event)
            @php
                $confirmedCount = $event->registrations()
                    ->where('status', 'confirmed')
                    ->count();

                $remaining = $event->capacity - $confirmedCount;
            @endphp

            <div class="border p-4 rounded mb-4 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start">
                    <h2 class="text-xl font-semibold">{{ $event->title }}</h2>

                    {{-- Price badge --}}
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                        {{ $event->price ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $event->price ? '$' . number_format($event->price, 2) : 'Free' }}
                    </span>
                </div>

                <p class="text-gray-600 mt-1">
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
                    @if ($remaining > 0)
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
                   class="text-blue-600 mt-3 inline-block font-medium">
                    View Details →
                </a>
            </div>
        @empty
            <p>No upcoming events available.</p>
        @endforelse
    </div>
</x-guest-layout>
