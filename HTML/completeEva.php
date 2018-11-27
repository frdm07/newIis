<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="baseStyle.css">
        <title>送信完了</title>
    </head>
    <body>
    <div>
        <?php
        $isError = false;
        $isError = insinfchk($_POST['value']);
        $pdo = connectDB();
        try{
            $sql = "INSERT evalution (c_id, u_id, results) VALUES
            (:c_id, :u_id, :results)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(':c_id',$_SESSION['com_id'],PDO::PARAM_INT);
            $stm->bindValue(':u_id',$_POST['u_id'],PDO::PARAM_INT);
            $stm->bindValue(':results',$_POST['value'],PDO::PARAM_INT);
            $stm->execute();
        } catch (Exception $e) {
            echo '<span class="error">SQLの実行でエラーがありました</span><br>';
            echo $e->getMessage();
            exit();
        }
        ?>
        <?php if($isError == true): ?>
        <span class= "error">エラーが発生しました。もう一度操作をやり直してください。</span>
            <a href="evaluate.php">評価ページへ<a>
            <form method='POST' action='evaluate.php'>
                <input type='hidden' name='u_id' value=$_POST['u_id']>
                <input type='hidden' name='u_nm' value=$_POST['u_nm']>
                <input type='submit' value='評価ページに戻る' class='minbutton'>
            </form>
        <?php else: ?>
        <span>評価を送信しました。</span>
            <form method='POST' action='myPageIns.html'>
                <input type='hidden' name='u_id' value=$_POST['u_id']>
                <input type='submit' value='閲覧中のマイページに戻る' class='minbutton'>
            </form>
        <?php endif; ?>
    </div>
    </body>
</html>

<?php
function insinfchk($value){
    if(isset($value)){
        $chkObj = trim($name);
        if($chkObj===""){
            return true;
        }
    }
}
?>