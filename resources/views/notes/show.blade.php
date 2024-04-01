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
            <ul class="grid grid-cols-4 gap-2 py-2">
                @foreach ($note->tasks as $task)
                <li id="task_{{$task->id}}" title="Task #{{$task->id}}">
                    <a href="/tasks/{{$task->id}}">
                        <div
                            class="text-pretty p-2 rounded bg-gray-200 dark:bg-gray-800 min-h-48 min-w-48 w-full md:w-fit md:max-w-sm shadow hover:ring-2 transition-all">
                            <div>
                                <h3 class="text-xl font-bold truncate">{{ $task->name }}</h3>
                            </div>

                            <p
                                class="text-md break-all text-neutral-800 dark:text-neutral-300 truncate text-pretty mt-2">
                                {{
                                $task->description }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>
