<?php

namespace App\Console\Commands;

use App\Models\TokenType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateTokenTypeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:token-type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new token type';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('Новый тип токена');

        $data = $this->getValidatedData();

        TokenType::create($data);
        $this->line("Новая тип \"{$data['name']}\" создан.");

    }

    private function getValidatedData(): array
    {
        while (true) {
            $name = $this->ask('Введите название типа');

            $validator = Validator::make([
                'name' => $name,
            ], [
                'name' => 'required|string',
            ], [
                'name.required' => 'Название обязательно!'
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                $this->warn('Пожалуйста, исправьте ошибки.');
                continue;
            }

            return [
                'name' => $name,
            ];
        }
    }

}
