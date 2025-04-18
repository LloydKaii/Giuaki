<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    // Xử lý ảnh
    $target_dir = "uploads/"; // Thư mục lưu ảnh
    $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
    move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);

    // Thêm vào database
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$target_file', '$MaNganh')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location='index.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center">Thêm Sinh Viên</h2>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Mã Sinh Viên:</label>
            <input type="text" class="form-control" name="MaSV" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Họ Tên:</label>
            <input type="text" class="form-control" name="HoTen" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <select class="form-control" name="GioiTinh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh:</label>
            <input type="date" class="form-control" name="NgaySinh" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mã Ngành:</label>
            <input type="text" class="form-control" name="MaNganh" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình Đại Diện:</label>
            <input type="file" class="form-control" name="Hinh" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
