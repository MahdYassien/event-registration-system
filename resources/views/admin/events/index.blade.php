<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4 text-white">Events</h1>

        <a href="{{ route('admin.events.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Create Event
        </a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Title</th>
                    <th class="p-2">Date</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Capacity</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="border-t text-white">
                        <td class="p-2">{{ $event->title }}</td>
                        <td class="p-2">{{ $event->date_time }}</td>
                        <td class="p-2">{{ ucfirst($event->status) }}</td>
                        <td class="p-2">{{ $event->capacity }}</td>
                        <td class="p-2">
                            <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600">Edit</a>
                            <a href="{{ route('admin.events.registrations', $event) }}"
                                     class="text-green-600 ml-2">
                                    Registrations
                                    </a>
                            <form action="{{ route('admin.events.destroy', $event) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-2"
                                        onclick="return confirm('Delete this event?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
