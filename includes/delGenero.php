<?php
header('Content-type: text/html; charset=utf-8');
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );

//forcar mostrar todos os erros
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

	require './connect.class.php';
        require './functions.php';
    
        
    if(isset( $_GET['id_genero'] ) && is_numeric( $_GET['id_genero'] ) ){
        
        $id_genero = (isset( $_GET['id_genero']))? $_GET['id_genero']  :0;

                
	/*
		|| GRAVANDO OS DADOS EM TABELA DE REGISTRO DE ACESSO
	*/
	try{
            
            $stmt = $conn->prepare("DELETE FROM pgl_generos WHERE id=?");
            $stmt->bindParam(1, $id_genero, PDO::PARAM_INT);
            
            $executa = $stmt->execute();
 
            if($executa){
                echo '<style>.alert-success {
                        color: #3c763d;
                        background-color: #dff0d8;
                        border-color: #d6e9c6;
                        padding: 10px;
                        }   
                    </style>
                    <div class="alert alert-success fade in" style="margin-top:18px; ">
                        <table bordre="0">
                            <tr>
                                <td>
                                    <div syle="float: left;width: 150px;">Dados <b>atualizados</b> com sucesso.</div> 
                                </td>
                                <td>
                                <div syle="float: right;width: 150px;">
                                    <a href="../listar-eventos.php">VOLTAR</a>
                                </div>
                                </td>
                            </tr>
                        </table>
                    </div>';
            }
            else{
                echo '\n Erro ao excluir';
            }
   		
  		//$stmt->rowCount(); 
		
	} catch(PDOException $e) {
    	echo '\n ERROR: ' . $e->getMessage();
	}
	
	$conn = array();
	$executa = array();
    }  //verificando se Evento foi passado

	include( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-footer.php' );







