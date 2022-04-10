<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Code extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'code',
        'product_id',
        'prospect_id',
        'broker_id',
        'available',
        'used',
    ];

    public $sortable = ['id',
        'code',
        'available',
        'used',
        'created_at',
        'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function broker()
    {
        return $this->belongsTo(User::class);
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }
}
