<?php
header('Content-type: text/html; charset=utf-8');

 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );

//forcar mostrar todos os erros
error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 1);

	require 'connect.class.php';
	
        $nome_evento    = (isset($_POST['nome_evento'])) ? utf8_decode($_POST['nome_evento']) : '';
        $data_inicio    = (isset($_POST['data_inicio'])) ? $_POST['data_inicio'] :'';
            $data_inicio = explode('/', $data_inicio);
            $data_inicio = $data_inicio[2]."-".$data_inicio[1]."-".$data_inicio[0];
        $data_fim       = (isset($_POST['data_fim'])) ? $_POST['data_fim'] :'';
            $data_fim = explode('/', $data_fim);
            $data_fim = $data_fim[2]."-".$data_fim[1]."-".$data_fim[0];
        $horario        = (isset($_POST['horario'])) ? $_POST['horario'] :'';
        $id_genero = (isset($_POST['id_genero']))? $_POST['id_genero'] : '';
        $link_comprar = (isset($_POST['link_comprar']))? $_POST['link_comprar'] : '#';
        $url_video = (isset($_POST['url_video']))? $_POST['url_video'] : '';
        $descricao_curta = (isset($_POST['descricao_curta']))? utf8_decode($_POST['descricao_curta']) : '';
        $descricao_longa = (isset($_POST['descricao_longa']))? utf8_decode($_POST['descricao_longa']) : '';
        $destaque_home = (isset($_POST['destaque_home']))? $_POST['destaque_home'] : 'Nao';
            
        //realizando o UPLOAD da Imagem escolhida
            $imagem_destaque="";
            //if (($file_size > 1000000)){      
             //   $message = 'Limite de menos de 1 megabytes para foto, favor enviar imagem menor.'; 
             //   echo '<script type="text/javascript">alert("'.$message.'");  history.back();</script>'; 
            //} else {
                if(is_uploaded_file($_FILES['imagem_destaque']['tmp_name'])){ 
                    $folder = "upload/"; 
                    $file = basename( $_FILES['imagem_destaque']['name']);
                    
                    $full_path = $folder.$file; 
                    if(move_uploaded_file($_FILES['imagem_destaque']['tmp_name'], $full_path)) { 
                       // echo "succesful upload, we have an image!";

                        $imagem_destaque= $full_path;

                    } else { 
                       //echo "Upload Ralizado!";
                    } 
                }else{ 
                    echo "";
                } 
                
                $imagem_interna="";
                //UPLOAD DA SEGUNDA IMAGEM
                if(is_uploaded_file($_FILES['imagem_interna']['tmp_name'])){ 
                    $folder = "upload/"; 
                    $file = basename( $_FILES['imagem_interna']['name']);
                    
                    $full_path = $folder.$file; 
                    if(move_uploaded_file($_FILES['imagem_interna']['tmp_name'], $full_path)) { 
                       // echo "succesful upload, we have an image!";

                        $imagem_interna= $full_path;

                    } else { 
                       //echo "Upload Ralizado!";
                    } 
                }else{ 
                    echo "";
                } 
            //}
        
            
            //var_dump($_POST);            exit();
	/*
		|| GRAVANDO OS DADOS EM TABELA DE REGISTRO DE ACESSO
	*/
	try{

            //manter registro de foto caso nao tenha sido escolhido no form
           $stmt = $conn->prepare("INSERT INTO `pgl_eventos` (`id_genero`, `nome_evento`, `data_inicio`, `data_fim`, `horario`, `descricao_curta`, `descricao_longa`, `link_comprar`, `url_video`, `imagem_interna`, `imagem_destaque`, `destaque_home`) 
                    VALUES (  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?);");
            
           
            $stmt->bindParam(1, $id_genero, PDO::PARAM_INT);  
            $stmt->bindParam(2,$nome_evento, PDO::PARAM_STR); 
            $stmt->bindParam(3,$data_inicio, PDO::PARAM_STR); 
            $stmt->bindParam(4,$data_fim, PDO::PARAM_STR);
            $stmt->bindParam(5, $horario, PDO::PARAM_STR);
            $stmt->bindParam(6, $descricao_curta, PDO::PARAM_STR);
            $stmt->bindParam(7,$descricao_longa, PDO::PARAM_STR);
            $stmt->bindParam(8,$link_comprar, PDO::PARAM_STR);
            $stmt->bindParam(9, $url_video, PDO::PARAM_STR);
            //manter registro de foto caso nao tenha sido escolhido no form
                $stmt->bindParam(10,$imagem_interna, PDO::PARAM_STR);
                $stmt->bindParam(11,$imagem_destaque, PDO::PARAM_STR);
            $stmt->bindParam(12, $destaque_home, PDO::PARAM_STR);

            
          		
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
                                    <div syle="float: left;width: 150px;">Dados gravados com sucesso.</div> 
                                </td>
                                <td>
                                <div syle="float: right;width: 150px;">
                                    <a href="../admin.php">VOLTAR</a>
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



