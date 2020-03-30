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
    <?php if(@$_GET['tipo'] == 'professores'){ ?>
    <h1>Relatório de Professores</h1>
        <?php if(isset($_POST['button'])){
            $tipo = $_POST['tipo'];
            
            ?>
            <a target="_blank" href="relatorio_professores.php?tipo=<?php echo $tipo; ?>"><input type="button" value="Imprimir"/></a>
            <?php    
        }?>
        <form name="button" method="post" action="" enctype="multipart/form-data">
            <table width="950" border="0">
                <tr>
                    <td width="267"><strong>Status</strong></td>
                    <td width="180">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select name="tipo" size="1" id="select">
                            <option value="Ativo">Professores Ativos</option>
                            <option value="Inativo">Professores Inativos</option>
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