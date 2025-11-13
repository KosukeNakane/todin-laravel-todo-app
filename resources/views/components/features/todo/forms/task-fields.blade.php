@props([
    'titleId' => 'title',
    'descriptionId' => 'description',
    'dueDateId' => 'due_date',
    'priorityId' => 'priority',
    'titleValue' => '',
    'descriptionValue' => '',
    'dueDateValue' => '',
    'priorityValue' => 0,
    'priorityLabel' => '優先度',
    'variant' => 'default',
    'groupLayout' => 'stack',
    'titlePlaceholder' => '例：週次ミーティングの準備',
    'descriptionPlaceholder' => 'メモや詳細をここに残せます',
])

@php
    $variantKey = $variant === 'compact' ? 'compact' : 'default';
@endphp

<div class="space-y-4">
    <div>
        <x-shared.forms.input-label :for="$titleId" :variant="$variantKey">
            タイトル
        </x-shared.forms.input-label>
        <x-shared.forms.text-input id="{{ $titleId }}" name="title" type="text" :value="$titleValue" :placeholder="$titlePlaceholder" :variant="$variantKey" required />
    </div>

    <div>
        <x-shared.forms.input-label :for="$descriptionId" :variant="$variantKey">
            内容
        </x-shared.forms.input-label>
        <x-shared.forms.textarea id="{{ $descriptionId }}" name="description" rows="3" :variant="$variantKey" placeholder="{{ $descriptionPlaceholder }}">{{ $descriptionValue }}</x-shared.forms.textarea>
    </div>

    @if ($groupLayout === 'grid')
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-shared.forms.input-label :for="$dueDateId" :variant="$variantKey">
                    期限
                </x-shared.forms.input-label>
                <x-shared.forms.text-input
                    id="{{ $dueDateId }}"
                    name="due_date"
                    type="text"
                    data-date-picker
                    autocomplete="off"
                    inputmode="numeric"
                    placeholder="YYYY-MM-DD"
                    :value="$dueDateValue"
                    :variant="$variantKey"
                />
            </div>
            <div>
                <x-shared.forms.input-label :for="$priorityId" :variant="$variantKey">
                    {{ $priorityLabel }}
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="{{ $priorityId }}" name="priority" type="number" min="0" max="5" :value="$priorityValue" :variant="$variantKey" />
            </div>
        </div>
    @else
        <div>
            <x-shared.forms.input-label :for="$dueDateId" :variant="$variantKey">
                期限
            </x-shared.forms.input-label>
            <x-shared.forms.text-input
                id="{{ $dueDateId }}"
                name="due_date"
                type="text"
                data-date-picker
                autocomplete="off"
                inputmode="numeric"
                placeholder="YYYY-MM-DD"
                :value="$dueDateValue"
                :variant="$variantKey"
            />
        </div>
        <div>
            <x-shared.forms.input-label :for="$priorityId" :variant="$variantKey">
                {{ $priorityLabel }}
            </x-shared.forms.input-label>
            <x-shared.forms.text-input id="{{ $priorityId }}" name="priority" type="number" min="0" max="5" :value="$priorityValue" :variant="$variantKey" />
        </div>
    @endif
</div>
