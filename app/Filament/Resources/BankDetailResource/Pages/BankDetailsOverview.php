<?php

namespace App\Filament\Resources\BankDetailResource\Pages;

use App\Filament\Resources\BankDetailResource;
use App\Models\bank_detail as BankDetail;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;

class BankDetailsOverview extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = BankDetailResource::class;
    protected static string $view = 'filament.bank-details-overview';

    public ?array $data = [];
    public $records;


    public ?int $editingRecordId = null;

    public function mount(): void
    {
        $this->fetchRecords();
        $this->form->fill();
    }

    protected function fetchRecords()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $this->records = BankDetail::all();
        } else {
            $this->records = BankDetail::where('user_id', $user->id)->get();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('google_pay_number')->numeric()->nullable()->placeholder('Enter Google Pay Number'),
                TextInput::make('phonepe_number')->numeric()->nullable()->placeholder('Enter PhonePe Number'),
                TextInput::make('upi_id')->nullable()->placeholder('Enter UPI ID'),
                TextInput::make('paytm_number')->numeric()->nullable()->placeholder('Enter Paytm Number'),
                TextInput::make('account_name')->nullable()->placeholder('Enter Account Name'),
                TextInput::make('bank_name')->nullable()->placeholder('Enter Bank Name'),
                TextInput::make('branch_name')->nullable()->placeholder('Enter Branch Name'),
                TextInput::make('ifsc_code')->nullable()->placeholder('Enter IFSC Code'),

                FileUpload::make('scanner_image')
                    ->disk('public_uploads')
                    ->directory('')
                    ->image()
                    ->moveFiles()
                    ->preserveFilenames()
            ])
            ->statePath('data');
    }

    //  Edit mode
    public function edit($id): void
    {
        $record = BankDetail::find($id);
        $user = Auth::user();

        if ($record && ($user->isSuperAdmin() || $record->user_id == $user->id)) {
            $this->editingRecordId = $id;
            $this->form->fill($record->toArray());
        }
    }

    // 👇 Save (Create or Update)
    public function save(): void
    {
        $data = $this->form->getState();
        $data['user_id'] = Auth::id();

        if ($this->editingRecordId) {
            $record = BankDetail::find($this->editingRecordId);
            if ($record && empty($data['scanner_image'])) {
                $data['scanner_image'] = $record->scanner_image;
            }
        }

        $data['scanner_image'] = $this->normalizeScannerImageState($data['scanner_image']);

        try {
            \Log::info('BankDetailsOverview::save - form state', $data);
        } catch (\Throwable $e) {
            \Log::error('BankDetailsOverview::save - logging failed: ' . $e->getMessage());
        }

        if ($this->editingRecordId) {
            $record = BankDetail::find($this->editingRecordId);
            if ($record) {
                $record->update($data);
            }
        } else {
            BankDetail::create($data);
        }

        $this->editingRecordId = null;
        $this->form->fill();
        $this->fetchRecords();
    }

    protected function normalizeScannerImageState($scannerImage): ?string
    {
        
        if (empty($scannerImage)) {
            return null;
        }

        $scanner = is_array($scannerImage) ? ($scannerImage[0] ?? null) : $scannerImage;
        if (empty($scanner)) {
            return null;
        }

        if ($scanner instanceof TemporaryUploadedFile || $scanner instanceof UploadedFile) {
            $filename = $scanner->getClientOriginalName();
            $safeName = $this->makeSafeFilename($filename);
            Storage::disk('public_uploads')->putFileAs('', $scanner, $safeName);
            return $safeName;
        }

        if (is_string($scanner)) {
            $name = basename($scanner);
            if (Storage::disk('public_uploads')->exists($name) || file_exists(public_path('uploads/' . $name))) {
                return $name;
            }

            $candidates = [
                public_path(ltrim($scanner, '/')),
                public_path('uploads/' . $name),
                storage_path('app/public/' . ltrim($scanner, '/')),
                storage_path('app/public/' . $name),
                storage_path('app/public/scanner-images/' . $name),
            ];

            $found = null;
            foreach ($candidates as $candidate) {
                if ($candidate && file_exists($candidate)) {
                    $found = $candidate;
                    break;
                }
            }

            if ($found) {
                $safeName = $this->makeSafeFilename($name);
                $destination = public_path('uploads/' . $safeName);

                if (!is_dir(public_path('uploads'))) {
                    mkdir(public_path('uploads'), 0755, true);
                }

                if (!file_exists($destination)) {
                    if (!rename($found, $destination)) {
                        copy($found, $destination);
                    }
                }

                return $safeName;
            }

            return $name;
        }

        return null;
    }

    protected function makeSafeFilename(string $filename): string
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $base = pathinfo($filename, PATHINFO_FILENAME);
        $safeBase = Str::slug(substr($base, 0, 50)) ?: 'scanner';

        return time() . '_' . $safeBase . ($extension ? '.' . $extension : '');
    }

    public function delete($id): void
    {
        $record = BankDetail::find($id);
        $user = Auth::user();

        if ($record && ($user->isSuperAdmin() || $record->user_id == $user->id)) {
            $imagePath = public_path('uploads/' . basename($record->scanner_image));
            if ($record->scanner_image && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $record->delete();
            $this->fetchRecords();
        }
    }

    public function getImageUrl($path)
    {
        if (!$path) {
            return null;
        }
        return asset('uploads/' . basename($path));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('bankDetailsSample')
                ->label('Bank Details Sample')
                ->color('primary')
                ->icon('heroicon-o-information-circle')
                ->url('/hardiksengar/bank-details'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        // Default label
        $label = 'Services';

        // ✅ Only for normal users (not admin / superadmin)
        if ($user->isUser()) {
            if ($user->is_premium == 0) {
                $label .= ' 👑';
            }
        }

        return $label;
    }
}
