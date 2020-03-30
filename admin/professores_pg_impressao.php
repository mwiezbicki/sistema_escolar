<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="" rel="stylesheet" type="text/css"/>

<title>Imprimir</title>
</head>
    <body>
        <script language='javascript'>window.print()</script>
        <div id='box'>
            <?php
            require '../config.php';

            ?>
            <table width="600" border="1">
              <?php
              $sql_1 = "SELECT * FROM cursos";
              $sql_1 = $pdo->query($sql_1);
              foreach ($sql_1 as $res_1):
                    $serie = $res_1['curso']; ?>
                    <tr>
                      <td style="text-align:center"><strong><?php echo $res_1['curso']; ?></strong></td>
                    </tr>
                    <?php
                    $sql_2 = "SELECT periodos FROM periodos";
                    $sql_2 = $pdo->query($sql_2);
                    foreach ($sql_2 as $res_2):
                        $periodo = $res_2['periodos']; ?>
                        <tr>
                          <td style="text-align:center"><?php echo $periodo; ?></td>
                        </tr>
                        <?php
                        $sql_3 = "SELECT nome FROM estudantes WHERE serie = '$serie' AND turno = '$periodo'";
                        $sql_3 = $pdo->query($sql_3);
                        foreach ($sql_3 as $res_3): ?>
                        <tr>
                            <td><?php echo $res_3['nome']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php  endforeach;  ?>
              <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>
