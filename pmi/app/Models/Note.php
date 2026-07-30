<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * -----------------------------------------------------------------------------
 * Note Model
 * -----------------------------------------------------------------------------
 *
 * Represents a note entity stored in the database.
 *
 * This model provides:
 *
 * - Mass assignment configuration
 * - Status filtering functionality
 * - Sorting functionality
 *
 * The model uses Eloquent ORM to interact with the notes database table.
 */

class Note extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable =[
            'title',
            'description',
            'status',
    ];


    /**
     * Available fields for sorting notes.
     *
     * Only fields listed here can be used in sorting queries
     * to prevent invalid database columns from being requested.
     *
     * @var array<int, string>
     */
    private const SORTABLE_FIELDS = [
            'id',
            'created_at', '
            updated_at'
    ];


    /**
     * Scope to filter notes by their status.
     *
     * Accepts only valid note statuses:
     *
     * - todo
     * - done
     *
     * Invalid values are ignored and result in no filtering.
     *
     * Usage example:
     *
     * Note::filterByStatus('done')->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $filter Status filter value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByStatus($query, ?string $filter)
    {
        if (!in_array($filter, ['todo', 'done'])) {
            $filter = null;
        }

        return $query->when($filter, fn($q) => $q->where('status', $filter));
    }

    /**
     * Scope to sort notes by a specific column.
     *
     * Only predefined sortable fields are allowed.
     * Invalid columns or sorting directions are replaced
     * with safe default values.
     *
     * Supported sorting fields:
     *
     * - id
     * - created_at
     * - updated_at
     *
     * Supported sorting directions:
     *
     * - asc
     * - desc
     *
     * Usage example:
     *
     * Note::sortable('created_at', 'asc')->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sortBy Column used for sorting
     * @param string $sortOrder Sorting direction
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
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
