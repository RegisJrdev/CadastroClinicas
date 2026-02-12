<?php

namespace App\Http\Controllers;

use App\Http\Services\FormSubmission\FormSubmissionService;
use App\Models\FormSubmission;
use App\Models\Question;
use App\Models\Tenant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FormSubmissionController extends Controller
{
    public function __construct(private FormSubmissionService $formSubmissionService) {}

    public function index()
    {
        $submissions = $this->formSubmissionService->getSubmissions();

        return Inertia::render('FormSubmission/Index', [
            'submissions' => $submissions
        ]);
    }

    public function show(FormSubmission $submission)
    {
        $submission = $this->formSubmissionService->getSubmissionDetails($submission);

        return Inertia::render('FormSubmissions/Show', [
            'submission' => $submission
        ]);
    }

    public function reportPdf()
    {
        $submissions = FormSubmission::with('answers')->latest()->get();

        $questionIds = $submissions->pluck('answers.*.question_id')->flatten()->unique();
        $questions = Question::whereIn('id', $questionIds)->get();

        $submissions->each(function ($submission) use ($questions) {
            $submission->answers->each(function ($answer) use ($questions) {
                $answer->question = $questions->firstWhere('id', $answer->question_id);
            });
        });

        $tenant = Tenant::find(tenant('id'));
        $logoBase64 = null;
        if ($tenant->photo_path && Storage::disk('public')->exists($tenant->photo_path)) {
            $file = Storage::disk('public')->get($tenant->photo_path);
            $mime = Storage::disk('public')->mimeType($tenant->photo_path);
            $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode($file);
        }

        $pdf = Pdf::loadView('pdf.submissions-report', [
            'submissions' => $submissions,
            'questions' => $questions,
            'tenant' => $tenant,
            'logoBase64' => $logoBase64,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('relatorio-cadastros.pdf');
    }

    public function downloadPdf(FormSubmission $submission)
    {
        $submission = $this->formSubmissionService->getSubmissionDetails($submission);

        $tenant = Tenant::find(tenant('id'));
        $logoBase64 = null;
        if ($tenant->photo_path && Storage::disk('public')->exists($tenant->photo_path)) {
            $file = Storage::disk('public')->get($tenant->photo_path);
            $mime = Storage::disk('public')->mimeType($tenant->photo_path);
            $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode($file);
        }

        $pdf = Pdf::loadView('pdf.submission', [
            'submission' => $submission,
            'tenant' => $tenant,
            'logoBase64' => $logoBase64,
        ]);

        return $pdf->download('submissao-' . $submission->id . '.pdf');
    }
}
