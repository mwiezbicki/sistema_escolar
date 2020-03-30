<!doctype html>
<html>
    <head>
        <?php
        require 'config.php'; require 'operacional.php'; require 'pagamento_funcionarios.php';
        ?>
        <title>Sistema Escolar</title>
        <link rel="shortcut icon" href="/img/ico_escola.png" />
        <link type="text/css" rel="stylesheet" href="css/stilo.css"/>
    </head>
    <body>
        <div id="logo">
            <img src="img/logo1.png">
        </div>
        <div id="caixa_login">
            <?php
            if(isset($_POST['button'])){
                $code = addslashes($_POST['code']);
                $senha = addslashes($_POST['senha']);

                if($code == ''){
                    echo "<h2>Por favor digite o número do cartão ou código de acesso!</h2>";
                } else if($senha == '') {
                    echo "<h2>Favor digitar a senha de acesso! </h2>";
                } else {
                    $sql = "SELECT * FROM login WHERE code = :code AND senha = :senha";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":code", $code);
                    $sql->bindValue(":senha", $senha);
                    $sql->execute();

                    if($sql->rowCount() > 0){
                        $pessoa = $sql->fetch();
                        $code = $pessoa['code'];
                        $status = $pessoa['status'];
                        $painel = $pessoa['painel'];
                        $nome = $pessoa['nome'];
                        $senha = $pessoa['senha'];

                        if($status == "Inativo"){
                            echo "<h2>Você está inativo, procure o Administrador do sistema!</h2>";
                        } else {
                            session_start();
                            $_SESSION['cLogin'] = $pessoa['code'];
                            $_SESSION['code'] = $code;
                            $_SESSION['nome'] = $nome;
                            $_SESSION['senha'] = $senha;
                            $_SESSION['painel'] = $painel;

                            if($painel == 'Admin'){
                                echo "<script language='javascript'>window.location='admin';</script>";
                            } else if($painel == 'Professor') {
                                echo "<script language='javascript'>window.location='professor';</script>";
                            } else if($painel == 'Aluno'){
                                echo "<script language='javascript'>window.location='aluno';</script>";
                            } else if($painel == 'Portaria') {
                                echo "<script language='javascript'>window.location='portaria';</script>";
                            } else if($painel == 'Tesouraria') {
                                echo "<script language='javascript'>window.location='tesouraria';</script>";
                            }
                        }

                    } else {
                        echo "<h2>Usuário não cadastrado!</h2>";
                    }

                }
            }
            ?>

            <form name="form" method="POST" action="" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><h1>Cartão ou Código de Acesso:</h1></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="code" /></td>
                    </tr>
                    <tr>
                        <td><h1>Senha:</h1></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="senha" /></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="submit" name="button" value="Entrar" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
