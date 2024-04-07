@props(['note_id'])

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create a task for note #'.$note_id) }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Can be whatever you need to remember.") }}
        </p>
    </header>

    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('tasks.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <input id="note_id" name="note_id" type="hidden" value="{{$note_id}}" />

        <div>
            <x-input-label for="name" :value="__('Task name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-area id="description" name="description" type="text" class="mt-1 block w-full h-fit" required>
            </x-text-area>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="due_date" :value="__('Due Date')" />
            <x-text-input type="datetime-local" id="due_date" name="due_date" required>
            </x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
        </div>

        <div>
            <div class="flex space-x-2 items-center">
                <x-text-input class="p-4" type="checkbox" id="done" name="done">
                </x-text-input>
                <x-input-label for="done" :value="__('Done')" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('done')" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
