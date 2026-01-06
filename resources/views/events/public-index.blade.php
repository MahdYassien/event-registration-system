<x-guest-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Upcoming Events</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <div class="text-sm font-medium text-blue-600 mb-1">
                            {{ $event->date_time->format('F j, Y @ g:i A') }}
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->title }}</h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $event->description }}</p>
                        
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-sm text-gray-500">📍 {{ $event->location }}</span>
                            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No events found at the moment.</p>
            @endforelse
        </div>
    </div>
</x-guest-layout>