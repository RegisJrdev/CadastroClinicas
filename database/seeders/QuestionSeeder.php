<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            ['title' => 'Nome Completo', 'type' => 'text'],
            ['title' => 'N° Cartão', 'type' => 'number'],
            ['title' => 'Plano', 'type' => 'select'],
            ['title' => 'CPF', 'type' => 'text'],
            ['title' => 'WhatsApp', 'type' => 'number'],
            ['title' => 'E-mail', 'type' => 'text'],
            ['title' => 'Data de Nascimento', 'type' => 'date'],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}