<div>
    <h2 class="text-lg font-bold mb-4">Kontrol Fitur</h2>
    <div class="space-y-4">
        @foreach($features as $feature)
            <div class="flex items-center justify-between p-2 bg-white rounded-lg">
                <div class="flex flex-col">
                    <span class="text-base font-medium text-gray-900">{{ $feature->nama_fitur }}</span>
                    @if($feature->deskripsi)
                        <span class="text-sm text-gray-500 mt-1">{{ $feature->deskripsi }}</span>
                    @endif
                </div>
                <label for="toggle-{{ $feature->id }}" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" id="toggle-{{ $feature->id }}" class="sr-only" 
                               wire:change="toggleFeature({{ $feature->id }})"
                               @if($feature->status === 'aktif') checked @endif>
                        <div class="w-10 h-4 bg-gray-100 rounded-full shadow-inner"></div>
                        <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                    </div>
                </label>
            </div>
        @endforeach
    </div>
    <style>
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #0b79ca;
    }
    </style>
</div>