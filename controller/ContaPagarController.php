<?php
require_once '../model/ContaAPagar.php';
require_once '../includes/database.php';

class ContaPagarController {
    public function adicionarContaPagar($id_empresa, $data_pagar, $valor) {
        ContaPagar::adicionar($id_empresa, $data_pagar, $valor);
    }

    public function editarContaPagar($id_conta_pagar, $id_empresa, $data_pagar, $valor) {
        ContaPagar::editar($id_conta_pagar, $id_empresa, $data_pagar, $valor);
    }

    public function listarContasPagar() {
        return ContaPagar::listarTodas();
    }

    public function excluirContaPagar($id_conta_pagar) {
        ContaPagar::excluir($id_conta_pagar);
    }

    public function marcarComoPago($id_conta_pagar) {
        ContaPagar::marcarComoPago($id_conta_pagar);
    }

    public function atualizarStatusPago($id_conta_pagar, $pago) {
        ContaPagar::atualizarPago($id_conta_pagar, $pago);
    }

    public function buscarContaPagarPorId($id_conta_pagar) {
        $contaPagar = new ContaPagar();
        return $contaPagar->buscarPorId($id_conta_pagar);
    }
}

// Verifica se a requisição é POST para atualizar o status "Pago"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contaPagarCtrl = new ContaPagarController();

    // Verifica se o formulário foi submetido para atualizar o status "Pago"
    if (isset($_POST['pago']) && isset($_POST['id_conta_pagar'])) {
        $id_conta_pagar = $_POST['id_conta_pagar'];
        $pago = ($_POST['pago'] == '1') ? true : false;

        // Chama o método no controlador para atualizar o status "Pago"
        $contaPagarCtrl->atualizarStatusPago($id_conta_pagar, $pago);

        // Redireciona para a página de listagem após a atualização
        header('Location: ../view/listarconta.php');
    }
}

// Outras operações GET e POST continuam aqui (adicionar, editar, excluir, marcarPago)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contaPagarCtrl = new ContaPagarController();

    if (isset($_POST['inserir'])) {
        $id_empresa = $_POST['id_empresa'];
        $data_pagar = $_POST['data_pagar'];
        $valor = $_POST['valor'];

        $contaPagarCtrl->adicionarContaPagar($id_empresa, $data_pagar, $valor);
        header('Location: ../view/listarconta.php');
    }

    if (isset($_POST['editar'])) {
        $id_conta_pagar = $_POST['id_conta_pagar'];
        $id_empresa = $_POST['id_empresa'];
        $data_pagar = $_POST['data_pagar'];
        $valor = $_POST['valor'];

        $contaPagarCtrl->editarContaPagar($id_conta_pagar, $id_empresa, $data_pagar, $valor);
        header('Location: ../view/listarconta.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $contaPagarCtrl = new ContaPagarController();
        $action = $_GET['action'];
        $id_conta_pagar = $_GET['id'];

        if ($action === 'excluir') {
            $contaPagarCtrl->excluirContaPagar($id_conta_pagar);
            header('Location: ../view/listarconta.php');
        }

        if ($action === 'marcarPago') {
            $contaPagarCtrl->marcarComoPago($id_conta_pagar);
            header('Location: ../view/listarconta.php');
        }
    }
}
?>
