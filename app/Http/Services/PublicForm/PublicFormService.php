<?php

namespace App\Http\Services\PublicForm;

class PublicFormService
{
    public function __construct(
        private GetTenantQuestionsService $getTenantQuestionsService,
        private StoreFormSubmissionService $storeFormSubmissionService
    ) {}

    public function getTenantQuestions(string $tenantId)
    {
        return $this->getTenantQuestionsService->execute($tenantId);
    }

    public function storeFormSubmission(array $data)
    {
        return $this->storeFormSubmissionService->execute($data);
    }
}
