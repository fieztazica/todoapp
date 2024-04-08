@props(["tasks", "note_id"])

<ul class="grid grid-cols-4 gap-2 py-2">
    @foreach ($tasks as $task)
    <li id="task_{{$task->id}}" title="Task #{{$task->id}}">
        <a href="{{route('tasks.edit', ['id' => $task->id, 'task' => $task])}}">
            @php
            $green = "bg-green-300 dark:bg-green-900";
            $none = "bg-gray-200 dark:bg-gray-800";
            $red = "bg-red-300 dark:bg-red-900";
            $yellow = "bg-yellow-200 dark:bg-yellow-800";
            $color;

            if ($task->due_status == 2) { $color=$green; } else if ($task->due_status == 0) { $color=$none;}
            else
            if ($task->due_status > 0) { $color=$yellow;} else {$color=$red;} @endphp
            <div class="text-pretty p-2 rounded min-h-48 min-w-48 w-full md:max-w-sm shadow
                hover:ring-2 transition-all h-full {{ $color }}">
                <p class="text-sm italic break-all text-neutral-800 dark:text-neutral-300 truncate text-pretty mt-2">
                    {{ $task->due_date }} ({{ $task->fromNow }})</p>
                <div>
                    <h3 class="text-xl font-bold truncate">{{ $task->name }}</h3>
                </div>
                <p class="text-md break-all text-neutral-800 dark:text-neutral-300 truncate text-pretty mt-2">
                    {{$task->description }}</p>
            </div>
        </a>
    </li>
    @endforeach
    <li id="task_create" title="Create a task">
        <a href="{{ route('tasks.create', ['note_id' => $note_id]) }}">
            <div class="text-pretty p-2 rounded min-h-48 min-w-48 w-full md:w-fit md:max-w-sm shadow
                hover:ring-2 transition-all h-full bg-gray-200
                dark:bg-gray-800 justify-center items-center flex flex-col aspect-square group">
                <div class="text-4xl font-black">+</div>
                <div class="text-lg font-semibold underline group-hover:underline-offset-2">Create a task
                </div>
            </div>
        </a>
    </li>
</ul>
