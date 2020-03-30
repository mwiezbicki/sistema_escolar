<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="../css/relatorios.css" rel="stylesheet" type="text/css"/>

<title>Imprimir</title>
</head>
    <body>
        <script language='javascript'>window.print()</script>
        <div id='box'>
            <?php
            require '../config.php';
            $data_hoje = date('d/m/Y H:i:s');
            $s = base64_decode($_GET['s']);
            $sql_1 = $pdo->query($s);
            ?>
                <table width='950' border='0'>
                    <h2>Sossego da Mamãe - Itajaí/SC - <?php echo $data_hoje; ?></h2>
                    <h1>Relatório de Alunos Cadastrados no Sistema</h1>
        
                    <hr/>
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
                        <td colspan='5'></td>
                    </tr>    
                    <?php endforeach; ?>
                    <tr>
                        <td align="center" colspan="6"><a target="_blank" href="alunos_pg_aniversario.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa</a></td>
                    </tr>
                </table>
        </div>
    </body>
</html>