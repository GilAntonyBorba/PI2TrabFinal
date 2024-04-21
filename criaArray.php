<?php 

function criaArray($csvname, $jsonname){
    $csvFile = file($csvname);
    $csvFile = array_map("utf8_encode", $csvFile);
    $data = [];

    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line,";");
    }

    array_splice($data, 0, 1);

    $array = [];

    foreach($data as $line){
        $array[$line[0]][$line[1]][$line[2]][$line[3]] = $line[4];
    }

    file_put_contents($jsonname,json_encode($array));
}

?>