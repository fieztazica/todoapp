<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $fillable = [
        "name",
        "description"
    ];
    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the note.
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }
}
