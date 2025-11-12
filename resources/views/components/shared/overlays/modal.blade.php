@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4 py-6 sm:px-0"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform"
        x-on:click="show = false"
        x-transition:enter="modal-overlay-enter"
        x-transition:enter-start="modal-overlay-enter-start"
        x-transition:enter-end="modal-overlay-enter-end"
        x-transition:leave="modal-overlay-leave"
        x-transition:leave-start="modal-overlay-leave-start"
        x-transition:leave-end="modal-overlay-leave-end"
    >
        <div class="absolute inset-0 bg-slate-900/60"></div>
    </div>

    <div
        x-show="show"
        class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="modal-panel-enter"
        x-transition:enter-start="modal-panel-enter-start"
        x-transition:enter-end="modal-panel-enter-end"
        x-transition:leave="modal-panel-leave"
        x-transition:leave-start="modal-panel-leave-start"
        x-transition:leave-end="modal-panel-leave-end"
    >
        {{ $slot }}
    </div>
</div>
