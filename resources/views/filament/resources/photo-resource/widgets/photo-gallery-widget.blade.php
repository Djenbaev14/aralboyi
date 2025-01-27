<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($photos as $photo)
                <div class="bg-white shadow rounded p-2">
                    <img src="{{ asset('storage/' . $photo) }}" alt="Photo" class="w-full rounded">
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
