<?php
  require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin.php' );
 require_once( '/home/storage/f/c4/cd/vivorio3/public_html/site/wp-admin/admin-header.php' );
 require('header.php');
 
 require './includes/connect.class.php';
 require './includes/functions.php';
?>

<div class="container">
    <h2>Listagem de Gêneros</h2>
    <br>
    
  
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
                <th>Nome</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody id='listar-corpo'>
              <?php CarregarListagemGeneros($conn);?>
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
       


        
        function DeletarGenero(idEv){
            var x;
            if (confirm("Tem certeza que pretende excluir este Genero?") == true) {
                
                if(idEv){
                    $.ajax({
                        type: "GET",
                        dataType: "html",
                        url: "includes/delGenero.php",
                        data: {
                            id_espec: 1, 
                            id_genero: idEv
                        },
                        success: function (data) {
                               console.log(data);
                               window.location.href="listar-generos.php";
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


