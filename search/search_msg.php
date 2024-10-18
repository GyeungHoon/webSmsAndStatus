<?php 
require_once('../common/config.php');
header('Content-Type: application/json'); // JSON 응답임을 명시

// 모든 출력 버퍼를 정리
ob_clean();
ob_start();

//테스트 임의 값 생성
// $name = isset($_GET['name']) ? $_GET['name'] : 'test1';
// $msgval = isset($_GET['msgval']) ? $_GET['msgval'] : '';

// 디버깅 메시지를 error_log로 기록
// error_log("name: $name");
// error_log("msgval: $msgval");



// var_dump($name); // 전체 배열 상태 확인
// var_dump($_GET[name]); // 전체 배열 상태 확인


$sql_val_select = "SELECT * FROM member WHERE `name` = '$_GET[name]'";
// var_dump($sql_val_select); // 전체 배열 상태 확인

// 디버깅 메시지를 error_log로 기록
// error_log("sql_val_select: $sql_val_select");

// 쿼리 실행 실패 시 데이터베이스 연결 종료 추가
$result_val_select = mysqli_query($conn, $sql_val_select);
if (!$result_val_select) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    ob_end_flush();
    mysqli_close($conn);
    exit();
}



// error_log("result_val_select: " . (mysqli_num_rows($result_val_select) > 0 ? 'Results found' : 'No results found'));


$rs_val_select = mysqli_fetch_array($result_val_select);
if ($rs_val_select) {
    // error_log("\$rs_val_select['state']: " . $rs_val_select['state']);
} else {
    // error_log("No results found for the query: $sql_val_select");
}

$sql = "SELECT
    M.`date` AS RESULT1, M.`from` AS RESULT2, M.`to` AS RESULT3, 
    COALESCE(U.`phname`, M.`androidId`) AS RESULT4, M.`message` AS RESULT5
    FROM maintable AS M
    LEFT JOIN uuid AS U ON M.`androidId` IS NOT NULL AND M.`androidId` = U.`androidId`
    WHERE DATE_ADD(NOW(), INTERVAL -10 MINUTE) <= DATE_FORMAT(M.`date`, '%Y-%m-%d %T')";

if ($msgval != "") {
    $sql .= " AND (M.`message` LIKE '%" . $msgval . "%' OR M.`from` LIKE '%" . $msgval . "%' OR M.`to` LIKE '%" . $msgval . "%')";
}


// 결과를 JSON으로 출력 (최하단에 중복 코드가 있어 삭제)
// echo json_encode($results);

// $rs_val_select['state'] = '카카오톡';  // 테스트 임의값 입력
// var_dump($results); // 전체 배열 상태 확인

// state(키워드)가 있가면 해당 키워드로 필터링 하는 쿼리문 추가
if (isset($rs_val_select['state'])) {
    $sql .= " AND M.`message` LIKE '%" . $rs_val_select['state'] . "%' ORDER BY M.no DESC";
}


// 디버깅을 위한 쿼리 출력
// error_log("Final query: $sql");

// 쿼리 실행 후 데이터베이스 연결 종료 추가
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    ob_end_flush();
    mysqli_close($conn);
    exit();
}

$results = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = array(
            'RESULT1' => $row['RESULT1'],
            'RESULT2' => $row['RESULT2'],
            'RESULT3' => $row['RESULT3'],
            'RESULT4' => $row['RESULT4'],
            'RESULT5' => $row['RESULT5'],
        );
    }
} else {
    error_log("No records found.");
}


// rs_val_select 값 디버깅
// var_dump($results); // 전체 배열 상태 확인

echo json_encode($results);
ob_end_flush();
?>
