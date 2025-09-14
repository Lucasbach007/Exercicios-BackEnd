<?php

class Relatorio {
    private $pessoas = [];

    public function add(Pessoa $p) {
        $this->pessoas[] = $p;
    }

    public function log() {
        foreach ($this->pessoas as $pessoa) {
            echo "<b>{$pessoa->nome}</b><br>";

            // Se tiver trait de IMC
            if (method_exists($pessoa, "calcIMC")) {
                $pessoa->calcIMC();
                echo "IMC: " . number_format($pessoa->imc, 2) . "<br>";
                echo "Classificação: " . $pessoa->classifica() . "<br>";
                echo "Normal? " . ($pessoa->isNormal() ? "Sim" : "Não") . "<br>";
            }

            // Se implementar iFuncionario
            if ($pessoa instanceof iFuncionario) {
                echo $pessoa->mostrarSalario() . "<br>";
                echo $pessoa->mostrarTempoContrato() . "<br>";
            }

            echo "<hr>";
        }
    }
}
