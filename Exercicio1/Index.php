<html>
    <head>
        <meta charset= "utf-8"> 
        <title> PHP COM POO  </title>
    </head>   

    <head>

    </head>
    <body>
        
    </body>

    <pre>
    <?php

    require_once 'Classes\Pessoa.php';
    require_once 'Classes\IMC.php';


        // Criando pessoa
        $p1 = new Pessoa("Lucas", 22, 70, 1.75);

        // Criando objeto IMC passando a pessoa
        $imc = new IMC($p1);

        echo "IMC de {$p1->nome}: " . number_format($imc->calcular(), 2) . "<br>";
        echo "Classificação: " . $imc->classificacao();

        $ps1 = new Pessoa("Lucas", 22, 70, 1.75);
        $ps1->exibirDados();

    ?>
    </pre>
</html>