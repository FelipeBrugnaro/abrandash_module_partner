<?php

namespace Modules\Partner\app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'body',
        'status'
    ];
}
