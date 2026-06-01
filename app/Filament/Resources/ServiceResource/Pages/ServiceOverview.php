<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Models\Service;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ServiceOverview extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = ServiceResource::class;
    protected static string $view = 'filament.service-overview';

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
            $this->records = Service::all(); // Admin / SuperAdmin see all
        } else {
            $this->records = Service::where('user_id', $user->id)->get(); // Normal users see only their own
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('service_image')
                    ->disk('public_uploads')   
                    ->directory('')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->placeholder('Upload Service Image'),

                TextInput::make('service_name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter Service Name'),

                Textarea::make('service_description')
                    ->required()
                    ->placeholder('Describe the service in detail'),
            ])
            ->statePath('data');
    }

    public function edit($id): void
    {
        $record = Service::find($id);
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
            $record = Service::find($this->editingRecordId);
            if ($record) {
                $record->update($data);
            }
        } else {
            Service::create($data);
        }

        $this->editingRecordId = null;
        $this->form->fill();
        $this->fetchRecords();
    }

    public function delete($id): void
    {
        $record = Service::find($id);
        $user = Auth::user();

        if ($record && ($user->isAdmin() || $user->isSuperAdmin() || $record->user_id == $user->id)) {
            if ($record->service_image && file_exists(public_path('uploads/' . $record->service_image))) {
                unlink(public_path('uploads/' . $record->service_image));
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
            Actions\Action::make('sampleServices')
                ->label('Services Sample')
                ->color('primary')
                ->icon('heroicon-o-information-circle')
                ->url('/hardiksengar/services'),
        ];
    }
}
