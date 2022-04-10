<?php

namespace App\Imports;

use App\Models\TempUnitImport;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UnitsImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithCalculatedFormulas
{
    use RemembersRowNumber;

    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TempUnitImport([
            'type' => $row['tipo'],
            'type_number' => $row['numero_tipo'],
            'unit_number' => $row['numero_unidade'],
            'size' => $row['metragem_m2'],
            'price' => $row['valor_r'],
            'sun' => $row['sol'],
            'floor' => $row['andar'] == 'Térreo' ? 0 : $row['andar'],
            'unit_status' => $row['status'],
            'delivery_forecast' => Date::excelToDateTimeObject($row['previsao_entrega']),
            'has_pre_keys' => $row['possui_pre_chaves'] == 'Sim' ? true : false,
            'pre_keys_spot_month' => Date::excelToDateTimeObject($row['mes_ato']),
            'inflow' => $row['valor_entrada'],
            'pre_keys_monthly_qty' => $row['qtde_mensais'],
            'pre_keys_monthly_value' => $row['valor_mensais'],
            'pre_keys_monthly_start' => Date::excelToDateTimeObject($row['data_inicio_mensais']),
            'pre_keys_intermediate_value' => $row['valor_intermediarias'],
            'intermediate_start_1' => Date::excelToDateTimeObject($row['data_intermediaria_1']),
            'intermediate_start_2' => Date::excelToDateTimeObject($row['data_intermediaria_2']),
            'intermediate_start_3' => Date::excelToDateTimeObject($row['data_intermediaria_3']),
            'intermediate_start_4' => Date::excelToDateTimeObject($row['data_intermediaria_4']),
            'intermediate_start_5' => Date::excelToDateTimeObject($row['data_intermediaria_5']),
            'intermediate_start_6' => Date::excelToDateTimeObject($row['data_intermediaria_6']),
            'financing_type' => $row['tipo_financiamento'],
            'financing_monthly_qty' => $row['meses_financiamento'],
            'financing_monthly_value' => $row['valor_mensal'],
            'financing_monthly_start' => Date::excelToDateTimeObject($row['data_inicio_mensais']),
            'financing_yearly_qty' => $row['anos_financiamento'],
            'financing_yearly_value' => $row['valor_anual'],
            'financing_yearly_start' => Date::excelToDateTimeObject($row['data_inicio_anuais']),
            'description' => $row['descritivo'],
            'line' => $this->getRowNumber() - 1,
            'message' => 'Processando',
            'product_id' => $this->productId,
            'status' => 'temp'
        ]);
    }
}
