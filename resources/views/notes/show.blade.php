<x-app-layout>
    <div class="text-white px-4 py-2">
        <div class="flex space-x-2 justify-between items-center mt-2">
            <h2>Note #{{ $note->id }}</h2>
            @include('notes.partials.delete-note', ['note' => $note])
        </div>
        {{-- <h3 class="text-xl font-bold"> {{ $note->title }}</h3>
        <textarea class="text-black">{{ $note->content }}</textarea> --}}
        @include('notes.partials.note-form', ['note' => $note])
        <div>
            <div>
                <h2>Tasks</h2>
            </div>
            @include('notes.partials.task-list', ['tasks' => $note->tasks, 'note_id' => $note->id])
        </div>
    </div>

</x-app-layout>
