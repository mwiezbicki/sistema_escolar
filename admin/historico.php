<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Histórico</title>
        <link href="../css/historico.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <?php require '../config.php'; ?>
    </head>
    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">
        </div>
        <?php if (@$_GET['pg'] == 'historico') { ?>
            <div id="box_curso">
                <br /><br />
                <a class="a2" href="historico.php?pg=historico&cadastra=sim">Cadastrar Histórico</a>
                <br /><br />
                <hr />
                
                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                <h1>Cadastrar Histórico</h1>
                    <?php
                    if (isset($_POST['cadastra'])) {
                        $data = date('d/m/Y H:s:i');
                        $aluno = $_POST['aluno'];
                        $ano = $_POST['ano'];
                        $serie = $_POST['serie'];
                        $unid_inst = $_POST['unid_inst'];
                        $munic_inst = $_POST['munic_inst'];
                        $uf_inst = $_POST['uf_inst'];

                        $sql_4 = "INSERT INTO historico (data,aluno,ano,serie, unid_inst,munic_inst,uf_inst) VALUES "
                                . "('$data','$aluno','$ano','$serie','$unid_inst','$munic_inst','$uf_inst')";
                        $sql_4 = $pdo->query($sql_4);
                        
                        if ($sql_4->rowCount() > 0) {
                            echo "<script language='javascript'>window.alert('Histórico cadastrado com sucesso!!!');</script>";
                            echo "<script language='javascript'>window.location='historico.php?pg=historico';</script>";
                        } else {
                            echo "<script language='javascript'>window.alert('Histórico não cadastrado!!!');</script>";
                        }
                    }
                    ?>
                    <form name="form1" method="POST" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="134">Aluno</td>
                                <td>Ano</td>
                                <td>Série</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="aluno">
                                            <?php
                                            $sql_1 = "SELECT code, nome FROM estudantes";
                                            $sql_1 = $pdo->query($sql_1);
                                            foreach ($sql_1 as $res_1):
                                                ?>
                                                <option value="<?php echo $res_1['code']; ?>"><?php echo $res_1['nome']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="text" name="ano"/></td>
                                <td><input type="text" name="serie"/></td>
                            </tr>
                            <tr>
                                <td>Unidade de Ensino</td>
                                <td>Município</td>
                                <td>UF</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="unid_inst"/></td>
                                <td><input type="text" name="munic_inst"/></td>
                                <td><select name="uf_inst" id="uf_inst">                                      
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </td>
                            </tr>
                       
                            <tr>
                                <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"/></td>
                            </tr>
                        </table>
                    </form>
                    <br/>

                    <?php
                    die;
                }
                ?>
                <!-- Visualizar os Historicos Cadastrados-->
                <h1>Histórico</h1>
                <?php
                $sql = "SELECT * FROM historico";
                $sql = $pdo->query($sql);
                if ($sql->rowCount() == '') {
                    echo "<h2>Nenhum historico cadastrado no momento!!</h2>";
                }else{
                    ?>

                    <table width="900" border="0">
                        <tr>
                            <td><strong>Histórico:</strong></td>
                            <td><strong>Aluno:</strong></td>
                            <td><strong>Ano:</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php foreach ($sql as $res): ?>
                        <tr>
                            <td><h3><?php echo $res['id']; ?></h3></td>
                            <?php
                            $aluno = $res['aluno'];
                            $sql_3 = "SELECT * FROM estudantes WHERE code = '$aluno'";
                            $sql_3 = $pdo->query($sql_3);
                            foreach ($sql_3 as $res_3):
                            
                            ?>
                            <td><h3><?php echo $res_3['nome']; ?></h3></td>
                            <?php endforeach; ?>
                            <td><h3><?php echo $res['ano']; ?></h3></td>
                           
                            <td><a class="a" href="historico.php?pg=historico&deleta=his&id=<?php echo @$res['id']; ?>">
                                <img title="Excluir Historico" src="../img/deleta.jpg" width="18" height="18" border="0"/></a>
                            </td>
                            <td><a class="a" href="historico.php?pg=historico&editar=his&id=<?php echo @$res['id']; ?>"><img title="Incluir Disciplinas do Histórico" src="../img/ico-editar.png" width="18" height="18" border="0"/></a>
                            <td><a class="a" rel="superbox[iframe][920x600]" href="mostrar_historico.php?id=<?php echo $res_3['code']; ?>"><img title="Informações detalhada deste aluno(a)" src="../img/visualizar16.gif" width="18" height="18" border="0"/></a>
                            </td>    
                        </tr>
                        <?php endforeach; ?>
                </table>
            <?php
            }

                // Exclusao do Historico
                if (@$_GET['deleta'] == 'his') {
                    $id = $_GET['id'];

                    $sql_3 = "DELETE FROM historico WHERE id = '$id'";
                    $sql_3 = $pdo->query($sql_3);
                    echo "<script language='javascript'>window.alert('Historico excluído com sucesso!');window.location='historico.php?pg=historico';</script>";
                }
                ?>
                <br/>
                
                <?php
                // Inclusao de Disciplina
                if (@$_GET['editar'] == 'his') {
                    if (isset($_POST['edita'])) {
                        $id = $_GET['id'];
                        $disciplina = $_POST['disciplina'];
                        $nota = $_POST['nota'];
                        $carga_horaria = $_POST['carga_horaria'];
                        $total_faltas = $_POST['total_faltas'];
                        $frequencia = $_POST['frequencia'];
                        $dias_letivos = $_POST['dias_letivos'];
                        $resultado_final = $_POST['resultado_final'];
                        
                        $sql_5 = "INSERT INTO historico_disc (id_historico, disciplina, nota, carga_horaria, total_faltas, frequencia, dias_letivos, resultado_final) VALUES"
                            . "('$id','$disciplina','$nota','$carga_horaria','$total_faltas','$frequencia','$dias_letivos','$resultado_final')";
                        $sql_5 = $pdo->query($sql_5);
                        if ($sql_5->rowCount() > 0) {
                            echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!!!');</script>";
                            echo "<script language='javascript'>window.location='historico.php?pg=historico';</script>";
                        } else {
                            echo "<script language='javascript'>window.alert('Disciplina não cadastrada no Histórico!!!');</script>";
                        }
                    }
                    ?>
                        <form name="form1" method="POST" action="">
                        <table width="900" border="0">
                                <tr>
                                    <td>Disciplina:</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="disciplina"/></td>
                                    
                                </tr>
                                <tr>
                                    <td>Nota</td>
                                    <td>Carga Horária</td>
                                    <td>Total de Faltas Anuais</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nota"/></td>
                                    <td><input type="text" name="carga_horaria"/></td>
                                    <td><input type="text" name="total_faltas"/></td>
                                </tr>
                                <tr>
                                    <td>% de Frequência</td>
                                    <td>Dias Letivos</td>
                                    <td>Resultado Final</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="frequencia"/></td>
                                    <td><input type="text" name="dias_letivos"/></td>
                                    <td><select name="resultado_final" id="resultado_final">
                                            <option value="AP">Aprovado</option>
                                            <option value="RP">Reprovado</option>   
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="input" type="submit" name="edita" id="button" value="Cadastrar"/></td>
                                </tr>
                            </table>
                        </form>
                <?php 
                }
                ?>
                <br/>
                

              
                
            </div><!-- box_curso -->
            <?php
        }?>
        <?php require 'rodape.php'; ?>  
    </body>
</html>