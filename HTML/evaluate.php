<?php
    session_start();
    require_once("../commonSql.php");
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="baseStyle.css">
        <title>評価入力画面</title>
    </head>
    <body>
        <?php
        echo "<h3>{$_POST['u_nm']} さんを評価します</h3>";
        ?>
        <form type="POST" action="completeEva.html">
            <table>
                <tr>
                    <td><select name="value">
                            <option value="">選択してください</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>  
                    </td>
                    <td>
                        <input type='hidden' name='u_id' value=$_POST['u_id']>
                        <input type='hidden' name='u_nm' value=$_POST['u_nm']>
                        <input type="submit" value="確定" class="regiButton">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>