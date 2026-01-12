<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-xl font-bold mb-4 text-white">Create Event</h1>

        <form method="POST" action="{{ route('admin.events.store') }}">
            @csrf

            <input name="title" placeholder="Title" class="w-full mb-2" required>
            <textarea name="description" placeholder="Description" class="w-full mb-2" required></textarea>
            <input type="datetime-local" name="date_time" class="w-full mb-2" required>
            <input name="location" placeholder="Location" class="w-full mb-2" required>
            <input type="number" name="capacity" placeholder="Capacity" class="w-full mb-2" required>
            <input type="number" step="0.01" name="price" placeholder="Price" class="w-full mb-2">

            <select name="status" class="w-full mb-4">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="cancelled">Cancelled</option>
                <option value="completed">Completed</option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
