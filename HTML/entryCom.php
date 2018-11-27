<?php
    session_start();
    require_once("../commonSql.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>完了しました。</title>
</head>
<body>
    <div>
        <?php
        $isError = false;
        $isError = insinfchk($_POST['name'], $_POST['tel'], $_POST['email']
        , $_POST['loginId'], $_POST['pass']);
        $pdo = connectDB();
        try{
            $sql = "INSERT company (nm, tel, e_mail, loginId, ps) VALUES
            (:nm, :tel, :e_mail, :loginId, :ps)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(':nm',$_POST['name'],PDO::PARAM_STR);
            $stm->bindValue(':tel',$_POST['tel'],PDO::PARAM_STR);
            $stm->bindValue(':e_mail',$_POST['email'],PDO::PARAM_STR);
            $stm->bindValue(':loginId',$_POST['loginId'],PDO::PARAM_STR);
            $stm->bindValue(':ps',$_POST['pass'],PDO::PARAM_STR);
            $stm->execute();
        } catch (Exception $e) {
            echo '<span class="error">SQLの実行でエラーがありました</span><br>';
            echo $e->getMessage();
            exit();
        }
        ?>
        <?php if($isError == true): ?>
        <span class= "error">必要情報を正しく入力してください。</span>
            <a href="newRegiIns.html">新規登録ページへ<a>
        <?php else: ?>
        <span>
            登録が完了しました。
            <a href="loginCom.html">ログインページへ<a>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
function insinfchk($name, $tel, $e_mail, $loginId, $pass){
    if(isset($name) || isset($tel) || isset($e_mail) || isset($loginId) || isset($pass)){
        $c=1;
        while(true){
            if($c==1) $chkObj = trim($name);
            if($c==2) $chkObj = trim($tel);
            if($c==3) $chkObj = trim($e_mail);
            if($c==4) $chkObj = trim($loginId);
            if($c==5) $chkObj = trim($pass);
            if($chkObj===""){
                return true;
            }
            $c++;
            if($c==6)break;
        }
    }
}
?>