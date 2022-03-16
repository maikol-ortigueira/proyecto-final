@props(['items'])
<div class="mx-auto max-w-xl border border-gray-200 bg-white" x-data="{selected:1}">
    <ul class="shadow-box" id="acordeon-pasos">
        @php
            $order = 0;
        @endphp
        @foreach ($items as $item)
            <x-accordion.item order="" >
                {{ $item }}
            </x-accordion.item>
            @php
                $order++;
            @endphp
        @endforeach
    </ul>
</div>
