@props(['note'])

<section>
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create a note') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Can be whatever you need to remember.") }}
        </p>
    </header> --}}

    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('notes.update', ['id' => $note->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="title" value="{{$note->title}}" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="content" :value="__('Content')" />
            <x-text-area id="content" name="content" type="text" class="mt-1 block w-full h-fit {{ (strlen($note->content) > 256) ? 'min-h-screen' : 'min-h-96' }}" required>{{$note->content}}</x-text-area>
            <x-input-error class="mt-2" :messages="$errors->get('content')" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            @include('notes.partials.delete-note', ['note' => $note])
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'note-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
