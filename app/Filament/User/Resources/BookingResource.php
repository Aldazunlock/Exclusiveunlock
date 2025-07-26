<?php

namespace App\Filament\User\Resources;

use Filament\Tables\Actions\Action;

use App\Filament\User\Resources\BookingResource\Pages;
use App\Filament\User\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use app\Filament\User\Resources\BookingResource\RelationManagers\StatusHistoriesRelationManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Customer;
use App\Models\Brand;
use App\Models\BrandModel;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🔹 Información del trabajo
                Forms\Components\Section::make('Job Information')
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->label('Customer Name')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->required()
                            ->live()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\TextInput::make('email')->email()->required(),
                                Forms\Components\TextInput::make('phone')->required(),
                            ])
                            ->createOptionUsing(fn(array $data) => Customer::create($data)->getKey()),

                        Forms\Components\Select::make('service_id')
                            ->label('Service')
                            ->options(fn() => \App\Models\Service::pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre del servicio')
                                    ->required(),
                            ])
                            ->createOptionUsing(fn(array $data) => \App\Models\Service::create($data)->id),

                        Forms\Components\TextInput::make('imei')
                            ->label('IMEI')
                            ->maxLength(15)
                            ->required(),

                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->required(),

                        Forms\Components\DatePicker::make('receive_date')
                            ->label('Receive Date')
                            ->required()
                            ->native(false),

                        Forms\Components\DatePicker::make('delivery_date')
                            ->label('Delivery Date')
                            ->required()
                            ->native(false),

                        Forms\Components\TextInput::make('technician')
                            ->label('Job Pending with')
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),

                        Forms\Components\Textarea::make('note')
                            ->label('Note')
                            ->rows(3),
                    ])
                    ->columns(2),

                // 🔹 Información del dispositivo
                Forms\Components\Section::make('Device Information')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->defaultItems(1)
                            ->addActionLabel('Add More Devices')
                            ->columnSpanFull()
                            ->schema([
                                Forms\Components\Select::make('brand_id')
                                    ->label('Device Brand')
                                    ->options(fn() => Brand::all()->pluck('title', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(fn($state, Forms\Set $set) => $set('brand_model_id', null)),

                                Forms\Components\Select::make('brand_model_id')
                                    ->label('Device Model')
                                    ->options(
                                        fn(Forms\Get $get) =>
                                        $get('brand_id')
                                            ? \App\Models\BrandModel::where('brand_id', $get('brand_id'))->pluck('title', 'id')
                                            : \App\Models\BrandModel::all()->pluck('title', 'id')
                                    )
                                    ->searchable()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Modelo')
                                            ->required(),
                                        Forms\Components\Hidden::make('brand_id')
                                            ->default(fn(Forms\Get $get) => $get('brand_id'))
                                            ->required(),
                                    ])
                                    ->createOptionUsing(fn(array $data) => \App\Models\BrandModel::create($data)->id),

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

                                // 🔸 Estado del dispositivo
                                Forms\Components\Section::make('Status Information')
                                    ->schema([
                                        Forms\Components\Select::make('status')
                                            ->label('Status')
                                            ->options(Booking::statusOptions())
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set, $record) {
                                                if ($record) {
                                                    $set('status_notes', "Estado cambiado a: " . Booking::statusOptions()[$state]);
                                                }
                                            }),

                                        Forms\Components\Textarea::make('status_notes')
                                            ->label('Status Change Notes')
                                            ->columnSpanFull(),
                                    ]),

                                // 🔸 Revisión inicial
                                Forms\Components\Section::make('Initial Check')
                                    ->schema([
                                        Forms\Components\Select::make('power_on')
                                            ->options(['1' => 'Working', '0' => 'Not Working'])
                                            ->required(),

                                        Forms\Components\Select::make('charging')
                                            ->options(['1' => 'Working', '0' => 'Not Working'])
                                            ->required(),

                                        Forms\Components\Select::make('network')
                                            ->options(['1' => 'Working', '0' => 'Not Working'])
                                            ->required(),

                                        Forms\Components\Select::make('display')
                                            ->options(['1' => 'Working', '0' => 'Not Working'])
                                            ->required(),

                                        Forms\Components\Select::make('camera')
                                            ->options(['1' => 'Working', '0' => 'Not Working'])
                                            ->required(),

                                        Forms\Components\Select::make('battery')
                                            ->options(['1' => 'Working', '0' => 'Not Working'])
                                            ->required(),
                                    ])
                                    ->columns(6),
                            ]),
                    ]),

                // 🔹 Notas adicionales
                Forms\Components\Section::make('Description & Remarks')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Other Notes')
                            ->columnSpanFull(),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'in_progress' => 'info',
                        'waiting_parts' => 'warning',
                        'completed' => 'success',
                        'delivered' => 'primary',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => Booking::statusOptions()[$state] ?? $state),

                Tables\Columns\TextColumn::make('receive_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('delivery_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('technician')
                    ->label('Technician')
                    ->searchable(),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Devices')
                    ->counts('items'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn(Booking $record): string => route('bookings.print', $record))
                    ->openUrlInNewTab()
                    ->visible(fn(): bool => auth()->user()->can('print', Booking::class)),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('technician')
                    ->options(fn() => Booking::pluck('technician', 'technician')->unique()),

                Tables\Filters\Filter::make('receive_date')
                    ->form([
                        Forms\Components\DatePicker::make('receive_from'),
                        Forms\Components\DatePicker::make('receive_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['receive_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('receive_date', '>=', $date)
                            )
                            ->when(
                                $data['receive_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('receive_date', '<=', $date)
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('print_job')
                    ->label('Print Job')
                    ->icon('heroicon-o-printer')
                    ->url(fn(Booking $record): string => route('job.recept', $record))
                    ->openUrlInNewTab(),
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
            RelationManagers\ItemsRelationManager::class,
            RelationManagers\StatusHistoryRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}