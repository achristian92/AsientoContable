<?php


namespace App\Exports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class TemplateCostDistributionExport implements FromCollection,WithEvents,WithHeadings,ShouldAutoSize
{
    private $headers;

    public function __construct(array $headers)
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
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(25);

                $endColumn = Coordinate::stringFromColumnIndex(count($this->headers));

                $style = EventExportStyles();
                $event->sheet->getDelegate()
                    ->getStyle('A1:'.$endColumn.'1')
                    ->applyFromArray($style['HEADER']);
            }
        ];
    }

    public function headings(): array
    {
        return $this->headers;
    }
}
