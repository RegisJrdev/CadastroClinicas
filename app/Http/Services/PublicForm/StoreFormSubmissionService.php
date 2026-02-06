<?php

namespace App\Http\Services\PublicForm;

use App\Models\FormSubmission;
use App\Models\FormSubmissionAnswer;

class StoreFormSubmissionService
{
    public function execute(array $data)
    {
        $submission = FormSubmission::create();

        foreach ($data['answers'] as $questionId => $answer) {
            FormSubmissionAnswer::create([
                'form_submission_id' => $submission->id,
                'question_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        return $submission;
    }
}
