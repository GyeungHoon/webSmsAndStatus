<?php
    require_once('../common/config.php');
    header('Content-Type: application/json'); // JSON 응답임을 명시

    // 모든 출력 버퍼를 정리
    ob_clean();
    ob_start();

$sql = "SELECT * FROM phone_status_table LEFT JOIN uuid ON phone_status_table.androidId = uuid.androidId WHERE uuid.phname LIKE 'A%' ORDER BY phname ASC;";
$result = mysqli_query($conn, $sql);

    $results = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = array(
                'phone_number' => $row['phone_number'],
                'number_status' => $row['number_status'],
                'phone_status' => $row['phone_status'],
                'phname' => $row['phname'],
            );
        }
    } else {
        error_log("No records found.");
    }

    echo json_encode($results);
    ob_end_flush();

?>