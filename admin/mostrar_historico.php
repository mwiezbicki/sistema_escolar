<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Histórico</title>
        <link href="../css/historico_do_professor.css" rel="stylesheet" type="text/css" />
        <?php require '../config.php'; ?>
    </head>
    <body>
        <div id="box">
            <?php
            $id = $_GET['id'];
            
            $sql_1 = "SELECT * FROM historico WHERE aluno = '$id'";
            $sql_1 = $pdo->query($sql_1);
            $sql_3 = "SELECT * FROM estudantes WHERE code = '$id'";
            $sql_3 = $pdo->query($sql_3);
            foreach ($sql_3 as $res_3):
                $nome = $res_3['nome'];
            endforeach;
            
            if($sql_1->rowCount() == ''){
                echo "nenhum historico";
            }else {
                foreach ($sql_1 as $res_1):
            ?>
            <table>
                <tr>
                    <td><strong><?php echo $nome; ?></strong></td>
                </tr>
                <tr>
                    <td><strong>Ano</strong></td>
                    <td><strong>Serie</strong></td>
                    <td><strong>Unidade Institucional</strong></td>
                    <td><strong>Município</strong></td>
                    <td><strong>Estado</strong></td>
                </tr>
                <tr>
                    <td><?php echo $res_1['ano']; ?></td>
                    <td><?php echo $res_1['serie']; ?></td>
                    <td><?php echo $res_1['unid_inst']; ?></td>
                    <td><?php echo $res_1['munic_inst']; ?></td>
                    <td><?php echo $res_1['uf_inst']; ?></td>
                </tr>
            </table>
            <?php
            $id = $res_1['id'];
            $sql_2 = "SELECT * FROM historico_disc WHERE id_historico = '$id'";
            $sql_2 = $pdo->query($sql_2);
            if($sql_2->rowCount() == ''){
                echo "Nenhuma disciplina cadastrada";
            } else {
                ?>
            <table width="800" border="0">
                <tr>
                    <td><strong>Disciplina</strong></td>
                    <td><strong>Nota</strong></td>
                    <td><strong>Total de Faltas</strong></td>
                    <td><strong>% Frequência</strong></td>
                    <td><strong>Carga Horária</strong></td>
                    <td><strong>Dias Letivos</strong></td>
                    <td><strong>Resultado Final</strong></td>
                </tr>
                <?php
                foreach ($sql_2 as $res_2):
                ?>

                    <tr>
                        <td>
                            <?php echo $res_2['disciplina']; ?>
                        </td>
                        <td>
                            <?php echo $res_2['nota']; ?>
                        </td>
                        <td>
                            <?php echo $res_2['total_faltas']; ?>
                        </td>
                        <td>
                            <?php echo $res_2['frequencia']; ?>
                        </td>
                        <td>
                            <?php echo $res_2['carga_horaria']; ?>
                        </td>
                        <td>
                            <?php echo $res_2['dias_letivos']; ?>
                        </td>
                        <td>
                            <?php echo $res_2['resultado_final']; ?>
                        </td>
                    </tr>
                
                <?php
                endforeach;
            ?>
            </table>
            <?php
            }
            
            endforeach; ?>
            <?php } ?>
        </div>
    </body>
</html>