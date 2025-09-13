<?php
Class Pessoa{
public $nome, $idade, $peso, $altura;
   
function _cosntruct($nome, $idade, $peso, $altura){
    $this->nome=$nome;
    $this->idade=$idade;
    $this->peso=$altura;
    $this->peso=$peso;
   
}
    public function exibirDados() {
        echo "Nome: {$this->nome}<br>";
        echo "Idade: {$this->idade} anos<br>";
        echo "Peso: {$this->peso} kg<br>";
        echo "Altura: {$this->altura} m<br>";
    }
    public class IMC {
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

// Criando pessoa
$p1 = new Pessoa("Lucas", 22, 70, 1.75);

// Criando objeto IMC passando a pessoa
$imc = new IMC($p1);

echo "IMC de {$p1->nome}: " . number_format($imc->calcular(), 2) . "<br>";
echo "Classificação: " . $imc->classificacao();

$ps1 = new Pessoa("Lucas", 22, 70, 1.75);
$ps1->exibirDados();
}