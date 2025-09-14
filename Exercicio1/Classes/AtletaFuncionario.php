<?php

class AtletaFuncionario extends Atleta implements iFuncionario {
    private $salario;
    private $anosContrato;

    public function __construct($nome, $idade, $peso, $altura, $salario, $anosContrato) {
        parent::__construct($nome, $idade, $peso, $altura);
        $this->salario       = $salario;
        $this->anosContrato  = $anosContrato;
    }

    public function mostrarSalario() {
        return "Salário: R$ " . number_format($this->salario, 2, ',', '.');
    }

    public function mostrarTempoContrato() {
        return "Contrato de {$this->anosContrato} anos.";
    }
}