<x-filament-panels::page>
    <style>
        .side-by-side-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 1024px) {
            .side-by-side-layout {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-section, .data-section {
            width: 100%;
        }
    </style>

    <div class="side-by-side-layout">
        <!-- Left Side - Form -->
        <div class="form-section">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $editingRecordId ? 'Edit Service' : 'Add Service' }}
                </h2>

                <x-filament-panels::form wire:submit="save">
                    {{ $this->form }}

                    <div class="flex justify-end mt-4">
                        <x-filament::button type="submit" class="bg-primary-600 hover:bg-primary-700">
                            {{ $editingRecordId ? 'Update Service' : 'Save Service' }}
                        </x-filament::button>
                    </div>
                </x-filament-panels::form>
            </div>
        </div>

        <!-- Right Side - Records List -->
        <div class="data-section">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Existing Services</h2>

                <div class="space-y-4">
                    @if($records->count() > 0)
                        @foreach($records as $record)
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-start space-x-4">
                                    @if($record->service_image)
                                        <img src="{{ $this->getImageUrl($record->service_image) }}"
                                             alt="Service Image"
                                             class="h-16 w-16 rounded object-cover border flex-shrink-0"
                                             onerror="this.style.display='none'">
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-800 truncate">
                                            {{ $record->service_name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 break-words line-clamp-2">
                                            {{ $record->service_description }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex space-x-2">
                                    <x-filament::button 
                                        wire:click="edit({{ $record->id }})" 
                                        size="sm"
                                        color="primary">
                                        Edit
                                    </x-filament::button>

                                    <x-filament::button 
                                        wire:click="delete({{ $record->id }})" 
                                        size="sm"
                                        color="danger"
                                        wire:confirm="Are you sure you want to delete this service?">
                                        Delete
                                    </x-filament::button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No services yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding your first service.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
