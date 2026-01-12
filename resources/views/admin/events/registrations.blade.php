<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        {{-- Page Title --}}
        <h1 class="text-xl font-bold mb-4 text-white">
            Registrations – {{ $event->title }}
        </h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.events.registrations.export', $event) }}"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Export CSV
            </a>
        </div>

        {{-- Registrations Table --}}
        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Registered At</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($registrations as $registration)
                    <tr class="border-t">

                        <td class="p-2 border text-white">
                            {{ $registration->attendee->name }}
                        </td>

                        <td class="p-2 border text-white">
                            {{ $registration->attendee->email }}
                        </td>

                        <td class="p-2 border">
                            <span class="font-semibold
                                @if ($registration->status === 'confirmed') text-green-600
                                @elseif ($registration->status === 'waitlisted') text-yellow-600
                                @else text-red-600
                                @endif">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </td>

                        <td class="p-2 border text-white">
                            {{ $registration->created_at->format('M d, Y H:i') }}
                        </td>

                        <td class="p-2 border">
                            @if ($registration->status !== 'cancelled')
                                <form method="POST"
                                      action="{{ route('admin.registrations.cancel', $registration) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="text-red-600 hover:underline"
                                            onclick="return confirm('Are you sure you want to cancel this registration?')">
                                        Cancel
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 italic">
                                    Cancelled
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No registrations found for this event.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
