﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="../css/funcionarios.css" rel="stylesheet" type="text/css"/>
        <title>Cadastro Funcionários</title>
        <link rel="stylesheet" type="text/css" href="css/suporte_tecnico.css"/>
    </head>

    <body>
        <?php require "topo.php"; ?>
        <div id="caixa_preta">
        </div>
        <?php if (@$_GET['pg'] == 'todos') { ?>
            <div id="box_funcionarios">
                <br /><br />
                <a class='a2' href='funcionarios.php?pg=cadastra'>Cadastrar funcionários</a>
                <br /><br />
                <hr />
                <h1>Funcionários</h1>
                <?php
                $sql_1 = "SELECT * FROM funcionarios WHERE nome != '' AND tipo != 'D'";
                $sql_1 = $pdo->query($sql_1);
                if ($sql_1->rowCount() == '') {
                    echo "Nenhum funcionário cadastrado no momento";
                } else {
                    ?>
                    <table width='900' border='0'>
                        <tr>
                            <td><strong>Código:</strong></td>
                            <td><strong>Nome:</strong></td>
                            <td><strong>Profissão:</strong></td>
                            <td><strong>Remuneração:</strong></td>
                            <td><strong>Status:</strong></td>
                            <td></td>
                        </tr>
                        <?php foreach ($sql_1 as $res_1): ?>
                            <tr>
                                <td><?php echo $res_1['code']; ?></td>
                                <td><?php echo $res_1['nome']; ?></td>
                                <td><?php echo $res_1['profissao']; ?></td>
                                <td>R$ <?php echo number_format($res_1['salario'], 2); ?></td>
                                <td><?php echo $res_1['status']; ?></td>
                                <td></td>
                                <td>
                                    <a class="a" href="funcionarios.php?pg=todos&func=deleta&id=<?php echo $res_1['id']; ?>"><img title="Excluir Funcionário" src="../img/deleta.png" width="18" height="18" border="0"/></a>
                                    <?php if ($res_1['status'] == 'Inativo') { ?>
                                        <a class="a" href="funcionarios.php?pg=todos&func=ativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Ativar novamente o acesso do funcionário" src="../img/correto.jpg" width="20" height="20" border="0"/></a>
                                    <?php } ?>
                                    <?php if ($res_1['status'] == 'Ativo') { ?>       
                                        <a class="a" href="funcionarios.php?pg=todos&func=inativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Inativar funcionário(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"/></a>
                                    <?php } ?>
                                    <a class="a" href="funcionarios.php?pg=todos&func=edita&id=<?php echo $res_1['id']; ?>"><img title="Editar Dados Cadastrais" src="../img/ico-editar.png" width="18" height="18" border="0"/></a>
                                </td>
                            </tr>    
                        <?php endforeach; ?>
                    </table>
                    <br/>
                <?php } ?>
            </div><!--Fecha box_funcionarios -->

            <?php
            if (@$_GET['func'] == 'deleta') {
                $id = $_GET['id'];
               // $sql_1 = "DELETE FROM funcionarios WHERE id = '$id'";
                $sql_1 = "UPDATE funcionarios SET tipo = 'D' WHERE id = '$id'";
                $sql_1 = $pdo->query($sql_1);
                $data = date('d/m/Y H:i:s');
                $ip = $_SERVER['REMOTE_ADDR'];
                $sql_2 = "INSERT INTO logsistema (datalog, tipo, usuario, iplocal, servico) VALUES ('$data', 'DEL', '$code', '$ip', 'Excluiu o usuario com o id = $id')";
                $sql_2 = $pdo->query($sql_2);
                echo "<script language='javascript'>window.location='funcionarios.php?pg=todos';</script>";
            }
            ?>

            <?php
            if (@$_GET['func'] == 'ativa') {

                $id = $_GET['id'];
                $code_f = $_GET['code'];
                $sql_2 = "UPDATE funcionarios SET status = 'Ativo' WHERE id = '$id'";
                $sql_2 = $pdo->query($sql_2);
                $sql_3 = "UPDATE  login SET status = 'Ativo' WHERE code = '$code_f'";
                $sql_3 = $pdo->query($sql_3);
                echo "<script language='javascript'>window.location='funcionarios.php?pg=todos';</script>";
            }
            ?>

            <?php
            if (@$_GET['func'] == 'inativa') {

                $id = $_GET['id'];
                $code_f = $_GET['code'];
                $sql_2 = "UPDATE funcionarios SET status = 'Inativo' WHERE id = '$id'";
                $sql_2 = $pdo->query($sql_2);
                $sql_3 = "UPDATE  login SET status = 'Inativo' WHERE code = '$code_f'";
                $sql_3 = $pdo->query($sql_3);
                echo "<script language='javascript'>window.location='funcionarios.php?pg=todos';</script>";
            }
            ?> 

            <?php } ?>

            <?php if (@$_GET['pg'] == 'cadastra') { ?>
            <div id='cadastra_funcionarios'>
                <h1>Cadastrar Funcionários</h1>
                <?php
                if (isset($_POST['button'])) {
                    $code = $_POST['code'];
                    $nome = $_POST['nome'];
                    $cpf = $_POST['cpf'];
                    $nascimento = $_POST['nascimento'];
                    $formacao = $_POST['formacao'];
                    $graduacao = $_POST['graduacao'];
                    $pos_graduacao = $_POST['pos_graduacao'];
                    $mestrado = $_POST['mestrado'];
                    $doutorado = $_POST['doutorado'];
                    $salario = $_POST['salario'];
                    $profissao = $_POST['profissao'];
                    $acesso = $_POST['acesso'];

                    $sql_2 = "INSERT INTO funcionarios (code, status, profissao, nome, cpf, nascimento, formacao, graduacao, pos_graduacao, mestrado, doutorado, salario, tipo) VALUES ('$code', 'Ativo', '$profissao', '$nome', '$cpf', '$nascimento', '$formacao', '$graduacao', '$pos_graduacao', '$mestrado', '$doutorado', '$salario', '')";
                    $sql_2 = $pdo->query($sql_2);
                    
                   
                    $data = date('d/m/Y H:i:s');
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $sql_4 = "INSERT INTO logsistema (datalog, tipo, usuario, iplocal, servico) VALUES ('$data', 'INC', '$user', '$ip', 'Inclusao do funcionario com o id = $code')";
                    $sql_4 = $pdo->query($sql_4);

                    if ($acesso != 'Sem acesso') {
                        $sql_3 = "INSERT INTO login (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', '$acesso')";
                        $sql_3 = $pdo->query($sql_3);
                    }
                    echo "<script language='javascript'>window.alert('Funcionário cadastrado com sucesso');window.location='funcionarios.php?pg=todos';</script>";
                }
                ?>
                <form name="form1" method="post" action="">
                    <table width="900" border="0">
                        <tr>
                            <td>Código:</td>
                            <td>Nome:</td>
                            <td>CPF:</td>
                        </tr>
                        <tr>
                            <td>
                            <?php
                            $sql_1 = "SELECT * FROM funcionarios ORDER BY id DESC LIMIT 1";
                            $sql_1 = $pdo->query($sql_1);
                            if ($sql_1->rowCount() == '') {
                                $novo_code = "3000";
                                ?>
                                <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                                <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"/>
                            </td>
                            <?php
                            }else{
                                foreach ($sql_1 as $res_1) :
                                    $novo_code = $res_1['code'] + 713;
                                    ?>
                                    <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                                    <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                                <?php endforeach;
                            } ?>
                            <td><label for="textfield2"></label>
                                <input type="text" name="nome" id="textfield2"/>
                            </td>
                            <td><label for="textfield3"></label>
                                <input type="text" name="cpf" id="textfield3"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Data de nascimento:</td>
                            <td>Formação Acadêmica</td>
                            <td>Graduação(ões):</td>
                        </tr>
                        <tr>
                            <td><label for="textfield4"></label>
                                <input type="text" name="nascimento" id="textfield4"/>
                            </td>
                            <td><label for="select"></label>
                                <select name="formacao" size="1" id="select">
                                    <option value="Ensino Medio Incompleto">Ensino Médio Incompleto</option>
                                    <option value="Ensino Medio Completo">Ensino Médio Completo</option>
                                    <option value="Superior Incompleto">Superior Incompleto</option>
                                    <option value="Superior Completo">Superior Completo</option>
                                </select>
                            </td>
                            <td><input type="text" name="graduacao" id="textfield5"/></td>
                        </tr>
                        <tr>
                            <td>Pós-graduação(ões):</td>
                            <td>Mestrado(s):</td>
                            <td>Doutorado(s):</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="pos_graduacao" id="textfield6"/></td>
                            <td><input type="text" name="mestrado" id="textfield7"/></td>
                            <td><input type="text" name="doutorado" id="textfield8"/></td>
                        </tr>
                        <tr>
                            <td>Salário:</td>
                            <td>Profissão:</td>
                            <td>Tipo de acesso:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="salario" id="textfield8"/></td>
                            <td><input type="text" name="profissao" id="textfield8"/></td>
                            <td><select name="acesso" size="1">
                                    <option value="Sem acesso">Sem acesso</option>
                                    <option value="Tesouraria">Tesoureiro</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Portaria">Portaria</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"/></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                </form>
            </div><!-- cadastra_funcionarios -->
            <?php } ?>
            
            <?php if(@$_GET['func'] == 'edita'){ ?>
                <div id="box_funcionarios">
                <h1>Editar dados cadastrais</h1>

                <?php if(isset($_POST['button'])){
                            $id = $_GET['id'];
                            $code = $_POST['code'];
                            $nome = $_POST['nome'];
                            $cpf = $_POST['cpf'];
                            $nascimento = $_POST['nascimento'];
                            $formacao = $_POST['formacao'];
                            $graduacao = $_POST['graduacao'];
                            $pos_graduacao = $_POST['pos_graduacao'];
                            $mestrado = $_POST['mestrado'];
                            $doutorado = $_POST['doutorado'];
                            $salario = $_POST['salario'];
                            $profissao = $_POST['profissao'];


                            $sql_2 = "UPDATE funcionarios SET nome = '$nome', cpf = '$cpf', nascimento = '$nascimento', formacao = '$formacao', graduacao = '$graduacao', pos_graduacao = '$pos_graduacao', mestrado = '$mestrado', doutorado = '$doutorado', salario = '$salario', profissao = '$profissao' WHERE id = '$id'";
                            $sql_2 = $pdo->query($sql_2);
                            
                            $data = date('d/m/Y H:i:s');
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $sql_4 = "INSERT INTO logsistema (datalog, tipo, usuario, iplocal, servico) VALUES ('$data', 'INC', '$user', '$ip', 'Edicao do funcionario com o id = $code')";
                            $sql_4 = $pdo->query($sql_4);
                            if($sql_2 == ''){
                                echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
                            }else{
                                echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='funcionarios.php?pg=todos';</script>";

                            }                
                    }?>
                <?php 
                $sql_1 = "SELECT * FROM funcionarios WHERE id = ".$_GET['id']."";
                $sql_1 = $pdo->query($sql_1);
                foreach ($sql_1 as $res_1):
                    ?>
                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                          <tr>
                            <td>Nome:</td>
                            <td>CPF:</td>
                            <td>Data de nascimento:</td>
                          </tr>
                          <tr>
                            <td><input type="text" name="nome" id="textfield2" value="<?php echo $res_1['nome']; ?>"></td>
                            <td><label for="textfield2">
                              <input type="text" name="cpf" id="textfield3" value="<?php echo $res_1['cpf']; ?>">
                            </label></td>
                            <td><label for="textfield3">
                              <input type="text" name="nascimento" id="textfield4" value="<?php echo $res_1['nascimento']; ?>">
                            </label></td>
                            <input type="hidden" name="code" value="<?php echo $res_1['code']; ?>"/>
                          </tr>
                          <tr>
                            <td>Formação Acadêmica</td>
                            <td>Graduação(ões):</td>
                            <td>Pos-graduação(ões):</td>
                          </tr>
                          <tr>
                            <td><label for="textfield4">
                              <select name="formacao" size="1" id="select">
                                <option value="<?php echo $res_1['formacao']; ?>"><?php echo $res_1['formacao']; ?></option>
                                <option value=""></option>
                                <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                <option value="Superior Incompleto">Superior Incompleto</option>
                                <option value="Superior Completo">Superior Completo</option>
                              </select>
                            </label></td>
                            <td><label for="select">
                              <input type="text" name="graduacao" id="textfield5" value="<?php echo $res_1['graduacao']; ?>">
                            </label></td>
                            <td><input type="text" name="pos_graduacao" id="textfield6" value="<?php echo $res_1['pos_graduacao']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Mestrado(s):</td>
                            <td>Doutorado(s):</td>
                            <td>Salário:</td>
                          </tr>
                          <tr>
                            <td><input type="text" name="mestrado" id="textfield7" value="<?php echo $res_1['mestrado']; ?>"></td>
                            <td><input type="text" name="doutorado" id="textfield" value="<?php echo $res_1['doutorado']; ?>"></td>
                            <td><input type="text" name="salario" id="textfield9" value="<?php echo $res_1['salario']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Profissão:</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><input type="text" name="profissao" id="textfield8" value="<?php echo $res_1['profissao']; ?>"></td>
                            <td><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                        <br/>
                        <br/>
                    </form>
                <?php endforeach; ?>
                </div>
            <?php }?>
    <?php require "rodape.php"; ?>
    </body>
</html>