<?php
require_once "../connection.php";
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/236237b42b.js" crossorigin="anonymous"></script>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/2">
            <a href="index.php"><i class="fas fa-arrow-circle-left text-3xl text-blue-700"></i></a>
            <h2 class="text-center text-blue-700 font-bold text-2xl">Thông tin tài khoản</h2>
            <?php
            foreach (selectDb("SELECT * FROM user where username='$username'") as $client) {
            ?>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="username"
                    type="text" placeholder="Username" value="<?= $client['username'] ?>">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Email
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="email" placeholder="email" name="email" value="<?= $client['email'] ?>">

            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    Phone
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    type="text" placeholder="" name="phone" value="<?= $client['phone'] ?>">

            </div>
            <?php
            }
            ?>


            <div class="flex items-center justify-between">
                <a href="changePass.php?username=<?= $username ?> "
                    class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" name="dangKy">
                    Đổi mật khẩu
                </a>
                <a class="inline-block align-baseline font-bold text-sm text-blue-400 hover:text-blue-700"
                    href="index.php">
                    Quay lại
                </a>
            </div>
        </div>
    </form>



</body>

</html>