<?php
require_once '../controller/ContaPagarController.php';
$contaPagarCtrl = new ContaPagarController();
$contasPagar = $contaPagarCtrl->listarContasPagar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listar Contas a Pagar</title>
</head>
<body>
    <h2>Listar Contas a Pagar</h2>
    <table border="1">
        <tr>
            <th>Empresa</th>
            <th>Data a ser Pago</th>
            <th>Valor (R$)</th>
            <th>Pago</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($contasPagar as $contaPagar): ?>
        <tr>
            <td><?= $contaPagar->getIdEmpresa() ?></td>
            <td><?= $contaPagar->getDataPagar() ?></td>
            <?php
                $valorOriginal = $contaPagar->getValor();
                $dataPagar = new DateTime($contaPagar->getDataPagar());
                $hoje = new DateTime();

                $dataPagar->setTime(0, 0, 0, 0);
                $hoje->setTime(0, 0, 0, 0);

                if ($hoje < $dataPagar) {
                    $valorFinal = $valorOriginal * 0.95;
                } elseif ($hoje > $dataPagar) {
                    $valorFinal = $valorOriginal * 1.1;
                } else {
                    $valorFinal = $valorOriginal;
                }
            ?>
            <td>R$ <?= number_format($valorFinal, 2, ',', '.') ?></td>
            <td>
                <form action='../controller/ContaPagarController.php' method='post'>
                    <input type='hidden' name='id_conta_pagar' value='<?= $contaPagar->getIdContaPagar() ?>'>
                    <select name='pago' onchange='this.form.submit()'>
                        <option value='1'<?= ($contaPagar->isPago() ? ' selected' : '') ?>>Sim</option>
                        <option value='0'<?= (!$contaPagar->isPago() ? ' selected' : '') ?>>Não</option>
                    </select>
                </form>
            </td>
            <td>
                <a href='editarconta.php?id=<?= $contaPagar->getIdContaPagar() ?>'>Editar</a> |
                <a href='../controller/ContaPagarController.php?action=excluir&id=<?= $contaPagar->getIdContaPagar() ?>'>Excluir</a> |
                <a href='../controller/ContaPagarController.php?action=marcarPago&id=<?= $contaPagar->getIdContaPagar() ?>'>Marcar como Pago</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">Voltar para a página inicial</a>
</body>
</html>
