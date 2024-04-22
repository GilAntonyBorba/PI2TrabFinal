<?php

// Classe Pesquisa
class Pesquisa {
    private $item;

    public function __construct($item) {;
        $this->item = $item;
    }

    public function getitem() {
        return $this->item;
    }
}

// Interface PesquisaDAO
interface PesquisaDAO {
    public function ler();
    public function criar($item, $id);
    public function remover($id);
}

// Classe PesquisaDAO
class PesquisaDAOImpl implements PesquisaDAO {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function ler() {
        try {
            // Selecionando todos os dados da tabela Pesquisa
            $aux = $this->conexao->query("SELECT * FROM Pesquisa ORDER BY data_hora DESC");
            // Retornando todos os dados como um array
            return $result = $aux->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erro ao selecionar dados da tabela Pesquisa: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function criar($item, $id) {
        try {
            // Inserindo dados na tabela Pesquisa
            $stmt = $this->conexao->prepare("INSERT INTO Pesquisa (id, item) VALUES (?, ?)");
            $stmt->execute([$id, $item]);
            //echo "Pesquisa $item inserida com sucesso! <br>";
        } catch (PDOException $e) {
            print "Erro ao inserir dados na tabela Pesquisa: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }

    public function remover($id) {
        $existe = $this->verificarExistencia($id);
        if($existe){
            try {
                //prepare() é utilizado para consultas que envolvem valores/variáveis fornecidos pelo usuário para garantir a segurança contra injeção de SQL.
                $aux = $this->conexao->prepare("DELETE FROM Pesquisa WHERE id = ?");
                $aux->execute([$id]);
                echo "Registro removido: com id: $id<br>";    
            } catch (PDOException $e) {
                print "Erro ao remover dados da tabela Pesquisa: " . $e->getMessage() . "<br/>";
                die();
            }
        }else{
            echo "não encontrado(a) no banco de dados. Nenhuma remoção foi realizada.<br>";
        }
        
        
    }

    public function verificarExistencia($id) {
        $registros = $this->ler();
        $existe = false;
        foreach ($registros as $registro) {
            if ($registro['id'] == $id) {
                $existe = true;
                break;
            }
        }
        return $existe;   
    }
}

// Classe ConnectionFactory
class ConnectionFactory {
    public static function getConnection($host, $database, $user, $password) {
        try {
            // Conectando ao MySQL
            $dbh = new PDO("mysql:host=$host;", $user, $password);
            // PDO sendo configurado para lançar exceções, do tipo PDOException
            //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Criando o banco de dados se não existir
            $dbh->exec("CREATE DATABASE IF NOT EXISTS $database");
            //echo "Banco de dados $database criado com sucesso! <br>";
                   
            // Selecionando o banco de dados
            $dbh->exec("USE $database");
            //echo "Conexão com o banco de dados, $host, $database, $user, estabelecida com sucesso! <br>";

            // Criando a tabela Pesquisa se ela não existir
            $dbh->exec("CREATE TABLE IF NOT EXISTS Pesquisa (
                id VARCHAR(13),
                item VARCHAR(255),
                data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            //echo "Tabela Pesquisa criada com sucesso! <br>";
            //13 pois o ID gerado pelo uniqid(), produzirá uma string de 13 caracteres.
            
            return $dbh;
        } catch (PDOException $e) {
            print "Erro! Com a Criação/Conexão com o banco de dados, ou com a criação da tabela Pesquisa!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

class DBHelper {
    public static function getList() {
        $host = 'localhost';
        $database = 'TesteTrabFinal';
        $user = 'Gil2024PI2';
        $password = 'teste123';

        $conexao = ConnectionFactory::getConnection($host, $database, $user, $password);
        $PesquisaDAO = new PesquisaDAOImpl($conexao);
        $dadosBd = $PesquisaDAO->ler();
        return $dadosBd;
        
    }
    public static function saveItem($item, $id) {
        $host = 'localhost';
        $database = 'TesteTrabFinal';
        $user = 'Gil2024PI2';
        $password = 'teste123';

        $conexao = ConnectionFactory::getConnection($host, $database, $user, $password);
        $PesquisaDAO = new PesquisaDAOImpl($conexao);
        $PesquisaDAO->criar($item, $id);
        
    }

    public static function removerItem($id) {
        $host = 'localhost';
        $database = 'TesteTrabFinal';
        $user = 'Gil2024PI2';
        $password = 'teste123';
        
        $conexao = ConnectionFactory::getConnection($host, $database, $user, $password);
        $PesquisaDAO = new PesquisaDAOImpl($conexao);
        $PesquisaDAO->remover($id);
        
    }
}



// // Teste
// $host = 'localhost';
// $database = 'TesteTrabFinal';
// $user = 'Gil2024PI2';
// $password = 'teste123';

// $conexao = ConnectionFactory::getConnection($host, $database, $user, $password);
// $PesquisaDAO = new PesquisaDAOImpl($conexao);
// $PesquisaDAO->remover('6625c467280da');

// //Simulação
// $PesquisaDAO->criar('Akemi');
// $PesquisaDAO->criar('Ezio');
// $PesquisaDAO->criar('Caio');
// $PesquisaDAO->criar('Ze');

// echo "<br><hr><br>";
// echo "Listando todos os registros:<br>";
// $dadosBd = $PesquisaDAO->ler();
// foreach ($dadosBd as $row) {
//     echo "Item: " . $row['item']. "<br>";
// }

// echo "<br><hr><br>";
// echo "Removendo dois registros:<br>";
// $PesquisaDAO->remover('Amanda');
// $PesquisaDAO->remover('Ezio');


// echo "<br><hr><br>";
// echo "Listando todos os registros no banco após remover algum registro:<br>";
// $dadosBd = $PesquisaDAO->ler();
// foreach ($dadosBd as $row) {
//     echo "Item: " . $row['item']. "<br>";
// }

?>
