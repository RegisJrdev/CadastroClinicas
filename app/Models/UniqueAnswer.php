<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniqueAnswer extends Model
{
    protected $connection = 'mysql';

    protected $fillable = [
        'question_id',
        'answer_value',
        'tenant_id',
    ];
}
