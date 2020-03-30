<?php $painel_atual = "tesouraria"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/index_1.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="../img/ico_escola.png" />
<title>Tesouraria</title>

</head>
    <body>
       <?php require "topo.php"; ?> 
        <div id="caixa_preta">
        </div>
        
        <div id="box">
            <?php
            $d = date('d');
            $m = date('m');
            $a = date('Y');
            ?>
            <div id="relatorios">
                <ul>
                    <h1><strong>Situação financeira do caixa (R$) Hoje</strong></h1>
                    <li><strong>Mensalidades pagas em dinheiro:</strong> R$
                    <?php
                    $sql_2 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND metodo_pagamento = 'Dinheiro'";
                    $sql_2 = $pdo->query($sql_2);
                    foreach ($sql_2 as $res_2):
                        echo number_format($res_2['soma'],2);
                    endforeach;
                    ?>
                    </li>
                    <li><strong>Mensalidades pagas em cartão de crédito:</strong> R$
                    <?php
                    $sql_2 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND metodo_pagamento = 'Cartao de credito'";
                    $sql_2 = $pdo->query($sql_2);
                    foreach ($sql_2 as $res_2):
                        echo number_format($res_2['soma'],2);
                    endforeach;
                    ?>
                    </li>
                    <li><strong>Mensalidades pagas em cartão de débito:</strong> R$
                    <?php
                    $sql_2 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND metodo_pagamento = 'Cartao de debito'";
                    $sql_2 = $pdo->query($sql_2);
                    foreach ($sql_2 as $res_2):
                        echo number_format($res_2['soma'],2);
                    endforeach;
                    ?>
                    </li>
                    <li><strong>Mensalidades pagas em cheques:</strong> R$
                    <?php
                    $sql_2 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND metodo_pagamento = 'Cheque'";
                    $sql_2 = $pdo->query($sql_2);
                    foreach ($sql_2 as $res_2):
                        echo number_format($res_2['soma'],2);
                    endforeach;
                    ?>
                    </li>
                </ul>
            </div>
            <div id="notificacoes">
                <h1>Notificações</h1>
                <div id="avisos_notificacoes">
                    <?php
                        $sql_1 = "SELECT * FROM mural_tesouraria ORDER BY id DESC LIMIT 30";
                        $sql_1 = $pdo->query($sql_1);
                        $conta_sql_1 = $sql_1->rowCount();
                        if($conta_sql_1 == ''){
                            echo "<h1>No momento não existe nenhum aviso em seu mural!</h1>";
                        }else{
                            foreach($sql_1 as $res_1):
                            ?>    
                            <ul>
                                <li>
                                    <?php echo $res_1['titulo']; ?>
                                </li>
                            </ul>
                            <?php endforeach;
                        }?>
                </div>
            </div>
        </div>
        <?php require "rodape.php"; ?>
    </body>
</html>    