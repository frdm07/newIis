<?php
require_once("../commonSql.php");
session_start();
$_SESSION["u_id"] = $_POST["findId"];
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            言語入力
        </title>
    </head>
    <body>
        <h1>使用可能な言語を入力してください。</h1>
        <form method="POST" action="InsertSkill.php">
            <select name="skill[]" multiple>
                <?php
                $result = getPullDownList($pdo);
                foreach($result as $view){
                    echo "<option value='{$view['id']}'>{$view['lang']}</option>";
                }
                ?>
            </select>
            <input type="sumbit" value="送信">
        </form>
    </body>
</html>