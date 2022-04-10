<?php

namespace App\Exports;

use App\Models\Unit;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UnitsExport implements FromQuery, Responsable, WithMapping, WithHeadings, WithColumnFormatting, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function __construct($productId)
    {
        $this->productId = $productId;
        $this->fileName = 'unidades_' . $productId . '.xlsx';
    }

    private $fileName = 'unidades.xlsx';
    private $writerType = Excel::XLSX;
    private $headers = [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    public function query()
    {
        return Unit::query()->whereProductId($this->productId);
    }

    public function headings(): array
    {
        return [
            'Tipo',
            'Número Tipo',
            'Número Unidade',
            'Metragem (m²)',
            'Valor (R$)',
            'Sol',
            'Andar',
            'Status',
            'Previsão Entrega',
            'Possui Pré-chaves',
            'Mês Ato',
            'Valor Entrada',
            'Qtde. Mensais',
            'Valor Mensais',
            'Data Inicio Mensais',
            'Valor Intermediárias',
            'Data Intermediária 1',
            'Data Intermediária 2',
            'Data Intermediária 3',
            'Data Intermediária 4',
            'Data Intermediária 5',
            'Data Intermediária 6',
            'Tipo Financiamento',
            'Meses Financiamento',
            'Valor Mensal',
            'Data Início Mensais',
            'Anos Financiamento',
            'Valor Anual',
            'Data Início Anuais',
            'Descritivo'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '0.00',
            'E' => 'R$ #.00',
            'I' => 'mm/yyyy',
            'K' => 'mm/yyyy',
            'L' => 'R$ #.00',
            'M' => NumberFormat::FORMAT_NUMBER,
            'N' => 'R$ #.00',
            'O' => 'mm/yyyy',
            'P' => 'R$ #.00',
            'Q' => 'mm/yyyy',
            'R' => 'mm/yyyy',
            'S' => 'mm/yyyy',
            'T' => 'mm/yyyy',
            'U' => 'mm/yyyy',
            'V' => 'mm/yyyy',
            'X' => NumberFormat::FORMAT_NUMBER,
            'Y' => 'R$ #.00',
            'Z' => 'mm/yyyy',
            'AA' => NumberFormat::FORMAT_NUMBER,
            'AB' => 'R$ #.00',
            'AC' => 'mm/yyyy'
        ];
    }

    public function map($unit): array
    {
        return [
            $unit->unit_group->getTranslatedType(),
            $unit->unit_group->number,
            $unit->number,
            $unit->size,
            $unit->price,
            $unit->getTranslatedSun(),
            $unit->getTranslatedFloor(),
            $unit->getTranslatedStatus(),
            $unit->delivery_forecast != null ? Date::dateTimeToExcel($unit->delivery_forecast) : null,
            $unit->has_pre_keys ? 'Sim' : 'Não',
            $unit->pre_keys_spot_month != null ? Date::dateTimeToExcel($unit->pre_keys_spot_month) : null,
            $unit->inflow,
            $unit->pre_keys_monthly_qty,
            $unit->pre_keys_monthly_value,
            $unit->pre_keys_monthly_start,
            $unit->pre_keys_intermediate_value,
            $unit->intermediate_start_1 != null ? Date::dateTimeToExcel($unit->intermediate_start_1) : null,
            $unit->intermediate_start_2 != null ? Date::dateTimeToExcel($unit->intermediate_start_2) : null,
            $unit->intermediate_start_3 != null ? Date::dateTimeToExcel($unit->intermediate_start_3) : null,
            $unit->intermediate_start_4 != null ? Date::dateTimeToExcel($unit->intermediate_start_4) : null,
            $unit->intermediate_start_5 != null ? Date::dateTimeToExcel($unit->intermediate_start_5) : null,
            $unit->intermediate_start_6 != null ? Date::dateTimeToExcel($unit->intermediate_start_6) : null,
            $unit->getTranslatedFinancingType(),
            $unit->financing_monthly_qty,
            $unit->financing_monthly_value,
            $unit->financing_monthly_start != null ? Date::dateTimeToExcel($unit->financing_monthly_start) : null,
            $unit->financing_yearly_qty,
            $unit->financing_yearly_value,
            $unit->financing_yearly_start != null ? Date::dateTimeToExcel($unit->financing_yearly_start) : null,
            $unit->description
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                for ($i = 2; $i <= 5001; $i++) {
                    $configs = "Bloco, Torre, Vila, Quadra";
                    $objValidation = $sheet->getCell('A' . $i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(true);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Erro');
                    $objValidation->setError('Tipo da unidade deve estar na lista.');
                    $objValidation->setFormula1('"' . $configs . '"');

                    $configSun = "Sol da manhã, Sol da tarde, Indiferente";
                    $objValidationPreKeys = $sheet->getCell('F' . $i)->getDataValidation();
                    $objValidationPreKeys->setType(DataValidation::TYPE_LIST);
                    $objValidationPreKeys->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidationPreKeys->setAllowBlank(true);
                    $objValidationPreKeys->setShowInputMessage(true);
                    $objValidationPreKeys->setShowErrorMessage(true);
                    $objValidationPreKeys->setShowDropDown(true);
                    $objValidationPreKeys->setErrorTitle('Erro');
                    $objValidationPreKeys->setFormula1('"' . $configSun . '"');

                    $configStatus = "Livre, Reservada, Vendida";
                    $objValidationPreKeys = $sheet->getCell('H' . $i)->getDataValidation();
                    $objValidationPreKeys->setType(DataValidation::TYPE_LIST);
                    $objValidationPreKeys->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidationPreKeys->setAllowBlank(true);
                    $objValidationPreKeys->setShowInputMessage(true);
                    $objValidationPreKeys->setShowErrorMessage(true);
                    $objValidationPreKeys->setShowDropDown(true);
                    $objValidationPreKeys->setErrorTitle('Erro');
                    $objValidationPreKeys->setFormula1('"' . $configStatus . '"');

                    $configsPreKeys = "Sim, Não";
                    $objValidationPreKeys = $sheet->getCell('J' . $i)->getDataValidation();
                    $objValidationPreKeys->setType(DataValidation::TYPE_LIST);
                    $objValidationPreKeys->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidationPreKeys->setAllowBlank(true);
                    $objValidationPreKeys->setShowInputMessage(true);
                    $objValidationPreKeys->setShowErrorMessage(true);
                    $objValidationPreKeys->setShowDropDown(true);
                    $objValidationPreKeys->setErrorTitle('Erro');
                    $objValidationPreKeys->setFormula1('"' . $configsPreKeys . '"');

                    $configsFinancingType = "Próprio, Bancário";
                    $objValidationFinancingType = $sheet->getCell('W' . $i)->getDataValidation();
                    $objValidationFinancingType->setType(DataValidation::TYPE_LIST);
                    $objValidationFinancingType->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidationFinancingType->setAllowBlank(true);
                    $objValidationFinancingType->setShowInputMessage(true);
                    $objValidationFinancingType->setShowErrorMessage(true);
                    $objValidationFinancingType->setShowDropDown(true);
                    $objValidationFinancingType->setErrorTitle('Erro');
                    $objValidationFinancingType->setFormula1('"' . $configsFinancingType . '"');
                }
            }
        ];
    }
}
