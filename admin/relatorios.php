<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="../css/relatorios_alu.css" rel="stylesheet" type="text/css"/>

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
            $turno = $_POST['turno'];
            ?>
            <a target="_blank" href="relatorio_estudantes.php?tipo=<?php echo $tipo; ?>&serie=<?php echo $serie;?>&turno=<?php echo $turno;?>"><input type="button" value="Imprimir"/></a>
            <?php
        }?>
        <form name="button" method="post" action="" enctype="multipart/form-data">
            <table width="950" border="0">
                <tr>
                    <td width="250"><strong>Status</strong></td>
                    <td width="250"><strong>Série</strong></td>
                    <td width="250"><strong>Periodo</strong></td>
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
                    <td>
                      <select name="turno" id="select2">
                      <?php
                          $sql_3 = "SELECT * FROM periodos";
                          $sql_3 = $pdo->query($sql_3);
                          foreach ($sql_3 as $res_3):
                          ?>
                          <option value="<?php echo $res_3['periodos']; ?>"><?php echo $res_3['periodos']; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
                </tr>
            </table>
        </form>
    <?php } ?>
</div>
</body>
</html>
