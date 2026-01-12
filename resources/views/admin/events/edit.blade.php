<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-xl font-bold mb-4 text-white">Edit Event</h1>

        <form method="POST" action="{{ route('admin.events.update', $event) }}">
            @csrf
            @method('PUT')

            <input name="title" value="{{ $event->title }}" class="w-full mb-2" required>
            <textarea name="description" class="w-full mb-2" required>{{ $event->description }}</textarea>
            <input type="datetime-local"
                   name="date_time"
                   value="{{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i') }}"
                   class="w-full mb-2"
                   required>
            <input name="location" value="{{ $event->location }}" class="w-full mb-2" required>
            <input type="number" name="capacity" value="{{ $event->capacity }}" class="w-full mb-2" required>
            <input type="number" step="0.01" name="price" value="{{ $event->price }}" class="w-full mb-2">

            <select name="status" class="w-full mb-4">
                @foreach (['draft','published','cancelled','completed'] as $status)
                    <option value="{{ $status }}" @selected($event->status === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
