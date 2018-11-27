<?php
    session_start();
    require_once("../iis/commonSql.php");
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
        if(isset($_POST['inst_id'])){
            $inst_id = trim($_POST['inst_id']);
            if($inst_id===""){
                $isError = true;
            }
        } else {
            $isError = true;
        }
        connectDB();
        $sql = "SELECT loginId FROM instructor;";
        $list['loginId'] = exeSQL($sql);
        $idflg = false;
        $psflg = false;
        foreach($list['loginId'] as $id){
            if($_POST['inst_id'] === $id){
                $idflag = true;
                $pdo = connectDB();
                try{
                    $sql = "SELECT ps FROM instructor WHERE loginId = :id;";
                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(':id',$id,PDO::PARAM_INT);
                    $ps = exeSQL($stm);
                } catch (Exception $e) {
                    echo '<span class="error">SQLの実行でエラーがありました</span><br>';
                    echo $e->getMessage();
                    exit();
                }
                if($_POST['inst_ps'] === $ps){
                    $psflag = true;
                    $_SESSION['ins_id'] = $_POST['inst_id'];
                    break;
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
            <a href="myInst.html">マイページへ<a>
        <?php endif; ?>
    </div>
</body>
</html>