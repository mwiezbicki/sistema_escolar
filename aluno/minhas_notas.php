<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/minhas_notas.css" rel="stylesheet" type="text/css"/>
        <title>Minhas Notas</title>
    </head>
    <body>
        <?php require "topo.php"; ?>
        <div id="caixa_preta">
        </div>
        <div id="box">
            <!--Comeco de notas de trabalhos-->
            <?php if($_GET['pg'] == 'trabalhos') { ?>
            <h1><strong>Nota de seus trabalhos em cada bimestre</strong></h1>
            <table width="900" border="0">
                <tr>
                    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
                    <td width="150"><strong>1&ordm; Bimestre</strong></td>
                    <td width="150"><strong>2&ordm; Bimestre</strong></td>
                    <td width="150"><strong>3&ordm; Bimestre</strong></td>
                    <td width="150"><strong>4&ordm; Bimestre</strong></td>
                </tr>
                <?php
                $sql_1 = "SELECT * FROM disciplinas WHERE curso = '$serie'";
                $sql_1 = $pdo->query($sql_1);
                foreach ($sql_1 as $res_1):
                    $disciplina = $res_1['disciplina'];
                $sql_2 = "SELECT * FROM notas_trabalhos WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '1'";
                $sql_2 = $pdo->query($sql_2);
                
                $sql_3 = "SELECT * FROM notas_trabalhos WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '2'";
                $sql_3 = $pdo->query($sql_3);
                
                $sql_4 = "SELECT * FROM notas_trabalhos WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '3'";
                $sql_4 = $pdo->query($sql_4);
                
                $sql_5 = "SELECT * FROM notas_trabalhos WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '4'";
                $sql_5 = $pdo->query($sql_5);
                ?>
                <tr>
                    <td><?php echo $disciplina; ?></td>
                    <td>
                        <?php
                        if($sql_2->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_2 as $res_2):
                            $nota = $res_2['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($sql_3->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_3 as $res_3):
                            $nota = $res_3['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($sql_4->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_4 as $res_4):
                            $nota = $res_4['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($sql_5->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_5 as $res_5):
                            $nota = $res_5['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="6"><img src="img/menu_top.png" width="900" height="1"/></td>
                </tr>
                <?php
                endforeach;
                ?>
            </table>
            <h4>OBS: Esta nota é obtida através do trabalho que você enviou ao professor e que o mesmo deu a nota!</h4>
            <?php
            }
            ?>
            <!--Comeco de notas de prova-->
            <?php if($_GET['pg'] == 'provas') { ?>
            <h1><strong>Nota de suas provas em cada bimestre</strong></h1>
            <table width="900" border="0">
                <tr>
                    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
                    <td width="150"><strong>1&ordm; Bimestre</strong></td>
                    <td width="150"><strong>2&ordm; Bimestre</strong></td>
                    <td width="150"><strong>3&ordm; Bimestre</strong></td>
                    <td width="150"><strong>4&ordm; Bimestre</strong></td>
                </tr>
                <?php
                $sql_1 = "SELECT * FROM disciplinas WHERE curso = '$serie'";
                $sql_1 = $pdo->query($sql_1);
                foreach ($sql_1 as $res_1):
                    $disciplina = $res_1['disciplina'];
                    $sql_2 = "SELECT * FROM notas_provas WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '1'";
                    $sql_2 = $pdo->query($sql_2);

                    $sql_3 = "SELECT * FROM notas_provas WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '2'";
                    $sql_3 = $pdo->query($sql_3);

                    $sql_4 = "SELECT * FROM notas_provas WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '3'";
                    $sql_4 = $pdo->query($sql_4);

                    $sql_5 = "SELECT * FROM notas_provas WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '4'";
                    $sql_5 = $pdo->query($sql_5);
                    ?>
                    <tr>
                        <td><?php echo $disciplina; ?></td>
                        <td>
                        <?php
                        if($sql_2->rowCount() <= 0){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_2 as $res_2):
                            $nota = $res_2['nota'];
                            $prova = $res_2['prova'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_2['nota']."</strong>";
                            } else {
                                echo "<h3><strong>".$res_2['nota']."</strong>";
                            }
                            if($res_2['prova'] == ''){
                                
                            }else{
                                echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_3->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_3 as $res_3):
                            $nota = $res_3['nota'];
                            $prova = $res_3['prova'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_3['nota']."</strong>";
                            } else {
                                echo "<h3><strong>".$res_3['nota']."</strong>";
                            }
                            if($res_3['prova'] == ''){
                                
                            }else{
                                echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_4->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_4 as $res_4):
                            $nota = $res_4['nota'];
                            $prova = $res_4['prova'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_4['nota']."</strong>";
                            } else {
                                echo "<h3><strong>".$res_4['nota']."</strong>";
                            }
                            if($res_4['prova'] == ''){
                                
                            }else{
                                echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_5->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_5 as $res_5):
                            $nota = $res_5['nota'];
                            $prova = $res_5['prova'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_5['nota']."</strong>";
                            } else {
                                echo "<h3><strong>".$res_5['nota']."</strong>";
                            }
                            if($res_5['prova'] == ''){
                                
                            }else{
                                echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"><img src="img/menu_top.png" width="900" height="1"/></td>
            </tr>
            </table>
            <h4>OBS: Esta nota é obtida através do trabalho que você enviou ao professor e que o mesmo deu a nota!</h4>
            <?php
            }
            ?>
            
            <!--Comeco de notas de observacao-->
            <?php if($_GET['pg'] == 'observacao') { ?>
            <h1><strong>Nota de observações em cada bimestre</strong></h1>
            <table width="900" border="0">
                <tr>
                    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
                    <td width="150"><strong>1&ordm; Bimestre</strong></td>
                    <td width="150"><strong>2&ordm; Bimestre</strong></td>
                    <td width="150"><strong>3&ordm; Bimestre</strong></td>
                    <td width="150"><strong>4&ordm; Bimestre</strong></td>
                </tr>
                <?php
                $sql_1 = "SELECT * FROM disciplinas WHERE curso = '$serie'";
                $sql_1 = $pdo->query($sql_1);
                foreach ($sql_1 as $res_1):
                    $disciplina = $res_1['disciplina'];
                    $sql_2 = "SELECT * FROM notas_observacao WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '1'";
                    $sql_2 = $pdo->query($sql_2);

                    $sql_3 = "SELECT * FROM notas_observacao WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '2'";
                    $sql_3 = $pdo->query($sql_3);

                    $sql_4 = "SELECT * FROM notas_observacao WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '3'";
                    $sql_4 = $pdo->query($sql_4);

                    $sql_5 = "SELECT * FROM notas_observacao WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '4'";
                    $sql_5 = $pdo->query($sql_5);
                    ?>
                    <tr>
                        <td><?php echo $disciplina; ?></td>
                        <td>
                        <?php
                        if($sql_2->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_2 as $res_2):
                            $nota = $res_2['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_2['nota']."</strong></h2>";
                            } else {
                                echo "<h3><strong>".$res_2['nota']."</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_3->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_3 as $res_3):
                            $nota = $res_3['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_3['nota']."</strong></h2>";
                            } else {
                                echo "<h3><strong>".$res_3['nota']."</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_4->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_4 as $res_4):
                            $nota = $res_4['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_4['nota']."</strong></h2>";
                            } else {
                                echo "<h3><strong>".$res_4['nota']."</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_5->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_5 as $res_5):
                            $nota = $res_5['nota'];
                            if($nota >= 7){
                                echo "<h2><strong>".$res_5['nota']."</strong></h2>";
                            } else {
                                echo "<h3><strong>".$res_5['nota']."</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"><img src="img/menu_top.png" width="900" height="1"/></td>
            </tr>
            </table>
            <h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
            <?php
            }
            ?>
            <!--Comeco de notas bimestrais-->
            <?php if($_GET['pg'] == 'bimestrais') { ?>
            <h1><strong>Suas Notas Bimestrais</strong></h1>
            <table width="900" border="0">
                <tr>
                    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
                    <td width="120"><strong>1&ordm; Bimestre</strong></td>
                    <td width="120"><strong>2&ordm; Bimestre</strong></td>
                    <td width="120"><strong>3&ordm; Bimestre</strong></td>
                    <td width="120"><strong>4&ordm; Bimestre</strong></td>
                    <td width="150"><strong>Resultado</strong></td>
                </tr>
                <?php
                $sql_1 = "SELECT * FROM disciplinas WHERE curso = '$serie'";
                $sql_1 = $pdo->query($sql_1);
                foreach ($sql_1 as $res_1):
                    $disciplina = $res_1['disciplina'];
                    $sql_2 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '1'";
                    $sql_2 = $pdo->query($sql_2);

                    $sql_3 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '2'";
                    $sql_3 = $pdo->query($sql_3);

                    $sql_4 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '3'";
                    $sql_4 = $pdo->query($sql_4);

                    $sql_5 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '4'";
                    $sql_5 = $pdo->query($sql_5);
                    ?>
                    <tr>
                        <td><?php echo $disciplina; ?></td>
                        <td>
                        <?php
                        if($sql_2->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_2 as $res_2):
                            $nota = number_format($res_2['nota'],2);
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_3->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_3 as $res_3):
                            $nota = number_format($res_3['nota'],2);
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_4->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_4 as $res_4):
                            $nota = number_format($res_4['nota'],2);
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_5->rowCount() == ''){
                            echo "<h2>Aguarda</h2>";
                        } else {
                        foreach ($sql_5 as $res_5):
                            $nota = number_format($res_5['nota'],2);
                            if($nota >= 7){
                                echo "<h2><strong>$nota</strong></h2>";
                            } else {
                                echo "<h3><strong>$nota</strong></h3>";
                            }
                        endforeach;
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($sql_5->rowCount() == ''){
                            echo "Aguarda";
                        }else{
                            $sql_2 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '1'";		
                            $sql_2 = $pdo->query($sql_2);

                            $sql_3 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '2'";	
                            $sql_3 = $pdo->query($sql_3);

                            $sql_4 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '3'";	
                            $sql_4 = $pdo->query($sql_4);

                            $sql_5 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND disciplina = '$disciplina' AND bimestre = '4'";	
                            $sql_5 = $pdo->query($sql_5);
                            
                            foreach ($sql_2 as $res_2):
                                foreach ($sql_3 as $res_3):
                                    foreach($sql_4 as $res_4):
                                        foreach ($sql_5 as $res_5):
                                            	$media = ($res_2['nota']+$res_3['nota']+$res_4['nota']+$res_5['nota'])/4;
	
                                                if($media >=7){
                                                        echo "<h2><strong>".number_format($media,2)." - Aprovado</strong></h2>";
                                                }else{
                                                        echo "<h3><strong>".number_format($media,2)." - Reprovado</strong></h3>";

                                                }
                                        endforeach;
                                    endforeach;
                                endforeach;
                            endforeach;
                        }?>
                        </td>
                    </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"><img src="img/menu_top.png" width="900" height="1"/></td>
            </tr>
            </table>
            <h4>OBS: A média por bimestre é obtido da seguinte forma: nota do trabalho+nota da prova+nota de observacao=Resultado da soma/3=Sua média naquele bimestre!</h4>
            <h4>OBS 2: O resultado final é obtido a partir de todas suas notas somadas divido por 4= Sua média final</h4>
            <?php
            }
            ?>
        </div>
    </body>
</html>            