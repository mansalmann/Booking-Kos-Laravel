<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Boarding House Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                ->directory('testimonials')               
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
                Forms\Components\Select::make('boarding_house_id')
                ->relationship('boardingHouse', 'name')
                ->searchable(['name'])
                ->preload()
                ->native(false)
                ->columnSpan(2)
                ->required(),
                Forms\Components\TextInput::make('name')
                ->autocomplete(false)
                ->autocapitalize()
                ->maxLength(50)
                ->required(),
                Forms\Components\TextInput::make('rating')
                ->numeric()
                ->minValue(1)
                ->maxValue(5)
                ->step(0.5)
                ->required(),
                Forms\Components\TextArea::make('content')
                ->columnSpan(2)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo'),
                Tables\Columns\TextColumn::make('boardingHouse.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('rating'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
