<?php
require_once("../commonSql.php");
session_start();
$gotoMypage = "myInst.php";
$logId = $_SESSION["com_id"];
$_SESSION["com_id"] = $logId;
$_SESSION["backId"] = $logId;
$dateLim = date("Y/m/d",strtotime("+7 day"));
?>

<?php
$pdo = connectDB();
if(isset($logId)){
    try{
        $sql = "INSERT schedule(c_id, u_id, s_id, contents, str_date, end_date, order_date, limit_date, app_id, complete_id) 
                VALUES(:c_id, :u_id, :s_id :contents, :str_date, :end_date, now(), :limit_date, 1, 2)";
        $stm = $pdo->prepare($sql);
        if(isset($_POST["str_date"]) || isset($_POST["end_date"])){
            $stm->bindValue(':c_id', $_SESSION["c_id"], PDO::PARAM_INT);
            $stm->bindValue(':u_id', $_SESSION["str_date1"], PDO::PARAM_INT);
            $stm->bindValue(':s_id', $_SESSION["str_date1"], PDO::PARAM_INT);
            $stm->bindValue(':contens', $_POST["message"], PDO::PARAM_STR);
            $stm->bindValue(':str_date', $_POST["str_date"], PDO::PARAM_DATE);
            $stm->bindValue(':end_date', $_POST["end_date"], PDO::PARAM_DATE);
            $stm->bindValue(':str_date', $dateLim, PDO::PARAM_DATE);
        }
        $stm->execute();
        echo "依頼作成完了";
        $pdo = NULL;
    }catch (Exception $e){
        echo '<span class="error">エラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}else{
    echo "<a href='top.html'>トップページへ</a>";
}
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>登録完了</title>
    </head>
    <body>
        <?php
        echo "<a href={$gotoMypage}>マイページへ</a>";
        ?>
    </body>
</html>