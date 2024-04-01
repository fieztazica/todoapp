<x-app-layout>
    <div class="text-black dark:text-white px-4 py-2">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                @if ($notes->count())
                <span>{{ $notes->count() }}/{{ $notes->total() }} notes found in page {{ $notes->currentPage()
                    }}/{{ceil($notes->total()/$notes->perPage())}}</span>
                @endif
                <div class="flex space-x-2">
                    @if ($notes->hasPages())
                    <a href="{{$notes->previousPageUrl()}}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Previous</a>
                    <a href="{{$notes->nextPageUrl()}}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Next</a>
                    @endif
                </div>
            </div>
            <x-nav-link :href="route('notes.create')"
                class="text-xl after:content-['+'] after:ml-2 after:text-black dark:after:text-white">
                Create a new one</x-nav-link>
        </div>
        @if ($notes->count() == 0)
        <p>You don't have any note! <x-nav-link :href="route('notes.create')">Create one</x-nav-link>
        </p>
        @else
        <ul class="flex flex-wrap gap-2 py-2">
            @foreach ($notes as $note)
            <li id="note_{{$note->id}}" title="Note #{{$note->id}}">
                <a href="/notes/{{$note->id}}">
                    <div
                        class="group text-pretty p-2 rounded bg-gray-200 dark:bg-gray-800 min-h-48 min-w-48 w-full md:w-fit md:max-w-sm shadow hover:ring-2 transition-all relative">
                        <h3 class="text-xl font-bold truncate">{{ $note->title }}</h3>
                        <p class="text-md break-all text-neutral-800 dark:text-neutral-300 truncate text-pretty mt-2">{{
                            $note->summary }}</p>
                        <div class="absolute bottom-0 right-0 p-2 w-fit hidden group-hover:block">
                            @include('notes.partials.delete-note', ['note' => $note])
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                @if ($notes->count())
                <span>{{ $notes->count() }}/{{ $notes->total() }} notes found</span>
                @endif
                <div class="flex space-x-2">
                    @if ($notes->hasPages())
                    <a href="{{$notes->previousPageUrl()}}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Previous</a>
                    <a href="{{$notes->nextPageUrl()}}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Next</a>
                    @endif
                </div>
            </div>
            <x-nav-link :href="route('notes.create')"
                class="text-xl after:content-['+'] after:ml-2 after:text-black dark:after:text-white">
                Create a new one</x-nav-link>
        </div>
    </div>

</x-app-layout>
