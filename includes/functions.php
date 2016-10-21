<?php
//LIMPAR SUJEIRA DE CARACTERES
function cleanSpecialCaracters($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

    //tratamento de datas para listagem Administrativa
    function verificaMesPassado($mes = null){
                $convert = explode(" - ", $mes);
                
                $mesPassado ='00';
                //convertendo o mes
                switch ($convert[0]):
                    case 'Janeiro': 
                        $mesPassado = '01';
                        break;
                    case 'Fevereiro':
                        $mesPassado = '02';
                        break;
                    case 'Março':
                        $mesPassado = '03';
                        break;
                    case 'Abril':
                        $mesPassado = '04';
                        break;
                    case 'Maio':
                        $mesPassado = '05';
                        break;
                    case 'Junho':
                        $mesPassado = '06';
                        break;
                    case 'Julho':
                        $mesPassado = '07';
                        break;
                    case 'Agosto':
                        $mesPassado = '08';
                        break;
                    case 'Setembro':
                        $mesPassado = '09';
                        break;
                    case 'Outubro':
                        $mesPassado = '10';
                        break;
                    case 'Novembro':
                        $mesPassado = '11';
                        break;
                    case 'Dezembro':
                        $mesPassado = '12';
                        break;
                    default :
                        $mesPassado = '01';
                endswitch;
                
                //convertendo o ano que foi passado e escolhido
                $anoPassado = $convert[1];
                
                //armazenando em array o resultado para consulta SQL
                $retorno = [
                    'dataInicial' => $anoPassado.'-'.$mesPassado.'-'.'01',
                    'dataFinal' => $anoPassado.'-'.$mesPassado.'-'.'31',
                ];
                
                return $retorno;
        }

//carregar dados da clinica
        function CarregarDadosFormEvento($idEv, $conn){
            try {
                //listar os especialistas
                
                    $stmt = $conn->query("SELECT *, g.nome_genero as NOME_GENERO FROM `pgl_eventos` as e "
                            . " INNER JOIN pgl_generos as g ON e.id_genero=g.id "
                            . " WHERE e.id=$idEv;");
                    $resultado = '';   
                    if($stmt){
                        foreach($stmt as $ln){
                            //tratar datas para exibiçao
                            $data_inicio = explode('-', $ln['data_inicio']);
                            $ln['data_inicio'] = $data_inicio[2]."/".$data_inicio[1]."/".$data_inicio[0];
                            
                            $data_fim = explode('-', $ln['data_fim']);
                            $ln['data_fim'] = $data_fim[2]."/".$data_fim[1]."/".$data_fim[0];
                            
                            $resultado = $ln;
                        }
                    }
                    return $resultado;

            } catch (Exception $ex) {
                return "Error na listagem: $ex";
            }
        }
        
        //converter data PT-BR para Mysql
        function PtBrToMysqlDate($data_mysql){
            $data_mysql = explode('/', $data_mysql);
            $data = $data_mysql[2]."-".$data_mysql[1]."-".$data_mysql[0];
            
            return $data;
        }
        
        //converter data MYSQL para PT-BR
        function MysqlToPtBrDate($data_ptbr){
            $data_mysql = explode('-', $data_ptbr);
            $data = $data_mysql[2]."/".$data_mysql[1]."/".$data_mysql[0];
            
            return $data;
        }
        
        //carregar a lista de Generos
        function CarregarListagemGeneros($conn){
             /*
                    || LISTANDO OS EVENTOS
            */
            try{

                $stmt = $conn->query("SELECT * FROM  pgl_generos as g "
                            . " ORDER BY g.`nome_genero`  ASC;");
           
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
                                      
                                    <?php echo utf8_encode( $ln['nome_genero']); ?>
                                    <input name="food_source_row_<?php echo $y; ?>" value="" type="hidden">
                                </td>
                                     
                                <td class="acoes-button" style="padding: 1px; border-left:5px solid #ffffff; width: 31%;">
                                    <button onclick="javascript:window.location.href='editGenero.php?idGen=<?php echo $ln['id'];?>';" id="edit-corpo" type="button" class="btn btn-info btn-xs" style="float: left; margin-right: 27px;">
                                        <i class="glyphicon glyphicon-pencil"></i>  Editar
                                    </button>     
                                    <button id="del-corpo" type="button" onclick="DeletarGenero(<?php echo $ln['id'];?>)" class="btn btn-danger btn-xs" style="float: left;"> 
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
            
        } // fim da function
        
        /*
         * CARREGAR DADOS DE GENERO
         */
        function CarregarFormGenero($idGen, $conn){
            
            try {
                //listar os especialistas
                
                    $stmt = $conn->query("SELECT * FROM `pgl_generos` as g "
                            . " WHERE g.id=$idGen;");
                    $resultado = '';   
                    if($stmt){
                        foreach($stmt as $ln){
                            
                            $resultado = $ln;
                        }
                    }
                    return $resultado;

            } catch (Exception $ex) {
                return "Error na listagem: $ex";
            }
        }
        
        

