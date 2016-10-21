<?php
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 1);
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );
 require('header.php');
 
?> 
<style>
    .form-group input,select,textarea{
        width: 50%;
    }
    .kv-file-upload{
        display: none
    }
</style>
    
  <h2>Cadastro de Evetos</h2>
  <form id="especialistasForm1" action="includes/insertEventos.php" enctype="multipart/form-data" method="post">
    
    <div class="form-group">
      <label for="Nome">Nome do Evento:</label>
      <input type="text" class="form-control" name="nome_evento" id="nome_evento" placeholder="" required>
    </div>
    <div class="form-group">
      <label for="Data">Data Inicio:</label>
      <input type="date" class="form-control" name="data_inicio" id="data_inicio" placeholder="" required>
    </div>
    
    <div class="form-group">
      <label for="Data">Data Fim:</label>
      <input type="date" class="form-control" name="data_fim" id="data_fim" placeholder="">
    </div>
      
    <div class="form-group">
      <label for="Data">Horário:</label>
      <input type="text" class="form-control" name="horario" id="horario" placeholder="" required>
    </div>
    
    <div class="form-group">
      <label for="Area_Atuacao"> Gênero Musical:</label>
      <select class="form-control" name="id_genero" id="id_genero"  style="width: 50%;" required>
            <option value=""> Carregando... </option>
            
                        
      </select>
    </div>

    <div class="form-group" id="foto">
        <label for="Foto">Imagem Destaque: 
        <div id="fotoUploads">   
            <input  name="imagem_destaque" id="imagem_destaque" type="file" class="file" data-min-file-count="1">
        </div>
    </div>
    <div class="form-group" id="foto">
        <label for="Foto">Imagem Interna: 
        <div id="fotoUploads">   
            <input  name="imagem_interna" id="imagem_interna" type="file" class="file" data-min-file-count="1">
        </div>
    </div>
      
    <div class="form-group">
      <label for="Data">Link Comprar Ingresso:</label>
      <input type="text" class="form-control" name="link_comprar" id="link_comprar" placeholder="" required>
    </div>
    
    <div class="form-group">
      <label for="Data">URL Vídeo (Youtube):</label>
      <input type="text" class="form-control" name="url_video" id="url_video" placeholder="" required>
    </div>
      
    <div class="form-group">
      <label for="curriculo">Descrição Curta:</label>
     
      <textarea style="width: 70%;" class="form-control" name="descricao_curta" id="descricao_curta" cols="5" required></textarea>
    </div> 
    <div class="form-group">
      <label for="curriculo">Descrição Longa:</label>
     
      <textarea style="width: 70%;" class="form-control" name="descricao_longa" id="descricao_longa" cols="5"></textarea>
    </div>
      <div class="form-group">
          <label> Destaque na Home? </label>
          <select id="destaque_home" name="destaque_home" class="form-control" style="width: 50%;">
              <option value="Nao">Não</option>
              <option value="Sim">Sim</option>
          </select>
      </div>
    
      <!-- <input type="submit" id="submit" value="Gravar" class="btn btn-success"> -->
      
      <button class="btn btn-default fileinput-upload fileinput-upload-button btn-success" title="Upload selected files" tabindex="500" type="submit"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">Gravar</span></button>
      
  </form>
</div>

<script>
//CARREGAR OS GENEROS CADASTRADOS
        $.ajax({
                type: "GET",
                dataType: "html",
                url: "includes/listarGeneros.php",
                data: {
                    id_espec: 1 
                },
                success: function (data) {
                     
                       data = "<option value=''>Escolha Gênero</option>"+data;
                         $('#id_genero').html(data);
                }
        });
</script>
<?php 
	require('footer.php'); 
	include( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-footer.php' );
?>



