<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Zoomable sunburst</title>
    <link rel="stylesheet" type="text/css" href="./inspector.css">
    <link rel="stylesheet" type="text/css" href="./styleForm.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
    <?php
    include_once 'getJSONFile.php';

    clearstatcache();

    $arrayFileName = "arrayCustAdm.json";
    $csvFileName = "custeio_adm.csv";
    
    if(!file_exists($arrayFileName)){
        include_once 'criaArray.php';
        criaArray($csvFileName, $arrayFileName);
    }

    $array = json_decode(file_get_contents($arrayFileName), true);

    $name = "files/custeioTratado.json";

    getJSONFile($array, $name);
    // var_dump($array);

    $file = file($csvFileName);
    $file = array_map("utf8_encode", $file);

    $opcoes = [];

    ?>

    <main>
        <h1 id="title">Custeio Administrativo 02/2024</h1>
        <div id="div-form">
            <form name="" action="" method="post" id="form-create-account">
                <h3>Pesquisa por Item</h3>
                <select class="form-select" onchange="this.form.submit()" name="itens">
                  <option selected disabled>Item</option>
                  <option value="TODOS">TODOS</option>
                  <?php
                  $opcoes = [];
                  foreach ($file as $line) {
                    $line = str_getcsv($line,";");
                    $opcoes[$line[2]] = null;
                  }
                  array_splice($opcoes, 0, 1);
                  if(isset($_POST["itens"])){
                    $item = $_POST["itens"];
                  }else{
                    $item="";
                  }
                  
                  foreach($opcoes as $key => $value){
                    if($key===$item){
                      echo '<option value="'.$key.'" selected>'.$key.'</option>';
                    }else{
                      echo '<option value="'.$key.'">'.$key.'</option>';
                    }
                  }
                  ?>
                </select>
                <div class="form-group">
                    <p><a href="historico.php">Visualizar Histórico de Pesquisa</a></p>
                </div>
                <!-- <button class="btn btn-primary" id="btn-form" type="submit">Pesquisar</button> -->
              </form>
        </div>
        <div id="zoomable-sunburst">
            <script type="module">
                import define from "./index.js";
                import {Runtime, Library, Inspector} from "./runtime.js";
        
                const runtime = new Runtime();
                const main = runtime.module(define, Inspector.into(document.body));
            </script>
        </div>
      </main>
      <?php
        if(isset($_POST["itens"])){
          $item = $_POST["itens"];
          if($item != "TODOS"){
            $vetor = [];
            foreach($array as $orgao => $v){
              foreach($v as $dep => $v1){
                foreach($v1 as $gasto => $v2){
                  if($gasto == $item){
                    $vetor[$orgao][$dep][$gasto] = $array[$orgao][$dep][$gasto];
                  }
                }
              }
            }
            getJSONFile($vetor, $name);
          }
          $id = uniqid();
          include_once 'DBConection.php';
          DBHelper::saveItem($item, $id);
        }
      ?>
      <script>
      
          window.addEventListener("load", (event) => {
            document.getElementsByClassName("observablehq")[1].style='width:50%;margin-left: 25%;margin-right: 25%;';

          });
      </script>
    
</body>
</html>
