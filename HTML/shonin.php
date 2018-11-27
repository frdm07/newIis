<?php
require_once("../commonSql.php");
$pdo = connectDB();
$logId = $_SESSION["backId"];
$_SESSION["ins_id"] = $logId;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>承認</title>
</head>
<body>
    <h1>承認しました。</h1>
    <a href="myInst.php">マイページへ</a>
    <?php
    try{
        $sql = "UPDATE offer SET app.id = :id where id = :findId";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id', $_POST["approval"], PDO::PARAM_INT);
        $stm->bindValue(':findId', $_POST["findId"], PDO::PARAM_INT);
        $stm->execute();
        $pdo = NULL;
    }catch (Exception $e){
        echo '<span class="error">エラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
    ?>
</body>
</html>