<?php
class Empresa {
    private $id_empresa;
    private $nome;

    public function __construct($id_empresa = null, $nome = null) {
        $this->id_empresa = $id_empresa;
        $this->nome = $nome;
    }

    public function getIdEmpresa() {
        return $this->id_empresa;
    }

    public function setIdEmpresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public static function listarTodas() {
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM tbl_empresa");
        $empresas = [];
        while ($row = $result->fetch_assoc()) {
            $empresas[] = new Empresa($row['id_empresa'], $row['nome']);
        }
        return $empresas;
    }
}
?>
