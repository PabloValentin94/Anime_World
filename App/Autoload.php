<?php

/* Utilização de uma função de AutoLoading (Carregamento automático de classes.)
   cujo parâmetro é uma função anônima (Que não possui nome.). */

   spl_autoload_register(function($classe){

    // Criação de uma váriável que recebe o caminho do arquivo a ser incluso.

    $arquivo = BASEDIR . $classe . ".php";

    // Verificando se o caminho (Arquivo.) especificado existe.

    if(file_exists($arquivo))
    {

        // Caso o caminho especificado realmente exista, o arquivo será incluso.

        include $arquivo;
        
    }

    else
    {

        /* Caso o caminho especificado não exista, o desenvolvedor será notificado,
           podendo ver o caminho especificado. */

        exit("Arquivo não encontrado! Arquivo especificado: " . $arquivo);

    }

});

?>