<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Boarding House Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                ->required(),
                Forms\Components\Select::make('boarding_house_id')
                ->relationship('boardingHouse', 'name')
                ->searchable(['name'])
                ->preload()
                ->native(false)
                ->required(),
                Forms\Components\Select::make('room_id')
                ->relationship('room', 'name')
                ->searchable(['name'])
                ->preload()
                ->native(false)
                ->required(),
                Forms\Components\TextInput::make('name')
                ->required(),
                Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
                Forms\Components\TextInput::make('phone_number')
                ->tel()
                ->required(),
                Forms\Components\Select::make('payment_method')
                ->options([
                    'down_payment' => 'Down Payment',
                    'full_payment' => 'Full Payment',
                ])
                ->native(false)
                ->required(),
                Forms\Components\TextInput::make('payment_status')
                ->required(),
                Forms\Components\Datepicker::make('start_date')
                ->native(false)
                ->weekStartsOnMonday()
                ->minDate(now())
                ->maxDate(now()->addDays(7))
                ->displayFormat('d F Y')
                ->locale('id')
                ->required(),
                Forms\Components\TextInput::make('duration')
                ->numeric()
                ->suffix('days')
                ->required(),
                Forms\Components\TextInput::make('total_amount')
                ->numeric()
                ->prefix('IDR')
                ->required(),
                Forms\Components\Datepicker::make('transaction_date')
                ->native(false)
                ->weekStartsOnMonday()
                ->minDate(now())
                ->maxDate(now())
                ->displayFormat('d F Y')
                ->locale('id')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('boardingHouse.name'),
                Tables\Columns\TextColumn::make('room.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('total_amount'),
                Tables\Columns\TextColumn::make('transaction_date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
