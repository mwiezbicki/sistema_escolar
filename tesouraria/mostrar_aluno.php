<?php
$_SESSION['painel_atual'] = "tesouraria";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />

        <title>Tesouraria</title>
        <link href="css/index.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <?php require "topo.php"; ?>
        <div id="caixa_preta">          
        </div>

        <div id="box">
            <h1>N&ordm; da Matricula do Aluno - <?php echo $matricula = $_GET['matricula']; ?></h1>
            <?php
            $sql_1 = "SELECT * FROM estudantes WHERE code = '$matricula'";
            $sql_1 = $pdo->query($sql_1);
            foreach ($sql_1 as $res_1):
                ?>
                <table width="900" border="0">
                    <tr>
                        <td colspan="4"><hr /></td>
                    </tr>
                    <tr>
                        <td width="314"><strong>Nome:</strong></td>
                        <td width="308"><strong>Nascimento</strong></td>
                        <td width="221"><strong>Vencimento:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['nome']; ?></td>
                        <td><?php echo $res_1['nascimento']; ?></td>
                        <td><?php echo $res_1['vencimento']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Valor:</strong></td>
                        <td><strong>Status:</strong></td>
                        <td><strong>CPF:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['mensalidade']; ?></td>
                        <td><?php echo $res_1['status']; ?></td>
                        <td><?php echo $res_1['cpf']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Turno:</strong></td>
                        <td><strong>Telefone de cobrança:</strong></td>
                        <td><strong>Curso:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['turno']; ?></td>
                        <td><?php echo $res_1['tel_cobranca']; ?></td>
                        <td><?php echo $res_1['serie']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr>
                            <h1><strong>Histório de Mensalidade</strong><h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table width="920" border="0">
                              <tr>
                                <td width="130" height="21"><strong>Nº da cobrança:</strong></td>
                                <td width="100"><strong>Vencimento:</strong></td>
                                <td width="80"><strong>Valor:</strong></td>
                                <td width="150"><strong>Status:</strong></td>
                                <td width="170"><strong>Data do pagamento:</strong></td>
                                <td width="154"><strong>Forma de pagamento:</strong></td>
                              </tr>
                              <?php
                              $sql_2 = "SELECT * FROM mensalidades WHERE matricula = '$matricula' ORDER BY id DESC";
                              $sql_2 = $pdo->query($sql_2);
                              foreach ($sql_2 as $res_2):
                              ?>
                                <tr>
                                    <td><?php echo $res_2['code']; ?></td>
                                    <td><?php echo $res_2['vencimento']; ?></td>
                                    <td><?php echo $res_2['valor']; ?></td>
                                    <td><?php echo $res_2['status']; ?></td>
                                    <td><?php echo $res_2['data_pagamento']; ?></td>
                                    <td><?php echo $res_2['metodo_pagamento']; ?></td> 
                                </tr>
                                <tr>
                                    <td colspan="6"><hr>                                  
                                    </td>
                                </tr>    
                              <?php endforeach; ?>
                            </table>    
                        </td>        
                    </tr>
                </table>    
            <?php
            endforeach;
            ?>
        </div>
    </body>
</html>