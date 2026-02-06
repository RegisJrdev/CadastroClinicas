<?php

namespace App\Http\Services\FormSubmission;

use App\Models\FormSubmission;
use App\Models\Question;

class GetSubmissionsService
{
    public function execute()
    {
        $submissions = FormSubmission::with('answers')
            ->latest()
            ->paginate(10);

        $questionIds = $submissions->pluck('answers.*.question_id')->flatten()->unique();
        $questions = Question::whereIn('id', $questionIds)->get()->keyBy('id');

        $submissions->map(function ($submission) use ($questions) {
            $submission->answers->map(fn($answer) => $answer->question = $questions[$answer->question_id]);
            return $submission;
        });

        return $submissions;
    }
}
