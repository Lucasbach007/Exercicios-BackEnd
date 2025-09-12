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

$ps1 = new Pessoa("Lucas", 22, 70, 1.75);
$ps1->exibirDados();
}