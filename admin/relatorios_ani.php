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
    <?php if(@$_GET['tipo'] == 'aniversariantes'){ ?>
    <h1>Relatório Aniversariantes</h1>
        <?php if(isset($_POST['button'])){
            $tipo = $_POST['tipo'];
            $mes = $_POST['mes'];
            
            ?>
            <a target="_blank" href="relatorio_aniversario.php?tipo=<?php echo $tipo; ?>&mes=<?php echo $mes;?>"><input type="button" value="Imprimir"/></a>
            <?php    
        }?>
        <form name="button" method="post" action="" enctype="multipart/form-data">
            <table width="950" border="0">
                <tr>
                    <td width="267"><strong>Status</strong></td>
                    <td width="248"><strong>Mes</strong></td>
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
                        <select name="mes" id="select2">
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option> 
                            <option value="03">Marco</option> 
                            <option value="04">Abril</option> 
                            <option value="05">Maio</option> 
                            <option value="06">Junho</option> 
                            <option value="07">Julho</option> 
                            <option value="08">Agosto</option> 
                            <option value="09">Setembro</option> 
                            <option value="10">Outubro</option> 
                            <option value="11">Novembro</option> 
                            <option value="12">Dezembro</option> 
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