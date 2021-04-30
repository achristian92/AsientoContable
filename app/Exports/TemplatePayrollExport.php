<?php


namespace App\Exports;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;

class TemplatePayrollExport implements FromView,WithEvents,ShouldAutoSize
{
    private $headers;

    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    public function view(): View
    {
        return view('exports.template-payroll',[
            'headers' => $this->headers
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(15);
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(25);

                $endColumn = Coordinate::stringFromColumnIndex(count($this->headers));

                $style = EventExportStyles();
                $event->sheet->getDelegate()
                    ->getStyle('A1:'.$endColumn.'2')
                    ->applyFromArray($style['HEADER']);
            }
        ];
    }




}
