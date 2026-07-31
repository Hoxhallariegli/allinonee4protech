<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'c_tasks';
    protected $fillable = ['title', 'deal_id', 'due_date', 'completed'];
    protected function casts(): array { return [
            'due_date' => 'datetime',
            'completed' => 'boolean',
        ]; }
    public static function rules($id = null): array { return [
            'title' => ['required', 'string', 'max:255'],
            'deal_id' => ['required', 'integer'],
            'due_date' => ['required', 'date'],
            'completed' => ['nullable', 'boolean'],
        ]; }
    public static function sortable(): array { return ['id', 'title', 'deal_id', 'due_date', 'completed']; }

    public function deal(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\CRM\Deal::class, 'deal_id'); }

}