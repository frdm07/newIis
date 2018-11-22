<?php
    require_once("../commonSql.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/baseStyle.css">
        <?php
        $pdo = connectDB();
        $userInfo = nameAndSkill($_POST['u_id'], $pdo);
        echo "<title>{$userInfo[0]['nm']} さんのマイページ</title>"; 
        ?>
    </head>
    <body>
        <?php
        echo "<h1>
            <table>
                <tr><td>{$userInfo[0]['nm']}</td>
                    <td class='stitle'>評価</td>
                    <td>";
        $pdo = connectDB();
        $Ave = getAverage($_POST['u_id'], $pdo);  
        echo "{$Ave}";            
        echo       "</td>
                    <td>
                        <form method='POST' action='hyoka.html'>
                            <input type='hidden' name='u_id' value='{$_POST['u_id']}'>
                            <input type='hidden' name='u_nm' value='{$userInfo[0]['nm']}'>
                            <input type='submit' value='この講師を評価する' class='minbutton'>
                        </form>
                    </td>
                </tr>
            </table>
        </h1>
        <table class='grade'>
            <tr><th>経験言語</th>
                <th></th></tr><tr><td>";
        for($i=0;$i<17;$i++){
            echo "  {$userInfo[$i]['lang']}";
        }
        echo "    </td><tr><td></td>
                <td colspan='2' rowspan='2'>Java</td></tr>      
        </table>
        <table class='grade'>
            <tr><th>
            空き日程</th>
                <th></th></tr>
            <tr><td></td><td>
                <table class='schedule' border='3'>
                    <tr><th>開始日</td><td>終了日</th></tr>";
        $pdo = connectDB();
        $sche = displayVoid($_POST['u_id'], $pdo);
        $count=0;
        foreach($sche as $date){
            echo "<tr><td>{$date[$count]['str_date']}</td><td>~</td><td>{$date[$count]['end_date']}</td></tr>";
            $count++;
        }   
        echo "</table>
        </table>
        <table>
            <tr>
                <td>
                    <form method='POST' action='offer.php'>
                        <input type='hidden' name='u_id' value='{$_POST['u_id']}'>
                        <input type='hidden' name='c_id' value='{$_SESION['com_id']}'>
                        <input type='hidden' name='s_id' value='{$userInfo[0]['id']}'>>
                        <input type='submit' value='この講師にオファーする' class='minbutton'>
                    </form>
                </td>   
            </tr>
        </table>";
        ?>
    </body>
</html>