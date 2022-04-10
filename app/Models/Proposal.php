<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Proposal extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'broker_id',
        'product_id',
        'prospect_id',
        'unit_id',
        'code_id',
        'status',
        'unit_price',
        'house_commission_value',
        'partner_commission_value',
        'payment_method',
        'financing_type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $sortable = ['id',
        'name',
        'email',
        'created_at',
        'updated_at'];

    public function broker()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function payments()
    {
        return $this->hasMany(ProposalPayment::class);
    }

    public function getTranslatedPaymentMethod()
    {
        switch ($this->payment_method) {
            case 'cash':
                return 'À vista';
            case 'table':
                return 'Na tabela';
            case 'cash':
                return 'Personalizada';
            default:
                return 'Erro';
        }
    }

    public function translateStatus($plural = false)
    {
        switch ($this->status) {
            case 'open':
                return 'Aberta' . ($plural ? 's' : '');
            case 'approved':
                return 'Aprovada' . ($plural ? 's' : '');
            case 'rejected':
                return 'Reprovada' . ($plural ? 's' : '');
            default:
                return 'Desconhecido';
        }
    }

    public function getStatusColor()
    {
        switch ($this->status) {
            case 'open':
                return 'yellow';
            case 'approved':
                return 'green';
            case 'rejected':
                return 'red';
            default:
                return 'gray';
        }
    }

    public function getTranslatedFinancingType()
    {
        switch ($this->financing_type) {
            case 'incorporator':
                return 'Próprio';
            case 'bank':
                return 'Bancário';
            default:
                return 'Erro';
        }
    }

    public function getTotalPreKeysValue()
    {
        return $this->payments->where('section', 'pre_keys')->sum('installment_value');
    }

    public function getTotalPostKeysValue()
    {
        return $this->payments->where('section', 'post_keys')->sum('installment_value');
    }
}
