<?php
require_once __DIR__ ."/function.php";
require_once __DIR__.'/config.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, data FROM sweetfilmbar";
    $response = array();

    try {
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            foreach ($result as $row) {
                $id = $row["id"];
                $data = json_decode($row["data"], true);
                $response[] = array("id" => $id, "data" => $data);
            }
        } else {
            $response["message"] = "ไม่พบข้อมูล";
        }
    } catch (PDOException $e) {
        $response = array("error" => "เกิดข้อผิดพลาดในการเรียกข้อมูล: " . $e->getMessage());
    }

    echo json_encode($response);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_data = json_decode(file_get_contents("php://input"), true);
    $response = array();

    if (!empty($post_data)) {
        $jsonData = json_encode($post_data);
        $sql = "INSERT INTO sweetfilmbar (data) VALUES (:data)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':data', $jsonData);
            if ($stmt->execute()) {
                $response = array("message" => "บันทึกข้อมูลเรียบร้อยแล้ว");
            } else {
                $response = array("error" => "เกิดข้อผิดพลาดในการบันทึกข้อมูล");
            }
        } catch (PDOException $e) {
            $response = array("error" => "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $e->getMessage());
        }
    } else {
        $response = array("error" => "ข้อมูลไม่ครบถ้วน");
    }

    echo json_encode($response);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $response = array();

        try {
            $sql = "DELETE FROM sweetfilmbar WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $response = array("message" => "ลบข้อมูลเรียบร้อยแล้ว");
            } else {
                $response = array("error" => "เกิดข้อผิดพลาดในการลบข้อมูล");
            }
        } catch (PDOException $e) {
            $response = array("error" => "เกิดข้อผิดพลาดในการลบข้อมูล: " . $e->getMessage());
        }
    } else {
        $response = array("error" => "ข้อมูล 'id' ไม่ถูกส่งมาทาง URL");
    }

    echo json_encode($response);
} elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    // ดึงข้อมูล JSON จากฐานข้อมูล
    $data_id = isset($_GET['id']) ? $_GET['id'] : null; // แทน 'id' ด้วยชื่อพารามิเตอร์ URL

    if ($data_id) {
        // อ่านข้อมูล JSON จากฐานข้อมูล
        $sql = "SELECT data FROM sweetfilmbar WHERE id = ?";
        $stmt = $db->$pdo->prepare($sql);
        $stmt->bind_param("i", $data_id); // ต้องใช้ i เนื่องจากเป็น integer
        $stmt->execute();
        $stmt->bind_result($json_data);
        $stmt->fetch();
        $stmt->close();

        if ($json_data !== null) {
            // แปลง JSON เป็น array
            $data_array = json_decode($json_data, true);

            // ตรวจสอบว่ามีข้อมูลที่ต้องการอัปเดต (ยกเลิกหรือเปลี่ยนค่า)
            if (isset($_REQUEST['customerStatus'])) {
                $data_array['key1'] = $_REQUEST['customerStatus'];
            }

            // แปลง array กลับเป็น JSON
            $new_json_data = json_encode($data_array);

            // อัปเดตข้อมูล JSON ในฐานข้อมูลด้วยข้อมูล JSON 
            $update_sql = "UPDATE sweetfilmbar SET data = ? WHERE id = ?";
            $stmt = $db->$pdo->prepare($update_sql);
            $stmt->bind_param("si", $new_json_data, $data_id);
            
            if ($stmt->execute()) {
                $response = array("message" => "อัปเดตข้อมูลเรียบร้อยแล้ว");
            } else {
                $response = array("error" => "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $stmt->error);
            }

            $stmt->close();
        } else {
            $response = array("error" => "ไม่พบข้อมูลสำหรับ ID ที่ระบุ");
        }
    } else {
        $response = array("error" => "ไม่ระบุ ID สำหรับการอัปเดตข้อมูล");
    }

    echo json_encode($response);
} else {
    echo json_encode(array("error" => "ไม่อนุญาตให้ใช้คำร้องขอนี้"));
}


?>