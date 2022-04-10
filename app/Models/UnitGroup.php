<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class UnitGroup extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'type',
        'number',
        'product_id',
    ];

    public $sortable = [
        'id',
        'type',
        'number',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function getTranslatedType()
    {
        switch ($this->type) {
            case 'block':
                return __('Bloco');
            case 'tower':
                return __('Torre');
            case 'village':
                return __('Vila');
            case 'square':
                return __('Quadra');
            default:
                return __('Desconhecido');
        }
    }
}
