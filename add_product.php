<?php
// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "productstest";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $attributes = json_encode($_POST['attributes']); // เช่น ["สี"=>"แดง", "ขนาด"=>"M"]
    $stock = $_POST['stock'];

    // การอัปโหลดไฟล์ภาพ
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO products (name, category, price, description, image_path, attributes, stock)
            VALUES ('$name', '$category', '$price', '$description', '$target_file', '$attributes', '$stock')";

    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มสินค้าสำเร็จ!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
