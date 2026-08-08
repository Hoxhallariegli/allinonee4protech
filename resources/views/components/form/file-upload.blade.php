@props([
    'label' => '',
    'id' => 'file-upload',
    'isEditing' => false,
    'preview' => null,
])

@php
    // Detect preview automatically from the wire:model property if not provided
    if (!$preview && $attributes->wire('model')->value()) {
        $propertyName = $attributes->wire('model')->value();
        $modelValue = $this->{$propertyName} ?? null;

        if ($modelValue) {
            if (is_string($modelValue)) {
                // It's a path from the database
                $preview = asset('uploads/' . $modelValue);
            } elseif (is_object($modelValue) && method_exists($modelValue, 'temporaryUrl')) {
                // It's a temporary upload object
                try {
                    $preview = $modelValue->temporaryUrl();
                } catch (\Exception $e) {}
            }
        }
    }
@endphp

<div class="space-y-2">
    @if($label)
        <label for="{{ $id }}" class="block mb-2 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">
            {{ $label }}
        </label>
    @endif

    <div class="flex items-center gap-4">
        @if($preview)
            <div class="flex-none">
                <div class="relative group">
                    <img src="{{ $preview }}" class="w-24 h-24 object-cover rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl flex items-center justify-center">
                        <x-heroicon-o-eye class="w-6 h-6 text-white" />
                    </div>
                </div>
            </div>
        @endif

        <div
            x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            class="relative flex-1"
        >
            <label class="flex flex-col items-center justify-center w-full h-24 sm:h-24 border-2 border-dashed {{ $errors->has($attributes->get('wire:model')) ? 'border-red-300 bg-red-50/30' : 'border-gray-200' }} dark:border-gray-700 rounded-[2rem] cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all group">
                <div class="flex items-center gap-3 px-4">
                    <div class="p-2 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-cloud-arrow-up class="w-5 h-5" />
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] text-gray-700 dark:text-gray-300 font-bold">
                            {{ ($isEditing || (isset($modelValue) && is_string($modelValue))) ? __('admin.Replace File') : __('admin.Click or Drag') }}
                        </p>
                        <p class="text-[8px] text-gray-400 uppercase">Max 15MB</p>
                    </div>
                </div>
                <input type="file" {{ $attributes }} class="hidden" id="{{ $id }}" />
            </label>

            @error($attributes->get('wire:model')) <p class="text-[9px] text-red-500 font-bold uppercase mt-2">{{ $message }}</p> @enderror

            <!-- Progress Bar -->
            <div x-show="isUploading" class="mt-2 px-2">
                <div class="w-full bg-gray-100 rounded-full h-1 dark:bg-gray-700">
                    <div class="bg-blue-600 h-1 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                </div>
            </div>
        </div>
    </div>
</div>
