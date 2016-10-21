<?php
    require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
    require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );
    require('header.php');
?>

<div class="container">
    <h2>Listagem de Eventos</h2>
    <div>
        <form class="form-inline">
            
            <div class="form-group">
                 <label for="pwd">Filtar:</label>
                <select class="form-control" name="id_genero" id="id_genero" required="">
                    <option value="">Escolha um Gênero</option>
                    
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" id="mes" name="mes" required="">
                    <option value="" id="msg-select-01"  selected> Escolha Mês</option>
                    <?php
                        $ano = date('Y');
                        $meses = [
                            0 => "Janeiro",
                            1 => "Fevereiro",
                            2 => "Março",
                            3 => "Abril",
                            4 => "Maio",
                            5 => "Junho",
                            6 => "Julho",
                            7 => "Agosto",
                            8 => "Setembro",
                            9 => "Outubro",
                            10 => "Novembro",
                            11 => "Dezembro",
                        ];
                        for($x=0; $x < 12; $x++){
                            echo '<option value="'.$meses[$x].' - '.$ano.'">'.$meses[$x].' - '.$ano.'</option>';
                        }
                        for($x=0; $x < 12; $x++){
                            echo '<option value="'.$meses[$x].' - '.($ano+1).'">'.$meses[$x].' - '.($ano+1).'</option>';
                        }
                        for($x=0; $x < 12; $x++){
                            echo '<option value="'.$meses[$x].' - '.($ano+2).'">'.$meses[$x].' - '.($ano+2).'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group" id="listar-especialidades">
                
            </div>
            <div class="form-group">
              
               <input type="text" class="form-control" name="filtrar01" id="filtrar01" placeholder="Pesquisar por nome">
            </div>
                
            <button type="button" id="search" class="btn btn-warning">
                 <i class="glyphicon glyphicon-search"></i> 
            </button>

        </form>
    </div>
    
  
  <style>

			.th-linha{
				background: #006c92;
				font-family: 'Raleway', sans-serif;
				line-height: 20px;
				font-size: 20px;
    			font-weight: 900;
				color: #ffffff;
				padding: 20px;
				text-align: left;
				border-left: 5px solid #ffffff;
			}
			.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   				background-color: #efefef;
   				font-family: 'Raleway', sans-serif;
				font-size: 13px;
				color: #747474;
				font-weight: bold;
   			}
			.table-striped > tbody > tr > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   				background-color: #f8f8f8;
   				font-family: 'Raleway', sans-serif;
				font-size: 13px;
				color: #747474;
				font-weight: bold;
   			}
			.table-striped > tbody > tr > td a{
				color: #747474;
				cursor: pointer;
			}
			.table-striped tr td{
				margin: 15px;
			}
                        .table-striped tr td:eq(0){
				margin: 0px;
			}
	</style>
  
    <div class="table-responsive">
          <table class="food_planner table-striped"  id="table1">
            <thead>
              <tr>
                 <th id="primeira-coluna" width="0%"></th>
                <th>Nome Evento</th>
                <th>Gênero</th>
                <th>Data Inicio</th>
                <th>Data Fim</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody id='listar-corpo'>
              
            </tbody>
          </table>
          
          <!-- pager --> 
			<div id="pager" class="pager">
				<form>
  					<div style="float: left; padding-left: 10px;">
    					<img src="https://mottie.github.io/tablesorter/addons/pager/icons/first.png" class="first disabled" tabindex="0" aria-disabled="true"> </div>
    					<div style="float: left; padding-left: 10px;">	<img src="https://mottie.github.io/tablesorter/addons/pager/icons/prev.png" class="prev disabled" tabindex="0" aria-disabled="true"></div>
    						<span class="pagedisplay" id="table1_pager_info">1 to 10 of 16 linhas</span> <!-- this can be any element, including an input -->
  								<select class="pagesize" aria-disabled="false">
      								<option value="5">5</option>
      								<option value="10">10</option>
      								<option value="10">12</option>
      								<option value="20">20</option>
      								<option value="all">Todas as Linhas</option>
    							</select>
  							<div style="float: left; padding-left: 10px;">
  								<img src="https://mottie.github.io/tablesorter/addons/pager/icons/next.png" class="next" tabindex="0" aria-disabled="false">
  							</div>
    						<div style="float: left; padding-left: 10px;">
    							<img src="https://mottie.github.io/tablesorter/addons/pager/icons/last.png" class="last" tabindex="0" aria-disabled="false">
  							</div>
    			</form>
  			</div>
  		<!-- fim pager -->
										
    </div>
</div>

<script>
        //PADRAO MANTER DESATIVADO OS CAMPOS DEPENDENTES
        $('select#mes').hide();
        $('#filtrar01').hide();
        
        //inicia-se com a listagem de generos
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
        
        //iniciando a lista de eventos
        $.ajax({
                type: "GET",
                dataType: "html",
                url: "includes/searchEventos.php",
                data: {
                    id_espec: 1, 
                    nome_evento: $('#filtrar01').val(), 
                    
                },
                success: function (data) {
                       $('#listar-corpo').html(data);
                }
            });
        //AO CLICAR NO BOTAO DE SEARCH
        $('button#search').click(function(){
            $.ajax({
                type: "GET",
                dataType: "html",
                url: "includes/searchEventos.php",
                data: {
                    id_espec: 1, 
                    nome_evento: $('#filtrar01').val(), 
                    id_genero: $('select#id_genero').val(), 
                    mes: $('select#mes').val()
                },
                success: function (data) {
                       $('#listar-corpo').html(data);
                }
            });
        });
        
        //FILTRAGEM DEPENDENTE DE ESCOLHER O GENERO
        $('select#id_genero').change(function(){
           
            var valor = $(this).val();
            console.log(valor);
            if(valor > 0){
                 $('select#mes').show();
            } else {
                $('select#mes').hide();
                $('input#filtrar01').hide();
            }
        });
        
        //FILTRAGEM DEPENDENTE DE ESCOLHER O GENERO
        $('select#mes').change(function(){
           
            var valor = $(this).val();
            console.log(valor);
            if(valor.length > 0){
               $('input#filtrar01').show();
            } else {
               $('input#filtrar01').hide();
            }
        });
        
        function DeletarEvento(idEv){
            var x;
            if (confirm("Tem certeza que pretende excluir este evento?") == true) {
                
                if(idEv){
                    $.ajax({
                        type: "GET",
                        dataType: "html",
                        url: "includes/delEvento.php",
                        data: {
                            id_espec: 1, 
                            id_evento: idEv
                        },
                        success: function (data) {
                               console.log(data);
                        }
                    });
                }
                
            } else {
                x = "";
            }
        }   
        
    </script>
<?php 
	require('footer.php'); 
	include( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-footer.php' );
?>


