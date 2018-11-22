<?php
    session_start();
    require_once("../commonSql.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ログイン認証</title>
</head>
<body>
    <div>
        <?php
        $isError = false;
        if(isset($_POST['ins_id'])){
            $ins_id = trim($_POST['ins_id']);
            if($ins_id===""){
                $isError = true;
            }
        } else {
            $isError = true;
        }
        $pdo = connectDB();
        try{
            $sql = "SELECT loginId, ps FROM instructor;";
            $stm = $pdo->prepare($sql);
            $list = exeSQL($stm);
        } catch (Exception $e) {
            echo '<span class="error">SQLの実行でエラーがありました</span><br>';
            echo $e->getMessage();
            exit();
        }
        $idflg = false;
        $psflg = false;
        foreach($list[0]['loginId'] as $id){
            if($_POST['com_id'] === $id){
                $idflag = true;
                foreach($list[0]['ps'] as $ps){
                    if($_POST['com_ps'] === $ps){
                        $psflag = true;
                        $_SESSION["com_id"] = $_POST["com_id"];
                    }
                }
            }
        }
        if($idflag = false){
            $isError = true;
        }
        if($psflag = false){
            $isError = true;
        }
        ?>
        <?php if($isError('true')): ?>
        <span class= "error">ログインIDとパスワードを正しく入力してください。</span>
        <a href="loginInst.html">ログインページに戻る<a>
        <?php else: ?>
        <span>
            ログインが完了しました。
            <a href="myInst.php">マイページへ<a>
        <?php endif; ?>
    </div>
</body>
</html>