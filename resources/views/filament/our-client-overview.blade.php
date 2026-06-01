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

        .form-section,
        .data-section {
            width: 100%;
        }
    </style>

    <div class="side-by-side-layout">
        <!-- ✅ Left Side - Form -->
        <div class="form-section">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $editingRecordId ? 'Edit Client' : 'Add New Client' }}
                </h2>

                <x-filament-panels::form wire:submit="save">
                    {{ $this->form }}

                    <div class="flex justify-end mt-4">
                        <x-filament::button type="submit" class="bg-primary-600 hover:bg-primary-700">
                            {{ $editingRecordId ? 'Update Client' : 'Save Client' }}
                        </x-filament::button>
                    </div>
                </x-filament-panels::form>
            </div>
        </div>

        <!-- ✅ Right Side - Records List -->
        <!-- ✅ Right Side - Records List -->
<div class="data-section">
    <div class="bg-white rounded-lg shadow p-6 h-[600px] flex flex-col">
        <h2 class="text-xl font-semibold mb-4">Existing Clients</h2>

        <!-- 👇 Yahan scroll lagayenge -->
        <div class="space-y-4 overflow-y-auto pr-2" style="max-height: 500px;">
            @if($records->count() > 0)
                @foreach($records as $record)
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        @if($record->client_company_logo)
                            <img src="{{ $this->getImageUrl($record->client_company_logo) }}" 
                                 alt="Client Logo" 
                                 class="h-20 w-auto rounded border object-contain mb-3">
                        @endif

                        <div class="flex space-x-2">
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
                                wire:confirm="Are you sure you want to delete this client?">
                                Delete
                            </x-filament::button>
                        </div>
                    </div>
                @endforeach
            @else
                        <div
                            class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No clients found</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding your first client.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>