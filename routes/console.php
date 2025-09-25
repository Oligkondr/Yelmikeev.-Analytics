<?php

use App\Console\Commands\GetDataCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GetDataCommand::class, ['sales', '--acc-id=1', '--yesterday'])->dailyAt('00:04');
Schedule::command(GetDataCommand::class, ['orders', '--acc-id=1', '--yesterday'])->dailyAt('00:05');
Schedule::command(GetDataCommand::class, ['incomes', '--acc-id=1', '--yesterday'])->dailyAt('00:06');

Schedule::command(GetDataCommand::class, ['sales', '--acc-id=1'])->dailyAt('12:04');
Schedule::command(GetDataCommand::class, ['orders', '--acc-id=1'])->dailyAt('12:05');
Schedule::command(GetDataCommand::class, ['incomes', '--acc-id=1'])->dailyAt('12:06');

Schedule::command(GetDataCommand::class, ['stocks', '--acc-id=1'])->dailyAt('12:00');
Schedule::command(GetDataCommand::class, ['stocks', '--acc-id=1'])->dailyAt('23:55');
