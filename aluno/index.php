<?php $painel_atual="Aluno"; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Painél do Aluno</title>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/ico_escola.png" />
    </head>

    <body>
        <?php require "topo.php"; ?>
        <div id="caixa_preta">
            
        </div>
        <div id="box">
            <div id="relatorios">
                <ul>
                    <h1><strong>Frequência Escolar</strong></h1>
                    <li><strong>Presenças:</strong>
                        <?php $sql_1 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$code' AND presente = 'SIM'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Faltas Justificadas:</strong>
                        <?php $sql_1 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$code' AND presente = 'JUSTIFICADA'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Faltas não justificadas:</strong>
                        <?php $sql_1 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$code' AND presente = 'NAO'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                </ul>
                <ul>
                    <h1><strong>Setor Financeiro</strong></h1>
                    <li><strong>Pagamento(s) confirmado(s):</strong>
                        <?php $sql_1 = "SELECT * FROM mensalidades WHERE matricula = '$code' AND status = 'Pagamento Confirmado'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Cobrança ainda não quitada(s):</strong>
                        <?php $sql_1 = "SELECT * FROM mensalidades WHERE matricula = '$code' AND status = 'Aguarda Pagamento'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                </ul>
                <ul>
                    <h1><strong>Suporte Técnico</strong></h1>
                    <li><strong>Caixa de Entrada:</strong>
                        <?php $sql_1 = "SELECT * FROM central_mensagem WHERE emissor = '$code'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Mensagens ainda não respondidas:</strong>
                        <?php $sql_1 = "SELECT * FROM central_mensagem WHERE emissor = '$code' AND status = 'Aguarda Resposta'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Mensagens respondidas:</strong>
                        <?php $sql_1 = "SELECT * FROM central_mensagem WHERE emissor = '$code' AND status = 'Respondida'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                </ul>           
            </div>
            <div id="notificacoes">
                <h1>Notificações</h1>
                <div id="avisos_notificacoes">
                    <ul>
                        <?php
                        $sql_2 = "SELECT * FROM estudantes WHERE code = ".$code."";
                        $sql_2 = $pdo->query($sql_2);

                        foreach ($sql_2 as $res_2):
                        ?>
                        <li>
                            <?php
                                $data = $res_2['nascimento']; 
                                $aniver = explode("/", $data);
                                $d = date('d');
                                $m = date('m');
                                if(($aniver[0] == $d) && ($aniver[1] == $m)){
                                    echo "<h2>Feliz Aniversario</h2>";
                                }
                            ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul>
                        <?php
                        $sql_1 = "SELECT * FROM mural_aluno WHERE curso = '$serie'";
                        $sql_1 = $pdo->query($sql_1);
                        foreach ($sql_1 as $res_1):
                        ?>
                        <li>
                            <h1><?php echo $res_1['titulo']; ?></h1>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- avisos_notificacoes -->
            </div>
        </div>
        <?php require "rodape.php"; ?>
    </body>
</html>