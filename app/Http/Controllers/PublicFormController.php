<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\FormSubmissionAnswer;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicFormController extends Controller
{
    public function index() {
    }

    public function show()
    {
        $tenantId = tenant('id');
        $questions = Tenant::find($tenantId)->questions()->get();

        return Inertia::render('PublicForm', [
            'questions' => $questions,
            'tenantId' => $tenantId
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tenant_id' => 'required',
            'answers' => 'required|array|min:1',
        ]);

        $submission = FormSubmission::create();

        foreach ($data['answers'] as $questionId => $answer) {
        FormSubmissionAnswer::create([
            'form_submission_id' => $submission->id,
            'question_id' => $questionId,
            'answer' => $answer,
        ]);
    }

        return redirect(route('public_form.show'));
    }
}
