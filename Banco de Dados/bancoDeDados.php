<?php

class BancoDeDados
{
    // Instância única da classe
    private static $instancia;

    // Configurações do banco de dados
    private $host = "localhost";
    private $usuario = "websiga";
    private $senha = "aluno1232023";
    private $nomeBanco = "ESCOLA";

    // Conexão com o banco de dados
    private $conexao;

    // Construtor privado para evitar instâncias externas
    private function __construct()
    {
        $this->conectar();
    }

    // Método estático para obter a instância única da classe
    public static function obterInstancia()
    {
        if (!self::$instancia) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    // Conectar ao banco de dados
    private function conectar()
    {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->nomeBanco);

        // Verificar erros na conexão
        if ($this->conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    // Executar consulta no banco de dados (SELECT)
    public function consultar($query)
    {
        $resultado = $this->conexao->query($query);

        // Verificar erros na consulta
        if (!$resultado) {
            die("Erro na consulta: " . $this->conexao->error);
        }

        return $resultado;
    }

    // Inserir novo registro no banco de dados (CREATE)
    public function inserir($tabela, $dados)
    {
        $colunas = implode(", ", array_keys($dados));
        $valores = "'" . implode("', '", array_values($dados)) . "'";

        $query = "INSERT INTO $tabela ($colunas) VALUES ($valores)";

        $this->executarQuery($query);
    }

    // Atualizar registro no banco de dados (UPDATE)
    public function atualizar($tabela, $dados, $condicao)
    {
        $set = [];

        foreach ($dados as $coluna => $valor) {
            $set[] = "$coluna = '$valor'";
        }

        $set = implode(", ", $set);

        $query = "UPDATE $tabela SET $set WHERE $condicao";

        $this->executarQuery($query);
    }

    // Executar uma query no banco de dados
    private function executarQuery($query)
    {
        $resultado = $this->conexao->query($query);

        // Verificar erros na execução da query
        if (!$resultado) {
            die("Erro na execução da query: " . $this->conexao->error);
        }

        return $resultado;
    }

    public function executarQueryPublic($query)
    {
        $resultado = $this->conexao->query($query);

        // Verificar erros na execução da query
        if (!$resultado) {
            die("Erro na execução da query: " . $this->conexao->error);
        }

        return $resultado;
    }

    // Evitar a clonagem da instância
    private function __clone() {}

    // Fechar a conexão ao destruir a instância
    public function __destruct()
    {
        if ($this->conexao) {
            $this->conexao->close();
        }
    }
}
?>