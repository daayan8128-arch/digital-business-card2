<?php

namespace App\Filament\Resources\OurPartnerResource\Pages;

use App\Filament\Resources\OurPartnerResource;
use App\Models\our_partner as OurPartner;
use Filament\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class OurPartnerOverview extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = OurPartnerResource::class;
    protected static string $view = 'filament.our-partner-overview';

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
            // ✅ Admin & Super Admin → sab records dekh sakte hain
            $this->records = OurPartner::all();
        } else {
            // ✅ Normal user → sirf apne records dekh sakta hai
            $this->records = OurPartner::where('user_id', $user->id)->get();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('company_logo')
                    ->disk('public_uploads')
                    ->directory('partners')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->placeholder('Upload Partner Company Logo')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function edit($id): void
    {
        $record = OurPartner::find($id);
        $user = Auth::user();

        if ($record && ($user->isAdmin() || $user->isSuperAdmin() || $record->user_id == $user->id)) {
            $this->editingRecordId = $id;
            $this->form->fill($record->toArray());
        }
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $data['user_id'] = Auth::id();

        if ($this->editingRecordId) {
            $record = OurPartner::find($this->editingRecordId);
            if ($record) {
                $record->update($data);
            }
        } else {
            OurPartner::create($data);
        }

        $this->editingRecordId = null;
        $this->form->fill();
        $this->fetchRecords();
    }

    public function delete($id): void
    {
        $record = OurPartner::find($id);
        $user = Auth::user();

        if ($record && ($user->isAdmin() || $user->isSuperAdmin() || $record->user_id == $user->id)) {
            if ($record->company_logo && file_exists(public_path($record->company_logo))) {
                unlink(public_path($record->company_logo));
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
        return asset('uploads/partners/' . basename($path));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sampleOurPartners')
                ->label('Our Partners Sample')
                ->color('primary')
                ->icon('heroicon-o-information-circle')
                ->url('/hardiksengar'),
        ];
    }
}
