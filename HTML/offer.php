<?php
require_once("../commonSql.php");
session_start();
$logId = $_SESSION["id"];
$_SESSION["com_id"] = $logId;
$_SESSION["u_id"] = $_POST["u_id"];
$_SESSION["c_id"] = $_POST["c_id"];
$_SESSION["s_id"] = $_POST["s_id"];
$pdo = connectDB();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="baseStyle.css">
        <title>依頼作成画面</title>
    </head>
    <body>
        <?php
        echo "<h1>{$_POST['nm']}さんへオファーを作成します。</h1>"
        ?>
        <form method="POST" action="offComfirm.php">
            <table class="grade">
                <tr>
                    <td>オファーしたい期間を入力してください。</td>
                    <th></th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <table>
                            <tr>
                                <td><input type="date" name="str_date"> 〜 <input type="date" name="end_date"></td>
                            </tr>
                        </table>
                    </td>
                </tr>      
            </table>
            <table class="grade">
                <tr>
                    <td>依頼内容</td>
                </tr>
                <tr>
                    <td>
                        <textarea name="message" placeholder="依頼内容を入力してください" class="meMo" cols="50" rows="4"></textarea>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <input type="submit" value="この講師にオファーする" class="exebutton">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>