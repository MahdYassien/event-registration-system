<x-guest-layout>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex justify-between items-start">
            <h2 class="text-xl font-semibold text-white">{{ $event->title }}</h2>

            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                {{ $event->price ? '$' . number_format($event->price, 2) : 'Free' }}
            </span>
        </div>
        <p class="text-gray-500 mb-2">
            📅 {{ \Carbon\Carbon::parse($event->date_time)->format('M d, Y H:i') }}
        </p>

        <p class="text-gray-500 mb-2">
            📍 {{ $event->location }}
        </p>

        <p class="mt-4 text-white">
            {{ $event->description }}
        </p>

        @php
            $remaining = $event->capacity - $event->registrations()->count();
        @endphp

        <div class="mt-4">
            <p class="text-gray-500 font-medium">
                🧑‍🤝‍🧑 Capacity: {{ $event->capacity }}
            </p>
        </div>



        @php
            $confirmedCount = $event->registrations()->where('status', 'confirmed')->count();

            $remaining = $event->capacity - $confirmedCount;
        @endphp
        @if ($remaining > 0)
            <p class="mt-1 inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                Remaining spots: {{ max($remaining, 0) }}
            </p>
            @if ($remaining <= 5)
                <p class="mt-2 text-yellow-700 font-semibold">
                    ⚠️ Limited spots left!
                </p>
            @endif
        @else
            <p class="mt-1 inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                Fully Booked (Waitlist Available)
            </p>
        @endif

        <form method="POST" action="{{ route('events.register', $event) }}" class="mt-6">
            @csrf

            <input name="name" placeholder="Your Name" class="w-full mb-2" required>
            <input name="email" type="email" placeholder="Email" class="w-full mb-2" required>
            <input type="tel" name="phone" placeholder="Phone" class="w-full mb-2" required
                pattern="^\+?\d{10,15}$" title="Enter a valid phone number, e.g., +201234567890" />

            <input name="company" placeholder="Company (optional)" class="w-full mb-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Register
            </button>
        </form>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 mt-4 mb-4">
                {{ session('success') }}
            </div>
        @endif


        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mt-4 mb-4">
                {{ $errors->first() }}
            </div>
        @endif

    </div>
</x-guest-layout>
