<?php

namespace App\Http\Services\FormSubmission;

use App\Models\FormSubmission;

class FormSubmissionService
{
    public function __construct(
        private GetSubmissionsService $getSubmissionsService,
        private GetSubmissionDetailsService $getSubmissionDetailsService
    ) {}

    public function getSubmissions()
    {
        return $this->getSubmissionsService->execute();
    }

    public function getSubmissionDetails(FormSubmission $submission)
    {
        return $this->getSubmissionDetailsService->execute($submission);
    }
}
