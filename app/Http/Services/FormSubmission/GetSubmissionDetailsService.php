<?php

namespace App\Http\Services\FormSubmission;

use App\Models\FormSubmission;

class GetSubmissionDetailsService
{
    public function execute(FormSubmission $submission)
    {
        $submission->load('answers');

        return $submission;
    }
}
