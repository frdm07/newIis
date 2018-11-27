<?php
require_once("../commonSql.php");
session_start();
$pdo = connectDB();
$logid = $_SESSION["com_id"];
$_SESSION["backId"] = $logid;
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/mypage.css">
        <title>マイページ</title>
    </head>
    <body>
        <header>
            <a href="">ログアウト</a>
            <h3>マイページ</h3>
        </header>
        <div>
            <h2>依頼状況</h2>
            <table border="1">
                <tr>
                    <th>発行日</th>
                    <th>有効期限</th>
                    <th>依頼先</th>
                    <th>連絡先</th>
                    <th>メモ</th>
                    <th>状態</th>
                    <th>完了情報</th>
                </tr>
                <tr>
                    <?php
                        if(isset($logid)){
                            $result = displayOffer_Com($logid,$pdo);
                            if(!isset($result)){
                                echo "<tr><td colspan='7'>現在オファーはありません。<td></tr>";
                            }else{
                                foreach($result as $view){
                                    echo "<form method = 'POST' action = 'myPageIns.php'>";
                                    echo "<tr>";
                                    echo "<td>{$view['order_date']}</td>
                                        <td>{$view['limit_date']}</td>
                                        <td><input type='submit' value='{$view['insNm']}'</td>
                                        <td>{$view['tel']}</td>
                                        <td>{$view['contents']}</td>
                                        <td>{$view['appVal']}</td>
                                        <td>{$view['compVal']}</td>";
                                    echo "<input type='hidden' name='c_id' value={$view['c_id']}>";
                                    echo "<input type='hidden' name='u_id' value={$view['u_id']}>";
                                    echo "</tr>";
                                    echo "</form>";
                                }
                            }
                        }
                    ?>
                </tr>
            </table>
        </div>
        <form method="POST" action="findUser.php">
            <table>
                <tr>
                    <td colspan="2">講師を検索</td>
                </tr>
                <tr>
                    <td>要求スキル</td>
                    <td>
                        <select name="skill[]" multiple>
                            <?php
                            $result = getPullDownList($pdo);
                            foreach($result as $view){
                                echo "<option value='{$view['id']}'>{$view['lang']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>依頼日程</td>
                    <td><input type="date" name="str_date"> 〜 <input type="date" name="end_date"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="検索"></td>
                </tr>
            </table>
        </form>
    </body>
</html>