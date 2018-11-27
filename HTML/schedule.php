<?php
session_start();
$logId = $_SESSION["backId"];
$_SESSION["id"] = $logId;
$gobackURL = "myInst.php";
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>スケジュール入力画面</title>
        <link rel="stylesheet" href="../CSS/schedule.css">
    </head>
    <body>
        <header>
            <h3>スケジュール入力画面</h3>
        </header>
        <div>
            <form method="POST" action="scheConfirm.php">
                <table>
                    <tr>
                        <td>空きスケジュール</td>
                        <td><input type="date" name="str_date1"> 〜 <input type="date" name="end_date1"></td>
                    </tr>
                    <tr>
                        <td>空きスケジュール</td>
                        <td><input type="date" name="str_date2"> 〜 <input type="date" name="end_date2"></td>
                    </tr>
                    <tr>
                        <td>空きスケジュール</td>
                        <td><input type="date" name="str_date3"> 〜 <input type="date" name="end_date3"></td>
                    </tr>
                    <tr>
                        <td class="submit" colspan="2"><input type="submit" value="確定"></td>
                    </tr>
                </table>
                <?php
                echo "<a href={$scheConfirm}>マイページへ</a>";
                ?>
            </form>
        </div>
    </body>
</html>