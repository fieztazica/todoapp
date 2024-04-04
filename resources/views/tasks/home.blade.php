<x-app-layout>
    <div class="text-black dark:text-white px-4 py-2">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                @if ($tasks->count())
                <span>{{ $tasks->count() }}/{{ $tasks->total() }} tasks found in page {{ $tasks->currentPage()
                    }}/{{ceil($tasks->total()/$tasks->perPage())}}</span>
                @endif
                <div class="flex space-x-2">
                    @if ($tasks->hasPages())
                    <a href="{{$tasks->previousPageUrl()}}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Previous</a>
                    <a href="{{$tasks->nextPageUrl()}}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Next</a>
                    @endif
                </div>
            </div>
        </div>
        @if ($tasks->count() == 0)
        <p>You don't have any task!
        </p>
        @else
        <ul class="grid grid-cols-4 gap-2 py-2">
            @foreach ($tasks as $task)
            <li id="task_{{$task->id}}" title="Task #{{$task->id}}">
                <a href="{{route('tasks.edit', ['id' => $task->id, 'task' => $task])}}">
                    <div class="text-pretty p-2 rounded min-h-48 min-w-48 w-full group relative shadow
                        hover:ring-2 transition-all h-full {{$task->done ? " bg-green-300 dark:bg-green-900" : "bg-gray-200
                        dark:bg-gray-800" }}">
                        <div class="flex items-center justify-between">
                            <span
                                class="text-sm italic break-all text-neutral-800 dark:text-neutral-300 truncate text-pretty mt-2 flex-1">
                                {{ $task->due_date }}</span>
                            <h3 class="text-md font-bold truncate">Note #{{ $task->note_id }}</h3>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold truncate">{{ $task->name }}</h3>
                        </div>
                        <p class="text-md break-all text-neutral-800 dark:text-neutral-300 truncate text-pretty mt-2">
                            {{$task->description }}</p>
                        <div class="absolute bottom-0 right-0 p-2 w-fit hidden group-hover:block">
                            @include('tasks.partials.delete-task', ['task_id' => $task->id])
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</x-app-layout>
