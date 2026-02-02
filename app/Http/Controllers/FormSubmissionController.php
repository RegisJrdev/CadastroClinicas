<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\Question;
use Inertia\Inertia;

class FormSubmissionController extends Controller
{
    public function index()
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

        return Inertia::render('FormSubmission/Index', [
            'submissions' => $submissions
        ]);
    }

    public function show(FormSubmission $submission)
    {
        $submission->load('answers');

        return Inertia::render('FormSubmissions/Show', [
            'submission' => $submission
        ]);
    }
}
