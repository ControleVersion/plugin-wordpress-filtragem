<?php
header('Content-type: text/html; charset=utf-8');
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );

//forcar mostrar todos os erros
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

	require './connect.class.php';
        require './functions.php';
    
        
    if(isset( $_POST['id_genero'] ) && is_numeric( $_POST['id_genero'] ) ){
        
        $id_genero = (isset( $_POST['id_genero']))? (int)$_POST['id_genero']  :0;

        $nome_genero                   = (isset($_POST['nome_genero'])) ? utf8_decode($_POST['nome_genero']) : '';
        
        //var_dump($_POST);
        
	/*
		|| GRAVANDO OS DADOS EM TABELA DE REGISTRO DE ACESSO
	*/
	try{

                //UPDATE `pgl_generos` SET `nome_genero` = 'Arrochas' WHERE `pgl_generos`.`id` = 1;
                $stmt = $conn->prepare("UPDATE `pgl_generos` as g SET `nome_genero`=? "
                        . " WHERE g.`id`=?;");

                $stmt->bindParam(1, $nome_genero, PDO::PARAM_STR);
                $stmt->bindParam(2, $id_genero, PDO::PARAM_INT);  
       
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
                                    <a href="../listar-generos.php">VOLTAR</a>
                                </div>
                                </td>
                            </tr>
                        </table>
                    </div>';
            }
            else{
                echo '\n Erro ao inserir os dados';
            }
   		
  		//$stmt->rowCount(); 
		
	} catch(PDOException $e) {
    	echo '\n ERROR: ' . $e->getMessage();
	}
	
	$conn = array();
	$executa = array();
}  //verificando se Evento foi passado

	include( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-footer.php' );
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#adminmenuwrap .wp-menu-name').hide();
        $('#adminmenu').hide();
        $('.update-nag').hide();
    });
</script>




