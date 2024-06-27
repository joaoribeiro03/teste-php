<?php

require_once '../includes/database.php';

class ContaPagar {
    private $id_conta_pagar;
    private $valor;
    private $data_pagar;
    private $pago;
    private $id_empresa;

    public function __construct($id_conta_pagar = null, $valor = null, $data_pagar = null, $pago = null, $id_empresa = null) {
        $this->id_conta_pagar = $id_conta_pagar;
        $this->valor = $valor;
        $this->data_pagar = $data_pagar;
        $this->pago = $pago;
        $this->id_empresa = $id_empresa;
    }

    public function getIdContaPagar() {
        return $this->id_conta_pagar;
    }

    public function setIdContaPagar($id_conta_pagar) {
        $this->id_conta_pagar = $id_conta_pagar;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getDataPagar() {
        return $this->data_pagar;
    }

    public function setDataPagar($data_pagar) {
        $this->data_pagar = $data_pagar;
    }

    public function isPago() {
        return $this->pago;
    }

    public function setPago($pago) {
        $this->pago = $pago;
    }

    public function getIdEmpresa() {
        return $this->id_empresa;
    }

    public function setIdEmpresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public static function listarTodas() {
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM tbl_conta_pagar");
        $contas = [];
        while ($row = $result->fetch_assoc()) {
            $contas[] = new ContaPagar($row['id_conta_pagar'], $row['valor'], $row['data_pagar'], $row['pago'], $row['id_empresa']);
        }
        return $contas;
    }

    public static function adicionar($id_empresa, $data_pagar, $valor) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO tbl_conta_pagar (id_empresa, data_pagar, valor, pago) VALUES (?, ?, ?, 0)");
        $stmt->bind_param("isd", $id_empresa, $data_pagar, $valor);
        $stmt->execute();
        $stmt->close();
    }

    public static function editar($id_conta_pagar, $id_empresa, $data_pagar, $valor) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE tbl_conta_pagar SET id_empresa = ?, data_pagar = ?, valor = ? WHERE id_conta_pagar = ?");
        $stmt->bind_param("isdi", $id_empresa, $data_pagar, $valor, $id_conta_pagar);
        $stmt->execute();
        $stmt->close();
    }

    public static function excluir($id_conta_pagar) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM tbl_conta_pagar WHERE id_conta_pagar = ?");
        $stmt->bind_param("i", $id_conta_pagar);
        $stmt->execute();
        $stmt->close();
    }

    public static function marcarComoPago($id_conta_pagar) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE tbl_conta_pagar SET pago = 1 WHERE id_conta_pagar = ?");
        $stmt->bind_param("i", $id_conta_pagar);
        $stmt->execute();
        $stmt->close();
    }

    public static function atualizarPago($id_conta_pagar, $pago) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE tbl_conta_pagar SET pago = ? WHERE id_conta_pagar = ?");
        $stmt->bind_param("ii", $pago, $id_conta_pagar);
        $stmt->execute();
        $stmt->close();
    }

    public static function buscarPorId($id_conta_pagar) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_conta_pagar WHERE id_conta_pagar = ?");
        $stmt->bind_param("i", $id_conta_pagar);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            return new ContaPagar($row['id_conta_pagar'], $row['valor'], $row['data_pagar'], $row['pago'], $row['id_empresa']);
        }
        return null;
    }
}
?>
