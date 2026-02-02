<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantQuestionsRequest;
use App\Http\Services\Question\QuestionService;
use App\Models\Tenant;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(private QuestionService $questionService) {}
    public function storeTenantQuestions(StoreTenantQuestionsRequest $request)
    {
        $data = $request->validated();
        return $this->questionService->assignTenantQuestion($data['tenant_id'], $data['questions']);

         return redirect(route('dashboard'))
            ->with('sucess', 'Tenant criado com sucesso!');
    }
}