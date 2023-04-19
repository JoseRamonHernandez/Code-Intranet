<?php

require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\SpreadSheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new SpreadSheet();
$spreadsheet->getProperties()->setCreator("Clerprem")->setTitle("Matriz de hábilidades");

$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();

$allOperations = json_decode(file_get_contents("http://localhost:3000/operations"), true);

$arregloABC = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');


for($x=0; $x<count($allOperations); $x++)
{

    $position = $arregloABC[$x];

    $masuno = $x+1;

    $numero = strval($masuno);

    $position2 = $arregloABC[$x]."".$numero;
//    $position3 = $arregloABC[$x]+2;

   $idOperation = $allOperations[$x]['_id'];
    $nameOperation = $allOperations[$x]['name_of_operation'];
    $projectOperation = $allOperations[$x]['project'];

//    $hojaActiva->setCellValue("$position", "$nameOperation");
    $hojaActiva->setCellValue("$position2", "$projectOperation");

  /*  $registerOnCollaborators = json_decode(file_get_contents("http://localhost:3000/getCollaborators/operation/$idOperation"), true);

    for($a=0; $a<count($registerOnCollaborators); $a++)
    {
        $numberCollaborator = $registerOnCollaborators[$a]['no_collaborator'];
        $porcentCollaborator = $registerOnCollaborators[$a]['porcent'];

        $infoCollaborator = json_decode(file_get_contents("http://localhost:3000/collaborator/$numberCollaborator"), true);
        $nameCollaborator = $infoCollaborator['name'];

        $newPosition = $position3+1;
        $newPosition2 = $newPosition+1;
        

        $hojaActiva->setCellValue("$position3", "$nameCollaborator");
        $hojaActiva->setCellValue("$newPosition", "$numberCollaborator");
        $hojaActiva->setCellValue("$newPosition2", "$porcentCollaborator");
        
    }
    */

}

/*
$hojaActiva->setCellValue('A1', 'EJEMPLO PARA LA CELDA A1');
$hojaActiva->setCellValue('B1', 'EJEMPLO PARA LA CELDA B1');
$hojaActiva->setCellValue('C1', 'EJEMPLO PARA LA CELDA C1');
$hojaActiva->setCellValue('D1', 'EJEMPLO PARA LA CELDA D1');
$hojaActiva->setCellValue('F1', 'EJEMPLO PARA LA CELDA F1');
$hojaActiva->setCellValue('G1', 'EJEMPLO PARA LA CELDA G1');
*/

/* Here there will be some code where you create $spreadsheet */

// redirect output to client browser

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Matriz de hábilidades.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');


$writer = new Xlsx($spreadsheet);
$writer->save('Matriz de hábilidades.xlsx');


?>