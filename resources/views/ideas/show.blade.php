<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-icons.arrow-back />

                Back to ideas
            </a>

            <div class="gap-x-3 flex items-center">
                <button class="btn btn-outlined">
                    <x-icons.external />

                    Edit idea
                </button>
            </div>

            <form method="post" action="{{ route('idea.destroy', $idea) }}">
                @csrf
                @method('DELETE')

                <button class="btn btn-outlined text-red-500">Delete</button>
            </form>
        </div>

        <div class="mt-8 space-y-6">
            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

            <x-ideas.status :status="$idea->status->value">
                {{ $idea->status->label() }}
            </x-ideas.status>

            <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>

            <x-cards class="mt-6">
                <div class="text-foreground max-w-none">{{ $idea->description }}</div>
            </x-cards>

            @if ($idea->links->count())
                <div>
                    <h3 class="font-bold text-xl mt-6">Links</h3>

                    <div class="mt-3 space-y-2">
                        @foreach ($idea->links as $link)
                            <x-cards :href="$link" class="text-primary font-medium flex gap-x-3 items-center">
                                <x-icons.external />
                                
                                {{ $link }}
                            </x-cards>
                        @endforeach
                    </div>
                </div>
            @else
                <x-cards>
                    <p>No links at this time.</p>
                </x-cards>
            @endif
        </div>
    </div>
</x-layout>
