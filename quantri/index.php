<?php
require_once "../connection.php";
//hiển thị  danh mục 
$sql = "SELECT * from categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll(PDO::FETCH_ASSOC);

//hiển thị sản phẩm
$sql = "SELECT * from products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pro = $stmt->fetchAll(PDO::FETCH_ASSOC);

//hiển thị slider
$sql = "SELECT * from slider";
$stmt = $conn->prepare($sql);
$stmt->execute();
$slider = $stmt->fetchAll(PDO::FETCH_ASSOC);

//top sp yêu thích
$sql = "SELECT * FROM products ORDER BY view DESC LIMIT 0,4";
$stmt = $conn->prepare($sql);
$stmt->execute();
$view = $stmt->fetchAll(PDO::FETCH_ASSOC);

//hiển thị info
$sql = "SELECT * FROM info";
$stmt = $conn->prepare($sql);
$stmt->execute();
$info = $stmt->fetchAll(PDO::FETCH_ASSOC);

//hiển thị sp giảm giá 
$sqlSale = "SELECT * FROM products ORDER BY sale DESC LIMIT 0,4";
$stmt = $conn->prepare($sqlSale);
$stmt->execute();
$sale = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M Shop</title>
    <link href="./tailwind.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/236237b42b.js" crossorigin="anonymous"></script>
    <style>
    .image {
        width: 100%;
        height: 200px;
    }

    .images {
        overflow: hidden;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 550px;
    }

    .images-inner {
        width: 500%;
        transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
        transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000);
        animation: slide 12300ms infinite;
    }

    .image-slide {
        width: 20%;
        float: left;
        transition: all 0.5s ease-out;
    }

    /* Move slides overflowed container */
    #slide1:checked~.images .images-inner {
        margin-left: 0;
    }

    #slide2:checked~.images .images-inner {
        margin-left: -100%;
    }

    #slide3:checked~.images .images-inner {
        margin-left: -200%;
    }

    /* Calculate AUTOPLAY for BULLETS */
    @keyframes bullet {

        0%,
        33.32333333333334% {
            background: red;
        }

        33.333333333333336%,
        100% {
            background: gray;
        }
    }

    @keyframes slide {

        0%,
        25.203252032520325% {
            margin-left: 0;
        }

        33.333333333333336%,
        58.53658536585366% {
            margin-left: -100%;
        }

        66.66666666666667%,
        91.869918699187% {
            margin-left: -200%;
        }
    }

    @keyframes caption {

        0%,
        33.32333333333334% {
            opacity: 1;
        }

        33.333333333333336%,
        100% {
            opacity: 0;
        }
    }
    </style>
</head>

<body>
    <!--header-->
    <header class="sticky top-0 bg-white border-b z-10">
        <div class="container mx-auto">
            <div class="flex grid items-center grid-cols-8">
                <div class="col-span-2"><a href="index.php"><img src="../images/logo1.png" alt="" width="250"></a></div>
                <div class="col-span-4">
                    <form action="" method="get">
                        <input type="text" name="pro_name" id="" placeholder="Nhập từ khóa tìm kiếm....."
                            class="w-9/12 px-4 py-2 border border-solid">
                        <button type="submit" class="px-4 py-2 text-white bg-red-600 border border-solid">Tìm
                            kiếm</button>
                    </form>
                </div>
                <div class="col-span-2 ">
                    <nav class="flex">
                        <li class="list-none"><a href="" class="text-center"><i class="fas fa-shopping-cart"></i>Giỏ
                                hàng </a></li>
                        <?php session_start();
                        if (isset($_SESSION['username']) || isset($_SESSION['admin'])) {

                            if (isset($_SESSION['admin'])) {
                                $data = "<li class='list-none px-4'><a href='./indexQT.php'
                                class=' hover:text-red-600'>" . $_SESSION['admin'] . "</a>
                        </li>";
                            } else {
                                $data = "<li class='list-none px-4'><a href='./infoClient.php?username=" . $_SESSION['username'] . "' 
                        class=' hover:text-red-600'>" . $_SESSION['username'] . "</a>
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
            </ul>
        </div>

    </section>
    <!---->
    <section>
        <div id="homepage-slider" class="st-slider">
            <div class="images">
                <?php foreach ($slider as $slider) : ?>
                <div class="images-inner">
                    <div class="image-slide">
                        <div class="image bg-yellow">
                            <img src="../upload/<?= $slider['slider_img'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--show products by categories-->
    <section class="pt-10">
        <div class="container mx-auto">
            <div class="grid grid-cols-8 gap-5">
                <!--right column-->
                <div class="col-span-6">
                    <h3 class="font-bold py-4 text-2xl text-center">Sản phẩm nổi bật </h3>
                    <hr class="py-4">
                    <div class="grid grid-cols-3 gap-8 ">
                        <?php foreach ($pro as $pro) : ?>
                        <div class="">
                            <a href="product_detail.php?pro_id=<?= $pro['pro_id'] ?>&cate_id=<?= $pro['cate_id'] ?>"><img
                                    src="../upload/<?= $pro['pro_img'] ?>" alt="" class="w-full"></a>
                            <div class="py-4 text-center"><a href="">
                                    <h3 class="font-medium uppercase"><?= $pro['pro_name'] ?></h3>
                                </a>
                                <p class="font-medium text-red-600"><?= $pro['price'] ?>đ</p>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!--left column-->
                <div class="col-span-2">
                    <!--category-->
                    <div class="border border-solid mt-10 rounded-md">
                        <h2 class=" p-4 text-xl font-bold bg-gray-100 border-b border-solid">
                            Danh mục sản phẩm</h2>
                        <hr>
                        <?php foreach ($cate as $cate) : ?>
                        <div class="flex p-4 border-b border-solid">
                            <a href="product_by_categroies.php?cate_id=<?= $cate['cate_id'] ?>"
                                class=""><?= $cate['cate_name'] ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!--top favotite product-->
                    <div class="border border-solid mt-10 rounded-md">
                        <h2 class=" p-4 text-xl font-bold bg-gray-100 border-b border-solid">
                            Top sản phẩm yêu thích</h2>
                        <hr>
                        <?php foreach ($view as $row) : ?>
                        <div class="flex p-4 border-b border-solid">
                            <a href="product_detail.php?pro_id=<?= $row['pro_id'] ?>&cate_id=<?= $row['cate_id'] ?>"
                                class="w-1/5">
                                <img src="../upload/<?= $row['pro_img'] ?>" alt=""></a><a href=""
                                class="ml-10 font-medium"><?= $row['pro_name'] ?> <br>
                                <p class="text-red-600"><?= $row['price'] ?></p>
                            </a>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- sale procduct-->
                    <div class="border border-solid mt-10 rounded-md">
                        <h2 class=" p-4 text-xl font-bold bg-gray-100 border-b border-solid">
                            Sản phẩm khuyến mại</h2>
                        <hr>
                        <?php foreach ($sale as $sale) : ?>
                        <div class="flex p-4 border-b border-solid">
                            <a href="product_detail.php?pro_id=<?= $sale['pro_id'] ?>&cate_id=<?= $sale['cate_id'] ?>"
                                class="w-1/5"><img src="../upload/<?= $sale['pro_img'] ?>" alt=""></a>
                            <a href="" class="ml-10 font-medium">
                                <?= $sale['pro_name'] ?> <br>
                                <span class="flex">
                                    <p class="mr-4 text-gray-500 line-through">
                                        <?= $sale['price'] ?></p>
                                    <p class="text-red-600"><?= $sale['sale'] ?></p>
                                </span>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--content-->
    <hr>
    <footer class="pt-10">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 gap-8">
                <!--Col 1--> <?php foreach ($info as $info) : ?>
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
                            class="w-full px-4 py-2 border border-solid">
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