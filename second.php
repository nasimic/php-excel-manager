<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


$searchData = [
    'Provision' => [
        'fresh',
        'bonded',
        'provision',
        'cigar,'
    ],
    'Technical stores' => [
        'deck',
        'engine',
        'electrical',
        'safety',
        'chemicals',
        'paint',
        'stationary',
        'cabin',
        'valves',
        'morring',
        'wire rope',
        'medicine',
        'anchor',
        'chain',
        'fire',
        'charts',
        'publication',
        'life',
        'lubricant'
    ],
    'Spare Parts' => [
        'spare',
        'part',
        'oem',
        'used'
    ],
    'Service Providers' => [
        'boat',
        'barge',
        'survey',
        'compass',
        'condition',
        'navigation',
        'rewind',
        'automation',
        'it',
        'armed',
        'guard',
        'catering'
    ]
];


$inputFileName = __DIR__ . '/ship chandlers.xlsx';

$reader = IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load($inputFileName);

// $sheetData = $spreadsheet->getActiveSheet();

foreach ($spreadsheet->getWorksheetIterator() as $worksheet) 
{
    $worksheetTitle = $worksheet->getTitle();
    $highestColumn = $worksheet->getHighestColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    
    // expects same number of row records for all columns
    $highestRow = $worksheet->getHighestRow();

    
    for ($row = 1; $row <= $highestRow; $row++)
    {
        
        $cellDescription = $worksheet->getCellByColumnAndRow($highestColumnIndex - 6, $row);
        $cellActivity = $worksheet->getCellByColumnAndRow($highestColumnIndex - 5, $row);
        $cellCategory = $worksheet->getCellByColumnAndRow($highestColumnIndex, $row);
        // $val = $cell->getValue();
        $categories = "";
        foreach ($searchData as $category => $keywords){
            foreach ($keywords as $keyword){
                if($cellDescription->getValue() == null && $cellActivity->getValue() == null){
                    continue;
                }
                
                if($cellDescription->getValue() != null){
                    if( strpos($cellDescription->getValue(), $keyword) > -1){
                        $categories.= $category.",";
                        break;
                    }
                }

                if($cellActivity->getValue() != null){
                    if( strpos($cellActivity->getValue(), $keyword) > -1){
                        $categories.= $category.",";
                        break;
                    }
                }
            }
        }
        $spreadsheet->getActiveSheet()->getCellByColumnAndRow($highestColumnIndex, $row)->setValue(rtrim($categories,","));
    }
}

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('finalsheet-'.time().'.xlsx');