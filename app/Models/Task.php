<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $fillable = [
        "name",
        "description"
    ];
    protected $dates = ['deleted_at', 'due_date'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'done' => false,
    ];

    /**
     * Get the user that owns the note.
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }
}
