<?php
require_once("../commonSql.php");
session_start();
$pdo = connectDB();
$_SESSION["u_id"] = $_SESSION["u_id"];
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>登録画面</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION["u_id"])){
                try{
                    $sql = "INSERT schedule(u_id, s_id) 
                            VALUES(:u_id, :s_id)";
                    $stm = $pdo->prepare($sql);
                    if(isset($_SESSION["u_id"]) && isset($_POST["end_date"])){
                        foreach($_POST["skill"] as $value){
                            $stm->bindValue(':u_id', $_SESSION["u_id"], PDO::PARAM_INT);
                            $stm->bindValue(':s_id', $value, PDO::PARAM_INT);
                            $stm->execute();
                        }
                    }
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
        <a href="myInst.php">マイページへ</a>
    </body>
</html>