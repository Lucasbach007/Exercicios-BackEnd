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
    require_once 'Classes\Atleta.php';
    require_once 'Classes\Medico.php';
    require_once 'Classes\Relatorio.php';
    require_once 'Classes\iFuncionario.php';
    require_once 'Classes\AtletaFuncionario.php';


        // Criando pessoa
        $p1 = new Pessoa("Lucas", 22, 70, 1.75);

        // Criando objeto IMC passando a pessoa
        $imc = new IMC($p1);

        echo "IMC de {$p1->nome}: " . number_format($imc->calcular(), 2) . "<br>";
        echo "Classificação: " . $imc->classificacao();

        $ps1 = new Pessoa("Lucas", 22, 70, 1.75);
        $ps1->exibirDados();


                    // Criando objetos
            $atleta = new AtletaFuncionario("Lucas", 22, 70, 1.75, 5000, 3);
            $medico = new Medico("Dr. João", 45, 80, 1.80, 12000, 10);
            $pessoa = new Pessoa("Maria", 30, 65, 1.65);

            // Relatório
            $rel = new Relatorio();
            $rel->add($atleta);
            $rel->add($medico);
            $rel->add($pessoa);

            $rel->log();

    ?>
    </pre>
</html>