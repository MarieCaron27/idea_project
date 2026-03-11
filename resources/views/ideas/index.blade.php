<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-cards
                x-data
                @click="$dispatch('open-modal', 'create-idea-modal')"
                is="button"
                data-test="create-idea-button"
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
                <form x-data="{ status: 'pending', newLink: '', links: [], newStep: '', steps: [] }"
                    method="post"
                    action="{{ route('idea.store') }}"
                    @submit="links = links.map(l => l.trim()).filter(l => l.length > 0)"
                >                
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
                                        data-test="button-status-{{ $status->value }}"
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

                        <div>
                            <fieldset class="space-y-3">
                                <legend class="label">Steps</legend>

                                <!-- We use JS not PHP here -->
                                <template x-for="(step, index) in steps" :key="step">
                                    <div class="flex gap-x-2 items-center">
                                        <input 
                                            type="text"
                                            name="steps[]" 
                                            x-model="step" 
                                            class="input"
                                            readonly
                                        >

                                        <button type="button" @click="steps.splice(index, 1)" class="form-muted-icon" aria-label="Remove step">
                                            <x-icons.close />
                                        </button>                                    
                                    </div>
                                </template>

                                <div class="flex gap-x-2 items-center">
                                    <input 
                                        x-model="newStep"
                                        type="text"
                                        id="new-step"
                                        placeholder="What needs to be done ?"
                                        class="input flex-1"
                                        spellcheck="false"
                                    >

                                    <button 
                                        type="button" 
                                        @click="
                                            if (newStep.trim()) {
                                                steps.push(newStep.trim());
                                                newStep = '';
                                            }
                                        "
                                        :disabled="newStep.trim().length === 0"
                                        aria-label="Add step button"
                                        class="form-muted-icon"
                                    >
                                        <x-icons.close class="rotate-45"/>
                                    </button>
                                </div>
                            </fieldset>
                        </div>

                        <div>
                            <fieldset class="space-y-3">
                                <legend class="label">Links</legend>

                                <!-- We use JS not PHP here -->
                                <template x-for="(link, index) in links" :key="link">
                                    <div class="flex gap-x-2 items-center">
                                        <input 
                                            type="url"
                                            name="links[]" 
                                            x-model="link" 
                                            class="input"
                                            readonly
                                        >

                                        <button type="button" @click="links.splice(index, 1)" class="form-muted-icon" aria-label="Remove link">
                                            <x-icons.close />
                                        </button>                                    
                                    </div>
                                </template>

                                <div class="flex gap-x-2 items-center">
                                    <input 
                                        x-model="newLink"
                                        type="url"
                                        id="new-link"
                                        placeholder="https://example.com"
                                        autocomplete="url"
                                        class="input flex-1"
                                        spellcheck="false"
                                    >

                                    <button 
                                        type="button" 
                                        @click="
                                            if (newLink.trim()) {
                                                links.push(newLink.trim());
                                                newLink = '';
                                            }
                                        "
                                        :disabled="newLink.trim().length === 0"
                                        aria-label="Add link button"
                                        class="form-muted-icon"
                                    >
                                        <x-icons.close class="rotate-45"/>
                                    </button>
                                </div>
                            </fieldset>
                        </div>

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