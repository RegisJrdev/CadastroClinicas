<?php 

namespace App\Http\Services\Question;

use App\Models\Tenant;

class AssignTenantQuestionService
{
    public function execute($tenantId, $questions)
    {
        $tenant = Tenant::find($tenantId)->questions()->sync($questions);
        
         return redirect(route('dashboard'))
            ->with('sucess', 'Tenant criado com sucesso!');
    }
}