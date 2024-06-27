<?php
require_once '../model/Empresa.php';
require_once '../includes/database.php';

class EmpresaController {
    public function listarEmpresas() {
        return Empresa::listarTodas();
    }
}
?>
