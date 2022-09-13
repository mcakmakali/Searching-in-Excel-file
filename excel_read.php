<?php 

function excel_read_search($filePath, $searchColumn, $text){
 require __DIR__.'/setting.php';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = $reader->load($filePath);
unset($reader);
$worksheet = $spreadsheet->setActiveSheetIndex(0);
$highestRow = $worksheet->getHighestRow();
$highestCol = $worksheet->getHighestColumn();

$s_text = $text;
echo "<table id='searchTable'>"; 
echo "<tr id='table-head'>";
foreach($columns as $column){ 
    echo sprintf('<td>%s</td>', $column); 
} 
echo "</tr>";

foreach($worksheet->rangeToArray("A2:$highestCol$highestRow", null, true, false, false) as $item){
    if(strstr($item[$searchColumn],$s_text)){
    echo "<tr>"; 
        foreach($item as $value){
            echo "<td>".$value."</td>";
        }

    echo "</tr>";
}

}

echo "</table>";

}