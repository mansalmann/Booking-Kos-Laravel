<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\BoardingHouse;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Filament\Resources\BoardingHouseResource\RelationManagers;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Boarding House Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Main Information')
                            ->schema([
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                                    ->directory('boarding_houses')
                                    ->maxSize(1024)
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        null,
                                        '9:16',
                                        '16:9',
                                        '4:3',
                                        '1:1'
                                    ])
                                    ->required()
                                    ->storeFileNamesIn('attachment_file_names'),
                                Forms\Components\TextInput::make('name')
                                    ->autocomplete(false)
                                    ->autocapitalize()
                                    ->maxLength(50)
                                    ->required()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $originalSlug = Str::slug($state);
                                        $slug = $originalSlug;
                                        $counter = 1;

                                        while (BoardingHouse::where('slug', $slug)->exists()) {
                                            $slug = $originalSlug . '-' . $counter;
                                            $counter++;
                                        }

                                        $set('slug', $slug);
                                    })
                                    ->debounce(2000),
                                Forms\Components\TextInput::make('slug')
                                ->readOnly()
                                    ->required()
                                    ->markAsRequired(false),
                                Forms\Components\Select::make('city_id')
                                    ->relationship('city', 'name')
                                    ->searchable(['name'])
                                    ->preload()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable(['name'])
                                    ->preload()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('gender')
                                    ->native(false)
                                    ->options([
                                        'Pria',
                                        'Wanita',
                                        'Campur'
                                    ])
                                    ->required(),
                                Forms\Components\RichEditor::make('description')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->inputMode('decimal')
                                    ->minValue(0)
                                    ->step(50000)
                                    ->required(),
                                Forms\Components\TextArea::make('address')
                                    ->required(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Rooms')
                            ->schema([
                                Forms\Components\Repeater::make('rooms')
                                    ->relationship('rooms')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                        ->autocomplete(false)
                                        ->autocapitalize()
                                        ->maxLength(50)
                                        ->required(),
                                        Forms\Components\TextInput::make('room_type')
                                        ->autocomplete(false)
                                        ->autocapitalize()
                                        ->maxLength(50)
                                        ->required(),
                                        Forms\Components\TextInput::make('square_feet')
                                        ->numeric()
                                        ->suffix('m²')
                                        ->inputMode('decimal')
                                        ->minValue(0)
                                        ->maxValue(20)
                                        ->required(),
                                        Forms\Components\TextInput::make('price_per_month')
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->inputMode('decimal')
                                        ->minValue(0)
                                        ->step(50000)
                                        ->required(),
                                        Forms\Components\TextInput::make('capacity')
                                        ->numeric()
                                        ->suffix('person')
                                        ->inputMode('decimal')
                                        ->minValue(1)
                                        ->maxValue(5)
                                        ->required(),
                                        Forms\Components\Toggle::make('is_available')
                                        ->required(),
                                        Forms\Components\Repeater::make('images')
                                        ->relationship('images')
                                        ->schema([
                                            Forms\Components\FileUpload::make('image')
                                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                                            ->directory('room_images')
                                            ->maxSize(1024)
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                null,
                                                '9:16',
                                                '16:9',
                                                '4:3',
                                                '1:1'
                                            ])
                                            ->required()
                                            ->storeFileNamesIn('attachment_file_names'),
                                        ])
                                    ])

                            ]),
                        Forms\Components\Tabs\Tab::make('Bonuses')
                            ->schema([
                                Forms\Components\Repeater::make('bonuses')
                                    ->relationship('bonuses')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                                        ->directory('bonuses')
                                        ->maxSize(1024)
                                        ->imageEditor()
                                        ->imageEditorAspectRatios([
                                            null,
                                            '9:16',
                                            '16:9',
                                            '4:3',
                                            '1:1'
                                        ])
                                        ->storeFileNamesIn('attachment_file_names')
                                        ->required(),
                                    Forms\Components\TextInput::make('name')
                                        ->autocomplete(false)
                                        ->autocapitalize()
                                        ->maxLength(50)
                                        ->required(),
                                    Forms\Components\TextArea::make('description')
                                        ->required()
                                        ])
                                    ->collapsible(),

                            ]),
                        ])                       
                    ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('city.name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('price'),
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
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
