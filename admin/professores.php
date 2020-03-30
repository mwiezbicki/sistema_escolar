<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Professores</title>
        <link href="../css/professores.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        require 'topo.php';
        require '../config.php';
        ?>

        <div id="caixa_preta">
        </div>
        
        <!-- Exibir professores cadastrados -->
        <?php if(@$_GET['pg'] == 'todos') { ?>
        <div id="box_professores">
            <br/><br/>
            <a class="a2" href="professores.php?pg=cadastra">Cadastrar Professor</a>
            <br/><br/><br/>
            <hr/>
            <h1>Professores</h1>
            <?php
            $sql = "SELECT * FROM professores WHERE nome != ''";
            $sql = $pdo->query($sql);
            $sql->execute();
            
            if($sql->rowCount() <= 0) {
                echo "<h2>No momento não existe professores cadastrados!</h2>";
            } else {
                ?>
            <table width="900" border="0">
                <tr>
                    <td><strong>Código:</strong></td>
                    <td><strong>Nome:</strong></td>
                    <td><strong>N. Disciplina(s):</strong></td>
                    <td><strong>Remuneração:</strong></td>
                    <td><strong>Status</strong></td>
                    <td></td>
                </tr>
                <?php foreach ($sql as $prof): ?>
                <tr>
                    <td><h3><?php echo $code = $prof['code']; ?></h3></td>
                    <td><h3><?php echo $prof['nome']; ?></h3></td>
                    <td><h3><?php
                        $sql_qt = "SELECT count(*) as c FROM disciplinas WHERE professor = '$code'";
                        $sql_qt = $pdo->query($sql_qt);
                        $sql_qt->execute();
                        
                        $total = $sql_qt->fetch();
                        echo $total['c'];
                       ?></h3></td>
                    <td><h3>R$ <?php echo $prof['salario']; ?></h3></td>
                    <td><h3><?php echo $prof['status']; ?></h3></td>
                    <td></td>
                    <td><a class="a" href="professores.php?pg=todos&func=delete&id=<?php echo $prof['id']; ?>">
                            <img title="Excluir Professor" src="../img/deleta.jpg" width="18" height="18" border="0"/></a>
                        <?php if($prof['status'] == 'Inativo') { ?>
                        <a class="a" href="professores.php?pg=todos&func=ativa&id=<?php echo $prof['id']; ?>&code=<?php echo $prof['code']; ?>">
                            <img title="Ativar novamente Professor" src="../img/correto.jpg" width="20" height="20" border="0"/></a>
                        <?php }?>
                        <?php if($prof['status'] == 'Ativo') { ?>
                        <a class="a" href="professores.php?pg=todos&func=inativa&id=<?php echo $prof['id']; ?>&code=<?php echo $prof['code']; ?>">
                            <img title="Inativar o Professor" src="../img/ico_bloqueado.png" width="18" height="18" border="0"/></a>
                        <?php }?>
                        <a class="a" href="professores.php?pg=todos&func=edita&id=<?php echo $prof['id'];?>"><img title="Editar Dados Cadastrais" src="../img/ico-editar.png"
                                                                                                                  width="18" height="18" border="0"/></a>
                        <a class="a" rel="superbox[iframe][930x500]" href="historico_professor.php?id=<?php echo $prof['id']; ?>"><img title="Historico desde Professor"
                                                                                                                                       src="../img/visualizar16.gif" width="18" height="18" border="0"/></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php
            }
            ?>
            <br/>
            <!--Deletar Professor -->
            <?php if(@$_GET['func'] == 'delete') {
                $id = $_GET['id'];
                
                $sql_del = "DELETE FROM professores WHERE id = '$id'";
                $sql_del = $pdo->query($sql_del);
                $sql_del->execute();
                
                echo "<script language='javascript'>window.location='professores.php?pg=todos';</script>";
                
            }?>
            
            <!--Ativar o Professor -->
            <?php if(@$_GET['func'] == 'ativa') {
                $id = $_GET['id'];
                $code = $_GET['code'];
                
                $sql_edit1 = "UPDATE professores SET status = 'Ativo' WHERE id = '$id'";
                $sql_edit2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
                $sql_edit1 = $pdo->query($sql_edit1);
                $sql_edit2 = $pdo->query($sql_edit2);
                $sql_edit1->execute();
                $sql_edit2->execute();
                
                 echo "<script language='javascript'>window.location='professores.php?pg=todos';</script>";
            }?>
            
            <!--Ativar o Professor -->
            <?php if(@$_GET['func'] == 'inativa') {
                $id = $_GET['id'];
                $code = $_GET['code'];
                
                $sql_edit3 = "UPDATE professores SET status = 'Inativo' WHERE id = '$id'";
                $sql_edit4 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
                $sql_edit3 = $pdo->query($sql_edit3);
                $sql_edit4 = $pdo->query($sql_edit4);
                $sql_edit3->execute();
                $sql_edit4->execute();
                
                 echo "<script language='javascript'>window.location='professores.php?pg=todos';</script>";
            }?>
            
            <!--Editar Professor -->
            <?php if(@$_GET['func'] == 'edita') { ?>
            <hr/>
            <h1>Editar Professor</h1>
            <?php 
            $id = $_GET['id'];
            $sql_prof = "SELECT * FROM professores WHERE id = '$id'";
            $sql_prof = $pdo->query($sql_prof);
            $sql_prof->execute();
            ?>
            
            <?php
            
                if(isset($_POST['button'])) {
                    $id = $_GET['id'];
                    $nome = $_POST['nome'];
                    $cpf = $_POST['cpf'];
                    $nascimento = $_POST['nascimento'];
                    $formacao = $_POST['formacao'];
                    $graduacao = $_POST['graduacao'];
                    $pos_graduacao = $_POST['pos_graduacao'];
                    $mestrado = $_POST['mestrado'];
                    $doutorado = $_POST['doutorado'];
                    $salario = $_POST['salario'];
                    
                    $sql_edi_pro = "UPDATE professores SET nome = :nome, cpf = :cpf, nascimento = :nascimento, formacao = :formacao,"
                            . "graduacao = :graduacao, pos_graduacao = :pos_graduacao, mestrado = :mestrado, doutorado = :doutorado,"
                            . "salario = :salario WHERE id = :id";
                    $sql_edi_pro = $pdo->prepare($sql_edi_pro);
                    $sql_edi_pro->bindValue(":nome", $nome);
                    $sql_edi_pro->bindValue(":cpf",$cpf);
                    $sql_edi_pro->bindValue(":nascimento", $nascimento);
                    $sql_edi_pro->bindValue(":formacao", $formacao);
                    $sql_edi_pro->bindValue(":graduacao", $graduacao);
                    $sql_edi_pro->bindValue(":pos_graduacao", $pos_graduacao);
                    $sql_edi_pro->bindValue(":mestrado", $mestrado);
                    $sql_edi_pro->bindValue(":doutorado", $doutorado);
                    $sql_edi_pro->bindValue(":salario", $salario);
                    $sql_edi_pro->bindValue(":id", $id);
                    $sql_edi_pro->execute();
 
                    if($sql_edi_pro->rowCount() <= 0){
                        echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";    
                    } else {
                        echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='professores.php?pg=todos';</script>";
                    }
                } ?>
                <form name="form1" method="POST" action="" enctype="multipart/form-data">
                    <table width="900" border="0">
                    <tr>
                        <td>Nome:</td>
                        <td>CPF:</td>
                        <td>Salário:</td>
                    </tr>
                    <?php
                    foreach($sql_prof as $res):
                    ?>
                    <tr>
                        <td><label for="textfield2"></label>
                        <input type="text" name="nome" id="textfield2" value="<?php echo $res['nome'];?>"/></td>
                        <td><label for="textfield3"></label>
                        <input type="text" name="cpf" id="textfield3" value="<?php echo $res['cpf'];?>"/></td>
                        <td><label for="textfield9"></label>
                        <input type="text" name="salario" id="textfield9" value="<?php echo $res['salario'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Data de Nascimento:</td>
                        <td>Formação Acadêmica</td>
                        <td>Graduação(ões):</td>
                    </tr>
                    <tr>
                        <td><label for="texfield4"></label>
                        <input type="text" name="nascimento" id="textfield4" value="<?php echo $res['nascimento'];?>"/></td>
                        <td><label for="select"></label>
                            <select name="formacao" size="1" id="select">
                                <option value="<?php echo $res['formacao']; ?>"><?php echo $res['formacao']; ?></option>
                                <option value=""></option>
                                <option value="Ensino Medio Incompleto">Ensino Médio Incompleto</option>
                                <option value="Ensino Medio Completo">Ensino Médio Completo</option>
                                <option value="Superior Incompleto">Superior Incompleto</option>
                                <option value="Superior Completo">Superior Completo</option>         
                            </select></td>
                        <td><input type="text" name="graduacao" id="textfield5" value="<?php echo $res['graduacao']; ?>"</td>
                    </tr>
                    <tr>
                        <td>Pos-graduação (ões):</td>
                        <td>Mestrado(s):</td>
                        <td>Doutador (s):</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="pos_graduacao" id="textfield6" value="<?php echo $res['pos_graduacao'];?>"</td> 
                        <td><input type="text" name="mestrado" id="textfield7" value="<?php echo $res['mestrado'];?>"</td>
                        <td><input type="text" name="doutorado" id="textfield8" value="<?php echo $res['doutorado'];?>"</td>
                    </tr>
                        <tr>
                            <td><input class="input" type="submit" name="button" id="button" value="Atualizar"/></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </form>
            <br/>
            <?php
     
            }?>
        </div>
        <?php
        }
        ?>        
        
        <!--Cadastro dos Professores -->
        <?php if(@$_GET['pg'] == 'cadastra') { ?>
        <div id="cadastra_professores">
            <h1>Cadastrar novo Professor</h1>
            <?php if(isset($_POST['button'])){
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
                
                $sql = "INSERT INTO professores SET code = :code, status = :status, nome = :nome, cpf = :cpf, nascimento = :nascimento,"
                        . "formacao = :formacao, graduacao = :graduacao, pos_graduacao = :pos_graduacao, mestrado = :mestrado, doutorado = :doutorado,"
                        . "salario = :salario";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":code", $code);
                $sql->bindValue(":status", 'Ativo');
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":cpf", $cpf);
                $sql->bindValue(":nascimento", $nascimento);
                $sql->bindValue(":formacao", $formacao);
                $sql->bindValue(":graduacao", $graduacao);
                $sql->bindValue(":pos_graduacao", $pos_graduacao);
                $sql->bindValue(":mestrado", $mestrado);
                $sql->bindValue(":doutorado", $doutorado);
                $sql->bindValue(":salario", $salario);
                $sql->execute();
                
                if($sql->rowCount() <= 0){
                    echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar');</script>";
                } else {
                    $sql1 = "INSERT INTO login SET status = :status, code = :code, senha = :senha, nome = :nome, painel = :painel";
                    $sql1 = $pdo->prepare($sql1);
                    $sql1->bindValue(":status", 'Ativo');
                    $sql1->bindValue(":code", $code);
                    $sql1->bindValue(":senha", $cpf);
                    $sql1->bindValue(":nome", $nome);
                    $sql1->bindValue(":painel", 'Professor');
                    $sql1->execute();
                    
                    echo "<script language='javascript'>window.alert('Professor cadastrado com sucesso!');window.location='professores.php?pg=todos';</script>";
                }
            }?>
            <form name="form1" method="POST" action="">
                <table width="900" border="0">
                    <tr>
                        <td>Código:</td>
                        <td>Nome:</td>
                        <td>CPF:</td>
                    </tr>
                    <tr>
                        <td>
                        <?php
                        $sql_2 = "SELECT * FROM professores ORDER BY id DESC LIMIT 1";
                        $sql_2 = $pdo->query($sql_2);
                        $sql_2->execute();
                    
                        if($sql_2->rowCount() <= 0){
                            $new_code = "87415978";
                            ?>
                            <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code; ?>"/>
                            <input type="hidden" name="code" value="<?php echo $new_code; ?>"/>
                        </td>                        
                        <?php
                        } else {
                            foreach($sql_2 as $cad):
                                $new_code = $cad['code']+$cad['id']+741;
                                ?>
                                <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code; ?>"/>
                                <input type="hidden" name="code" value="<?php echo $new_code; ?>"/>
                        </td>   
                        <?php
                            endforeach;
                       }    
                       ?>
                       <td>
                           <input type="text" name="nome" id="textfield2"/>
                       </td>
                       <td>
                           <input type="text" name="cpf" id="textfield3"/>
                       </td>
                    </tr>
                    <tr>
                        <td>Data de Nascimento:</td>
                        <td>Formação Academica:</td>
                        <td>Graduação(ões):</td>
                    </tr>
                    <tr>
                        <td>
                            <label for="textfield4"></label>
                            <input type="text" name="nascimento" id="textfield4"/>
                        </td>
                        <td>
                            <label for="select"></label>
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
                        <td>Pos-Graduação(ões):</td>
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
                    </tr>
                    <tr>
                        <td><input type="text" name="salario" id="textfield9"/></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"/></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </form>
            <br/>
        </div> <!--Aqui fecha o PG cadastra -->
        <?php
        }
        ?>       
       <?php require "rodape.php"; ?>
    </body>
</html>