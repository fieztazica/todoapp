@props(['task'])

<section>
    <form method="post" action="{{ route('tasks.update', ['id' => $task->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Task name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="name" value="{{$task->name}}" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-area id="description" name="description" type="text"
                class="mt-1 block w-full h-fit {{ (strlen($task->description) > 256) ? 'min-h-screen' : 'min-h-96' }}"
                required>{{$task->description}}</x-text-area>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="due_date" :value="__('Due Date')" />
            <x-text-input type="datetime-local" id="due_date" name="due_date" required value="{{$task->due_date}}">
            </x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
        </div>

        <div>
            <div class="flex space-x-2 items-center">
                <x-text-input :checked="$task->done ? true : false" class="p-4" type="checkbox" id="done" name="done" value="{{$task->done ? 'true' : 'false'}}">
                </x-text-input>
                <x-input-label for="done" :value="__('Done')" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('done')" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'task-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
