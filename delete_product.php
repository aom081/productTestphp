<?php
$conn = new mysqli("localhost", "root", "", "your_database_name");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['ids']; // ตัวอย่าง: ["1", "2", "3"]
    $ids = implode(",", $ids); // แปลงเป็น "1,2,3"

    $sql = "DELETE FROM products WHERE id IN ($ids)";

    if ($conn->query($sql) === TRUE) {
        echo "ลบสินค้าสำเร็จ!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
