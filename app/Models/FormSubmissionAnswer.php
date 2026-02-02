<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmissionAnswer extends Model
{
    protected $fillable = [
        'form_submission_id',
        'question_id',
        'answer',
    ];

    protected $casts = [
        'answer' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(FormSubmission::class, 'form_submission_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}