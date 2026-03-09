@props(['name', 'title'])

<div
    x-data="{ show: false, name: @js($name) }"
    x-show="show"
    x-trap="show"
    @close-modal="show = false"
    @open-modal.window="show = ($event.detail === name)"
    @keydown.escape.window="show = false"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    style="display:none;"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-{{ $name }}-title"
    :aria-hidden="!show"
    tabindex="-1"
    id="modal-{{ $name }}"

>
    <x-cards is="div" @click.away="show = false" class="shadow-xl max-w-2xl w-full max-h-[80dvh] overflow-auto">
        <div class="flex justify-between items-center">
            <h2 id="modal-{{ $name }}-title" class="text-2xl font-bold">{{ $title }}</h2>

            <button type="button" @click="show = false" aria-label="Close the modal">
                <x-icons.close />
            </button>
        </div>

        <div class="mt-4">
            {{ $slot }}
        </div>
    </x-cards>
</div>