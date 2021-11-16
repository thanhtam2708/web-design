<?php
require_once "connection.php";
if (isset($_POST['dangKy'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = 0;
    $active = 1; //trạng thái hđ
    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $check_phone = "SELECT * FROM user WHERE phone = '$phone'";
    $cout_mail = $conn->prepare($check_email);
    $cout_mail->execute();
    $cout_phone = $conn->prepare($check_phone);
    $cout_phone->execute();
    if ($cout_mail->rowCount() > 0) {
        $error = "Email này đã có người sử dụng. Vui lòng chọn Email khác! ";
    } elseif ($cout_phone->rowCount() > 0) {
        $error = "Số điện thoại này đã có người sử dụng. Vui lòng chọn Số khác khác! ";
    } else {
        $sql = "INSERT INTO user set username='$username', password='$password', email='$email', phone='$phone', role='$role', active='$active'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location:signIn.php");
        $error = "Đăng kí thành công!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/236237b42b.js" crossorigin="anonymous"></script>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/2">
            <a href="index.php"><i class="fas fa-arrow-circle-left text-3xl text-blue-700"></i></a>
            <h2 class="text-center text-blue-700 font-bold text-2xl">Đăng ký</h2>
            <?php
            if (isset($error)) { ?>
            <p class="alert alert-primary"><?= $error ?></p>
            <?php

            }
            ?>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="username"
                    type="text" placeholder="Username">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Password
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="password" placeholder="******************" name="password">

            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Email
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="email" placeholder="email" name="email">

            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Phone
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="text" placeholder="" name="phone">

            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                    name="dangKy">
                    Sign up
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-400 hover:text-blue-700"
                    href="signIn.php">
                    Already have an account?
                </a>
            </div>
        </div>
    </form>



</body>

</html>