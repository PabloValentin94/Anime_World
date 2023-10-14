<?php

// Namespace desta classe.

namespace App\Controller;

abstract class Controller
{

    protected static function ViewRenderer($view) : void
    {

        $arquivo = VIEWS . $view . ".html";

        if(file_exists($arquivo))
        {

            include $arquivo;

        }

        else
        {

            exit("Arquivo não encontrado! Arquivo especificado: " . $arquivo);

        }

    }

    protected static function InputVerification(string $input) : bool
    {

        $quantidade_espacos_brancos = 0;

        for($i = 0; $i < strlen($input); $i++)
        {

            if($input[$i] == " ")
            {

                $quantidade_espacos_brancos++;
                
            }

        }

        if($quantidade_espacos_brancos == strlen($input))
        {

            return true;

        }

        else
        {

            return false;

        }

    }

    protected static function RecordVerification(string $old_record = null, string $new_record) : bool
    {

        if($old_record == null)
        {

            return true;

        }

        else
        {

            $recorde_atual = (int) str_replace(":", "", $old_record);

            $recorde_novo = (int) str_replace(":", "", $new_record);
    
            if($recorde_novo < $recorde_atual)
            {
    
                return true;
    
            }
    
            else
            {
    
                return false;
    
            }

        }

    }

    protected static function SendReturnAsJSON($data) : void
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));

    }

    protected static function GenerateBackup() : void
    {

        /* Observação: no comando exec são utilizadas aspas simples, pois as aspas 
           duplas são usadas em nomes de diretórios que possuam espaços contidos dentro de si. */

        // Definindo a repartição utilizada.

        $reparticao = BACKUP;

        // Acessando a repartição definida.

        exec($reparticao);

        // Definindo um nome para a pasta de backup.

        $pasta_backup = "Anime_World_Backup";

        // Criando a pasta, caso não exista, onde os arquivos de backup serão salvos.

        if(!is_dir("$reparticao\\$pasta_backup"))
        {

            exec("md $reparticao\\$pasta_backup");

        }

        // Definindo o fuso-horário brasileiro.

        date_default_timezone_set("America/Sao_Paulo");

        // Criando uma pasta, caso não exista, para os arquivos de backup do dia atual.

        $data_atual = strval(date("Y-m-d"));

        if(!is_dir("$reparticao\\$pasta_backup\\$data_atual"))
        {

            exec("md $reparticao\\$pasta_backup\\$data_atual");

        }

        // Criando uma pasta para os arquivos de backup do momento em esta função é acionada.

        $hora_atual = strval(date("H-i-s"));

        exec("md $reparticao\\$pasta_backup\\$data_atual\\$hora_atual");

        // Criando os arquivos de backup.

        exec('C:\"Program Files"\MySQL\"MySQL Server 8.0"\bin\mysqldump -h' . substr($_ENV["database"]["host"], 0, 9) . ' -P' . substr($_ENV["database"]["host"], 10, 4) . ' -u' . $_ENV["database"]["user"] . ' -p' . $_ENV["database"]["password"] . ' ' . $_ENV["database"]["db_name"] . ' --databases > ' . "$reparticao\\$pasta_backup\\$data_atual\\$hora_atual\\" . 'Full_Backup.sql');

        exec('C:\"Program Files"\MySQL\"MySQL Server 8.0"\bin\mysqldump -h' . substr($_ENV["database"]["host"], 0, 9) . ' -P' . substr($_ENV["database"]["host"], 10, 4) . ' -u' . $_ENV["database"]["user"] . ' -p' . $_ENV["database"]["password"] . ' ' . $_ENV["database"]["db_name"] . ' --no-data --databases > ' . "$reparticao\\$pasta_backup\\$data_atual\\$hora_atual\\" . 'Structure_Backup.sql');

        exec('C:\"Program Files"\MySQL\"MySQL Server 8.0"\bin\mysqldump -h' . substr($_ENV["database"]["host"], 0, 9) . ' -P' . substr($_ENV["database"]["host"], 10, 4) . ' -u' . $_ENV["database"]["user"] . ' -p' . $_ENV["database"]["password"] . ' ' . $_ENV["database"]["db_name"] . ' --no-create-info --databases > ' . "$reparticao\\$pasta_backup\\$data_atual\\$hora_atual\\" . 'Data_Backup.sql');

    }

}

?>