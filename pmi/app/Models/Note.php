<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;



    protected $fillable =[
            'title',
            'description',
            'status',
    ];

    private const SORTABLE_FIELDS = ['id', 'created_at', 'updated_at'];

    public function scopeFilterByStatus($query, ?string $filter)
    {
        if (!in_array($filter, ['todo', 'done'])) {
            $filter = null;
        }

        return $query->when($filter, fn($q) => $q->where('status', $filter));
    }

    public function scopeSortable($query, string $sortBy = 'id', string $sortOrder = 'desc')
    {
        if (!in_array($sortBy, self::SORTABLE_FIELDS)) {
            $sortBy = 'id';
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        return $query->orderBy($sortBy, $sortOrder);
    }








}
