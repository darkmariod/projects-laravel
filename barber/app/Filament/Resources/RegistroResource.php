<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroResource\Pages;
use App\Models\Registro;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class RegistroResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Etiquetas en español para el recurso
    protected static ?string $navigationLabel = 'Registros';
    protected static ?string $label           = 'Registro';
    protected static ?string $pluralLabel     = 'Registros';
    protected static ?string $createButtonLabel = 'Crear registro';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('fecha')
                    ->label('Fecha')
                    ->required(),

                TextInput::make('clientes')
                    ->label('Clientes')
                    ->numeric()
                    ->required(),

                TextInput::make('diario')
                    ->label('Diario')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        $set('porcentaje_60', round($state * 0.6, 2));
                    }),

                TextInput::make('porcentaje_60')
                    ->label('% 60')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('adelanto')
                    ->label('Adelanto')
                    ->numeric()
                    ->default(0)
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $incentivos = $get('incentivos') ?: 0;
                        $diario = $get('diario') ?: 0;
                        $porcentaje = $get('porcentaje_60') ?: 0;
                        if ($incentivos > 0) {
                            $p = ($diario - $porcentaje - $state) / $incentivos;
                            $set('porcentaje_incentivo', round($p, 2));
                        }
                    }),

                TextInput::make('incentivos')
                    ->label('Incentivos')
                    ->numeric()
                    ->default(0)
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $diario = $get('diario') ?: 0;
                        $porcentaje = $get('porcentaje_60') ?: 0;
                        $adelanto = $get('adelanto') ?: 0;
                        if ($state > 0) {
                            $p = ($diario - $porcentaje - $adelanto) / $state;
                            $set('porcentaje_incentivo', round($p, 2));
                        }
                    }),

                TextInput::make('porcentaje_incentivo')
                    ->label('P: Incentivo')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha')->label('Fecha')->date(),
                TextColumn::make('clientes')->label('Clientes'),
                TextColumn::make('diario')->label('Diario'),
                TextColumn::make('porcentaje_60')->label('% 60'),
                TextColumn::make('adelanto')->label('Adelanto'),
                TextColumn::make('incentivos')->label('Incentivos'),
                TextColumn::make('porcentaje_incentivo')->label('P: Incentivo'),
            ])
            ->actions([
                EditAction::make()->label('Editar'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRegistros::route('/'),
            'create' => Pages\CreateRegistro::route('/create'),
            'edit'   => Pages\EditRegistro::route('/{record}/edit'),
        ];
    }
}
