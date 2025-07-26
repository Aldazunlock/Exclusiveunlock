<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserStatsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Usuarios Activos', User::where('status', 1)->count())
                ->description('Usuarios con status = 1')
                ->color('success'),

            Card::make('Usuarios Desactivados', User::where('status', 0)->count())
                ->description('Usuarios con status = 0')
                ->color('danger'),

            Card::make('Total de Usuarios', User::count())
                ->description('Total registrados')
                ->color('primary'),
        ];
    }
}