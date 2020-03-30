<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/suporte_tecnico.css" rel="stylesheet" type="text/css"/>
        <title>Suporte Técnico Professor</title>
    </head>

    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">
        </div>

        <div id="box">
            <h1>Suporte Técnico</h1>
            <?php
            if (isset($_POST['button'])) {
                $resp = $_POST['resp'];
                $id = $_POST['id'];
                $date = date("d/m/Y H:i:s");
                $anexo = $_FILES['anexo']['name'];
                if(file_exists("../anexos/$anexo")){
		 $a = 1;
		 while(file_exists("../anexos/[$a]$anexo")){
			 $a++;
			 }
			 
		$anexo = "[".$a."]".$anexo;	 
                }
                $sql_2 = "UPDATE central_mensagem SET status = 'Respondida', data_resposta = '$date', resposta = '$resp', anexo_resp = '$anexo' WHERE id = '$id' ";
                $sql_2 = $pdo->query($sql_2);

                (move_uploaded_file($_FILES['anexo']['tmp_name'], "../anexos/".$anexo));

                echo "<script language='javascript'>window.alert('Mensagem respondida com sucesso!');window.location='';</script>";
            }
            ?>

            <?php
            $sql_1 = "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Aguarda resposta' LIMIT 3";
            $sql_1 = $pdo->query($sql_1);
            if ($sql_1->rowCount() <= 0) {
                echo "<h2>Não existe nenhum contato para ser respondido!</h2>";
            } else {
                foreach ($sql_1 as $res_1):
                ?>     
                <form name = "button" method = "post" action = "" enctype = "multipart/form-data">
                    <table width = "950" border = "0">
                    <tr>
                        <td><strong>Data:</strong></td>
                        <td><strong>Nº de matricula do aluno:</strong></td>
                        <td><strong>Anexo:</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $res_1['date'];
                        ?></td>
                        <td><?php echo $res_1['emissor']; ?></td>
                        <td><a target="_blank" href="../anexos/<?php echo $res_1['anexo']; ?>"><?php echo $res_1['anexo']; ?></a></td>
                    </tr>
                    <tr>
                        <td><strong>Mensagem:</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo $res_1['mensagem']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><label for="textarea"></label>
                        <textarea name="resp" id="textarea" cols="110" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Escolha o arquivo para anexar abaixo</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input name="anexo" type="file" /></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="submit" name="button" id="button" value="Enviar"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </table>
                    <input type="hidden" name="id" value="<?php echo $res_1['id']; ?>" />
                </form>
                <?php
                endforeach;
                }
                ?>
            </div>
    <?php require 'rodape.php'; ?>
    </body>
</html>    