<?php

namespace App\Http\Controllers;

use App\Http\Services\FormSubmission\FormSubmissionService;
use App\Models\FormSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function downloadPdf(FormSubmission $submission)
    {
        $submission = $this->formSubmissionService->getSubmissionDetails($submission);

        $pdf = Pdf::loadView('pdf.submission', [
            'submission' => $submission
        ]);

        return $pdf->download('submissao-' . $submission->id . '.pdf');
    }
}
