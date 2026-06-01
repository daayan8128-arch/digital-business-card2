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
        <!-- ✅ Left Side - Form -->
        <div class="form-section">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $editingRecordId ? 'Edit Bank Details' : 'Add Bank Details' }}
                </h2>

                <x-filament-panels::form wire:submit="save">
                    {{ $this->form }}

                    <div class="flex justify-end mt-4">
                        <x-filament::button type="submit" class="bg-primary-600 hover:bg-primary-700">
                            {{ $editingRecordId ? 'Update Bank Details' : 'Save Bank Details' }}
                        </x-filament::button>
                    </div>
                </x-filament-panels::form>
            </div>
        </div>

        <!-- ✅ Right Side - Records List -->
        <div class="data-section">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Existing Bank Details</h2>

                <div class="space-y-4">
                    @if($records->count() > 0)
                        @foreach($records as $record)
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $record->bank_name ?: 'Unnamed Bank' }}</h3>
                                        <p class="text-sm text-gray-600">Account: {{ $record->account_name ?: 'N/A' }}</p>
                                        <p class="text-sm text-gray-600">Branch: {{ $record->branch_name ?: 'N/A' }}</p>
                                        <p class="text-sm text-gray-600">IFSC: {{ $record->ifsc_code ?: 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm"><span class="font-medium text-gray-700">Google Pay:</span> {{ $record->google_pay_number ?: 'N/A' }}</p>
                                        <p class="text-sm"><span class="font-medium text-gray-700">PhonePe:</span> {{ $record->phonepe_number ?: 'N/A' }}</p>
                                        <p class="text-sm"><span class="font-medium text-gray-700">UPI ID:</span> {{ $record->upi_id ?: 'N/A' }}</p>
                                        <p class="text-sm"><span class="font-medium text-gray-700">Paytm:</span> {{ $record->paytm_number ?: 'N/A' }}</p>
                                    </div>
                                </div>

                                @if($record->scanner_image)
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-700">Scanner Image:</p>
                                        <img src="{{ $this->getImageUrl($record->scanner_image) }}" 
                                             alt="Scanner Image" 
                                             class="h-20 w-auto mt-2 rounded border object-contain"
                                             onerror="this.style.display='none'">
                                    </div>
                                @endif

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
                                        wire:confirm="Are you sure you want to delete this bank detail?">
                                        Delete
                                    </x-filament::button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No bank details</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding your first bank details.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
