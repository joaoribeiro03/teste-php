<?php require_once '../controller/EmpresaController.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adicionar Conta a Pagar</title>
</head>
<body>
    <h2>Adicionar Conta a Pagar</h2>
    <form action="../controller/ContaPagarController.php" method="post">
        <label for="empresa">Empresa:</label>
        <select name="id_empresa" id="empresa">
            <?php
            $empresaCtrl = new EmpresaController();
            $empresas = $empresaCtrl->listarEmpresas();

            foreach ($empresas as $empresa) {
                echo "<option value='" . $empresa->getIdEmpresa() . "'>" . $empresa->getNome() . "</option>";
            }
            ?>
        </select><br><br>

        <label for="data_pagar">Data a ser Pago:</label>
        <input type="date" id="data_pagar" name="data_pagar"><br><br>

        <label for="valor">Valor a ser pago (R$):</label>
        <input type="number" id="valor" name="valor" step="0.01"><br><br>

        <input type="submit" name="inserir" value="Inserir">
        <input type="submit" name="editar" value="Editar">
    </form>
</body>
</html>
