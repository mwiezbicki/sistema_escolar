<?php $painel_atual = "Professor"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <title>Painel do Professor</title>
    </head>

    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">
            
        </div>
        
        <div id="box">
            <div id="relatorios">
                <ul>
                    <h1><strong>Turmas & Alunos</strong></h1>
                    <li><strong>Disciplinas ministradas por você: </strong> 
                        <?php $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code'";
                              $sql_1 = $pdo->query($sql_1);
                              echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Você minista aula para

                    <?php

                        $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
                        $sql_2 = $pdo->query($sql_2);
                        foreach ($sql_2 as $res_1):
                            $curso = $res_1['curso'];
                            $sql_3 = "SELECT * FROM estudantes WHERE serie = '$curso'";
                            $sql_3 = $pdo->query($sql_3);
                        endforeach;
                        echo $sql_3->rowCount();
                        ?>
                    alunos. </strong></li>
                </ul>
                <ul>
                    <h1><strong>Informações de acesso</strong> </h1>
                    <li><strong>Seu código de acesso:</strong> <?php echo $code; ?></li>
                    <li><strong>Senha:</strong>***** <a rel="superbox[iframe][285x100]" href="altera_senha.php?code=<?php echo $code; ?>">Alterar</a></li>
                </ul> 
                <ul>
                    <h1><strong>Suporte Tecnico</strong></h1>
                    <li><strong>Mensagens aguardando resposta:</strong> 
                        <?php $sql_1 = "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Aguarda resposta'";
                        $sql_1 = $pdo->query($sql_1);
                        echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Mensagens respondidas:</strong>
                        <?php $sql_2 = "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Respondida'";
                        $sql_2 = $pdo->query($sql_2);
                        echo $sql_2->rowCount(); ?></li>
                    <li><strong>Todas as mensagens:</strong>  
                        <?php $sql_3 = "SELECT * FROM central_mensagem WHERE receptor = '$code'";
                        $sql_3 = $pdo->query($sql_3);
                        echo $sql_3->rowCount(); ?>
                    </li>
                </ul>    
            </div>
            <div id="notificacoes">
                <h1>Notificações</h1>
                <div id="avisos_notificacoes">
                    <ul>
                        <?php
                        $sql_1 = "SELECT * FROM central_mensagem WHERE receptor = '$code'";
                        $sql_1 = $pdo->query($sql_1);
                        if($sql_1->rowCount() == ''){
                            echo "No momento você não tem mensagens";
                        }else{
                            foreach ($sql_1 as $res_1):
                            ?>
                            <li><h1>Nova Mensagem - <?php echo $res_1['mensagem']; ?></h1></li>
                            <?php endforeach;
                            
                        } ?>
                    </ul>
                </div><!-- avisos_notificacoes -->
            </div><!-- notificacoes -->
        </div>
        <?php require 'rodape.php'; ?>
    </body>
</html>