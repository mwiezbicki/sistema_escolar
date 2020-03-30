<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Estudantes</title>
        <link href="../css/estudantes.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        require 'topo.php';
        require '../config.php';
        ?>

        <div id="caixa_preta">
        </div>

        <!-- Exibir estudantes cadastrados -->
        <?php if (@$_GET['pg'] == 'todos') { ?>
            <div id="box_aluno">
                <br/><br/>
                <a class="a2" href="estudantes.php?pg=cadastra&bloco=1">Cadastrar novo aluno</a>
                <br/><br/>
                <hr/>
                <h1>Alunos que estão cadastrados</h1>
                
                <?php
                $sql = "SELECT * FROM estudantes WHERE nome != ''";
                $sql = $pdo->query($sql);
                
                if ($sql->rowCount() == '') {
                    echo "<h2>No momento não existe nunhum aluno cadastrado!</h2>";
                } else {
                    ?>
                    <table width="900" border="0">
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td><strong>Código:</strong></td>
                            <td><strong>Nome:</strong></td>
                            <td><strong>Série(ano):</strong></td>
                            <td><strong>Mensalidade:</strong></td>
                            <td></td>
                        </tr>
                        <?php foreach ($sql as $alu): ?>
                            <tr>
                                <td><h3><?php echo $alu['status']; ?></h3></td>
                                <td><h3><?php echo $alu['code']; ?></h3></td>
                                <td><h3><?php echo $alu['nome']; ?></h3></td>
                                <td><h3><?php echo $alu['serie']; ?></h3></td>
                                <td><h3>R$ <?php echo $alu['mensalidade']; ?></h3></td>
                                <td></td>
                                <td><a class="a" href="estudantes.php?pg=todos&func=delete&id=<?php echo $alu['id']; ?>&code=<?php echo $alu['code']; ?>">
                                        <img title="Excluir Aluno(a)" src="../img/deleta.jpg" width="18" height="18" border="0"/></a>
                                    <?php if ($alu['status'] == 'Inativo') { ?>
                                        <a class="a" href="estudantes.php?pg=todos&func=ativa&id=<?php echo $alu['id']; ?>&code=<?php echo $alu['code']; ?>">
                                            <img title="Ativar novamente Aluno(a)" src="../img/correto.jpg" width="20" height="20" border="0"/></a>
                                    <?php } ?>
                                    <?php if ($alu['status'] == 'Ativo') { ?>
                                        <a class="a" href="estudantes.php?pg=todos&func=inativa&id=<?php echo $alu['id']; ?>&code=<?php echo $alu['code']; ?>">
                                            <img title="Inativar o Aluno(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"/></a>
                                    <?php } ?>
                                    <a class="a" href="estudantes.php?pg=todos&func=edita&id=<?php echo $alu['id']; ?>"><img title="Editar Dados Cadastrais" src="../img/ico-editar.png" width="18" height="18" border="0"></a>
                                    <a class="a" rel="superbox[iframe][800x600]" href="mostrar_resultado.php?q=<?php echo $alu['code']; ?>&s=aluno&curso=<?php echo $alu['serie']; ?>"><img title="Informações detalhada deste aluno(a)"
                                                                                                                                                src="../img/visualizar16.gif" width="18" height="18" border="0"/></a>
                                </td>
                            </tr>

                        <?php endforeach;?>

                    </table>
                    <br/>
                    <?php
                }
                ?>
                <br/>
            
            
                <!--Exclusão, ativação e Desativação -->
                <?php
                if (@$_GET['func'] == 'deleta') {
                    $id = $_GET['id'];
                    $code = $_GET['code'];

                    $sql_del = "DELETE FROM estudantes WHERE id = '$id'";
                    $sql_del2 = "DELETE FROM login WHERE code = '$code'";
                    $sql_del = $pdo->query($sql_del);
                    $sql_del2 = $pdo->query($sql_del2);
                    echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
                }
                ?>

                <!--Ativar o Aluno -->
                <?php
                if (@$_GET['func'] == 'ativa') {
                    $id = $_GET['id'];
                    $code = $_GET['code'];

                    $sql_editar = "UPDATE estudantes SET status = 'Ativo' WHERE id = '$id'";
                    $sql_editar2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
                    $sql_editar = $pdo->query($sql_editar);
                    $sql_editar2 = $pdo->query($sql_editar2);
                    echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
                }
                ?>

                <!--Inativar o Aluno -->
                <?php
                if (@$_GET['func'] == 'inativa') {
                    $id = $_GET['id'];
                    $code = $_GET['code'];

                    $sql_editar = "UPDATE estudantes SET status = 'Inativo' WHERE id = '$id'";
                    $sql_editar2 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
                    $sql_editar = $pdo->query($sql_editar);
                    $sql_editar2 = $pdo->query($sql_editar2);
                    echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
                }?>
                

                <!--Editar Alunos -->    
                <?php if (@$_GET['func'] == 'edita') { ?>
                    <hr />

                    <?php
                    $id = $_GET['id'];
                    $sql_1 = "SELECT * FROM estudantes WHERE id = '$id'";
                    $sql_1 = $pdo->query($sql_1);

                    foreach ($sql_1 as $edit):
                        ?>
                        <h1>Editar Estudantes - Código Aluno: <?php echo $edit['code']; ?></h1>
                        <?php
                        if (isset($_POST['button'])) {
                            $id = $_GET['id'];
                            $code = $_POST['code'];
                            $status = $_POST['status'];
                            $nome = $_POST['nome'];
                            $cpf = $_POST['cpf'];
                            $rg = $_POST['rg'];
                            $naturalidade = $_POST['naturalidade'];
                            $natural_uf = $_POST['natural_uf'];
                            $sexo = $_POST['sexo'];
                            $nascimento = $_POST['nascimento'];
                            $mae = $_POST['mae'];
                            $pai = $_POST['pai'];
                            $estado = $_POST['estado'];
                            $cidade = $_POST['cidade'];
                            $bairro = $_POST['bairro'];
                            $endereco = $_POST['endereco'];
                            $complemento = $_POST['complemento'];
                            $tel_residencial = $_POST['tel_residencial'];
                            $cep = $_POST['cep'];
                            $celular = $_POST['celular'];
                            $tel_amigo = $_POST['tel_amigo'];
                            $serie = $_POST['serie'];
                            $turno = $_POST['turno'];
                            $atendimento_especial = $_POST['atendimento_especial'];
                            $mensalidade = $_POST['mensalidade'];
                            $vencimento = $_POST['vencimento'];
                            $tel_cobranca = $_POST['tel_cobranca'];
                            $obs = $_POST['obs'];

                            $sql_2 = "UPDATE estudantes SET nome = '$nome', cpf = '$cpf', rg = '$rg', naturalidade = '$naturalidade', natural_uf = '$natural_uf', sexo = '$sexo', nascimento = '$nascimento', "
                                    . "mae = '$mae', pai = '$pai', estado = '$estado', cidade = '$cidade', bairro = '$bairro', endereco = '$endereco', complemento = '$complemento', cep = '$cep', "
                                    . "tel_residencial = '$tel_residencial', celular = '$celular', tel_amigo = '$tel_amigo', serie = '$serie', turno = '$turno', atendimento_especial = '$atendimento_especial', "
                                    . "mensalidade = '$mensalidade', vencimento = '$vencimento', tel_cobranca = '$tel_cobranca', obs = '$obs' WHERE id = '$id'";
                            $sql_2 = $pdo->query($sql_2);
                            if ($sql_2->rowCount() <= 0) {
                                echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
                            } else {
                                echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='estudantes.php?pg=todos';</script>";
                            }
                        }
                        ?>
                    <?php endforeach; ?>
                    <form name="form1" method="post" action="" enctype="multipart/form-data">
                        <table width="900" border="0">
                            <tr>
                                <td>Código:</td>
                                <td>Status:</td>
                            </tr>
                            <tr>
                                <td><label for="code"></label>
                                    <input type="text" name="code" id="textfield1" value="<?php echo $edit['code']; ?>"/></td>
                                <td><label for="status"></label>
                                    <input type="text" name="status" id="textfield20" value="<?php echo $edit['status']; ?>"/></td> 
                            </tr>
                            <tr>
                                <td>Nome:</td>
                                <td>CPF:</td>
                                <td>RG:</td>
                            </tr>
                            <tr>   
                                <td><label for="nome"></label>
                                    <input type="text" name="nome" id="textfield2" value="<?php echo $edit['nome']; ?>"/></td>
                                <td><label for="cpf"></label>
                                    <input type="text" name="cpf" id="textfield3" value="<?php echo $edit['cpf']; ?>"/></td>
                                <td><label for="rg"></label>
                                    <input type="text" name="rg" id="textfield4" value="<?php echo $edit['rg']; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Naturalidade:</td>
                                <td>Estado de Nascimento:</td>
                                <td>Sexo:</td> 
                            </tr>
                            <tr>
                                <td><label for="naturalidade"></label>
                                <input type="text" name="naturalidade" value="<?php echo $edit['naturalidade']; ?>"/></td>
                                <td><label for="natural_uf"></label>
                                    <select name="natural_uf" id="natural_uf">
                                        <option value="<?php echo $edit['natural_uf']; ?>"><?php echo $edit['natural_uf']; ?></option>
                                        <option></option>                                        
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
                                <td><label for="sexo"></label>
                                    <select name="sexo" id="sexo">
                                        <option value="<?php echo $edit['sexo']; ?>"><?php echo $edit['sexo']; ?></option>
                                        <option></option>                                        
                                        <option value="F">Feminino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Data de nascimento:</td>
                                <td>Nome da mãe:</td>
                                <td>Nome do Pai:</td>
                            </tr>
                            <tr>
                                <td><label for="nascimento"></label>
                                    <input type="text" name="nascimento" id="textfield5" value="<?php echo $edit['nascimento']; ?>"/></td>
                                <td><label for="select"></label>
                                    <input type="text" name="mae" id="textfield6" value="<?php echo $edit['mae']; ?>"/></td>
                                <td><input type="text" name="pai" id="textfield7" value="<?php echo $edit['pai']; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>Cidade:</td>
                                <td>Bairro:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="estado" id="textfield8" value="<?php echo $edit['estado']; ?>"/></td>
                                <td><input type="text" name="cidade" id="textfield9" value="<?php echo $edit['cidade']; ?>"/></td>
                                <td><input type="text" name="bairro" id="textfield10" value="<?php echo $edit['bairro']; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Endereço:</td>
                                <td>Complemento:</td>
                                <td>Cep:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="endereco" id="textfield11" value="<?php echo $edit['endereco']; ?>"/></td>
                                <td><input type="text" name="complemento" id="textfield12" value="<?php echo $edit['complemento']; ?>"/></td>
                                <td><input type="text" name="cep" id="textfield13" value="<?php echo $edit['cep']; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Telefone residencial:</td>
                                <td>Telefone Celular:</td>
                                <td>Telefone de um amigo:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="tel_residencial" id="textfield14" value="<?php echo $edit['tel_residencial']; ?>"/></td>
                                <td><input type="text" name="celular" id="textfield15" value="<?php echo $edit['celular']; ?>"/></td>
                                <td><input type="text" name="tel_amigo" id="textfield16" value="<?php echo $edit['tel_amigo']; ?>"/></td>
                            </tr>
                            <tr>
                                <td width="350">Série que este aluno vai se matricular:</td>
                                <td width="332">Turno:</td>
                                <td width="204">Cuidado Especial</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="serie" id="serie">
                                        <option value="<?php echo $edit['serie']; ?>"><?php echo $edit['serie']; ?></option>
                                        <option></option>
                                        <?php
                                        $sql_4 = "SELECT * FROM cursos";
                                        $sql_4 = $pdo->query($sql_4);
                                        foreach ($sql_4 as $res_1) :
                                            ?>
                                            <option value="<?php echo $res_1['curso']; ?>"><?php echo $res_1['curso']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><label for="turno"></label>
                                    <select name="turno" size="1" id="turno">
                                        <option value="<?php echo $edit['turno']; ?>"><?php echo $edit['turno']; ?></option>
                                        <option></option>
                                        <option value="Manha">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noite">Noite</option>
                                    </select>
                                </td>
                                <td><label for="atendimento_especial"></label>
                                    <select name="atendimento_especial" size="1" id="atendimento_especial">
                                        <option value="<?php echo $edit['atendimento_especial']; ?>"><?php echo $edit['atendimento_especial']; ?></option>
                                        <option></option>
                                        <option value="SIM">SIM</option>
                                        <option value="NAO">NÃO</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Valor da mensalidade:</td>
                                <td>Data de vencimento:</td>
                                <td>Telefone de cobrança:</td>
                            </tr>
                            <tr>
                                <td><label for="mensalidade"></label>
                                    <input type="text" name="mensalidade" id="mensalidade" value="<?php echo $edit['mensalidade']; ?>"/></td>
                                <td><label for="vencimento"></label>
                                    <input type="text" name="vencimento" id="vencimento" value="<?php echo $edit['vencimento']; ?>"/></td>
                                <td><label for="tel_cobranca"></label>
                                    <input type="text" name="tel_cobranca" id="tel_cobranca" value="<?php echo $edit['tel_cobranca']; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Observações para este(a) aluno(a)</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3"><label for="obs"></label>
                                    <textarea name="obs" id="obs" cols="45" rows="5"> 
                                        <?php echo trim($edit['obs']); ?>
                                    </textarea></td>
                            </tr>
                            <tr>
                                <td><input class="input" type="submit" name="button" id="button" value="Finalizar"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <br />
                        <br />
                    </form>     

                    <?php
                }
                ?>
            </div><!-- box_estudantes -->
        <?php } // Aqui fecha o PG todos
        ?>



        <!--Cadastro dos Estudantes - Etapa 1 -->
        <?php if (@$_GET['pg'] == 'cadastra') { ?>
            <?php if (@$_GET['bloco'] == '1') { ?>
                <div id="cadastra_estudante">
                    <h1>1&ordm; Passo - Cadastre os dados pessoais</h1>
                    <?php
                    if (isset($_POST['button'])) {
                        $code = $_POST['code'];
                        $nome = $_POST['nome'];
                        $cpf = $_POST['cpf'];
                        $rg = $_POST['rg'];
                        $naturalidade = $_POST['naturalidade'];
                        $natural_uf = $_POST['natural_uf'];
                        $sexo = $_POST['sexo'];
                        $nascimento = $_POST['nascimento'];
                        $mae = $_POST['mae'];
                        $pai = $_POST['pai'];
                        $estado = $_POST['estado'];
                        $cidade = $_POST['cidade'];
                        $bairro = $_POST['bairro'];
                        $endereco = $_POST['endereco'];
                        $complemento = $_POST['complemento'];
                        $tel_residencial = $_POST['tel_residencial'];
                        $cep = $_POST['cep'];
                        $celular = $_POST['celular'];
                        $tel_amigo = $_POST['tel_amigo'];


                        $sql_2 = "INSERT INTO estudantes (code, status, nome, cpf, rg, naturalidade, natural_uf, sexo, nascimento, mae, pai, estado, cidade, bairro, endereco, complemento, cep, tel_residencial, celular, tel_amigo, serie, turno, atendimento_especial, mensalidade, vencimento, tel_cobranca, obs) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$rg', '$naturalidade', '$natural_uf', '$sexo', '$nascimento', '$mae', '$pai', '$estado', '$cidade', '$bairro', '$endereco', '$complemento', '$cep', '$tel_residencial', '$celular', '$tel_amigo',"
                                . "'','','','','','','')";

                        $sql_login = "INSERT INTO login (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'Aluno')";
                        
                        $data = date('d/m/Y H:i:s');
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $sql_4 = "INSERT INTO logsistema (datalog, tipo, usuario, iplocal, servico) VALUES ('$data', 'INC', '$user', '$ip', 'Inclusao de estudante com o id = $code')";
                        $sql_4 = $pdo->query($sql_4);
                    
                        $sql_2 = $pdo->query($sql_2);
                        $sql_login = $pdo->query($sql_login);
                        echo "<script language='javascript'>window.alert('Dados cadastrados com sucesso! Click em OK para avançar');window.location='estudantes.php?pg=cadastra&bloco=2&code=$code';</script>";
                    }
                    ?>

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td></td>
                                <td colspan="2"><strong>Foi criado um código único para este aluno</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <?php
                                $sql_1 = "SELECT * FROM estudantes ORDER BY id DESC LIMIT 1";
                                $sql_1 = $pdo->query($sql_1);
                                if ($sql_1->rowCount() == '') {
                                    $novo_code = "587418";
                                    ?>
                                    <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                                    <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />    
                                    <?php
                                } else {

                                    foreach ($sql_1 as $res_1):
                                        $novo_code = $res_1['code'] + 741 + $res_1['id'];
                                        ?>
                                        <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                                        <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                                        <?php
                                    endforeach;
                                }
                                ?>
                                <td></td>
                            </tr>    
                            <tr>
                                <td>Nome:</td>
                                <td>CPF:</td>
                                <td>RG:</td>
                            </tr>
                            <tr>
                                <td><label for="celular"></label>
                                    <input type="text" name="nome" id="textfield2"></td>
                                <td><label for="tel_amigo"></label>
                                    <input type="text" name="cpf" id="textfield3"></td>
                                <td><label for="tel_amigo"></label>
                                    <input type="text" name="rg" id="textfield3"></td>
                            </tr>
                            <tr>
                                <td>Naturalidade:</td>
                                <td>Estado de Nascimento:</td>
                                <td>Sexo:</td>
                            </tr>
                            <tr>
                                <td><label for="naturalidade"></label>
                                <input type="text" name="naturalidade" id="textfiel17"</td>
                                <td><label for="natural_uf"></label>
                                    <select name="natural_uf">
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
                                <td><label for="sexo"></label>
                                    <select name="sexo">
                                        <option value="F">Feminino</option>
                                        <option value="M">Masculino</option>
                                    </select>  
                                </td>
                            </tr>
                            <tr>
                                <td>Data de nascimento:</td>
                                <td>Nome da mãe:</td>
                                <td>Nome do Pai:</td>
                            </tr>
                            <tr>
                                <td><label for="nascimento"></label>
                                    <input type="text" name="nascimento" id="textfield4"></td>
                                <td><label for="select"></label>
                                    <input type="text" name="mae" id="textfield12"></td>
                                <td><input type="text" name="pai" id="textfield5"></td>
                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>Cidade:</td>
                                <td>Bairro:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="estado" id="textfield6"></td>
                                <td><input type="text" name="cidade" id="textfield7"></td>
                                <td><input type="text" name="bairro" id="textfield8"></td>
                            </tr>
                            <tr>
                                <td>Endereço:</td>
                                <td>Complemento:</td>
                                <td>Cep:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="endereco" id="textfield8"></td>
                                <td><input type="text" name="complemento" id="textfield8"></td>
                                <td><input type="text" name="cep" id="textfield8"></td>
                            </tr>
                            <tr>
                                <td>Telefone residencial:</td>
                                <td>Telefone Celular:</td>
                                <td>Telefone de um amigo:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="tel_residencial" id="textfield9"></td>
                                <td><input type="text" name="celular" id="textfield10"></td>
                                <td><input type="text" name="tel_amigo" id="textfield11"></td>
                            </tr>
                            <tr>
                                <td><input class="input" type="submit" name="button" id="button" value="Avançar"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                    <br /> 

                </div><!-- cadastra_estudante -->

            <?php } // aqui fecha o bloco 1    ?>

            <!--Cadastro dos estudantes - Etapa 2 -->
            <?php if (@$_GET['bloco'] == '2') { ?>
                <div id="cadastra_estudante">
                    <h1>2&ordm; Passo - finalizar preenchimento de dados</h1>
                    <?php
                    if (isset($_POST['button'])) {
                        $code = $_GET['code'];
                        $serie = $_POST['serie'];
                        $turno = $_POST['turno'];
                        $atendimento_especial = $_POST['atendimento_especial'];
                        $mensalidade = $_POST['mensalidade'];
                        $vencimento = $_POST['vencimento'];
                        $tel_cobranca = $_POST['tel_cobranca'];
                        $obs = trim($_POST['obs']);

                        $sql_3 = "UPDATE estudantes SET serie = '$serie', turno = '$turno', atendimento_especial = '$atendimento_especial', mensalidade = '$mensalidade', vencimento = '$vencimento', tel_cobranca = '$tel_cobranca', obs = '$obs' WHERE code = '$code'";
                        $sql_3 = $pdo->query($sql_3);

                        $d = date("d");
                        $m = date('m');
                        $a = date('Y');
                        $code_cobranca = $code * 2;

                        $sql_mensal = "INSERT INTO mensalidades (code, matricula, d_cobranca, vencimento, valor, status, dia, mes, ano, dia_pagamento, data_pagamento, d_p, m_p, a_p, metodo_pagamento) VALUES ('$code_cobranca', '$code', '$d/$m/$a', '$vencimento/$m/$a', '$mensalidade', 'Aguarda Pagamento', '$d', '$m', '$a',"
                                . "'','','','','','')";
                        $sql_mensal = $pdo->query($sql_mensal);

                        echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&bloco=3';</script>";
                    }
                    ?>
                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="350">Série que este aluno vai se matricular:</td>
                                <td width="332">Turno:</td>
                                <td width="204">Cuidado Especial</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="serie" id="serie">
                                        <?php
                                        $sql_4 = "SELECT * FROM cursos";
                                        $sql_4 = $pdo->query($sql_4);

                                        foreach ($sql_4 as $res_1):
                                            ?>  
                                            <option value="<?php echo $res_1['curso']; ?>"><?php echo $res_1['curso']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><label for="turno"></label>
                                    <select name="turno" size="1" id="turno">
                                        <option value="Manha">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noite">Noite</option>
                                    </select></td>
                                <td><label for="atendimento_especial"></label>
                                    <select name="atendimento_especial" size="1" id="cuidado_especial">
                                        <option value="SIM">SIM</option>
                                        <option value="NAO">NÃO</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Valor da mensalidade:</td>
                                <td>Data de vencimento:</td>
                                <td>Telefone de cobrança:</td>
                            </tr>
                            <tr>
                                <td><label for="mensalidade"></label>
                                    <input type="text" name="mensalidade" id="mensalidade"/></td>
                                <td><label for="vencimento"></label>
                                    <input type="text" name="vencimento" id="vencimento"/></td>
                                <td><label for="tel_cobranca"></label>
                                    <input type="text" name="tel_cobranca" id="tel_cobranca"/></td>
                            </tr>
                            <tr>
                                <td>Observações para este(a) aluno(a)</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3"><label for="obs"></label>
                                    <textarea name="obs" id="obs" cols="45" rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="input" type="submit" name="button" id="button" value="Finalizar"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                    <br />
                </div>
            <?php } //fecha bloco 2  ?> 

            <?php if (@$_GET['bloco'] == '3') { ?>
                <div id="cadastra_estudante">
                    <h1>3º Passo - Mensagem de confirmação</h1>
                    <table>
                        <tr>
                            <td>
                                <h4>Este(a) Estudante foi cadastrado perfeitamente no sistema!
                                    <ul>
                                        <li>Mensalmente será gerado a cobrança no valor informado!</li>
                                        <li>Este estudante já tem acesso ao sistema usando seu código e seu CPF como senha!</li>
                                    </ul>
                                    <a href="estudantes.php?pg=todos">Clique aqui para voltar para página inicial</a>
                                </h4>
                            </td>
                        </tr>
                    </table>
                    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                </div><!-- cadastra_estudante -->
            <?php } // aqui fecha bloco 3  ?>
        <?php } // aqui fecha a PG cadastra ?>
        <?php require "rodape.php"; ?>
    </body>
</html>
