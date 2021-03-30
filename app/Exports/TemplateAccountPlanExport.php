<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TemplateAccountPlanExport implements FromCollection,WithEvents,WithDrawings
{

    public function collection(): Collection
    {
        return collect([]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
            $endColumn = 'H';
                /** NOTES */
                $event->sheet->getDelegate()
                    ->setCellValue('A1','CAMPOS OBLIGATORIOS:')
                    ->setCellValue('A2','* CUENTA,SUBCUENTA,ANALITICA, DESCRIPCIÓN Y TIPO')
                    ->setCellValue('A3','NOTA:')
                    ->setCellValue('A4','* Evitar modificar las cabeceras')
                    ->setCellValue('A5','* Complete la información');
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
                    ->setCellValue('H7','C. COSTOS 2');

                $event->sheet->getDelegate()->getColumnDimension('K')->setVisible(false);


                $sheet = $event->sheet->getDelegate();


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
                    ->getStyle('A1:'.$endColumn.'5')
                    ->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');
                //TITLE
                $event->sheet->getDelegate()
                    ->getStyle('A6:'.$endColumn.'6')
                    ->applyFromArray($style['TITLE']);
                // HEADER
                $event->sheet->getDelegate()
                    ->getStyle('A7:'.$endColumn.'7')
                    ->applyFromArray($style['HEADER']);
            }
        ];
    }

    public function drawings()
    {
        return EventExportImageLogo("G2");
    }
}
