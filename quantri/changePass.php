<?php
require_once "../connection.php";
//update password
session_start();
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    if (isset($_POST['updatePass'])) {
        $pass = $_POST['pass'];
        $passnew = $_POST['newpass'];
        $passconfirm = $_POST['confirmpass'];
        if ($passnew != $passconfirm) {
            $error = "Nhập lại mật khẩu chưa chính xác!";
        } else {
            $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$pass'";
            $check = $conn->prepare($sql);
            $check->execute();
            if ($check->rowCount() > 0) {
                action("UPDATE user SET password = '$passnew' WHERE username = '$username'");
                $error = "Đổi mật khẩu thành công!";
                header("location:index.php");
            } else {
                $error = "Mật khẩu sai vui lòng thử lại!";
            }
        }
    }
} else {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/236237b42b.js" crossorigin="anonymous"></script>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/2">
            <a href="index.php"><i class="fas fa-arrow-circle-left text-3xl text-blue-700"></i></a>
            <h2 class="text-center text-blue-700 font-bold text-2xl">Đổi mật khẩu</h2>
            <?php if (isset($error)) { ?>
            <p class="alert alert-primary"><?= $error ?></p>
            <?php
            } else {
            } ?>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Mật khẩu cũ
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="pass"
                    type="password">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Mật khẩu mới
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="password" name="newpass">

            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Nhập lại mật khẩu
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="password" name="confirmpass">

            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                    name="updatePass">
                    Đổi mật khẩu
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-400 hover:text-blue-700"
                    href="index.php">
                    Quay lại
                </a>
            </div>
        </div>
    </form>



</body>

</html>