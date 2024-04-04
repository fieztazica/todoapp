<x-app-layout>
    <div class="container text-white px-4 py-8 mx-auto">
        <div class="w-full ">
            @include('tasks.partials.create-task-form', ['note_id' => $note_id])
        </div>
    </div>
</x-app-layout>
