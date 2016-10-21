<?php
  require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );
 require('header.php');

$idEv =0;
$linha = array();
if(!is_numeric((integer)$_GET['idGen']) && !isset($_GET['idGen']) ){
        echo "<br><br>Genero Inválido escolhido";
        exit();
} else {
    $idGen = (is_numeric($_GET['idGen']))? $_GET['idGen'] : "";
    if($idGen != ""){   
        require 'includes/connect.class.php';
        require './includes/functions.php';        
        
        $dados_genero = CarregarFormGenero($idGen, $conn);
        //var_dump($dados_evento);
?>
 <style>

    .kv-file-upload{
        display: none
    }
</style>   
  <h2>Editar Gênero</h2>
  <form id="especialistasForm1" action="includes/updateGenero.php" enctype="multipart/form-data"  method="post" style="width: 50%">
    
     
    <div class="form-group">
      <label for="Nome">Nome Evento:</label>
      <input type="hidden" value="<?php echo $idGen;?>" name="id_genero" />
      <input type="text" class="form-control" name="nome_genero" value="<?php echo utf8_encode($dados_genero['nome_genero']);?>" id="nome_genero" placeholder="Nome" required>
    </div>  
      
          
    <button type="submit" tabindex="500" title="Upload selected files" class="btn btn-default fileinput-upload fileinput-upload-button btn-primary"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">Gravar</span></button>
  		
    <button type="button" class="btn btn-default" onclick="javascript:history.back();" style="float: right;">Voltar</button>
  </form>
</div>
<br><br>


<?php 
   } else {
       echo "<br><br>Genero Inválido escolhido e não numerico..."; 
    }
}

	require('footer.php'); 
	include( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-footer.php' );
?>








