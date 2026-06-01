<?php

namespace App\Filament\Resources\OurClientResource\Pages;

use App\Filament\Resources\OurClientResource;
use App\Models\our_client as OurClient;
use Filament\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class OurClientOverview extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = OurClientResource::class;
    protected static string $view = 'filament.our-client-overview';

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

        if ( $user->isSuperAdmin()) {
            $this->records = OurClient::all(); // admin/superadmin → all records
        } else {
            $this->records = OurClient::where('user_id', $user->id)->get(); // normal users → only own records
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('client_company_logo')
                    ->disk('public_uploads')
                    ->directory('clients')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->placeholder('Upload Client Company Logo')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function edit($id): void
    {
        $record = OurClient::find($id);
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
            $record = OurClient::find($this->editingRecordId);
            if ($record) {
                $record->update($data);
            }
        } else {
            OurClient::create($data);
        }

        $this->editingRecordId = null;
        $this->form->fill();
        $this->fetchRecords();
    }

    public function delete($id): void
    {
        $record = OurClient::find($id);
        $user = Auth::user();

        if ($record && ($user->isAdmin() || $user->isSuperAdmin() || $record->user_id == $user->id)) {
            if ($record->client_company_logo && file_exists(public_path($record->client_company_logo))) {
                unlink(public_path($record->client_company_logo));
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

        return asset('uploads/clients/' . basename($path));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sampleOurClients')
                ->label('Our Clients Sample')
                ->color('primary')
                ->icon('heroicon-o-information-circle')
                ->url('/hardiksengar'),
        ];
    }
}
