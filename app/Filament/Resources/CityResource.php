<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CityResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CityResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                ->directory('cities')               
                ->maxSize(1024)
                ->imageEditor()
                ->imageEditorAspectRatios([
                    null,
                    '9:16',
                    '16:9',
                    '4:3',
                    '1:1'])
                ->columnSpan(2)
                ->storeFileNamesIn('attachment_file_names')
                ->required(),
                Forms\Components\TextInput::make('name')
                ->autocomplete(false)
                ->autocapitalize()
                ->maxLength(50)
                ->required()
                ->afterStateUpdated(function ($state, callable $set){
                    $originalSlug = Str::slug($state);
                    $slug = $originalSlug;
                    $counter = 1;
            
                    while (City::where('slug', $slug)->exists()) {
                        $slug = $originalSlug . '-' . $counter;
                        $counter++;
                    }
            
                    $set('slug', $slug);
                })
                ->debounce(2000),
                Forms\Components\TextInput::make('slug')
                ->readOnly()
                ->required() 
                ->markAsRequired(false) 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }

    public function afterCreate(): void
    {
    $oldFiles = Storage::files('livewire-tmp');
        foreach($oldFiles as $file){
            Storage::delete($file);
        }
    }
}
