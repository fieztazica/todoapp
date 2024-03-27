<x-app-layout>
    <div class="text-white px-4 py-2">

        <div class="flex justify-between items-center">
            @if ($notes->count())
            <span>{{ $notes->count() }} notes found</span>
            @endif
            <div class="flex space-x-2">
                <x-nav-link :href="route('notes.create')"
                    class="text-xl after:content-['+'] after:ml-2 after:text-white">Create a new one</x-nav-link>
                @if ($notes->hasPages())
                <a href="{{$notes->previousPageUrl()}}"
                    class="px-4 py-2 bg-gray-800 rounded-md hover:bg-gray-700 transition-all">Previous</a>
                <a href="{{$notes->nextPageUrl()}}"
                    class="px-4 py-2 bg-gray-800 rounded-md hover:bg-gray-700 transition-all">Next</a>
                @endif
            </div>
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
                        class="text-pretty p-2 rounded bg-gray-800 min-h-48 min-w-48 w-full md:w-fit md:max-w-sm shadow hover:ring-2 transition-all">
                        <h3 class="text-xl font-bold truncate">{{ $note->title }}</h3>
                        <p class="text-md break-all text-neutral-300 truncate text-pretty mt-2">{{ $note->summary }}</p>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

</x-app-layout>
