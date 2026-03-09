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
    </div>
</x-layout>
