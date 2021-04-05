<?php


namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SeatingExport implements FromView,ShouldAutoSize,WithCustomStartCell,WithEvents
{

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.seating', [
            'data'  => $this->data,
        ]);
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function registerEvents(): array
    {
        $style    = EventExportStyles();
        $endRow   = 1 + count($this->data);
        return [
            AfterSheet::class => function(AfterSheet $event) use ($style,$endRow) {
                $event->sheet->setShowGridlines(false);
                /* Styles */
                $event->sheet->getDelegate()
                    ->getStyle('A1:T1')
                    ->applyFromArray($style['HEADER']);
                //FORMAT DATES
                $event->sheet->getDelegate()
                    ->getStyle('D2:D'.$endRow)
                    ->applyFromArray($style['NUMBER']);
                $event->sheet->getDelegate()
                    ->getStyle('Q2:Q'.$endRow)
                    ->applyFromArray($style['NUMBER']);


                //FORMAT NUMBERS
                $event->sheet->getDelegate()
                    ->getStyle('G2:H'.$endRow)
                    ->applyFromArray($style['NUMBER'])
                    ->getNumberFormat()
                    ->setFormatCode('#,##0.00');

                $event->sheet->getDelegate()
                    ->getStyle('K2:L'.$endRow)
                    ->applyFromArray($style['NUMBER'])
                    ->getNumberFormat()
                    ->setFormatCode('#,##0.00');
                /* Row Height */
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(25);
            }
        ];
    }
}
