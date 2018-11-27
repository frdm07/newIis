<?php
require_once("../commonSql.php");
session_start();
$findId = $_SESSION["backId"];
$_SESSION["com_id"] = $findId;
$pdo = connectDB();
?>

<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/findUser.css">
        <title>講師検索結果</title>
    </head>
    <body>
        <header>
            <h3>
                講師検索結果
            </h3>
        </header>
        <div>
            <table border="1">
                <tr>
                    <th>氏名</th>
                    <th>スキル(言語)</th>
                    <th>連絡先</th>
                    <th>空きスケジュール</th>
                </tr>
                <?php
                    if(isset($findId)){
                        $findId = implode(",", $_POST["skill"]);
                        $result = displayOffer_Com($findUser, $_POST["str_date"], $_POST["end_date"],$pdo);
                        foreach($result as $view){
                            echo "<form method = 'POST' action = 'myPageIns.php'>";
                            echo "<tr>";
                            echo "<td><input type='submit' value='{$view['nm']}'</td>
                                <td>{$view['lang']}</td>
                                <td>{$view['str_date']}</td>
                                <td>{$view['end_date']}</td>";
                            echo "<input type='hidden' name='findId' value={$view['id']}>";
                            echo "</tr>";
                            echo "</form>";
                        }
                    }
                ?>
            </table>
        </div>
    </body>
</html>