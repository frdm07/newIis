<?php
require_once("../commonSql.php");
session_start();
$gotoMypage = "myInst.php";
$gotoInsert = "schedule.php";
$logId = $_SESSION["id"];
$_SESSION["ins_id"] = $logId;
$_SESSION["backId"] = $logId;
?>

<?php
$pdo = connectDB();
if(isset($_SESSION["id"])){
    try{
        $sql = "INSERT schedule(str_date, end_date, u_id) VALUES(:str_date, :end_date, :u_id)";
        $stm = $pdo->prepare($sql);
        if(isset($_POST["str_date1"]) || isset($_POST["end_date1"])){
            $stm->bindValue(':str_date', $_POST["str_date1"], PDO::PARAM_DATE);
            $stm->bindValue(':end_date', $_POST["end_date1"], PDO::PARAM_DATE);
            $stm->bindValue(':u_id', $_SESSION["id"], PDO::PARAM_INT);
        }
        if(isset($_POST["str_date2"]) || isset($_POST["end_date2"])){
            $stm->bindValue(':str_date', $_POST["str_date2"], PDO::PARAM_DATE);
            $stm->bindValue(':end_date', $_POST["end_date2"], PDO::PARAM_DATE);
            $stm->bindValue(':u_id', $_SESSION["id"], PDO::PARAM_INT);
        }
        if(isset($_POST["str_date3"]) || isset($_POST["end_date3"])){
            $stm->bindValue(':str_date', $_POST["str_date1"], PDO::PARAM_DATE);
            $stm->bindValue(':end_date', $_POST["end_date1"], PDO::PARAM_DATE);
            $stm->bindValue(':u_id', $_SESSION["id"], PDO::PARAM_INT);
        }
        $stm->execute();
        echo "新規の空スケジューウを登録しました。";
        $pdo = NULL;
    }catch (Exception $e){
        echo '<span class="error">エラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
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
        echo "<a href={$gotoInsert}>スケジュール入力画面へ</a>";
        ?>
    </body>
</html>