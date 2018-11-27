<?php
$date = date("Y/m/d");
function connectDB(){
    $user ='root';
    $password ='mariadb';
    $dbName ='test_db1';
    $host ='localhost:3306';
    $dsn ="mysql:host={$host};dbname={$dbName};charset=utf8";
    try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        $pdo = NULL;
    } catch (Exception $e) {
        echo '<span class="error">エラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

//SQL実行
function exeSQL($stm){
    try{
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの実行でエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 名前、スキル（講師マイページ）
function nameAndSkill($ID, $pdo){
    $sql = "SELECT ins.nm, sk.lang, sk.id FROM instructor ins
    INNER JOIN skill_user sk_u ON ins.id = sk_u.u_id
    INNER JOIN skill sk ON sk.id = sk.s_id WHERE ins.loginId = :id";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 平均評価（講師マイページ）
function getAverage($ID, $pdo){
    $sql = "SELECT avg(evalution.results) as evaAvg FROM instructor ins
    INNER JOIN evalution eva ON ins.id = eva.u_id
    WHERE ins.loginId = :id
    GROUP BY eva.u_id";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 言語選択プルダウンリスト
function getPullDownList($pdo){
    $sql = "SELECT id,lang FROM skill";
    try{
        $stm = $pdo->prepare($sql);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 講師マイページ　依頼表示
function displayOffer_Ins($ID, $pdo){

    $sql = "SELECT of.id, of.limit_date, ins.nm as insNm, of.contents, 
    app.val, com.nm as comNm, skill.lang, com.tel
    FROM offer of
    INNER JOIN instructor ins ON of.u_id = ins.id
    INNER JOIN approval app ON of.app_id = app.id
    INNER JOIN company com ON of.c_id = com.id
    INNER JOIN skill sk ON of.s_id = sk.id
    WHERE ins.loginId = :id
    AND of.complete_id = 2
    AND of.app_id = 1
    AND of.limit_date >= :lim"; 
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $stm->bindValue(':lim',$date,PDO::PARAM_DATE);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 企業マイページ　依頼表示
function displayOffer_Com($ID, $pdo){
    $sql = "SELECT ins.id as u_id, com.id as c_id, ins.tel, of.order_date, of.limit_date, ins.nm as insNm, of.contents, 
    app.val as appVal, comp.val as compVal
    FROM offer of
    INNER JOIN instructor ins ON of.u_id = ins.id
    INNER JOIN approval app ON of.app_id = app.id
    INNER JOIN complete comp ON of.complete_id = comp.id
    INNER JOIN company com ON of.c_id = com.id
    WHERE com.loginId = :id
    AND of.limit_date >= :lim";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $stm->bindValue(':lim',$date,PDO::PARAM_DATE);
        $result = exeSQL($stm);
    return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 空き日程表示
function displayVoid($ID, $pdo){
    $sql = "SELECT sche.str_date, sche.end_date FROM instructor ins
    INNER JOIN schedule sche ON ins.id = sche.u_id 
    WHERE ins.loginId = :id";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$ID,PDO::PARAM_INT);
        $result = exeSQL($stm);
    return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

// 講師検索
function findUser($skillId, $str, $end, $pdo){
    $sql = "SELECT ins.nm, sk.lang, sch.str_date, sch.end_date
            FROM instructor ins
            INNER JOIN skill_user sk_u ON ins.id = sk_u.u_id
            INNER JOIN schedule sch ON ins.id = sch.u_id
            INNER JOIN skill sk ON sk.id = sk_u.s_id
            WHERE sk_u.s_id IN(:id)
            AND sch.str_date <= :str_date
            AND sch.end_date >= :end_date
            GROUP BY ins.id";
    try{
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id',$skillId,PDO::PARAM_STR);
        $stm->bindValue(':str_date',$str, PDO::PARAM_DATE);
        $stm->bindValue(':end_date',$end, PDO::PARAM_DATE);
        $result = exeSQL($stm);
        return $result;
    } catch (Exception $e) {
        echo '<span class="error">SQLの構文にエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}
?>
