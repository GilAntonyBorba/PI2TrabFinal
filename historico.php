<?php
    include_once 'DBConection.php';
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'deletar_') === 0) {
                $id = str_replace('deletar_', '', $key);
                include_once 'DBConection.php';
                DBHelper::removerItem($id);
                header("Refresh:0");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Zoomable sunburst</title>
    <link rel="stylesheet" type="text/css" href="./inspector.css">
    <link rel="stylesheet" type="text/css" href="./styleForm.css">
    <link rel="stylesheet" type="text/css" href="./styleHistorico.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
    

    <main>
        <div id="voltar">
            <a href="index.php" class="btn btn-primary"><= Voltar a Página Principal</a>
        </div>
        <h1 id="title">Histórico</h1>
        <?php
            include_once 'DBConection.php';
            // $conexao = ConnectionFactory::getConnection($host, $database, $user, $password);
            // $PesquisaDAO = new PesquisaDAOImpl($conexao);
            // $PesquisaDAO->listar($PesquisaDAO);
            $dadosBd = DBHelper::getList();
            // echo "<br><hr><br>";
            // echo "Listando todos os registros no banco:<br>";
            // foreach ($dadosBd as $row) {
            //     echo "ID: " . $row['id'] . ", Item: " . $row['item'] . ", Data e Hora: " . $row['data_hora'] . "<br>";
            // }
            if ($dadosBd) {
                foreach ($dadosBd as $row) {
                    echo '<div class="card" style="--bs-card-border-width:none">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['item'] . '</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Data e Hora: ' . $row['data_hora'] . '</h6>
                                <div class="div-forms">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="itens" value="' . $row['item'] . '">
                                        <button type="submit" class="btn btn-primary">Pesquisar Novamente</button>
                                    </form>
                                    <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                        <input type="hidden" name="id" value=""' . $row['id'] . '">
                                        <button type="submit" name="deletar_' . $row['id'] . '" class="btn btn-danger">Deletar</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>';
                        
                }
            } else {
                echo "<p>Nenhum registro encontrado.</p>";
            }
        ?>
        
      </main>
    
</body>
</html>
