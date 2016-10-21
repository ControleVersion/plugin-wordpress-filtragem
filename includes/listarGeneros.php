<?php
header('Content-type: text/html; charset=utf-8');
//forcar mostrar todos os erros
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

	require 'connect.class.php';
	
    
        $id_espec              = (isset($_GET['id_espec'])) ? $_GET['id_espec'] :'';  
        if($id_espec != '' && is_numeric($id_espec)){
            /*
                    || LISTANDO OS EVENTOS
            */
            try{


                //$stmt = $conn->prepare("INSERT INTO monit_trafego_sites (idCli,url, date) VALUES (?, ?, ?)");
                $stmt = $conn->query("SELECT * FROM `pgl_generos` ORDER BY nome_genero ASC;");

                $executa = $stmt;

                if($executa){
                    foreach($executa as $ln){
                        echo '<option value="'.$ln['id'].'">'.  html_entity_decode( utf8_encode( $ln['nome_genero'])).'</option>';
                    }
                }
                else{
                    echo '\n Erro ao listar os dados';
                }

                    //$stmt->rowCount(); 

            } catch(PDOException $e) {
            echo '\n ERROR: ' . $e->getMessage();
            }
            $conn  = array();
            $stmt = array();
            $executa = array();
        }

