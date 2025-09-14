<?php
require_once 'Pessoa.php';
 Class IMC {
    private $pessoa;

    // Recebe um objeto Pessoa no construtor
    public function __construct(Pessoa $pessoa) {
        $this->pessoa = $pessoa;
    }

    // Cálculo do IMC
    public function calcular() {
        return $this->pessoa->peso / ($this->pessoa->altura * $this->pessoa->altura);
    }

    // Retorna classificação
    public function classificacao() {
        $imc = $this->calcular();

        if ($imc < 18.5) {
            return "Abaixo do peso";
        } elseif ($imc < 24.9) {
            return "Peso normal";
        } elseif ($imc < 29.9) {
            return "Sobrepeso";
        } elseif ($imc < 34.9) {
            return "Obesidade Grau I";
        } elseif ($imc < 39.9) {
            return "Obesidade Grau II";
        } else {
            return "Obesidade Grau III";
        }
    }
}