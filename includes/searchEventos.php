<?php
header('Content-type: text/html; charset=utf-8');
//forcar mostrar todos os erros
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

	require 'connect.class.php';
        require './functions.php';
	
        
        //====== FIM DAS FUNCTIONS AUXILIARES ==================================
        
        
        $id_espec              = (isset($_GET['id_espec'])) ? $_GET['id_espec'] :''; 
        $nome_evento = (isset($_GET['nome_evento'])) ? addslashes( $_GET['nome_evento'] ) :'';
        $idGenero = (isset($_GET['id_genero'])) ? $_GET['id_genero'] :'';
        $mes = (isset($_GET['mes'])) ? $_GET['mes'] :'';
        
        if($mes != ''){
            $diaInicial = verificaMesPassado($mes);
            $diaInicial = ($mes != "")? $diaInicial['dataInicial'] : '';
            $diaFinal = verificaMesPassado($mes);
            $diaFinal = ($mes != "")? $diaFinal['dataFinal'] : '';
        }
        
                
        if($id_espec != '' && is_numeric($id_espec)){
       
            /*
                    || LISTANDO OS EVENTOS
            */
            try{

                //FILTRAR SOMENTE POR NOME
                //====================  reajustando ==================
                if($nome_evento != "" && $idGenero == "" && $mes == ''){
                    $stmt = $conn->query("SELECT *,g.nome_genero as NOME_GENERO, e.id id_evento FROM `pgl_eventos` as e "
                            . "INNER JOIN pgl_generos as g ON e.id_genero=g.id "
                            . " WHERE e.nome_evento LIKE '%$nome_evento%' "
                            . " ORDER BY e.`nome_evento`  ASC;");
                   //echo "<h1>SOMENTE PELO NOME</h1>";
                                       //CONTADOR DE RESULTADOS
                    if($stmt->rowCount() <= 0){
                        echo "<tr><td colspan='6'>NENHUM EVENTO ECONTRADO...</td></tr>";
                    }    
                }
                
                //FOLTRAR POR APENAS GENERO MUSICAL
                if ($idGenero != "" && $mes == '' && $nome_evento == "") {
                    
                    $stmt = $conn->query("SELECT *,g.nome_genero as NOME_GENERO, e.id id_evento FROM `pgl_eventos` as e  
                                        INNER JOIN pgl_generos as g ON e.id_genero=g.id
                                        WHERE  e.id_genero=$idGenero ORDER BY e.`nome_evento`  ASC");
                        //echo "<h1> SOMENTE GENERO MUSICAL</h1>";
                                        //CONTADOR DE RESULTADOS
                    if($stmt->rowCount() <= 0){
                        echo "<tr><td colspan='6'>NENHUM EVENTO ECONTRADO...</td></tr>";
                    }   
                       
                }
                
                //FILTRAR APENAS POR GENERO E MES DO EVENTO SEM NOME
                if ($idGenero != "" && $mes != '' && $nome_evento == "") {
                    
                    $stmt = $conn->query("SELECT *,g.nome_genero as NOME_GENERO, e.id id_evento FROM `pgl_eventos` as e 
                                        INNER JOIN pgl_generos as g ON e.id_genero=g.id
                                        WHERE  e.id_genero=$idGenero AND e.data_inicio BETWEEN '$diaInicial' AND '$diaFinal'
                                        ORDER BY e.`nome_evento`  ASC");
                        //echo "<h1> SOMENTE POR GEnero e Mes dos Eventos</h1>";
                    //CONTADOR DE RESULTADOS
                    if($stmt->rowCount() <= 0){
                        echo "<tr><td colspan='6'>NENHUM EVENTO ECONTRADO...</td></tr>";
                    }
                } 
                //FILTRAR APENAS POR GENERO E MES E NOME (TRES FILTROS)
                if ($idGenero != "" && $mes != '' && $nome_evento != "") {
                    
                    $stmt = $conn->query("SELECT *,g.nome_genero as NOME_GENERO, e.id id_evento FROM `pgl_eventos` as e  
                                        INNER JOIN pgl_generos as g ON e.id_genero=g.id
                                        WHERE  e.id_genero=$idGenero AND e.data_inicio BETWEEN '$diaInicial' AND '$diaFinal' AND e.nome_evento LIKE '%$nome_evento%'
                                        ORDER BY e.`nome_evento`  ASC");
                        //echo "<h1> SOMENTE POR GEnero e Mes dos Eventos</h1>";
                    //CONTADOR DE RESULTADOS
                    if($stmt->rowCount() <= 0){
                        echo "<tr><td colspan='6'>NENHUM EVENTO ECONTRADO...</td></tr>";
                    }
                     
                } 
                //FILTRAR SEM PASSAR NADA
                if($nome_evento == "" && $idGenero == "" && $mes == ''){
                        $stmt = $conn->query("SELECT *, g.nome_genero as NOME_GENERO, e.id id_evento FROM `pgl_eventos` as e
                                            INNER JOIN pgl_generos as g ON e.id_genero=g.id  ORDER BY e.`nome_evento`  ASC;");
                        //echo "<h1>NEHUM DOS CASOS</h1>";
                                         //CONTADOR DE RESULTADOS
                    if($stmt->rowCount() <= 0){
                        echo "<tr><td colspan='6'>NENHUM EVENTO ECONTRADO...</td></tr>";
                    }  
                }
               
               
              
                $executa = $stmt;
                    
                if($executa){
                    $y=0;
                    foreach($executa as $ln){
                       
           
                        ?>
                        <tr>
                                <td width="0" style="width: 0px ! important;">
                                    <input name="food_id_<?php echo $y; ?>" value="<?php echo $y; ?>" checked="checked" id="" style="" type="hidden">
                                </td>
                                <td style="padding: 10px; border-left:5px solid #ffffff;">
                                      
                                    <?php echo utf8_encode( $ln['nome_evento']); ?>
                                    <input name="food_source_row_<?php echo $y; ?>" value="" type="hidden">
                                </td>
                                <td style="padding: 10px; border-left:5px solid #ffffff;">
                                        <?php echo utf8_encode($ln['NOME_GENERO']); ?>
                                        <input name="food_source_row_<?php echo $y; ?>" value="" type="hidden">
                                </td>
                                <td style="padding: 10px; border-left:5px solid #ffffff;">
                                        <?php echo MysqlToPtBrDate($ln['data_inicio']); ?>
                                        <input name="food_source_row_<?php echo $y; ?>" value="" type="hidden">
                                </td>
                                <td style="padding: 10px; border-left:5px solid #ffffff;">
                                        <?php echo MysqlToPtBrDate($ln['data_fim']); ?>
                                        <input name="food_source_row_<?php echo $y; ?>" value="" type="hidden">
                                </td>
     
                                <td  style="padding: 1px; border-left:5px solid #ffffff; width: 22%;">
                                    <button onclick="javascript:window.location.href='editEvento.php?idEv=<?php echo $ln['id_evento'];?>';" id="edit-corpo" type="button" class="btn btn-info btn-xs" style="float: left; margin-right: 27px;">
                                        <i class="glyphicon glyphicon-pencil"></i>  Editar
                                    </button>     
                                    <button id="del-corpo" type="button" onclick="DeletarEvento(<?php echo $ln['id_evento'];?>)" class="btn btn-danger btn-xs" style="float: left;"> 
                                       <i class="glyphicon glyphicon-trash"></i>  Excluir
                                    </button>
                                </td>
                        </tr>
                        <?php
                        $y++;
                    }
                }
                else{
                    echo '\n Erro ao listar os dados';
                }

                    //$stmt->rowCount(); 

            } catch(PDOException $e) {
            echo '\n ERROR: ' . $e->getMessage();
            }
            $conn  = array();
            $stmt = array();
            $executa = array();
        }


