<?php

use Carbon\Carbon;

function isOpenRoute($segmento, $route = '')
{
    request()->segment($segmento) === $route ? $route = 'open' : $route;
    return $route;
}

function isActiveRoute($segmento, $route = '')
{
    request()->segment($segmento) === $route ? $route = 'active' : $route;
    return $route;
}

if (!function_exists('_add4NumRand')) {
    function _add4NumRand(String $string = "123456")
    {
        $text_without_spaces = str_replace(' ', '', $string);
        return strtolower($text_without_spaces.rand(1000,9999));
    }
}

if (!function_exists('customerID')) {
    function customerID()
    {
        return (int) request()->segment(3);
    }
}

function formatDate(string $date = null)
{
    if ($date === null)
        return '';

    return Carbon::parse($date)->format('d/m/y');
}

function flatten($array) {
    $result = [];
    foreach ($array as $item) {
        if (is_array($item)) {
            $result[] = array_filter($item, function($array) {
                return ! is_array($array);
            });
            $result = array_merge($result, flatten($item));
        }
    }
    return array_filter($result);
}


function EventExportImageLogo($coordinates = "B2")
{
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setPath(public_path('/img/jga.png'));
    $drawing->setHeight(80);
    $drawing->setWidth(150);
    $drawing->setCoordinates($coordinates);

    return $drawing;
}

function EventExportStyles()
{
    return [
        'TITLE'=> [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'font' => [
                'bold' => true,
                'name' => 'Arial',
                'size' => 12,
                'color' => ['argb' => 'ffffff'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '292B57',
                ],
            ],
        ],
        'HEADER' => [
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'font' => [
                'bold' => true,
                'name' => 'Arial',
                'size' => 11,
                'color' => ['argb' => '434448'],
            ],
        ],
        'DATA' => [
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
        ]
    ];
}
