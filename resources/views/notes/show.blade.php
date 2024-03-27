<x-app-layout>
    <div class="text-white px-4 py-2">
        Note #{{ $note->id }}
        <h3 class="text-xl font-bold"> {{ $note->title }}</h3>
        <textarea class="text-black">{{ $note->content }}</textarea>
    </div>

</x-app-layout>
