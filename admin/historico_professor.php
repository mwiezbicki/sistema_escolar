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
            
            $sql = "SELECT * FROM professores WHERE id = '$id'";
            $sql = $pdo->query($sql);
            $sql->execute();
            
            $prof = $sql->fetch();
            ?>
            <table width="900" border="0">
                <tr>
                    <td><h2>Status:</h2></td>
                    <td><h2>Salário: R$</h2></td>
                </tr>
                <tr>
                    <td><h3><?php echo $prof['status'];?></h3></td>
                    <td><h3><?php echo $prof['salario'];?></h3></td>
                </tr>
                <tr>
                    <td><h2>Código:</h2></td>
                    <td><h2>Nome:</h2></td>
                    <td><h2>CPF:</h2></td>
                </tr>
                <tr>
                    <td><h3><?php echo $code = $prof['code']; ?></h3></td>
                    <td><h3><?php echo $prof['nome']; ?></h3></td>
                    <td><h3><?php echo $prof['cpf'] ;?></h3></td>
                </tr>
                <tr>
                    <td><h2>Data de Nascimento:</h2></td>
                    <td><h2>Formação Acadêmica:</h2></td>
                    <td><h2>Graduação(ões):</h2></td>
                </tr>
                <tr>
                    <td><h3><?php echo $prof['nascimento']; ?></h3></td>
                    <td><h3><?php echo $prof['formacao']; ?></h3></td>
                    <td><h3><?php echo $prof['graduacao']; ?></h3></td>
                </tr>
                <tr>
                    <td><h2>Pos-graduação(ões):</h2></td>
                    <td><h2>Mestrado(s):</h2></td>
                    <td><h2>Doutorado(s):</h2></td>
                </tr>
                <tr>
                    <td><h3><?php echo $prof['pos_graduacao']; ?></h3></td>
                    <td><h3><?php echo $prof['mestrado']; ?></h3></td>
                    <td><h3><?php echo $prof['doutorado']; ?></h3></td>
                </tr>
                <tr>
                    <td><h2><strong>Disciplinas que este professor ensina:</strong><?php $sql2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
                    $sql2 = $pdo->query($sql2);
                    $sql2->execute();

                    ?></h2></td>
                </tr>
                <?php foreach ($sql2 as $lista):
                ?>
                <tr>
                    <td><h2>Série:</h2></td>
                    <td><h2>Disciplinas:</h2></td>
                </tr>
                <tr>
                    <td><h3><?php echo $lista['curso'];?></h3></td>
                    <td><h3><?php echo $lista['disciplina'];?></h3></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>