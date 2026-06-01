<?php

namespace App\Filament\Resources\VisionaryResource\Pages;

use App\Filament\Resources\VisionaryResource;
use App\Models\article as Visionary;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class VisionaryOverview extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = VisionaryResource::class;
    protected static string $view = 'filament.visionary-overview';

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
            $this->records = Visionary::all(); // Admin / SuperAdmin see all
        } else {
            $this->records = Visionary::where('user_id', $user->id)->get(); // Normal users see only their own
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('article_title')
                    ->placeholder('Enter Article Title'),

                Textarea::make('article_description')
                    ->rows(4)
                    ->placeholder('Enter Article Description'),

                FileUpload::make('article_image')
                    ->required()
                    ->disk('public_uploads')
                    ->directory('')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->placeholder('Upload Article Image'),
            ])
            ->statePath('data');
    }

    public function edit($id): void
    {
        $record = Visionary::find($id);
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
            $record = Visionary::find($this->editingRecordId);
            if ($record) {
                $record->update($data);
            }
        } else {
            Visionary::create($data);
        }

        $this->editingRecordId = null;
        $this->form->fill();
        $this->fetchRecords();
    }

    public function delete($id): void
    {
        $record = Visionary::find($id);
        $user = Auth::user();

        if ($record && ( $user->isSuperAdmin() || $record->user_id == $user->id)) {
            if ($record->article_image && file_exists(public_path($record->article_image))) {
                unlink(public_path($record->article_image));
            }
            $record->delete();
            $this->fetchRecords();
        }
    }

    public function getImageUrl($path)
    {
        if (!$path) return null;
        return asset('uploads/' . basename($path));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sampleVisionaries')
                ->label('Visionaries Sample')
                ->color('primary')
                ->icon('heroicon-o-information-circle')
                ->url('/hardiksengar/visionary'),
        ];
    }
}
