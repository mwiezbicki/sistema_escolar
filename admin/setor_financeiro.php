<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Setor Financeiro</title>
        <link href="../css/setor_financeiro.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php
        require 'topo.php'; ?>

        <div id="caixa_preta">
        </div>
        <div id='box_aluno'>
            <h1>Setor Financeiro</h1>
            <?php
            $d = date('d');
            $m = date('m');
            $a = date('Y');
            ?>
            <table width='950' border='0'>
                <tr>
                    <td colspan='4'><h2><strong>Relatório de Hoje</strong></h2>
                </tr>
                <tr>
                    <td width='247'><strong>Mensalidades para hoje:</strong></td>
                    <td width='262'><strong>Mensalidades pagas hoje:</strong></td>
                    <td width='269'><strong>Mensalidades que aguardam pagamento:</strong></td>
                    <td width='154'><strong>Valor em Caixa:</strong></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $sql_1 = "SELECT * FROM mensalidades WHERE vencimento = '$d/$m/$a'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_2 = "SELECT * FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado'";
                        $sql_2 = $pdo->query($sql_2);
                        echo $sql_2->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_3 = "SELECT * FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Aguarda Pagamento'";
                        $sql_3 = $pdo->query($sql_3);
                        echo $sql_3->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_4 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo number_format($res_4['soma'],2);
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total pago em dinheiro:</strong></td>
                    <td><strong>Total pago em cartão de débito:</strong></td>
                    <td><strong>Total pago em cartão de crédito:</strong></td>
                    <td><strong>Total pago em cheque:</strong></td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        $sql_5 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Dinheiro'";
                        $sql_5 = $pdo->query($sql_5);
                        echo $sql_5->rowCount();
                        echo " - ";
                        foreach ($sql_5 as $res_5):
                            echo number_format($res_5['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_6 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de débito'";
                        $sql_6 = $pdo->query($sql_6);
                        echo $sql_6->rowCount();
                        echo " - ";
                        foreach ($sql_6 as $res_6):
                            echo number_format($res_6['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_7 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de crédito'";
                        $sql_7 = $pdo->query($sql_7);
                        echo $sql_7->rowCount();
                        echo " - ";
                        foreach ($sql_7 as $res_7):
                            echo number_format($res_7['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_8 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cheque'";
                        $sql_8 = $pdo->query($sql_8);
                        echo $sql_8->rowCount();
                        echo " - ";
                        foreach ($sql_8 as $res_8):
                            echo number_format($res_8['soma'],2);
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan='4'><hr></td>
                </tr>
                <tr>
                    <td colspan='4'><h2><strong>Relatório do mês</strong></h2></td>
                </tr>
                <tr>
                    <td width='247'><strong>Mensalidades do mês:</strong></td>
                    <td width='262'><strong>Mensalidades pagas no mês:</strong></td>
                    <td width='269'><strong>Mensalidades que aguardam pagamento:</strong></td>
                    <td width='154'><strong>Valor em caixa:</strong></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $sql_1 = "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$a'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_2 = "SELECT * FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado'";
                        $sql_2 = $pdo->query($sql_2);
                        echo $sql_2->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_3 = "SELECT * FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Aguarda Pagamento'";
                        $sql_3 = $pdo->query($sql_3);
                        echo $sql_3->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_4 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo number_format($res_4['soma'],2);
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total pago em dinheiro:</strong></td>
                    <td><strong>Total pago em cartão de débito:</strong></td>
                    <td><strong>Total pago em cartão de crédito:</strong></td>
                    <td><strong>Total pago em cheque:</strong></td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        $sql_5 = "SELECT sum(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Dinheiro'";
                        $sql_5 = $pdo->query($sql_5);
                        echo $sql_5->rowCount();
                        echo " - ";
                        foreach ($sql_5 as $res_5):
                            echo number_format($res_5['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_6 = "SELECT sum(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de débito'";
                        $sql_6 = $pdo->query($sql_6);
                        echo $sql_6->rowCount();
                        echo " - ";
                        foreach ($sql_6 as $res_6):
                            echo number_format($res_6['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_7 = "SELECT sum(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de crédito'";
                        $sql_7 = $pdo->query($sql_7);
                        echo $sql_7->rowCount();
                        echo " - ";
                        foreach ($sql_7 as $res_7):
                            echo number_format($res_7['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_8 = "SELECT sum(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cheque'";
                        $sql_8 = $pdo->query($sql_8);
                        echo $sql_8->rowCount();
                        echo " - ";
                        foreach ($sql_8 as $res_8):
                            echo number_format($res_8['soma'],2);
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan='4'><hr></td>
                </tr>
                <tr>
                    <td colspan='4'><h2><strong>Relatório do ano</strong></h2></td>
                </tr>
                <tr>
                    <td width='247'><strong>Mensalidades do ano:</strong></td>
                    <td width='262'><strong>Mensalidades pagas no ano:</strong></td>
                    <td width='269'><strong>Mensalidades que aguardam pagamento:</strong></td>
                    <td width='154'><strong>Valor em caixa:</strong></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $sql_1 = "SELECT * FROM mensalidades WHERE ano = '$a'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_2 = "SELECT * FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado'";
                        $sql_2 = $pdo->query($sql_2);
                        echo $sql_2->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_3 = "SELECT * FROM mensalidades WHERE a_p = '$a' AND status = 'Aguarda Pagamento'";
                        $sql_3 = $pdo->query($sql_3);
                        echo $sql_3->rowCount();
                        ?>
                    </td>
                    <td>
                        <?php
                        $sql_4 = "SELECT sum(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo number_format($res_4['soma'],2);
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total pago em dinheiro:</strong></td>
                    <td><strong>Total pago em cartão de débito:</strong></td>
                    <td><strong>Total pago em cartão de crédito:</strong></td>
                    <td><strong>Total pago em cheque:</strong></td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        $sql_5 = "SELECT sum(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Dinheiro'";
                        $sql_5 = $pdo->query($sql_5);
                        echo $sql_5->rowCount();
                        echo " - ";
                        foreach ($sql_5 as $res_5):
                            echo number_format($res_5['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_6 = "SELECT sum(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de débito'";
                        $sql_6 = $pdo->query($sql_6);
                        echo $sql_6->rowCount();
                        echo " - ";
                        foreach ($sql_6 as $res_6):
                            echo number_format($res_6['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_7 = "SELECT sum(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de crédito'";
                        $sql_7 = $pdo->query($sql_7);
                        echo $sql_7->rowCount();
                        echo " - ";
                        foreach ($sql_7 as $res_7):
                            echo number_format($res_7['soma'],2);
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $sql_8 = "SELECT sum(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cheque'";
                        $sql_8 = $pdo->query($sql_8);
                        echo $sql_8->rowCount();
                        echo " - ";
                        foreach ($sql_8 as $res_8):
                            echo number_format($res_8['soma'],2);
                        endforeach;
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php require 'rodape.php'; ?>
    </body>
</html>