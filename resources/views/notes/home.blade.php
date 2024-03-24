<x-app-layout>
    <div class="text-white px-4 py-2">
        Notes
        {{ $notes->count() }}
        @if (count($notes) == 0)
            <p>You don't have any note! <x-nav-link :href="route('notes.create')">Create one</x-nav-link></p>
        @else
            <ul class="flex-wrap">
                @foreach ($notes as $note)
                    <li>
                        <a href="/notes/{{$note->id}}">
                            <div class="p-2 rounded bg-gray-800">
                            {{ $note->id }}
                            {{ $note->title }}
                            </div>
                        </a>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</x-app-layout>
