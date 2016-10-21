<?php
  require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );
 require('header.php');

$idEv =0;
$linha = array();
if(!is_numeric((integer)$_GET['idEv']) && !isset($_GET['idEv']) ){
        echo "<br><br>Evento Inválido escolhido";
        exit();
} else {
    $idEv = (is_numeric($_GET['idEv']))? $_GET['idEv'] : "";
    if($idEv != ""){   
        require 'includes/connect.class.php';
        require './includes/functions.php';        
        
        $dados_evento = CarregarDadosFormEvento($idEv, $conn);
        //var_dump($dados_evento);
?>
 <style>

    .kv-file-upload{
        display: none
    }
</style>   
  <h2>Editar Evento</h2>
  <form id="especialistasForm1" action="includes/updateEvento.php" enctype="multipart/form-data"  method="post" style="width: 50%">
    
     
    <div class="form-group">
      <label for="Nome">Nome Evento:</label>
      <input type="hidden" value="<?php echo $idEv;?>" name="id_evento" />
      <input type="text" class="form-control" name="nome_evento" value="<?php echo utf8_encode($dados_evento['nome_evento']);?>" id="nome" placeholder="Nome" required>
    </div>  
      
    <div class="form-group">
      <label for="Data">Data Inicio:</label>
      <input type="date" class="form-control" name="data_inicio" value="<?php echo $dados_evento['data_inicio']?>" id="data_inicio" placeholder="" required>
    </div>
    
    <div class="form-group">
      <label for="Data">Data Fim:</label>
      <input type="date" class="form-control" name="data_fim" value="<?php echo $dados_evento['data_fim']?>" id="data_fim" placeholder="" required>
    </div>
      
    <div class="form-group">
      <label for="Data">Horário:</label>
      <input type="text" class="form-control" name="horario" value="<?php echo $dados_evento['horario']?>" id="horario" placeholder="" required>
    </div>
    
    <div class="form-group">
      <label for="Area_Atuacao"> Gênero Musical:</label>
      <select class="form-control" name="id_genero" id="id_genero"  style="width: 50%;" required>
          <option value='<?php echo $dados_evento['id_genero']?>'> <?php echo utf8_encode($dados_evento['nome_genero']); ?> </option>
                        
      </select>
    </div>

    <div class="form-group" id="foto">
        
        <label for="Foto">Imagem Destaque (262 x 339): </label>
        <br />
    <?php if($dados_evento['imagem_destaque'] != ""){?>
            <div style="padding: 10px; width: 50%;">
                <img src="includes/<?php echo $dados_evento['imagem_destaque']?>" class="img-thumbnail" id="img-thumbnail-destaque" alt="Imagem Interna"  width="150" />
        
            </div>
            <div class="clearfix" />
            <div class="file-footer-buttons" style="margin: 10px; float: left;">
                <button type="button" id="del-imagem-destaque" class="kv-file-remove btn btn-xs btn-default" title="Remove file">
                    <i class="glyphicon glyphicon-trash text-danger"></i> Excluir 
                </button>
            </div>        
    <?php }else { ?>
            <script>
                setTimeout(function(){
                    $('.imagem_destaque').show();
                }, 1500);
            </script>
    <?php }?>
        
        <div id="fotoUploads" class="imagem_destaque" style="display: none;">   
            <input  name="imagem_destaque" id="imagem_destaque" type="file" class="file" data-min-file-count="1">
        </div>
    </div>
    <div class="form-group" id="foto">
        
        <label for="Foto">Imagem Interna  (1920 x 690): </label>
        <br />
        <?php if($dados_evento['imagem_interna'] != ""){?>
                     
            
                <img src="includes/<?php echo $dados_evento['imagem_interna']?>" class="img-thumbnail" id="img-thumbnail-interna" alt="Imagem Interna" width="150" />
              
            </div>
            <div class="clearfix" />
            <div class="file-footer-buttons" style="margin: 10px; float: left;">
                <button  id="del-imagem-interna" type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file">
                    <i class="glyphicon glyphicon-trash text-danger"></i> Excluir 
                </button>
            </div>
            
    <?php } else { ?>
            <script>
                setTimeout(function(){
                    $('.imagem_interna').show();
                }, 1500);
            </script>
    <?php }?>
            
        <div id="fotoUploads" class="imagem_interna" style="display: none;">   
            <input  name="imagem_interna" id="imagem_interna" type="file" class="file" data-min-file-count="1">
        </div>
    </div>
      
    <div class="form-group">
      <label for="Data">Link Comprar Ingresso:</label>
      <input type="text" class="form-control" name="link_comprar" value="<?php echo $dados_evento['link_comprar']?>" id="link_comprar" placeholder="" required>
    </div>
    
    <div class="form-group">
      <label for="Data">URL Vídeo (Youtube):</label>
      <input type="text" class="form-control" name="url_video" value="<?php echo $dados_evento['url_video']?>" id="url_video" placeholder="" required>
    </div>
      
    <div class="form-group">
      <label for="curriculo">Descrição Curta:</label>
     
      <textarea style="width: 100%;" class="form-control" name="descricao_curta" id="descricao_curta" cols="10" required><?php echo utf8_encode($dados_evento['descricao_curta']);?></textarea>
    </div> 
    <div class="form-group">
      <label for="curriculo">Descrição Longa:</label>
     
      <textarea style="width: 100%; height: 100%;" class="form-control" name="descricao_longa" id="descricao_longa" cols="20"><?php echo utf8_encode($dados_evento['descricao_longa']); ?></textarea>
    </div>  
        
    <div class="form-group">
          <label> Destaque na Home? </label>
          <select id="destaque_home" name="destaque_home" class="form-control" style="width: 50%;">
              <option value="<?php echo $dados_evento['destaque_home']?>" selected><?php echo $dados_evento['destaque_home']?></option>
              
              <option value="Sim">Sim</option>
              <option value="Nao">Não</option>
          </select>
      </div>
      
    <button type="submit" tabindex="500" title="Upload selected files" class="btn btn-default fileinput-upload fileinput-upload-button btn-primary"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">Gravar</span></button>
  		
    <button type="button" class="btn btn-default" onclick="javascript:history.back();" style="float: right;">Voltar</button>
  </form>
</div>
<br><br>
<script>
    //inicia-se com a listagem de generos
        $.ajax({
                type: "GET",
                dataType: "html",
                url: "includes/listarGeneros.php",
                data: {
                    id_espec: 1 
                },
                success: function (data) {
                     
                       //data = "<option value=''>Escolha Gênero</option>"+data;
                         $('#id_genero').append(data);
                }
        });
        
        //excluir imagem interna já cadastrada
        $('#del-imagem-interna').click(function(){
            var x;
            if (confirm("Tem certeza que pretende excluir a imagem?") == true) {
                $('#img-thumbnail-interna').hide();
                $('.imagem_interna').show();
                $(this).hide();
                //PRODUZIR AJAX DE EXCLUSAO DE IMAGEM CADASTRADA
            } else {
                x = "";
            }
            
        });
        //excluir imagem destaque jah cadastrada
        $('#del-imagem-destaque').click(function(){
            
            var x;
            if (confirm("Tem certeza que pretende excluir a imagem?") == true) {
                $('#img-thumbnail-destaque').hide();
                $('.imagem_destaque').show();
                $(this).hide();
                //PRODUZIR AJAX DE EXCLUSAO DE IMAGEM CADASTRADA
            } else {
                x = "";
            }
            
        });
</script>

<?php 
   } else {
       echo "<br><br>EVENTO Inválido escolhido e não numerico..."; 
    }
}

	require('footer.php'); 
	include( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-footer.php' );
?>






