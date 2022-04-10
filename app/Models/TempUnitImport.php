<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TempUnitImport extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'type',
        'type_number',
        'unit_number',
        'size',
        'price',
        'sun',
        'floor',
        'delivery_forecast',
        'has_pre_keys',
        'pre_keys_spot_month',
        'inflow',
        'pre_keys_monthly_qty',
        'pre_keys_monthly_value',
        'pre_keys_monthly_start',
        'pre_keys_intermediate_value',
        'intermediate_start_1',
        'intermediate_start_2',
        'intermediate_start_3',
        'intermediate_start_4',
        'intermediate_start_5',
        'intermediate_start_6',
        'financing_type',
        'financing_monthly_qty',
        'financing_monthly_value',
        'financing_monthly_start',
        'financing_yearly_qty',
        'financing_yearly_value',
        'financing_yearly_start',
        'description',
        'line',
        'message',
        'product_id',
        'status',
        'unit_status'
    ];

    public $sortable = [
        'id',
        'type',
        'type_number',
        'number',
        'sun',
        'floor',
        'price',
        'created_at',
        'updated_at',
        'status',
        'unit_status'
    ];

    protected $casts = [
        'delivery_forecast' => 'date',
        'pre_keys_spot_month' => 'date',
        'pre_keys_monthly_start' => 'date',
        'intermediate_start_1' => 'date',
        'intermediate_start_2' => 'date',
        'intermediate_start_3' => 'date',
        'intermediate_start_4' => 'date',
        'intermediate_start_5' => 'date',
        'intermediate_start_6' => 'date',
        'financing_monthly_start' => 'date',
        'financing_yearly_start' => 'date',
    ];

    public function getTranslatedEnumType()
    {
        switch ($this->type) {
            case 'Bloco':
                return 'block';
            case 'Torre':
                return 'tower';
            case 'Vila':
                return 'village';
            case 'Quadra':
                return 'square';
            default:
                return 'error';
        }
    }

    public function getTranslatedEnumSun()
    {
        switch ($this->sun) {
            case 'Sol da manhã':
                return 'morning';
            case 'Sol da tarde':
                return 'afternoon';
            default:
                return 'any';
        }
    }

    public function getTranslatedFinancingTypeEnum()
    {
        switch ($this->financing_type) {
            case 'Próprio':
                return 'incorporator';
            case 'Bancário':
                return 'bank';
            default:
                return 'bank';
        }
    }

    public function getTranslatedStatus()
    {
        switch ($this->status) {
            case 'temp':
                return __('Processando');
            case 'validating':
                return __('Validando');
            case 'sync':
                return __('Sem alterações');
            case 'updatable':
                return __('Atualizar');
            case 'instertable':
                return __('Inserir');
            case 'deletable':
                return __('Remover');
            default:
                return __('Desconhecido');
        }
    }

    public function getTranslatedUnitStatus()
    {
        switch ($this->unit_status) {
            case 'Livre':
                return 'free';
            case 'Reservada':
                return 'booked';
            case 'Vendida':
                return 'Sold';
        }
    }
}
