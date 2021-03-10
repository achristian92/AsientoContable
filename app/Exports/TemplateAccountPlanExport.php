<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;

class TemplateAccountPlanExport implements FromCollection,WithEvents,WithDrawings
{
    private $headers;

    public function __construct($headers)
    {
        $this->headers = $headers;
    }

    public function collection(): Collection
    {
        return collect([]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                /** NOTES */
                $event->sheet->getDelegate()
                    ->setCellValue('A1','CAMPOS OBLIGATORIOS:')
                    ->setCellValue('A2','* CUENTA,SUBCUENTA,ANALITICA, DESCRIPCIÓN Y TIPO')
                    ->setCellValue('A3','NOTA:')
                    ->setCellValue('A4','* Evitar modificar las cabeceras')
                    ->setCellValue('A5','* La cabeza para importar sirve para identificar la cuenta contable en la planilla(seleccionar de la lista si es requerido)');
                /** Headers */
                $event->sheet->getDelegate()
                    ->setCellValue('A6','CUENTAS CONTABLES')
                    ->mergeCells('A6:G6');
                $event->sheet->getDelegate()
                    ->setCellValue('A7','CUENTA')
                    ->setCellValue('B7','SUBCUENTA')
                    ->setCellValue('C7','ANALITICA')
                    ->setCellValue('D7','DESCRIPCION')
                    ->setCellValue('E7','TIPO')
                    ->setCellValue('F7','ANALISIS')
                    ->setCellValue('G7','C. COSTOS')
                    ->setCellValue('H7','C. COSTOS 2')
                    ->setCellValue('I7','CABECERA IMPORTAR');

                /** Add Customer */
                $totalHeaders = $this->headers->count();
                foreach ($this->headers as $key => $customer) {
                    $row = $key+1;
                    $event->sheet->getDelegate()
                        ->setCellValue("K$row",$customer);
                }

                $event->sheet->getDelegate()->getColumnDimension('K')->setVisible(false);


                $sheet = $event->sheet->getDelegate();

                for ($a = 0; $a<100; $a++)
                {
                    $coordinate = $a+8;
                    // Headers
                    $validation = $sheet->getCell("I$coordinate")->getDataValidation();
                    $validation->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
                    $validation->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Error');
                    $validation->setError('Selecciona un cliente de la lista.');
                    $validation->setPromptTitle('Selecciona un cliente');
                    $validation->setFormula1('Worksheet!$K$1:$K$'.$totalHeaders);

                }


                /* Row Height */
                $event->sheet->getDelegate()->getRowDimension(6)->setRowHeight(25);
                $event->sheet->getDelegate()->getRowDimension(7)->setRowHeight(25);
                $largeColumns = ['D','I'];
                $smallColumns = ['A','B','C','E','F','G','H'];
                foreach ($smallColumns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(15);
                }
                foreach ($largeColumns as $colum) {
                    $event->sheet->getDelegate()->getColumnDimension($colum)->setWidth(30);
                }


                /**
                 *ADD STYLES
                 */
                $style = EventExportStyles();
                $event->sheet->getDelegate()
                    ->getStyle('A1')
                    ->applyFromArray([
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  12,
                            'bold'      =>  true
                        )
                    ]);
                $event->sheet->getDelegate()
                    ->getStyle('A3')
                    ->applyFromArray([
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  12,
                            'bold'      =>  true
                        )
                    ]);
                $event->sheet->getDelegate()
                    ->getStyle('A1:I5')
                    ->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');
                //TITLE
                $event->sheet->getDelegate()
                    ->getStyle('A6:I6')
                    ->applyFromArray($style['TITLE']);
                // HEADER
                $event->sheet->getDelegate()
                    ->getStyle('A7:I7')
                    ->applyFromArray($style['HEADER']);
            }
        ];
    }

    public function drawings()
    {
        return EventExportImageLogo("I2");
    }
}
