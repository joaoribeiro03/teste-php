<?php
require_once '../controller/ContaPagarController.php';

if (isset($_GET['id'])) {
    $id_conta_pagar = $_GET['id'];
    $contaPagarCtrl = new ContaPagarController();
    $contaPagar = $contaPagarCtrl->buscarContaPagarPorId($id_conta_pagar);

    if ($contaPagar) {
        $id_empresa = $contaPagar->getIdEmpresa();
        $data_pagar = $contaPagar->getDataPagar();
        $valor = $contaPagar->getValor();
    } else {
        header('Location: listarconta.php');
        exit;
    }
} else {
    header('Location: listarconta.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Conta a Pagar</title>
    <link rel="stylesheet" href="caminho_para_seu_css/style.css">
</head>
<body>
    <h1>Editar Conta a Pagar</h1>
    <form action="../controller/ContaPagarController.php" method="POST">
        <input type="hidden" name="id_conta_pagar" value="<?php echo $id_conta_pagar; ?>">
        
        <label for="id_empresa">Empresa:</label>
        <select id="id_empresa" name="id_empresa">
            <option value="<?php echo $id_empresa; ?>">Empresa X</option>
        </select>
        <br>
        
        <label for="data_pagar">Data a ser Pago:</label>
        <input type="date" id="data_pagar" name="data_pagar" value="<?php echo $data_pagar; ?>" required>
        <br>
        
        <label for="valor">Valor a ser Pago:</label>
        <input type="text" id="valor" name="valor" value="<?php echo $valor; ?>" required>
        <br>
        
        <button type="submit" name="editar">Editar</button>
    </form>
</body>
</html>
