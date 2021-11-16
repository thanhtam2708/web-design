<?php
session_start();
require_once "../connection.php";
$view = 1;
//hiển thị chi tiết sp 
if (isset($_GET['pro_id'])) {
    $pro_id =   intval($_GET['pro_id']);
    $sql = "SELECT * from products inner join categories on products.cate_id = categories.cate_id where pro_id = '$pro_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $pro = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sqlInsert = "UPDATE products set view=view+1 where pro_id = $pro_id ";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->execute();
}
//hiển thị sản phẩm liên quan
if (isset($_GET['cate_id'])) {
    $cate = $_GET['cate_id'];
    $sql = "SELECT * FROM products where cate_id ='$cate'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $product1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//hiển thị info
$sql = "SELECT * FROM info";
$stmt = $conn->prepare($sql);
$stmt->execute();
$info = $stmt->fetchAll(PDO::FETCH_ASSOC);

//comment
if (isset($_SESSION['username']) && isset($_POST['cmt'])) {
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $date = date("Y/m/d h:i:sa");
    $user = $_SESSION['username'];
    $content = $_POST['content'];
    foreach (selectDb("SELECT * FROM user WHERE username = '$user'") as $row) {
        $id_user = $row['user_id'];
    }
    action("INSERT INTO comment (content,user_id,pro_id,create_at) VALUES ('$content','$id_user','$pro_id','$date')");
} elseif (isset($_SESSION['admin']) && isset($_POST['cmt'])) {
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $date = date("Y/m/d h:i:sa");
    $user = $_SESSION['admin'];
    $content = $_POST['content'];
    foreach (selectDb("SELECT * FROM user WHERE username = '$user'") as $row) {
        $id_user = $row['user_id'];
    }
    action("INSERT INTO comment (content,user_id,pro_id,create_at) VALUES ('$content','$id_user','$pro_id','$date')");
} elseif (!isset($_SESSION['username']) && isset($_POST['cmt'])) {
    echo "<script>alert('Vui lòng đăng nhập trước khi bình luận!')</script>";
}
//xóa cmt
if (isset($_GET['cmt_id'])) {
    $id_cmt = $_GET['cmt_id'];
    action("DELETE FROM comment WHERE cmt_id = '$id_cmt'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết</title>
    <link href="./tailwind.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/236237b42b.js" crossorigin="anonymous"></script>
</head>

<body>

    <!--header-->
    <header>
        <div class="container mx-auto">
            <div class="flex grid items-center grid-cols-8">
                <div class="col-span-2"><a href="index.php"><img src="../images/logo1.png" alt="" width="250"></a></div>
                <div class="col-span-4">
                    <form action="" method="post"><input type="text" name="" id=""
                            placeholder="Nhập từ khóa tìm kiếm....."
                            class="w-9/12 px-4 py-2 border border-solid"><button type="submit"
                            class="px-4 py-2 text-white bg-red-600 border border-solid">Tìm kiếm</button></form>
                </div>
                <div class="col-span-2 ">
                    <nav class="flex">
                        <li class="list-none"><a href="" class="text-center"><i class="fas fa-shopping-cart"></i>Giỏ
                                hàng </a></li>
                        <?php
                        if (isset($_SESSION['username']) || isset($_SESSION['admin'])) {

                            if (isset($_SESSION['admin'])) {
                                $data = "<li class='list-none px-4'><a href='./indexQT.php'
                                class=' hover:text-red-600'>" . $_SESSION['admin'] . "</a>
                        </li>";
                            } else {
                                $data = "<li class='list-none px-4'><a href='./indexQT.php' class=' hover:text-red-600'>" . $_SESSION['username'] . "</a>
                                </li>";
                            }
                        ?>

                        <?= $data ?>
                        <li class="list-none px-4"><a href="../signOut.php"
                                onclick="return alert('Bạn chắc chắn muốn đăng xuất chứ ?')"
                                class="hover:text-red-600">Đăng xuất</a>
                        </li>
                        <?php
                        } else {
                        ?>
                        <li class="list-none "><a href="../signIn.php"
                                class="pl-4 flex items-center hover:text-red-600"><i class="fas fa-sign-in-alt"></i>
                                <p class="px-2">Đăng nhập</p>
                            </a></li>
                        <li class="list-none "><a href="../signUp.php"
                                class="pl-4 flex items-center hover:text-red-600"><i class="fas fa-user-plus"></i>
                                <p class="px-2">Đăng kí</p>
                            </a></li>
                        <?php
                        }
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!--menu-->
    <section class="bg-yellow-500">
        <div class="container mx-auto ">

            <ul class="flex p-3">
                <li class="px-8 text-lg text-white uppercase hover:font-bold hover:underline"><a href="index.php"
                        class="">Trang
                        chủ</a></li>
                <li class="px-8 text-lg text-white uppercase hover:font-bold hover:underline"><a href="">Giới
                        thiệu</a></li>
                <li class="px-8 text-lg text-white uppercase hover:font-bold hover:underline"><a href="">Sản
                        phẩm</a></li>
                <li class="px-8 text-lg text-white uppercase hover:font-bold hover:underline"><a href="">Tin
                        tức</a></li>
                <li class="px-8 text-lg text-white uppercase hover:font-bold hover:underline"><a href="">Liên
                        hệ</a></li>
                <?php
                if (isset($_SESSION['admin'])) {
                ?>
                <li class="px-8 text-lg text-white uppercase hover:font-bold hover:underline"><a href="indexQT.php"
                        class=" hover:text-red-600">Quản trị</a></li>
                <?php
                } else {
                ?>
                <?php
                }
                ?>
            </ul>
        </div>

    </section>
    <!--content-->
    <?php foreach ($pro as $pro) : ?>
    <section class="">
        <div class="container mx-auto p-4 ">

            <p class="text-3xl"><?= $pro['pro_name'] ?></p>
            <span class="flex items-center border-b border-gray-300 pb-3">
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
            </span>

        </div>
    </section>
    <section class="">
        <div class="container mx-auto ">
            <div class="grid grid-cols-10 gap-5">
                <div class="col-span-4 ">
                    <a href="">
                        <img src="../upload/<?= $pro['pro_img'] ?>" alt="" class="p-4 w-full">
                    </a>
                    <span class="flex items-center p-4 ml-40">
                        <i class="fas fa-search text-xs"></i>
                        <p class="px-2 text-xs ">Click hoặc dê chuột vào ảnh để phóng to</p>
                    </span>
                    <div class="flex ml-32">
                        <span class="px-4">
                            <a href="">
                                <i class="fas fa-sync border border-solid p-4 text-2xl"></i>
                                <p class="text-xs text-center">Ảnh 360 độ</p>
                            </a>
                        </span>
                        <span class="px-4">
                            <a href="">
                                <i class="fas fa-box-open border border-solid p-4 text-2xl"></i>
                                <p class="text-xs text-center">Mở hộp</p>
                            </a>
                        </span>
                        <span class="px-4">
                            <a href="">
                                <i class="fas fa-video border border-solid p-4 text-2xl"></i>
                                <p class="text-xs text-center">Video</p>
                            </a>
                        </span>
                        <span class="px-4">
                            <a href="">
                                <i class="fas fa-images border border-solid p-4 text-2xl"></i>
                                <p class="text-xs text-center">Xem ảnh</p>
                            </a>
                        </span>
                    </div>
                </div>

                <div class="col-span-4">
                    <div class="p-4">

                        <div class="flex">
                            <p class="font-bold text-2xl"><?= $pro['price'] ?>đ</p>
                            <a href="" class="w-auto h-auto bg-red-500 px-2 py-1 ml-4 rounded text-white">Trả
                                góp 0%</a>
                        </div>
                        <div>
                            <a href=""
                                class="flex items-center border border-solid border-gray-300 mt-3 bg-gray-100 p-2">
                                <i class="fas fa-stream text-red-600"></i>
                                <i class="fas fa-stopwatch text-red-600 text-xl pr-2"></i>
                                <p class="px-2 uppercase">Giao hàng trên 63 tỉnh thành</p>
                            </a>
                        </div>
                        <div class="border border-dashed">
                            <p class="border-b border-dashed bg-green-500 text-white font-bold p-1">Chi tiết sản phẩm
                            </p>
                            <nav class="p-4">
                                <?= $pro['detail'] ?>
                            </nav>
                        </div>

                        <div class="mt-5">
                            <div class="relative">
                                <img src="https://fptshop.com.vn/Uploads/images/2015/Voucher/Black%20Friday%202020/Detail-pc.png"
                                    alt="" class="w-full">
                                <div class="absolute bottom-0 left-0 mb-3 ml-5">
                                    <form action="" class="flex mb-2 ">
                                        <input type="text" name="" id="" placeholder="Nhập số điện thoại......."
                                            class="border border-solid p-2 rounded bg-white w-10/12">
                                        <a href="" class="uppercase bg-red-600 text-white p-1 rounded ">Nhận
                                            mã</a>
                                    </form>
                                    <span class="flex">
                                        <p class="text-white">Bạn đã có mã giảm giá ? <a href=""
                                                class="text-blue-700">Sử dụng ngay</a></p>
                                        <p>
                                            <a href="" class="text-blue-700 ml-40">Xem thêm >></a>
                                        </p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="border border-solid border-gray-100 bg-gray-100 rounded p-2 flex items-center">
                                <img src="image/moca.jpg" alt="" class="w-20 px-2">
                                <span class="">Hoàn tiền 10% tối đa 250.000 Khi thanh toán qua Ví Moca trên ứng
                                    dụng Grab. <a href="" class="text-blue-500">Xem chi tiết</a> </span>
                            </div>
                        </div>
                        <div class="mt-5 text-center border border-solid border-red-600 bg-red-600 rounded-sm">
                            <a href="" class="">
                                <p class="text-white text-xl py-2 uppercase"> Mua ngay</p>
                                <p class="text-white pb-2">Giao hàng trong 1 giờ hoặc nhận tại shop</p>
                            </a>
                        </div>
                        <div class="mt-5 flex justify-between">
                            <div class="text-center border border-solid border-blue-900 bg-blue-900 rounded-sm  px-2">
                                <a href="">
                                    <p class="text-white text-xl py-2 uppercase px-4">Trả góp 0%</p>
                                    <p class="text-white pb-2 px-4">Xét duyệt danh qua điện thoại</p>
                                </a>
                            </div>
                            <div
                                class="text-center border border-solid border-blue-900 bg-blue-900 rounded-sm w-2/5 px-2">
                                <a href="">
                                    <p class="text-white text-xl py-2 uppercase px-4">Trả góp qua thẻ</p>
                                    <p class="text-white pb-2 px-4">Visa, Master Card, JCB</p>
                                </a>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <span class="flex text-center text-xl">Gọi <p class="text-red-600 px-1 font-medium">
                                    1800-6601</p> để được tư vấn
                                mua hàng (Miễn phí)
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 border-l border-gray-300">
                    <div class="p-4 ">
                        <p class="font-bold">Shop cam kết :</p>
                        <div class="flex items-center py-2">
                            <i class="fas fa-medal text-red-600 px-2"></i>
                            <p>Hàng chính hãng</p>
                        </div>
                        <div class="flex items-center py-2">
                            <i class="fas fa-check-circle px-2 text-red-600"></i>
                            <p>Đổi hàng trong 7 ngày</p>
                        </div>
                        <div class="flex items-center py-2">
                            <i class="fas fa-shipping-fast px-2 text-red-600"></i>
                            <p>Giao hàng trên 63 tỉnh thành</p>
                        </div>

                        <div class="mt-5">
                            <a href="" class="flex items-center border border-solid p-2 rounded">
                                <i class="fas fa-map-marker-alt px-2 text-blue-900"></i>
                                <p class="text-blue-900">Tìm shop có hàng gần nhất </p>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach; ?>
    <!--comment-->
    <section class="container mx-auto mt-5">
        <h3 class="text-2xl pb-5">Đánh giá sản phẩm</h3>
        <form action="" method="post">
            <textarea name="content" id="" cols="130" rows="5" class="border border-solid border-black px-4 py-2"
                placeholder="Viết bình luận..."></textarea>
            <br>
            <button type="submit" name="cmt" class="border border-solid px-8 py-2 bg-red-500 text-white">Gửi</button>
        </form>

        <div class="py-5">
            <?php
            foreach (selectDb("SELECT * FROM comment WHERE pro_id = '$pro_id' ORDER BY cmt_id DESC") as $row) {
                $id_user = $row['user_id'];
                foreach (selectDb("SELECT * FROM user WHERE user_id= '$id_user'") as $tow) {
            ?>
            <div>
                <b><span><?= $tow['username'] ?></span></b>
                <h5 style="color: #757575;"><?= $row['content'] ?></h5>
                <small>Date : <?= $row['create_at'] ?></small>
                <?php
                        if (isset($_SESSION['username'])) {
                            if ($tow['username'] == $_SESSION['username']) { ?>
                <a href="product_detail.php?pro_id=<?= $pro_id ?>&cate=<?= $cate ?>&cmt_id=<?= $row['cmt_id'] ?>"
                    style="font-size:10px">Xóa</a>
                <?php

                            }
                        } else if (isset($_SESSION['admin']))
                            if ($tow['username'] == $_SESSION['admin']) { ?>
                <a href="product_detail.php?pro_id=<?= $pro_id ?>&cate=<?= $cate ?>&cmt_id=<?= $row['cmt_id'] ?>"
                    style="font-size:10px">Xóa</a>
                <?php
                            }
                        ?>
                <hr>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
    <!--sp liên quan-->
    <section class="mt-5">
        <div class="container mx-auto">
            <nav class=" border-b border-gray-300 py-2">
                <a href="" class="px-2 text-xl hover:underline">Sản phẩm liên quan</a>
            </nav>
            <div class="grid grid-cols-5 gap-5 mt-5">
                <?php foreach ($product1 as $product) : ?>
                <div class="p-2">
                    <a href="product_detail.php?pro_id=<?= $product['pro_id'] ?>&cate_id=<?= $product['cate_id'] ?>">
                        <img src="../upload/<?= $product['pro_img'] ?>" alt="">
                    </a>
                    <a href="">
                        <h3 class=""><?= $product['pro_name'] ?></h3>
                    </a>
                    <a href="" class="text-red-600 font-bold text-lg"><?= $product['price'] ?>đ</a><br>
                    <a href="" class="flex items-center">
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <hr>
    <!--footer-->
    <footer class="pt-10">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 gap-8">
                <!--Col 1-->
                <?php foreach ($info as $info) : ?>
                <div>

                    <a href=""><img src="../upload/<?= $info['logo'] ?>" alt="" width="250"></a>

                </div>
                <!--Col 3-->
                <div class="">
                    <h2 class="text-3xl font-medium">Thông tin liên hệ</h2>
                    <nav>

                        <li class="py-2 list-none ">
                            <b>Địa chỉ : <?= $info['address'] ?></b>

                        </li>
                        <li class="py-2 list-none">
                            <b>Điện thoại: <?= $info['phone'] ?> </b>
                        </li>
                        <li class="py-2 list-none">
                            <b>Email: <?= $info['email'] ?></b>
                        </li>

                    </nav>
                    <?php endforeach; ?>
                </div>
                <!--Col 3-->
                <div>
                    <h2 class="text-3xl font-medium">Đăng kí nhận tin</h2>
                    <form action="" class="py-2">
                        <input type="text" placeholder="Nhập email của bạn"
                            class="w-full px-4 py-2 border border-solid border-gray-500">
                        <button type="submit" class="px-4 py-2 text-white bg-red-600 border border-solid">Đăng
                            kí</button>
                    </form>
                </div>
                <!--Col 4-->
                <div>
                    <h2 class="text-3xl font-medium">Kết nối với chúng tôi</h2>
                    <ul class="flex py-2">
                        <li class="px-2">
                            <a href=""><i class="text-2xl text-blue-600 fab fa-facebook-f"></i></a>
                        </li>
                        <li class="px-2">
                            <a href=""><i class="text-2xl text-red-600 fab fa-youtube"></i></a>
                        </li>
                        <li class="px-2">
                            <a href=""><i class="text-2xl text-pink-700 fab fa-instagram"></i></a>
                        </li>
                        <li class="px-2">
                            <a href=""><i class="text-2xl text-blue-500 fab fa-skype"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>