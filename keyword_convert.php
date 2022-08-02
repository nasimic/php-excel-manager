<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$searchData = [];

if(isset($_POST['categories']) && isset($_POST['fields'])){
    foreach($_POST['categories'] as $key => $category){
        
        $keywords = explode(',',$_POST['keywords'][$key]);

        $keywords = array_map(function($val) {
            return explode(' ', $val);
        }, $keywords);

        $flatten_keywords = array_merge(...array_values($keywords));
        
        $final_keywords = array_filter($flatten_keywords, fn($value) => !is_null($value) && $value !== '');
        
        $searchData[$category] = $final_keywords;
    }
}

if(isset($_FILES['document'])){
    if($_FILES['document']['tmp_name']){
        if(!$_FILES['document']['error'])
        {
        
            $inputFile = $_FILES['document']['tmp_name'];
            $extension = strtoupper(explode(".", $_FILES['document']['name'])[1]);
            if($extension == 'XLSX'){
        
                //Read spreadsheeet workbook
                try {
                    $inputFileType = IOFactory::identify($inputFile);
                    $objReader = IOFactory::createReader($inputFileType);
                    $spreadsheet = $objReader->load($inputFile);
                } catch(Exception $e) {
                        die($e->getMessage());
                }

                $worksheet = $spreadsheet->getActiveSheet(); 
                $highestColumn = $worksheet->getHighestColumn();
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                $worksheet->getCellByColumnAndRow($highestColumnIndex, 1)->setValue('Category');

                // expects same number of row records for all columns
                $highestRow = $worksheet->getHighestRow();

                for ($col = 1; $col <= $highestColumnIndex; $col++)
                {
                    if(in_array($worksheet->getCellByColumnAndRow($col, 1)->getValue(), array_values($_POST['fields']))){
                        
                        for ($row = 1; $row <= $highestRow; $row++)
                        {
                            
                            $cellCategory = $worksheet->getCellByColumnAndRow($highestColumnIndex, $row);
                            
                            $categories = "";
                            foreach ($searchData as $category => $keywords){
                                foreach ($keywords as $keyword){

                                    if($worksheet->getCellByColumnAndRow($col, $row)->getValue() != null && $worksheet->getCellByColumnAndRow($col, $row)->getValue() != ""){
                                        if( str_contains(strtolower($worksheet->getCellByColumnAndRow($col, $row)->getValue()), strtolower($keyword))){
                                            $categories.= $category.',';
                                            break;
                                        }
                                    }

                                }
                            }
                            if($categories != ""){
                                $current_value = ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($highestColumnIndex, $row)->getValue() != null) 
                                    ? $spreadsheet->getActiveSheet()->getCellByColumnAndRow($highestColumnIndex, $row)->getValue().','
                                    : "";
                                $spreadsheet->getActiveSheet()->getCellByColumnAndRow($highestColumnIndex, $row)->setValue(rtrim($current_value.$categories,","));
                            }
                        }
                    }
                }
            }
            else{
                echo "Please upload an XLSX or ODS file";
            }
        }
        else{
            echo $_FILES['document']['error'];
        }
    }
}

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

$finalName = 'finalsheet-'.time().'.xlsx';

$writer->save($finalName);

header('Location: '.$finalName);