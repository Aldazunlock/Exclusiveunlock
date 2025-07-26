<?php

namespace App\Filament\User\Resources\BookingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('brand_id')
                    ->label('Device Brand')
                    ->relationship('brand', 'title')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('brand_model_id')
                    ->label('Device Model')
                    ->options(function (Forms\Get $get) {
                        $brandId = $get('brand_id');
                        if (!$brandId) {
                            return \App\Models\BrandModel::all()->pluck('title', 'id');
                        }
                        return \App\Models\BrandModel::where('brand_id', $brandId)->pluck('title', 'id');
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('device_number')
                    ->label('IMEI/ESN/SN')
                    ->required(),

                Forms\Components\TextInput::make('color')
                    ->label('Device Color')
                    ->required(),

                Forms\Components\TextInput::make('provider')
                    ->label('Provider Info')
                    ->required(),

                Forms\Components\TextInput::make('device_password')
                    ->label('Device Password')
                    ->required(),

                Forms\Components\TextInput::make('fault_discription')
                    ->label('Fault Description')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required(),

                Forms\Components\Section::make('Initial Check')
                    ->schema([
                        Forms\Components\Select::make('power_on')
                            ->options([
                                '1' => 'Working',
                                '0' => 'Not Working',
                            ])
                            ->required(),

                        Forms\Components\Select::make('charging')
                            ->options([
                                '1' => 'Working',
                                '0' => 'Not Working',
                            ])
                            ->required(),

                        Forms\Components\Select::make('network')
                            ->options([
                                '1' => 'Working',
                                '0' => 'Not Working',
                            ])
                            ->required(),

                        Forms\Components\Select::make('display')
                            ->options([
                                '1' => 'Working',
                                '0' => 'Not Working',
                            ])
                            ->required(),

                        Forms\Components\Select::make('camera')
                            ->options([
                                '1' => 'Working',
                                '0' => 'Not Working',
                            ])
                            ->required(),

                        Forms\Components\Select::make('battery')
                            ->options([
                                '1' => 'Working',
                                '0' => 'Not Working',
                            ])
                            ->required(),
                    ])->columns(6),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.title')
                    ->label('Brand'),

                Tables\Columns\TextColumn::make('brandModel.title')
                    ->label('Model'),

                Tables\Columns\TextColumn::make('device_number')
                    ->label('IMEI/ESN/SN'),

                Tables\Columns\TextColumn::make('amount')
                    ->money(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}