<script src="js/scripts.js"></script>
  

    <script src="bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
         This must be loaded before fileinput.min.js -->
    <script src="bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
         This must be loaded before fileinput.min.js -->
    <script src="bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- the main fileinput plugin file -->
    <script src="bootstrap-fileinput/js/fileinput.min.js"></script>
    <!-- bootstrap.js below is needed if you wish to zoom and view file content 
         in a larger detailed modal dialog -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- optionally if you need a theme like font awesome theme you can include 
        it as mentioned below -->
    <script src="bootstrap-fileinput/js/locales/pt-BR.js"></script>
    
    <!-- MASCARA PARA CAMPOS JQUERY -->
    <script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>
        
    <script>
        // initialize with defaults
        $("#imagem_destaque").fileinput({
            initialPreview:0,
            uploadUrl:false, 
            uploadAsync: false, 
            showUpload:false, 
            allowedFileExtensions:['jpg', 'png','gif', 'jpeg'], 
            maxFileSize: '1024',
            maxImageWidth: 170,
            resizeImage: true            
        });
		
		
		 // initialize with defaults
        $("#imagem_interna").fileinput({
            initialPreview:0,
            uploadUrl:false, 
            uploadAsync: false, 
            showUpload:false, 
            allowedFileExtensions:['jpg', 'png','gif', 'jpeg'], 
            maxFileSize: '1024',
            maxImageWidth: 170,
            resizeImage: true            
        });
	
	//MASCARA PARA DATA NO EDIT DE EVENTOS
        $("input#data_fim").mask("99/99/9999");
        $("input#data_inicio").mask("99/99/9999");
        $("#horario").mask("99:99");
    </script>
    
    <script src="https://mottie.github.io/tablesorter/js/jquery.tablesorter.js"></script>
	<!-- Tablesorter: optional -->
	<link rel="stylesheet" href="https://mottie.github.io/tablesorter/addons/pager/jquery.tablesorter.pager.css">
	<script src="https://mottie.github.io/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
	<script>
		//=== INICIO DO PAGINADOR ----------------------------------------

				//----------------------------------------------------------------
				 //exemplo paginado
    				setTimeout(function(){	
    					$("#table1").tablesorter({
                                                widthFixed: true,
                                                sortList: [[1,0],[0,1]]
                                        });
    					$("#table1").tablesorterPager({container: $("#pager"),size: 5});
					}, 3000);
				//----------------------------------------------------------------
                                        $("#table2").tablesorter({
                                                widthFixed: true,
                                                sortList: [[1,0],[0,1]]
                                        });
    					$("#table2").tablesorterPager({container: $("#pager"),size: 15});
                                //----------------------------------------------------------------
				//ocultando o menu administrativo para nao termos problemas
				$('#adminmenuwrap .wp-menu-name').hide();
				$('#adminmenu').hide();
				$('.update-nag').hide();
	</script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <script>
            $('#data_inicio').datepicker({
                format: 'dd/mm/yyyy',                
                language: 'pt-BR'
            });
            $('#data_fim').datepicker({
                format: 'dd/mm/yyyy',                
                language: 'pt-BR'
            });
        </script>
        
</body>
</html>

