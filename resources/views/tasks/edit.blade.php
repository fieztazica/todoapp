<x-app-layout>
    <div class="text-white px-4 py-2">
        <div class="flex space-x-2 justify-between items-center mt-2">
            <h2><a class="hover:underline" href="{{route('notes.show', ['id'=>
                $task->note_id])}}">Note #{{$task->note_id}}</a> / Task #{{ $task->id }}</h2>

            @include('tasks.partials.delete-task', ['task_id' => $task->id])
        </div>
        {{-- <h3 class="text-xl font-bold"> {{ $note->title }}</h3>
        <textarea class="text-black">{{ $note->content }}</textarea> --}}
        @include('tasks.partials.edit-task-form', ['task' => $task])
    </div>
</x-app-layout>
