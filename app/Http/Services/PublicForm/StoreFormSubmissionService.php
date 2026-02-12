<?php

namespace App\Http\Services\PublicForm;

use App\Models\FormSubmission;
use App\Models\FormSubmissionAnswer;
use App\Models\Question;
use App\Models\UniqueAnswer;

class StoreFormSubmissionService
{
    public function execute(array $data)
    {
        $submission = FormSubmission::create();

        $answerQuestionIds = array_keys($data['answers']);
        $uniqueQuestionIds = Question::whereIn('id', $answerQuestionIds)
            ->where('is_unique', true)
            ->pluck('id')
            ->toArray();

        foreach ($data['answers'] as $questionId => $answer) {
            FormSubmissionAnswer::create([
                'form_submission_id' => $submission->id,
                'question_id' => $questionId,
                'answer' => $answer,
            ]);

            if (in_array((int) $questionId, $uniqueQuestionIds) && $answer) {
                UniqueAnswer::create([
                    'question_id' => $questionId,
                    'answer_value' => $answer,
                    'tenant_id' => tenant('id'),
                ]);
            }
        }

        return $submission;
    }
}
