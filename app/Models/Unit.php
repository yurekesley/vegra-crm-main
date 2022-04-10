<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Unit extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'unit_group_id',
        'product_id',
        'number',
        'sun',
        'floor',
        'price',
        'size',
        'final_number',
        'delivery_forecast',
        'parking_lots',
        'has_pre_keys',
        'pre_keys_spot_month',
        'monthly_qty',
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
        'post_keys_financing_type',
        'financing_monthly_qty',
        'financing_monthly_value',
        'financing_monthly_start',
        'financing_yearly_qty',
        'financing_yearly_value',
        'financing_yearly_start',
        'inflow',
        'description'
    ];

    public $sortable = [
        'id',
        'number',
        'sun',
        'final_number',
        'created_at',
        'updated_at',
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

    public function unit_group()
    {
        return $this->belongsTo(UnitGroup::class);
    }

    public function getTranslatedSun()
    {
        switch ($this->sun) {
            case 'morning':
                return __('Sol da manhã');
            case 'afternoon':
                return __('Sol da tarde');
            default:
                return __('Indiferente');
        }
    }

    public function getStatusColor()
    {
        switch ($this->status) {
            case 'free':
                return 'green';
            case 'booked':
                return 'indigo';
            case 'sold':
                return 'red';
            default:
                return 'gray';
        }
    }

    public function getStatusChar()
    {
        switch ($this->status) {
            case 'free':
                return 'L';
            case 'booked':
                return 'R';
            case 'sold':
                return 'V';
            default:
                return 'N/D';
        }
    }

    public function getTranslatedStatus()
    {
        switch ($this->status) {
            case 'free':
                return __('Livre');
            case 'booked':
                return __('Reservada');
            case 'sold':
                return __('Vendida');
            default:
                return __('Desconhecido');
        }
    }

    public function getTranslatedFloor()
    {
        return $this->floor == 0 ? 'Térreo' : $this->floor . __('º andar');
    }

    public function getTotalPreKeysValue()
    {
        $value = 0;

        $value = $value + $this->inflow;

        if ($this->pre_keys_monthly_value > 0 && $this->pre_keys_monthly_qty > 0) {
            $value = $value + ($this->pre_keys_monthly_qty * $this->pre_keys_monthly_value);
        }

        if ($this->pre_keys_intermediate_value > 0 && $this->pre_keys_intermediate_qty > 0) {
            $value = $value + ($this->pre_keys_intermediate_qty * $this->pre_keys_intermediate_value);
        }

        return $value;
    }

    public function getTranslatedFinancingType()
    {
        switch ($this->post_keys_financing_type) {
            case 'incorporator':
                return 'Próprio';
            case 'bank':
                return 'Bancário';
            default:
                return 'Erro';
        }
    }

    public function getIntermediateQty()
    {
        $qty = 0;

        if ($this->intermediate_start_1 != null) {
            $qty++;
        }

        if ($this->intermediate_start_2 != null) {
            $qty++;
        }

        if ($this->intermediate_start_3 != null) {
            $qty++;
        }

        if ($this->intermediate_start_4 != null) {
            $qty++;
        }

        if ($this->intermediate_start_5 != null) {
            $qty++;
        }

        if ($this->intermediate_start_6 != null) {
            $qty++;
        }

        return $qty;
    }

    public function isTableProposalAvailable()
    {
        return ($this->has_pre_keys && ($this->inflow > 0 || $this->pre_keys_intermediate_value > 0))
            || ($this->post_keys_financing_type == 'incorporator' && ($this->financing_monthly_qty > 0 || $this->financing_yearly_qty));
    }

    public function getPopoverContent()
    {
        return '<p><strong>Sol</strong>: ' . $this->getTranslatedSun() . '</p>'
            . '<p><strong>Vagas</strong>: ' . ($this->parking_lots != null && $this->parking_lots > 0 ? $this->parking_lots : 'Não informado') . '</p>'
            . '<hr />'
            . '<p>' . (strlen($this->description) <= 500 ? $this->description : substr($this->description, 0, 500) . '...') . '</p>';
    }
}
