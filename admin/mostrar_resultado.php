<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Detalhes da Busca</title>
        <link href="../css/mostrar_resultado.css" rel="stylesheet" type="text/css"/>
        <?php require '../config.php'; ?>
    </head>

    <body>
        <div id="box">
            <?php if(@$_GET['s'] == 'professor') {?>
            <?php
            $q = $_GET['q'];
            $sql_1 = "SELECT * FROM professores WHERE code = '$q' OR nome = '$q'";
            $sql_1 = $pdo->query($sql_1);
            foreach ($sql_1 as $res_1):
                ?>
                <table width="750" border="0">
                    <tr>
                        <td colspan="3"><h1>Informações sobre este professor</h1></td>
                    </tr>
                    <tr>
                        <td><strong>Nome:</strong></td>
                        <td><strong>Salário:</strong></td>
                        <td><strong>CPF:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['nome']; ?> - <?php echo $res_1['code']; ?></td>
                        <td><?php echo number_format($res_1['salario'],2); ?></td>
                        <td><?php echo $res_1['cpf']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Formação</strong>:</td>
                        <td><strong>Graduação:</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['formacao']; ?></td>
                        <td><?php echo $res_1['graduacao']; ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><strong>Pos-graduação:</strong></td>
                        <td><strong>Mestrado:</strong></td>
                        <td><strong>Doutorado:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['pos_graduacao']; ?></td>
                        <td><?php echo $res_1['mestrado']; ?></td>
                        <td><?php echo $res_1['doutorado']; ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>

            <?php
            $sql_2 = "SELECT * FROM disciplinas WHERE professor = ".$res_1['code']."";
            $sql_2 = $pdo->query($sql_2);
            ?>
            <table width="750" border="0">
                <tr>
                    <td colspan="2"><strong>Status:</strong><?php echo $_GET['status']; ?></td>
                    <td width="330">&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Disciplinas ministradas:</strong></td>
                    <td><strong>Curso</strong></td>
                </tr>
                <?php foreach($sql_2 as $res_2): ?>
                <tr>
                    <td><?php echo $res_2['disciplina']; ?></td>
                    <td><?php echo $res_2['curso']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php
            $nome = $res_1['nome'];
            $sql_3 = "SELECT * FROM fluxo_de_caixa WHERE codigo = '$q' OR descricao LIKE '%$q%' OR descricao LIKE '%$nome%'";
            $sql_3 = $pdo->query($sql_3);
            if($sql_3->rowCount() == ''){
                echo "<h3>Não foi encontrado nenhum pagamento.</h3>";
            }else{
                ?>
                <table width="750" border="0">
                    <tr>
                        <td colspan="3"><h1>Histórico de pagamento</h1></td>
                    </tr>
                    <tr>
                        <td><strong>Data de pagamento:</strong></td>
                        <td><strong>Descrição:</strong></td>
                        <td><strong>Forma de pagamento:</strong></td>
                    </tr>
                    <?php foreach($sql_3 as $res_3): ?>
                    <tr>
                        <td><?php echo $res_3['date']; ?></td>
                        <td><?php echo $res_3['descricao']; ?></td>
                        <td><?php echo $res_3['form_pag']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php } ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <?php } ?>

            <?php if(@$_GET['s'] == 'aluno'){ ?>
            <?php
                $q = $_GET['q'];
                $sql_1 = "SELECT * FROM estudantes WHERE code = '$q' OR nome = '$q'";
                $sql_1 = $pdo->query($sql_1);
                foreach($sql_1 as $res_1): ?>
                    <table width="750" border="0">
                        <tr>
                            <td colspan="3"<h1>Informações Gerais</h1></td>
                        </tr>
                        <tr>
                            <td><strong>Nome:</strong></td>
                            <td><strong>CPF:</strong></td>
                            <td><strong>RG:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo $res_1['nome']; ?> - <?php echo $res_1['code']; ?></td>
                            <td><?php echo $res_1['cpf']; ?></td>
                            <td><?php echo $res_1['rg']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nascimento:</strong></td>
                            <td><strong>Mãe:</strong></td>
                            <td><strong>Pai:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo $res_1['nascimento']; ?></td>
                            <td><?php echo $res_1['mae']; ?></td>
                            <td><?php echo $res_1['pai']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Estado:</strong></td>
                            <td><strong>Cidade:</strong></td>
                            <td><strong>Bairro:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo $res_1['estado']; ?></td>
                            <td><?php echo $res_1['cidade']; ?></td>
                            <td><?php echo $res_1['bairro']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Endereço:</strong></td>
                            <td><strong>Complemento:</strong></td>
                            <td><strong>Cep:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo $res_1['endereco']; ?></td>
                            <td><?php echo $res_1['complemento']; ?></td>
                            <td><?php echo $res_1['cep']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Telefone Residencial:</strong></td>
                            <td><strong>Celular:</strong></td>
                            <td><strong>Telefone Amigo:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo $res_1['tel_residencial']; ?></td>
                            <td><?php echo $res_1['celular']; ?></td>
                            <td><?php echo $res_1['tel_amigo']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Série:</strong></td>
                            <td><strong>Turno:</strong></td>
                            <td><strong>Atendimento Especial:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo $res_1['serie']; ?></td>
                            <td><?php echo $res_1['turno']; ?></td>
                            <td><?php echo $res_1['atendimento_especial']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Mensalidade:</strong></td>
                            <td><strong>Vencimento:</strong></td>
                            <td><strong>Telefone Cobrança:</strong></td>
                        </tr>
                        <tr>
                            <td>R$ <?php echo $res_1['mensalidade']; ?></td>
                            <td><?php echo $res_1['vencimento']; ?></td>
                            <td><?php echo $res_1['tel_cobranca']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Observação:</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo $res_1['obs']; ?></td>
                        </tr>
                    </table>
            <?php endforeach; ?>
            <table width="750" border="0">
                <tr>
                    <td colspan="5"><h1>Informações acadêmicas</h1></td>
                </tr>
                <tr>
                    <td width="248"><strong>Presenças:</strong>
                        <?php $codigo = $res_1['code']; ?>
                        <?php $sql_2 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' OR code_aluno = '$codigo' AND presente = 'SIM' ";
                        $sql_2 = $pdo->query($sql_2);
                        echo $sql_2->rowCount();
                        ?>
                    </td>
                    <td colspan="2"><strong>Faltas:</strong>
                        <?php $sql_3 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' OR code_aluno = '$codigo' AND presente = 'NÃO' ";
                        $sql_3 = $pdo->query($sql_3);
                        echo $sql_3->rowCount();
                        ?>
                    </td>
                    <td colspan="2"><strong>Faltas justificadas:</strong>
                        <?php $sql_4 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' OR code_aluno = '$codigo' AND presente = 'JUSTIFICADA' ";
                        $sql_4 = $pdo->query($sql_4);
                        echo $sql_4->rowCount();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $sql_5 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'SIM'";
                        $sql_5 = $pdo->query($sql_5);
                        foreach($sql_5 as $res_5):
                            echo $res_5['date_day'];
                            echo " - ";
                            echo $res_5['disciplina'];
                            echo "<br>";
                        endforeach;
                        ?>
                    </td>
                    <td colspan="2">
                        <?php
                        $sql_6 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'NAO'";
                        $sql_6 = $pdo->query($sql_6);
                        foreach($sql_6 as $res_6):
                            echo $res_6['date_day'];
                            echo " - ";
                            echo $res_6['disciplina'];
                            echo "<br>";
                        endforeach;
                        ?>
                    </td>
                    <td colspan="2">
                        <?php
                        $sql_7 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'JUSTIFICADA'";
                        $sql_7 = $pdo->query($sql_7);
                        foreach($sql_7 as $res_7):
                            echo $res_7['date_day'];
                            echo " - ";
                            echo $res_7['disciplina'];
                            echo "<br>";
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><hr></td>
                </tr>
                <tr>
                    <td colspan="5"><h2><strong>Notas dos trabalhos bimestrais</strong></h2></td>
                </tr>
                <tr>
                    <td><strong>Disciplina:</strong></td>
                    <td width="119"><strong>1º Bimestre</strong></td>
                    <td width="119"><strong>2º Bimestre</strong></td>
                    <td width="119"><strong>3º Bimestre</strong></td>
                    <td width="119"><strong>4º Bimestre</strong></td>
                </tr>
                <?php
                $curso = $_GET['curso'];
                $sql_3 = "SELECT * FROM disciplinas WHERE curso = '$curso'";
                $sql_3 = $pdo->query($sql_3);
                foreach ($sql_3 as $res_3):
                    $disciplina = $res_3['disciplina'];
                ?>
                <tr>
                    <td><?php echo $res_3['disciplina']; ?></td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_trabalhos WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q' OR code = '$codigo' AND disciplina = '$disciplina' AND bimestre = '1'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_trabalhos WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q' OR code = '$codigo' AND disciplina = '$disciplina' AND bimestre = '2'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_trabalhos WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q' OR code = '$codigo' AND disciplina = '$disciplina' AND bimestre = '3'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_trabalhos WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q' OR code = '$codigo' AND disciplina = '$disciplina' AND bimestre = '4'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><hr/>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><h2><strong>Notas de trabalhos extras</strong></h2></td>
                </tr>
                <?php
                $curso = $_GET['curso'];
                $sql_3 = "SELECT *FROM disciplinas WHERE curso = '$curso'";
                $sql_3 = $pdo->query($sql_3);
                ?>
                <tr>
                    <td><strong>Disciplina:</strong></td>
                    <td colspan="4"><strong>Pontos</strong></td>
                </tr>
                <?php
                foreach ($sql_3 as $res_3):
                    $disciplina = $res_3['disciplina'];
                ?>
                <tr>
                    <td><?php echo $res_3['disciplina']; ?>
                    <td colspan="4">
                    <?php
                    $codigo = $res_1['code'];
                    $sql_4 = "SELECT * FROM pontos_extras WHERE disciplina = '$disciplina' AND code = '$q' OR code = '$codigo' AND disciplina = '$disciplina'";
                    $sql_4 = $pdo->query($sql_4);
                    foreach ($sql_4 as $res_4):
				echo $res_4['nota'];
                    endforeach;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><hr></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><h2><strong>Notas das provas</strong></h2></td>
                </tr>
                <tr>
                    <td><strong>Disciplina:</strong></td>
                    <td><strong>1º Bimestre</strong></td>
                    <td><strong>2º Bimestre</strong></td>
                    <td><strong>3º Bimestre</strong></td>
                    <td><strong>4º Bimestre</strong></td>
                </tr>
                <?php
                $curso = $_GET['curso'];
                $sql_3 = "SELECT * FROM disciplinas WHERE curso = '$curso'";
                $sql_3 = $pdo->query($sql_3);
                foreach ($sql_3 as $res_3):
                    $disciplina = $res_3['disciplina'];
                ?>
                <tr>
                    <td><?php echo $res_3['disciplina']; ?></td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_provas WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '1' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach ($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_5 = "SELECT * FROM notas_provas WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '2' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_5 = $pdo->query($sql_5);
                        foreach ($sql_5 as $res_5):
                            echo $res_5['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_6 = "SELECT * FROM notas_provas WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '3' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_6 = $pdo->query($sql_6);
                        foreach ($sql_6 as $res_6):
                            echo $res_6['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_7 = "SELECT * FROM notas_provas WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '4' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_7 = $pdo->query($sql_7);
                        foreach ($sql_7 as $res_7):
                            echo $res_7['nota'];
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><hr></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><h2><strong>Notas de observação</strong></h2></td>
                </tr>
                <tr>
                    <td><strong>Disciplina:</strong></td>
                    <td><strong>1º Bimestre</strong></td>
                    <td><strong>2º Bimestre</strong></td>
                    <td><strong>3º Bimestre</strong></td>
                    <td><strong>4º Bimestre</strong></td>
                </tr>
                <?php
                $curso = $_GET['curso'];
                $sql_3 = "SELECT * FROM disciplinas WHERE curso = '$curso'";
                $sql_3 = $pdo->query($sql_3);
                foreach ($sql_3 as $res_3):
                    $disciplina = $res_3['disciplina'];
                ?>
                <tr>
                    <td><?php echo $res_3['disciplina']; ?></td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_observacao WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '1' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach ($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_5 = "SELECT * FROM notas_observacao WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '2' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_5 = $pdo->query($sql_5);
                        foreach ($sql_5 as $res_5):
                            echo $res_5['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_6 = "SELECT * FROM notas_observacao WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '3' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_6 = $pdo->query($sql_6);
                        foreach ($sql_6 as $res_6):
                            echo $res_6['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_7 = "SELECT * FROM notas_observacao WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '4' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_7 = $pdo->query($sql_7);
                        foreach ($sql_7 as $res_7):
                            echo $res_7['nota'];
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><hr></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><h2><strong>Notas bimestrais</strong></h2></td>
                </tr>
                <tr>
                    <td><strong>Disciplina:</strong></td>
                    <td><strong>1º Bimestre</strong></td>
                    <td><strong>2º Bimestre</strong></td>
                    <td><strong>3º Bimestre</strong></td>
                    <td><strong>4º Bimestre</strong></td>
                </tr>
                <?php
                $curso = $_GET['curso'];
                $sql_3 = "SELECT * FROM disciplinas WHERE curso = '$curso'";
                $sql_3 = $pdo->query($sql_3);
                foreach ($sql_3 as $res_3):
                    $disciplina = $res_3['disciplina'];
                ?>
                <tr>
                    <td><?php echo $res_3['disciplina']; ?></td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_4 = "SELECT * FROM notas_bimestrais WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '1' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_4 = $pdo->query($sql_4);
                        foreach ($sql_4 as $res_4):
                            echo $res_4['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_5 = "SELECT * FROM notas_bimestrais WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '2' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_5 = $pdo->query($sql_5);
                        foreach ($sql_5 as $res_5):
                            echo $res_5['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_6 = "SELECT * FROM notas_bimestrais WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '3' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_6 = $pdo->query($sql_6);
                        foreach ($sql_6 as $res_6):
                            echo $res_6['nota'];
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        $codigo = $res_1['code'];
                        $sql_7 = "SELECT * FROM notas_bimestrais WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q' OR bimestre = '4' AND disciplina = '$disciplina' AND code = '$codigo'";
                        $sql_7 = $pdo->query($sql_7);
                        foreach ($sql_7 as $res_7):
                            echo $res_7['nota'];
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><hr></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td colspan="5"><h1>Informações financeiras</h1></td>
                </tr>
                <tr>
                    <td width="141"><strong>Código da cobrança:</strong></td>
                    <td width="133"><strong>Status:</strong></td>
                    <td width="120"><strong>Valor:</strong></td>
                    <td width="185"><strong>Data de pagamento</strong></td>
                    <td width="137"><strong>Forma de pagamento</strong></td>
                </tr>
                <?php
                $sql_5 = "SELECT * FROM mensalidades WHERE matricula = '$q' OR matricula =".$res_1['code']."";
                $sql_5 = $pdo->query($sql_5);
                foreach ($sql_5 as $res_5): ?>
                <tr>
                    <td><?php echo $res_5['code']; ?></td>
                    <td><?php echo $res_5['status']; ?></td>
                    <td>R$ <?php echo $res_5['valor']; ?></td>
                    <td><?php echo $res_5['data_pagamento']; ?></td>
                    <td><?php echo $res_5['metodo_pagamento']; ?></td>
                </tr>
                <tr>
                    <td colspan="5"><hr /></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <?php } ?>

            <?php if(@$_GET['s'] == 'cobranca'){ ?>
            <?php
            $q = $_GET['q'];
            $sql_1 = "SELECT * FROM mensalidades WHERE code = '$q'";
            $sql_1 = $pdo->query($sql_1);
            foreach ($sql_1 as $res_1):
                $matricula = $res_1['matricula'];
                $sql_2 = "SELECT * FROM estudantes WHERE code = '$matricula'";
                $sql_2 = $pdo->query($sql_2);
                foreach ($sql_2 as $res_2):
                ?>
                <table width="950" border="0">
                    <tr>
                        <td colspan="4"><hr /></td>
                    </tr>
                    <tr>
                        <td><strong>Número de matricula:</strong></td>
                        <td><strong>Nome do aluno:</strong></td>
                        <td><strong>Vencimento:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $matricula; ?></td>
                        <td><?php echo $res_2['nome']; ?></td>
                        <td><?php echo $res_1['vencimento']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Valor:</strong></td>
                        <td><strong>Status:</strong></td>
                        <td><strong>Data do pagamento:</strong></td>
                    </tr>
                    <tr>
                        <td>R$ <?php $res_1['valor']; ?></td>
                        <td><?php echo $res_1['status']; ?></td>
                        <td><?php echo $res_1['data_pagamento']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>CPF:</strong></td>
                        <td><strong>Curso:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_2['cpf']; ?></td>
                        <td><?php echo $res_2['serie']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Forma de pagamento:</strong></td>
                        <td><?php echo $res_1['metodo_pagamento']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr /></td>
                    </tr>
                </table>
                <?php endforeach;
            endforeach; ?>
            <?php } ?>
        </div>
    </body>
</html>
