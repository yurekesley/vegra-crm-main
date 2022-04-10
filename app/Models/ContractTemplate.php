<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ContractTemplate extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'active',
        'product_id',
        'content'
    ];

    /**
     * The attributes that are available for sorting.
     *
     * @var array<int, string>
     */
    public $sortable = [
        'id',
        'name',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function product()
    {
        $this->belongsTo(Product::class);
    }  
}
