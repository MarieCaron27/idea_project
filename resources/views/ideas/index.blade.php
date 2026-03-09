<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-cards
                x-data
                @click="$dispatch('open-modal', 'create-idea-modal')"
                is="button"
                class="mt-10 cursor-pointer h-32 w-full text-left"
            >
                <p>What's the idea ?</p>
            </x-cards>
        </header>

        <div>
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : ' ' }}">All</a>

            @foreach (App\IdeaStatus::cases() as $status)
                <a 
                    href="/ideas?status={{ $status->value }}" 
                    class="btn {{ request('status') === $status->value ? ' ' : 'btn-outlined' }}"
                >
                    {{ $status->label() }}

                    <span class="text-xs pl-3">{{ $statusCount->get($status->value) }}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-muted-foreground">
          <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                <x-cards href="{{ route('idea.show', $idea) }}">
                    <h3 class="text-foreground text-lg"> {{ $idea->title }} </h3>

                    <div class="mt-1">
                        <x-ideas.status status="{{ $idea->status }}">
                            {{ $idea->status->label() }}
                        </x-ideas.status>                    
                    </div>

                    <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                    <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                </x-cards>

                @empty
                    <x-cards>
                        <p>No ideas at this time.</p>
                    </x-cards>
                @endforelse
            </div>  
        </div>

        <div>
            <x-modal name="create-idea-modal" title="New Idea">
                <form x-data="{status: 'pending'}" method="post" action="{{ route('idea.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <x-forms.field 
                            label="Title" 
                            name="title" 
                            placeholder="Enter a title for your idea"
                            autofocus
                        />
                        
                        <div class="space-y-2">
                            <label for="status" class="label">Status</label>

                            <div class="flex gap-x-3">
                                @foreach (App\IdeaStatus::cases() as $status)
                                    <button 
                                        type="button"
                                        @click="status = @js($status->value)"
                                        class="btn flex-1 h-10"
                                        :class="status !== @js($status->value) ? 'btn-outlined' : ''"
                                    >
                                        {{ $status->label() }}
                                    </button>
                                @endforeach
                                <input type="hidden" name="status" :value="status" />
                            </div>
                        </div>

                        <x-forms.error name="status"/>

                        <x-forms.field 
                            label="Description" 
                            name="description" 
                            type="textarea"
                            placeholder="Describe your idea..."
                        />

                        <div class="flex justify-end gap-x-5">
                            <button type="submit" class="btn">Create</button>
                            <button type="button" @click="$dispatch('close-modal')">Cancel</button>
                        </div>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-layout>