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
    ?>

    <main>
        <h1 id="title">Custeio-Administrativo</h1>
        <div id="div-form">
            <form name="" action="processaFormLogin.php" method="post" id="form-create-account">
                <h3>Pesquisa</h3>
                <div class="form-group">
                  <label for="orgao_superior_nome">Orgao_superior_nome</label>
                  <input type="text" class="form-control" id="orgao_superior_nome" placeholder="Ex: MINISTÉRIO DA EDUCAÇÃO" name="orgao_superior_nome">
                </div>
                <div class="form-group">
                  <label for="orgao_nome">Orgao_nome</label>
                  <input type="text" class="form-control" id="orgao_nome" placeholder="Ex: INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO RIO GRANDE DO SUL" name="orgao_nome">
                </div>
                <div class="form-group">
                  <label for="nome_item">Nome_item</label>
                  <input type="text" class="form-control" id="nome_item" placeholder="Ex: Apoio Administrativo, Técnico e Operacional" name="nome_item">
                </div>
                <div class="form-group">
                  <label for="nome_natureza_despesa_detalhada">Nome_natureza_despesa_detalhada</label>
                  <input type="text" class="form-control" id="nome_natureza_despesa_detalhada" placeholder="Ex: Apoio Administrativo, Técnico e Operacional" name="nome_natureza_despesa_detalhada">
                </div>
                <div class="form-group">
                    <p>Visualizar: <a href="createAccount.php">Histórico de Pesquisa</a></p>
                </div>
                <button class="btn btn-primary" id="btn-form">Pesquisar</button>
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
    
</body>
</html>
