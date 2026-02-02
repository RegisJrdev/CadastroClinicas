<?php 

namespace App\Http\Services\Question;

use App\Models\Question;
use PhpParser\Node\Expr\Assign;

class QuestionService
{
    public function __construct(
        private AssignTenantQuestionService $assignTenantQuestionService
    ) {}
    public function assignTenantQuestion(string $tenantId, array $questions)
    {
        return $this->assignTenantQuestionService->execute($tenantId, $questions);
    }
}