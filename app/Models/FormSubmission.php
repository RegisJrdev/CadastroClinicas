<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $table = 'form_submissions';

    
    public function answers()
    {
        return $this->hasMany(FormSubmissionAnswer::class);
    }
}
