<x-guest-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>

        <p class="text-gray-600 mb-2">
            📅 {{ \Carbon\Carbon::parse($event->date_time)->format('M d, Y H:i') }}
        </p>

        <p class="text-gray-600 mb-2">
            📍 {{ $event->location }}
        </p>

        <p class="mt-4">
            {{ $event->description }}
        </p>

        @php
            $remaining = $event->capacity - $event->registrations()->count();
        @endphp

        {{-- Capacity info --}}
        <div class="mt-4">
            <p class="text-gray-700 font-medium">
                🧑‍🤝‍🧑 Capacity: {{ $event->capacity }}
            </p>

            @if($remaining > 0)
                <p class="mt-1 inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    Remaining spots: {{ $remaining }}
                </p>

                @if($remaining <= 5)
                    <p class="mt-2 text-yellow-700 font-semibold">
                        ⚠️ Limited spots left!
                    </p>
                @endif
            @else
                <p class="mt-1 inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                    ❌ Event Full
                </p>
            @endif
        </div>
    </div>
</x-guest-layout>
