<?php $painel_atual = "admin"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="../css/index.css" rel="stylesheet" type="text/css"/>
        <title>Painel Administrativo</title>
    </head>

    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">
        </div>
        
        <div id="box">
            <div id="relatorios">
                <?php
                $d = date('d');
                $m = date('m');
                $y = date('Y');
                ?>
                <ul>
                    <h1><strong>Cursos e Disciplinas</strong></h1>
                    <li><strong>Total de Cursos Cadastrados:</strong>
                        <?php $sql_1 = "SELECT * FROM cursos";
                              $sql_1 = $pdo->query($sql_1);
                              echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Total de Disciplinas Cadastradas:</strong>
                        <?php $sql_2 = "SELECT * FROM disciplinas";
                              $sql_2 = $pdo->query($sql_2);
                              echo $sql_2->rowCount(); ?>
                    </li>
                </ul>
                <ul>
                    <h1><strong>Professores</strong></h1>
                    <li><strong>Professores Ativos:</strong>
                        <?php $sql_1 = "SELECT * FROM professores WHERE status = 'Ativo'";
                              $sql_1 = $pdo->query($sql_1);
                              echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Professores Inativos:</strong>
                        <?php $sql_2 = "SELECT * FROM professores WHERE status = 'Inativo'";
                              $sql_2 = $pdo->query($sql_2);
                              echo $sql_2->rowCount(); ?>
                    </li>
                </ul>
                <ul>
                    <h1><strong>Estudantes</strong></h1>
                    <li><strong>Estudantes Ativos:</strong>
                        <?php $sql_1 = "SELECT * FROM estudantes WHERE status = 'Ativo'";
                              $sql_1 = $pdo->query($sql_1);
                              echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Estudantes Inativos:</strong>
                        <?php $sql_2 = "SELECT * FROM estudantes WHERE status = 'Inativo'";
                              $sql_2 = $pdo->query($sql_2);
                              echo $sql_2->rowCount(); ?>
                    </li>
                </ul>
                <ul>
                    <h1><strong>Setor Financeiro</strong></h1>
                    <li><strong>Cobranças geradas este mês:</strong>
                        <?php $sql_1 = "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$y'";
                              $sql_1 = $pdo->query($sql_1);
                              echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Cobranças Pagas:</strong>
                        <?php $sql_2 = "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$y' AND status = 'Pagamento Confirmado'";
                              $sql_2 = $pdo->query($sql_2);
                              echo $sql_2->rowCount(); ?>
                    </li>
                    <li><strong>Cobranças não pagas:</strong>
                        <?php $sql_3 = "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$y' AND status = 'Aguarda Pagamento'";
                              $sql_3 = $pdo->query($sql_3);
                              echo $sql_3->rowCount(); ?>
                    </li>
                </ul>
                <ul>
                    <h1><strong>Suporte Técnico</strong></h1>
                    <li><strong>Contatos que aguardam resposta:</strong>
                        <?php $sql_1 = "SELECT * FROM central_mensagem WHERE status = 'Aguarda resposta'";
                              $sql_1 = $pdo->query($sql_1);
                              echo $sql_1->rowCount(); ?>
                    </li>
                    <li><strong>Contatos respondidos:</strong>
                        <?php $sql_2 = "SELECT * FROM central_mensagem WHERE status = 'Respondida'";
                              $sql_2 = $pdo->query($sql_2);
                              echo $sql_2->rowCount(); ?>
                    </li>
                    <li><strong>Total de Contatos:</strong>
                        <?php $sql_3 = "SELECT * FROM central_mensagem";
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
                        $sql_5 = "SELECT * FROM mural_coordenacao ORDER BY id DESC";
                        $sql_5 = $pdo->query($sql_5);
                        if($sql_5->rowCount() == ''){
                            echo "No momento não existe novidades";
                        }else{
                            foreach ($sql_5 as $res_5):
                        ?>
                        <li><h1><?php echo $res_5['titulo']; ?></h1></li>
                        <?php endforeach;
                        } ?>
                     </ul>
                    </div><!-- avisos_notificacoes -->
            </div><!-- notificacoes -->
    </div>
    <?php require "rodape.php"; ?>
    </body>
</html>