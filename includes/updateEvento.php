<?php
header('Content-type: text/html; charset=utf-8');
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );

//forcar mostrar todos os erros
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

	require './connect.class.php';
        require './functions.php';
    
        
    if(isset( $_POST['id_evento'] ) && is_numeric( $_POST['id_evento'] ) ){
        
        $id_evento = (isset( $_POST['id_evento']))? $_POST['id_evento']  :'';

        $nome_evento                   = (isset($_POST['nome_evento'])) ? utf8_decode($_POST['nome_evento']) : '';
        $data_inicio            = (isset($_POST['data_inicio'])) ? PtBrToMysqlDate($_POST['data_inicio']) : '';
            //$data_mysql = explode('/', $data_inicio);
            //$data_inicio = $data_mysql[2]."-".$data_mysql[1]."-".$data_mysql[0];
        $data_fim               = (isset($_POST['data_fim'])) ? PtBrToMysqlDate($_POST['data_fim']) : '';
            //$data_mysql2 = explode('/', $data_fim);
            //$data_fim = $data_mysql2[2]."-".$data_mysql2[1]."-".$data_mysql2[0];
        
        $horario                = (isset($_POST['horario']))? $_POST['horario'] :'';
        $id_genero                = (isset($_POST['id_genero']))? $_POST['id_genero'] :'';
        
        $link_comprar = (isset($_POST['link_comprar']))? $_POST['link_comprar'] : '#';
        $url_video = (isset($_POST['url_video']))? $_POST['url_video'] : '';
        $descricao_curta = (isset($_POST['descricao_curta']))? utf8_decode($_POST['descricao_curta']) : '';
        $descricao_longa = (isset($_POST['descricao_longa']))? utf8_decode($_POST['descricao_longa']) : '';
        $destaque_home = (isset($_POST['destaque_home']))? $_POST['destaque_home'] : 'Nao';
        
        //DECLARACAO PARA NAO OCASIONAR ERROS
        $img_destaque='';
        $img_interna='';
        
        //&& is_uploaded_file($_FILES['imagem_destaque']['tmp_name'])
        if(isset($_FILES['imagem_destaque']['tmp_name']) || isset($_FILES['imagem_interna']['tmp_name']) ){ 
               
                $folder = "upload/"; 
                
                if($_FILES['imagem_destaque']['type'] == "image/jpeg" || $_FILES['imagem_destaque']['type'] == "image/png" || $_FILES['imagem_destaque']['type'] == "image/gif"){
                    if($_FILES['imagem_destaque']['tmp_name']  != ""):
                        //IMAGEM DESTAQUE
                        $file = basename( $_FILES['imagem_destaque']['name']);
                        //tatando o nome da imagem
                        $extension = explode(".", $file);
                        
                        //pegar os ultimos caracteres de extensao da imagem
                        $finalext = substr($file,-4);
                        $file = cleanSpecialCaracters($extension[0]).$finalext;

                        $full_path = $folder.$file; 
                        if(move_uploaded_file($_FILES['imagem_destaque']['tmp_name'], $full_path)) { 
                           // echo "succesful upload, we have an image!";

                            $img_destaque= $full_path;

                        }
                    endif;
                } 
                
                 if($_FILES['imagem_interna']['type'] == "image/jpeg" || $_FILES['imagem_interna']['type'] == "image/png" || $_FILES['imagem_interna']['type'] == "image/gif"){
                     if($_FILES['imagem_interna']['tmp_name']  != ""):
                        //IMAGEM INTERNA
                        $file2 = basename( $_FILES['imagem_interna']['name']);
                        //tatando o nome da imagem
                            $extension2 = explode(".", $file2);
                            $finalext2 = substr($file2,-4);
                            $file2 = cleanSpecialCaracters($extension2[0]).$finalext2;

                        $full_path2 = $folder.$file2; 
                        if(move_uploaded_file($_FILES['imagem_interna']['tmp_name'], $full_path2)) { 
                           // echo "succesful upload, we have an image!";

                            $img_interna= $full_path2;

                        }
                        else { 
                           //echo "Upload Ralizado!";
                        } 
                    endif;
                 } //FIM DO SEGUNDO UPLOAD DE IMAGEM
                 
            }else{ 
                echo "Imagem nao cadastrada...";
            }
        //var_dump($_POST);
        
	/*
		|| GRAVANDO OS DADOS EM TABELA DE REGISTRO DE ACESSO
	*/
	try{

            //manter registro de foto caso nao tenha sido escolhido no form
            if($img_destaque !='' && $img_interna !=''){
               
                $stmt = $conn->prepare("UPDATE `pgl_eventos` SET 
                        `id_genero` = ?, 
                        `nome_evento` = ?, 
                        `data_inicio` = ?, 
                        `data_fim` = ?, 
                        `horario` = ?, 
                        `descricao_curta` = ?, 
                        `descricao_longa` = ?, 
                        `link_comprar` = ?, 
                        `url_video` = ?, 
                        `imagem_interna` = ?, 
                        `imagem_destaque` = ?,
                        `destaque_home`=? "
                        . " WHERE `pgl_eventos`.`id`=?;");

                $stmt->bindParam(1, $id_genero, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_evento, PDO::PARAM_STR);
                $stmt->bindParam(3, $data_inicio, PDO::PARAM_STR);
                $stmt->bindParam(4, $data_fim, PDO::PARAM_STR);
                $stmt->bindParam(5, $horario, PDO::PARAM_STR);
                $stmt->bindParam(6, $descricao_curta, PDO::PARAM_STR);
                $stmt->bindParam(7, $descricao_longa, PDO::PARAM_STR);
                $stmt->bindParam(8, $link_comprar, PDO::PARAM_STR);
                $stmt->bindParam(9, $url_video, PDO::PARAM_STR);
                $stmt->bindParam(10, $img_interna, PDO::PARAM_STR);
                $stmt->bindParam(11, $img_destaque, PDO::PARAM_STR);
                $stmt->bindParam(12, $destaque_home, PDO::PARAM_STR);
                $stmt->bindParam(13, $id_evento, PDO::PARAM_INT);  
            }
            //SE IMAGEM DESTAQUE FOR VALIDA E INTERNA FOR NULL
            if($img_destaque !='' && $img_interna ==''){
               
                $stmt = $conn->prepare("UPDATE `pgl_eventos` SET 
                        `id_genero` = ?, 
                        `nome_evento` = ?, 
                        `data_inicio` = ?, 
                        `data_fim` = ?, 
                        `horario` = ?, 
                        `descricao_curta` = ?, 
                        `descricao_longa` = ?, 
                        `link_comprar` = ?, 
                        `url_video` = ?, 
                        `imagem_destaque` = ?,
                        `destaque_home`=? "
                        . "WHERE `pgl_eventos`.`id`=?;");

                $stmt->bindParam(1, $id_genero, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_evento, PDO::PARAM_STR);
                $stmt->bindParam(3, $data_inicio, PDO::PARAM_STR);
                $stmt->bindParam(4, $data_fim, PDO::PARAM_STR);
                $stmt->bindParam(5, $horario, PDO::PARAM_STR);
                $stmt->bindParam(6, $descricao_curta, PDO::PARAM_STR);
                $stmt->bindParam(7, $descricao_longa, PDO::PARAM_STR);
                $stmt->bindParam(8, $link_comprar, PDO::PARAM_STR);
                $stmt->bindParam(9, $url_video, PDO::PARAM_STR);
                $stmt->bindParam(10, $img_destaque, PDO::PARAM_STR);
                $stmt->bindParam(11, $destaque_home, PDO::PARAM_STR);
                $stmt->bindParam(12, $id_evento, PDO::PARAM_INT);  
            }
            //SE IMAGEM DESTAQUE FOR NULL E INTERNA VALIDO
            if($img_destaque =='' && $img_interna !=''){
               
                $stmt = $conn->prepare("UPDATE `pgl_eventos` SET 
                        `id_genero` = ?, 
                        `nome_evento` = ?, 
                        `data_inicio` = ?, 
                        `data_fim` = ?, 
                        `horario` = ?, 
                        `descricao_curta` = ?, 
                        `descricao_longa` = ?, 
                        `link_comprar` = ?, 
                        `url_video` = ?, 
                        `imagem_interna` = ?,
                        `destaque_home`=? "
                        . "WHERE `pgl_eventos`.`id`=?;");

                $stmt->bindParam(1, $id_genero, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_evento, PDO::PARAM_STR);
                $stmt->bindParam(3, $data_inicio, PDO::PARAM_STR);
                $stmt->bindParam(4, $data_fim, PDO::PARAM_STR);
                $stmt->bindParam(5, $horario, PDO::PARAM_STR);
                $stmt->bindParam(6, $descricao_curta, PDO::PARAM_STR);
                $stmt->bindParam(7, $descricao_longa, PDO::PARAM_STR);
                $stmt->bindParam(8, $link_comprar, PDO::PARAM_STR);
                $stmt->bindParam(9, $url_video, PDO::PARAM_STR);
                $stmt->bindParam(10, $img_interna, PDO::PARAM_STR);
                $stmt->bindParam(11, $destaque_home, PDO::PARAM_STR);
                $stmt->bindParam(12, $id_evento, PDO::PARAM_INT);  
            }
            //SE NAO FOR PASSADA NENHUMA IMAGEM
            if($img_destaque =='' && $img_interna ==''){
               
                $stmt = $conn->prepare("UPDATE `pgl_eventos` SET 
                        `id_genero` = ?, 
                        `nome_evento` = ?, 
                        `data_inicio` = ?, 
                        `data_fim` = ?, 
                        `horario` = ?, 
                        `descricao_curta` = ?, 
                        `descricao_longa` = ?, 
                        `link_comprar` = ?, 
                        `url_video` = ?,
                        `destaque_home`=? "
                        . "WHERE `pgl_eventos`.`id`=?;");

                $stmt->bindParam(1, $id_genero, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_evento, PDO::PARAM_STR);
                $stmt->bindParam(3, $data_inicio, PDO::PARAM_STR);
                $stmt->bindParam(4, $data_fim, PDO::PARAM_STR);
                $stmt->bindParam(5, $horario, PDO::PARAM_STR);
                $stmt->bindParam(6, $descricao_curta, PDO::PARAM_STR);
                $stmt->bindParam(7, $descricao_longa, PDO::PARAM_STR);
                $stmt->bindParam(8, $link_comprar, PDO::PARAM_STR);
                $stmt->bindParam(9, $url_video, PDO::PARAM_STR);
                $stmt->bindParam(10, $destaque_home, PDO::PARAM_STR);
                $stmt->bindParam(11, $id_evento, PDO::PARAM_INT);  
            }
            
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


