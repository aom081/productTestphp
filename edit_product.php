<?php
$conn = new mysqli("localhost", "root", "", "your_database_name");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    // ตรวจสอบว่ามีการอัปโหลดภาพใหม่หรือไม่
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = "UPDATE products SET name='$name', price='$price', description='$description', stock='$stock', image_path='$target_file' WHERE id='$id'";
    } else {
        $sql = "UPDATE products SET name='$name', price='$price', description='$description', stock='$stock' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขสินค้าสำเร็จ!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
