<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProspectDocument extends Model
{
    use HasFactory,Sortable,SoftDeletes;

    protected $fillable = [
        'type',
        'url',
        'prospect_id',
    ];

    public $sortable = ['id',
        'type',
        'url',
        'created_at',
        'updated_at'];

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function getTranslatedType()
    {
        switch ($this->type) {
            case 'cpf_cnh':
                return __('CPF ou CNH');
            case 'rg':
                return __('RG');
            case 'comp_res':
                return __('Comprovante de residência');
            case 'com_est_civil':
                return __('Comprovante de estado civil');
            case 'advb_est_civil':
                return __('Adverbações de estado civil');
            case 'com_renda':
                return __('Comprovante de renda');
            case 'other':
                return __('Outros');
            default:
                return __('Outros');
        }
    }

    public function getTranslatedTypeFile()
    {
        switch ($this->type) {
            case 'cpf_cnh':
                return __('CPF_CNH');
            case 'rg':
                return __('RG');
            case 'comp_res':
                return __('Comprovante_Residência');
            case 'com_est_civil':
                return __('Comprovante_Estado_Civil');
            case 'advb_est_civil':
                return __('Adverbacoes_EstadoCivil');
            case 'com_renda':
                return __('Comprovante_Renda');
            case 'other':
                return __('Outros');
            default:
                return __('Outros');
        }
    }
}
