@props(['task_id'])

<form method="post" action="{{ route('tasks.destroy', ['id' => $task_id]) }}">
    @csrf
    @method('delete')

    <div class="flex items-center gap-4 justify-end">
        <button type='submit' onclick="return confirm('Are you sure that you want to delete task #{{$task_id}}?')"
            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-500">
            {{ __('Delete') }}</button>
    </div>
</form>
