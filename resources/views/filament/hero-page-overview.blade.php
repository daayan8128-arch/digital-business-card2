<x-filament-panels::page>
    <style>
        .side-by-side-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            /* Left form बड़ा, Right छोटा */
            gap: 20px;
        }

        .records-container {
            max-height: 500px;
            /* 👈 Fixed height */
            overflow-y: auto;
            /* 👈 Scrollbar enable */
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            padding: 12px;
        }

        .records-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            /* Right table थोड़ा छोटा */
        }

        .records-table th,
        .records-table td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .records-table th {
            background-color: #f9fafb;
            text-align: left;
            font-size: 12px;
        }

        .record-image {
            width: 50px;
            height: auto;
            border-radius: 6px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #3b82f6;
            color: white;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
        }
    </style>

    <div class="side-by-side-layout">
        {{-- Left: Form --}}
        <div>
            <h2 class="text-lg font-bold mb-3">
                {{ $editingRecordId ? 'Edit Hero Page' : 'Add Hero Page' }}
            </h2>
            <form wire:submit.prevent="save">
                {{ $this->form }}
                <div class="mt-4">
                    <x-filament::button type="submit">
                        {{ $editingRecordId ? 'Update' : 'Save' }}
                    </x-filament::button>
                </div>
            </form>
        </div>

        {{-- Right: Records List (Scrollable) --}}
        <div>
            <h2 class="text-base font-bold mb-3">Hero Pages</h2>
            <div class="records-container">
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>Hero Image</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $record)
                            <tr>
                                <td>
                                    @if($record->heroimage)
                                        <img src="{{ $this->getImageUrl($record->heroimage) }}" alt="Hero Image" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>{{ $record->title }}</td>
                                <td>{{ $record->subtitle }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button wire:click="edit({{ $record->id }})" type="button" class="btn btn-edit">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $record->id }})" type="button" class="btn btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Hero Pages Found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>