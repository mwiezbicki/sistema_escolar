<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="../css/relatorios.css" rel="stylesheet" type="text/css"/>

<title>Administração</title>
</head>

<body>
<?php require "topo.php"; ?>
<div id="caixa_preta">
    
</div><!-- caixa_preta -->

<div id="box">
    <?php if(@$_GET['tipo'] == 'alunos'){ ?>
    <h1>Relatório de Alunos</h1>
        <?php if(isset($_POST['button'])){
            $tipo = $_POST['tipo'];
            $serie = $_POST['serie'];
            
            $s = base64_encode("SELECT * FROM estudantes WHERE status = '$tipo' AND serie = '$serie'");

            echo "<script language='javascript'>window.location='relatorios.php?tipo=alunos&s=$s';</script>";
        }?>
        <form name="button" method="post" action="" enctype="multipart/form-data">
            <table width="950" border="0">
                <tr>
                    <td width="267"><strong>Status</strong></td>
                    <td width="248"><strong>Série</strong></td>
                    <td width="180">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select name="tipo" size="1" id="select">
                            <option value="Ativo">Alunos Ativos</option>
                            <option value="Inativo">Alunos Inativos</option>
                        </select>
                    </td>
                    <td>
                        <select name="serie" id="select2">
                        <?php
                            $sql_2 = "SELECT * FROM cursos";
                            $sql_2 = $pdo->query($sql_2);
                            foreach ($sql_2 as $res_2):                           
                            ?>
                            <option value="<?php echo $res_2['curso']; ?>"><?php echo $res_2['curso']; ?></option>      
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
                </tr>
            </table>
        </form>
        <?php 
        $s = base64_decode($_GET['s']);
        $sql_1 = $pdo->query($s);
        if($sql_1->rowCount() == ''){
            echo "Não existe resultados para o filtro selecionado";
        }else{
            ?>
            <table width="950" border="0">
              <tr>
                <td width="200"><strong>Nome:</strong></td>
                <td width="130"><strong>Nº de matricula:</strong></td>
                <td width="155"><strong>Série:</strong></td>
                <td width="194"><strong>Mensalidades pagas:</strong></td>
                <td width="149"><strong>Mensalidade devedoras:</strong></td>
              </tr>
              <?php 
              foreach($sql_1 as $res_1): ?>
              <tr>
                <td><?php echo $res_1['nome']; ?></td>
                <td><?php echo $res_1['code']; ?></td>
                <td><?php echo $res_1['serie']; ?></td>
                <td><?php $sql_2 = "SELECT * FROM mensalidades WHERE matricula = ".$res_1['code']." AND status = 'Pagamento Confirmado'";
                          $sql_2 = $pdo->query($sql_2);
                          echo $sql_2->rowCount();
                    ?>
                </td>
                <td><?php $sql_3 = "SELECT * FROM mensalidades WHERE matricula = ".$res_1['code']." AND status = 'Aguarda Pagamento'";
                          $sql_3 = $pdo->query($sql_3);
                          echo $sql_3->rowCount();
                    ?>
                </td>
              </tr>
              <tr>
                <td colspan="5"><hr></td>
              </tr>
              <?php endforeach; ?>
              <tr>
               <td align="center" colspan="5"><a target="_blank" href="../relatorios/relatorio_estudantes.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa do aluno</a></td>
              </tr>
            </table>
        <?php } ?>
    <?php } ?>
    
    <?php if(@$_GET['tipo'] == 'aniversariantes'){ ?>
    <h1>Relatório de Alunos Aniversariantes</h1>
        <?php
        $s = base64_decode($_GET['s']);
        $sql_1 = $pdo->query($s);
        if($sql_1->rowCount() == ''){
            echo "Não existe resultados para o filtro selecionado";
        }else{
            ?>
            <table width="950" border="0">
              <tr>
                <td width="200"><strong>Nome:</strong></td>
                <td width="130"><strong>Nº de matricula:</strong></td>
                <td width="155"><strong>Série:</strong></td>
                <td width="194"><strong>Data de Aniversário:</strong></td>
              </tr>
              <?php 
              foreach($sql_1 as $res_1): ?>
              <tr>
              <?php    
                    $data = $res_1['nascimento']; 
                    $aniver = explode("/", $data);
                    $d = date('d');
                    $m = date('m');
                    if(($aniver[0] == $d) && ($aniver[1] == $m)){ ?>
                        <td><?php echo $res_1['nome']; ?></td>
                        <td><?php echo $res_1['code']; ?></td>
                        <td><?php echo $res_1['serie']; ?></td>
                        <td><?php echo $res_1['nascimento']; ?></td>
                        <td><?php echo "***Feliz Aniversario***"; ?></td>
                    <?php } ?>    
              </tr>
              <tr>
                <td colspan="5"></td>
              </tr>
              <?php endforeach; ?>
              <tr>
               <td align="center" colspan="5"><a target="_blank" href="alunos_pg_aniversario.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa do aluno</a></td>
              </tr>
            </table>
        <?php } ?>
    <?php } ?>
    
    <?php if(@$_GET['tipo'] == 'professores'){ ?>
    <h1>Relatório de professores</h1>
        <?php if(isset($_POST['button'])){
            $tipo = $_POST['tipo'];
            $serie = $_POST['serie'];
            
            $sql_3 = "SELECT * FROM professores WHERE status = '$tipo'";
            $sql_3 = $pdo->query($sql_3);
            if($sql_3->rowCount() == ''){
                echo "Não existe resultado para o filtro selecionado!";
                die;
                //echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=$s';</script>";
            }else{
                foreach ($sql_3 as $res_3):
                    $s = base64_encode("SELECT * FROM disciplinas WHERE curso = '$serie'");
                    echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=$s';</script>";
                endforeach;
            }
        }?>
        <form name="button" method="post" action="" enctype="multipart/form-data">
            <table width="950" border="0">
                <tr>
                  <td width="330"><strong>Status</strong></td>
                  <td width="151"><strong>Curso:</strong></td>
                  <td width="244">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select name="tipo" size="1" id="select">
                            <option value="Ativo">Professores Ativos</option>
                            <option value="Inativo">Professores Inativos</option>
                        </select>
                    </td>
                    <td>
                        <select name="serie" id="serie">
                        <?php
                        $sql_2 = "SELECT distinct(curso) FROM disciplinas";
                        $sql_2 = $pdo->query($sql_2);
                        foreach ($sql_2 as $res_2):
                            ?>
                            <option value="<?php echo $res_2['curso']; ?>"><?php echo $res_2['curso']; ?></option>
                        <?php 
                        endforeach; ?>
                        </select>
                    </td>
                    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"/></td>
                </tr>
            </table>
        </form>
    <?php
    $s = base64_decode($_GET['s']);
    $sql_1 = $pdo->query($s);
    if($sql_1->rowCount() == ''){
        echo "Não existe resultado para o filtro selecionado!";
    }else{
        ?>
        <table width="950" border="0">
            <tr>
              <td width="200"><strong>Disciplina/Curso:</strong></td>
              <td width="70"><strong>Código:</strong></td>
              <td width="150"><strong>Nome</strong></td>
              <td width="180"><strong>Formação:</strong></td>
              <td width="105"><strong>Salário:</strong></td>
            </tr>
            <?php foreach($sql_1 as $res_1): ?>
            <tr>
                <td><?php
                    echo $res_1['disciplina']; 
                    echo " - ";
                    echo $res_1['curso'];
                    ?>
                </td> 
                <td><?php echo $prof = $res_1['professor']; ?></td>
                <td><?php
                    $sql_3 = "SELECT * FROM professores WHERE code = $prof";
                    $sql_3 = $pdo->query($sql_3);
                    foreach ($sql_3 as $res_extra):
                    ?>
                    <?php echo $res_extra['nome']; ?>
                </td>
                <td><?php echo $res_extra['formacao']; ?>/<?php echo $res_extra['graduacao']; ?></td>
                <td>R$ <?php echo number_format($res_extra['salario'],2); ?></td>
            </tr>    
            <?php endforeach; ?>
            <tr>
                <td colspan='6'><hr></td>
            </tr>
            <?php
            endforeach; ?>
            <tr>
                <td align="center" colspan="6"><a target="_blank" href="professores_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa</a></td>
            </tr>
        </table>
    <?php
    }
    ?>
<?php } ?>
</div>
</body>
</html>