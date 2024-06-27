# Sistema de Gestão de Contas a Pagar

Este projeto é um sistema de gestão de contas a pagar desenvolvido em PHP seguindo o padrão de arquitetura MVC (Model-View-Controller), usando o VS code. O sistema permite gerenciar contas a pagar de uma empresa, aplicando regras de negócio específicas para cálculo de descontos e acréscimos com base na data de pagamento.

## Funcionalidades

- Listar todas as contas a pagar
- Adicionar novas contas a pagar
- Editar contas a pagar existentes
- Excluir contas a pagar
- Marcar contas como pagas
- Aplicar regras de negócio para cálculo de valores a pagar:
  - Contas pagas antes da data de vencimento têm um desconto de 5%
  - Contas pagas na data de vencimento não têm desconto
  - Contas pagas após a data de vencimento têm um acréscimo de 10%

## Configuração do Banco de Dados

### Criação do Banco de Dados e Tabelas

Execute o seguinte script SQL para criar o banco de dados e as tabelas necessárias:

```sql
CREATE DATABASE testephp;
USE testephp;
CREATE TABLE tbl_empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_conta_pagar (
    id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2) NOT NULL,
    data_pagar DATE NOT NULL,
    pago TINYINT(1) NOT NULL,
    id_empresa INT,
    FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa)
);

INSERT INTO tbl_empresa (nome) VALUES ('Empresa A'), ('Empresa B');

INSERT INTO tbl_conta_pagar (valor, data_pagar, pago, id_empresa) VALUES
(1000.50, '2024-07-01', 0, 1),
(250.75, '2024-07-10', 1, 1),
(300.00, '2024-08-01', 0, 2);
```

