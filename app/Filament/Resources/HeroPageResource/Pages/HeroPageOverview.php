<?php

namespace App\Filament\Resources\HeroPageResource\Pages;

use App\Filament\Resources\HeroPageResource;
use App\Models\HeroPage;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Actions;

class HeroPageOverview extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = HeroPageResource::class;
    protected static string $view = 'filament.hero-page-overview';

    public ?array $data = [];
    public $records;
    public ?int $editingRecordId = null;

    public function mount(): void
    {
        $this->fetchRecords();
        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sampleHeroPage')
                ->label('Hero Page Sample')
                ->color('primary')
                ->icon('heroicon-o-information-circle')
                ->url('/hardiksengar'),
        ];
    }

    protected function fetchRecords()
    {
        $user = Auth::user();

        if ( $user->isSuperAdmin()) {
            $this->records = HeroPage::all();
        } else {
            $this->records = HeroPage::where('user_id', $user->id)->get();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('heroimage')
                    ->required()
                    ->disk('public_uploads')
                    ->directory('')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->placeholder('Upload Hero Image'),

                TextInput::make('title')->label('Title'),
                TextInput::make('subtitle')->label('Subtitle'),
            ])
            ->statePath('data');
    }

    public function edit($id): void
    {
        $user = Auth::user();
        $record = HeroPage::find($id);

        if ($record && ($user->isAdmin() || $user->isSuperAdmin() || $record->user_id === $user->id)) {
            $this->editingRecordId = $id;
            $this->form->fill($record->toArray());
        }
    }

    public function save(): void
    {
        $user = Auth::user();
        $data = $this->form->getState();
        $data['user_id'] = $user->id;

        if ($this->editingRecordId) {
            $record = HeroPage::find($this->editingRecordId);
            if ($record) {
                $record->update($data);
            }
        } else {
            HeroPage::create($data);
        }

        $this->editingRecordId = null;
        $this->form->fill();
        $this->fetchRecords();
    }

    public function delete($id): void
    {
        $user = Auth::user();
        $record = HeroPage::find($id);

        if ($record && ($user->isAdmin() || $user->isSuperAdmin() || $record->user_id === $user->id)) {
            if ($record->heroimage && file_exists(public_path($record->heroimage))) {
                unlink(public_path($record->heroimage));
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
}
