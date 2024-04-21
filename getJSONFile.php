<?php 

function getJSONFile($array, $nome){
    file_put_contents($nome, '');
    $myfile = fopen($nome, "w") or die("Unable to open file!");
    $c = 0;
    fwrite($myfile, '{"name":"flare","children":[');
    foreach($array as $key => $value){
        fwrite($myfile, '{"name":"'.$key.'","children":[');
        $cont = 0;
        foreach($value as $k => $v){
            fwrite($myfile, '{"name":"'.$k.'","children":[');
            $cont1 = 0;
            foreach($v as $k2 => $v2){
                fwrite($myfile, '{"name":"'.$k2.'","children":[');
                $cont2 = 0;
                foreach($v2 as $k3 => $v3){
                    if(++$cont2 < count($v2)) fwrite($myfile, '{"name":"'.$k3.'","value":'.$v3.'},');
                    else fwrite($myfile, '{"name":"'.$k3.'","value":'.$v3.'}');
                }
                if(++$cont1 < count($v)) fwrite($myfile, "]},");
                else fwrite($myfile, "]}");
            }
            if(++$cont < count($value)) fwrite($myfile, "]},");
            else fwrite($myfile, "]}");
        }
        if(++$c < count($array)) fwrite($myfile, "]},");
        else fwrite($myfile, "]}");
    }
    fwrite($myfile, "]}");
    fclose($myfile);
}


?>