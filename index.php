<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <h3 class="title">PHP - Excel Manager</h3>
            <div class="links">
                <div>
                    <a href="keyword_form.php">Add Category based on keywords</a>
                </div>
            </div>
        </div>
        <h3 class="title">Created by <span style="color: #009688;"><a href="https://github.com/nasimic" target="_blank">nasimic</a></span></h3>
        <style>
            body{
                background: #0d1117;
                font-family: ui-monospace,SFMono-Regular,SF Mono,Menlo,Consolas,Liberation Mono,monospace;
            }
            .container{
                width: 400px;
                margin: auto;
                padding: 15px;
            }
            .title{
                color: #c9d1d9;
                text-align: center;
            }
            .links{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
            }
            .links > * {
                display: flex;
                justify-content: center;
                align-items: center;
                flex: 1 0 100%;
                background: #ccc;
                margin: 20px 0;
                color: #0d1117;
                border-radius: 10px;
                text-align: center;
                cursor: pointer;
            }
            .links > *:hover{
                background: #fff;
            }
            .links > div > a{
                width: 100%;
                padding: 15px;
            }
            a{
                color: inherit;
                text-decoration: none;
            }
            a:hover, a:active, a:focus, a:visited {
                color: inherit;
                text-decoration: none;
            }
        </style>
    </body>
</html>


<?php

// require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\IOFactory;


// $searchData = [
//     'Provision' => [
//         'fresh',
//         'bonded',
//         'provision',
//         'cigar,'
//     ],
//     'Technical stores' => [
//         'deck',
//         'engine',
//         'electrical',
//         'safety',
//         'chemicals',
//         'paint',
//         'stationary',
//         'cabin',
//         'valves',
//         'morring',
//         'wire rope',
//         'medicine',
//         'anchor',
//         'chain',
//         'fire',
//         'charts',
//         'publication',
//         'life',
//         'lubricant'
//     ],
//     'Spare Parts' => [
//         'spare',
//         'part',
//         'oem',
//         'used'
//     ],
//     'Service Providers' => [
//         'boat',
//         'barge',
//         'survey',
//         'compass',
//         'condition',
//         'navigation',
//         'rewind',
//         'automation',
//         'it',
//         'armed',
//         'guard',
//         'catering'
//     ]
// ];


// $inputFileName = __DIR__ . '/ship chandlers.xlsx';

// $reader = IOFactory::createReader("Xlsx");
// $spreadsheet = $reader->load($inputFileName);

// $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

// foreach($sheetData as $key => $data) {
//     if($key == array_key_first($sheetData)){
//         continue;
//     }
//     $last_key = array_key_last($data);
//     $last_index = $data[$last_key];
//     $data = array_values($data);
//     foreach ($searchData as $category => $keywords){
//         foreach ($keywords as $keyword){
//             if($data[count($data)-3] == null || $data[count($data)-2] == null){
//                 continue;
//             }

//             if( strpos($data[count($data)-3], $keyword) > -1 || strpos($data[count($data)-2], $keyword) > -1){
//                 $sheetData[$key][$last_key] .= $category.",";
//                 break;
//             }
//         }
//     }

//     // $sheetData[$key][$last_key] = rtrim($sheetData[$key][$last_key], ',');
    
// }

// $newSheet = new Spreadsheet();
// $newSheet->getActiveSheet()->fromArray($sheetData, null, 'A1');

// $writer = IOFactory::createWriter($newSheet, 'Xlsx');
// $writer->save('finalsheet-'.time().'.xlsx');