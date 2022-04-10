<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProposalPayment extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'section',
        'type',
        'proposal_id',
        'installments',
        'start_date',
        'installment_value',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'datetime',
    ];

    public $sortable = ['id',
        'section',
        'type',
        'start_date',
        'created_at',
        'updated_at'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function getTranslatedSection()
    {
        switch ($this->section) {
            case 'pre_keys':
                return 'Pré-chaves';
            case 'post_keys':
                return 'Pós-chaves';
            default:
                return 'Erro';
        }
    }

    public function getTranslatedTypePreKeys()
    {
        switch ($this->type) {
            case 'cash':
                return 'Ato';
            case 'monthly':
                return 'Mensais';
            case 'intermediate':
                return 'Intermediárias';
            default:
                return 'Erro';
        }
    }

    public function getTranslatedTypePostKeys()
    {
        switch ($this->type) {
            case 'cash':
                return 'Ato';
            case 'monthly':
                return 'Mensais';
            case 'intermediate':
                return 'Anuais';
            default:
                return 'Erro';
        }
    }
}
