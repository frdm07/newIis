<?php
require_once("../commonSql.php");
session_start();
$pdo = connectDB();
$logid = $_SESSION["ins_id"];
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
            <a href="top.html">ログアウト</a>
            <h3>マイページ</h3>
        </header>
        <table border="3">
            <tr>
                <td>
                    <table class="pro" border="2">
                        <tr>
                            <td>氏名：</td>
                            <?php
                                if(isset($logid)){
                                    $result = nameAndSkill($logid,$pdo);
                                    echo "<td>{$result[0]['nm']}</td>";
                                    echo "</tr><tr><td>スキル（言語）：</td>";
                                    echo "<td>";
                                    foreach($result as $view){
                                        echo "{$view['lang']} ";
                                    }
                                    echo "</td>";
                                }
                            ?>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                評価<br>
                                <?php
                                if(isset($logid)){
                                    $result = getAverage($logId,$pdo);
                                    echo "<h3>{$result[0]['evaAvg']} 点</h3>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        
            <div>
                <h2>依頼状況</h2>
                <table border="1">
                    <tr>
                        <th>依頼元（氏名）</th>
                        <th>要求スキル</th>
                        <th>連絡先</th>
                        <th>メモ</th>
                        <th>有効期限</th>
                        <th>承認/未承認</th>
                        <th>確定ボタン</th>
                    </tr>
                    <?php
                        if(isset($logid)){
                            $result = displayOffer_Ins($logid,$pdo);
                            if($result == null){
                                    echo "<tr><td colspan='7'>現在オファーはありません。<td></tr>";
                                }else{
                                foreach($result as $view){
                                    echo "<form method = 'POST' action = 'shonin.php'>";
                                    echo "<tr>";
                                    echo "<td>{$view['comNm']}</td>
                                        <td>{$view['lang']}</td>
                                        <td>{$view['tel']}</td>
                                        <td>{$view['contents']}</td>
                                        <td>{$view['limit_date']}</td>
                                        <td><input type='radio' name='approval' value='2' checked='checked'>承認/
                                        <input type='radio' name='approval' value='3'>拒否</td>";
                                    echo "<input type='hidden' name='findId' value={$view['id']}>";
                                    echo "<td><input type='submit' value='確定'></td>";
                                    echo "</tr>";
                                    echo "</form>";
                                }
                            }
                            echo "<form method='POST' action='InputSkill.php'>";
                            echo "<h3><input type='submit' vaklue='スキル入力画面へ'></h3>";
                            echo "<input type='hidden' name='findId' value={$view['id']}>";
                        }
                    ?>
                </table>
                </form>
            </div>
        <a href="schedule.php">スケジュール入力画面へ</a>
    </body>
</html>