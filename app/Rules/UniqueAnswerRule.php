<?php

namespace App\Rules;

use App\Models\UniqueAnswer;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueAnswerRule implements ValidationRule
{
    public function __construct(private int $questionId) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value || trim((string) $value) === '') {
            return;
        }

        $exists = UniqueAnswer::where('question_id', $this->questionId)
            ->where('answer_value', $value)
            ->exists();

        if ($exists) {
            $fail('Este valor já foi cadastrado anteriormente.');
        }
    }
}
