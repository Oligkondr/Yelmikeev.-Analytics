<?php

use App\Console\Commands\GetDataCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GetDataCommand::class, ['sales', '--yesterday'])->dailyAt('00:04');
Schedule::command(GetDataCommand::class, ['orders', '--yesterday'])->dailyAt('00:05');
Schedule::command(GetDataCommand::class, ['incomes', '--yesterday'])->dailyAt('00:06');

Schedule::command(GetDataCommand::class, ['sales'])->dailyAt('12:04');
Schedule::command(GetDataCommand::class, ['orders'])->dailyAt('12:05');
Schedule::command(GetDataCommand::class, ['incomes'])->dailyAt('12:06');

Schedule::command(GetDataCommand::class, ['stocks'])->dailyAt('12:00');
Schedule::command(GetDataCommand::class, ['stocks'])->dailyAt('23:55');
