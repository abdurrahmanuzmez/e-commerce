<?php
/* [INIT - GET PRODUCTS] */
require "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-db.php";
require PATH_LIB . "3a-lib-products.php";
$pdtLib = new Products();
$products = $pdtLib->get();

/* [HTML] */ ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title>
        Simple Cart Demo
    </title>
    <link rel="stylesheet" href="main-page-style.css">
    <script src="public/4a-cart.js"></script>
    <style>
        /* [HEADER + CART ICON] */
        html, body {
            font-family: arial, sans-serif;
            padding-right: 100px;
            padding-left: 100px;
            margin: 0 auto;
        }

        @media only screen and (max-width:1200px)
        {
            #page-products{
                margin-left: -150px;
                margin-right: -150px;
            }
        };

        #logo{
            margin-bottom: -11px;
        }

        #header-title{
            margin-left: 10px; margin-top: -10px;
            color: white;
        }

        #page-header {
            position: fixed;
            width: 100%;
            background: #C00A27;
            margin-left: -200px ;
        }

        #page-cart-icon {
            padding: 8px;
            margin-right: 50px;
            border-radius: 10px;
            font-size: 20px;
            background: #fafafa;
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* [PRODUCTS LIST] */
        #page-products {
            padding: 40px 10px 10px 10px;
            box-sizing: border-box;
            display: flex;
            flex-wrap: wrap;
            margin-left: -100px;
            margin-right: -100px;
        }
        .pdt {
            flex-grow: 1;
            width: 30%;
            background: #fff;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-sizing: border-box;
        }
        @media all and (max-width: 768px) {
            .pdt { width: 45% }
        }
        .pdt-img {
            max-width: 100%;
            object-fit: contain;
        }
        .pdt-name {
            font-size: 18px;
            margin: 5px 0;
        }
        .pdt-price {
            color: #2D2B2D;
            font-weight: 700;
        }
        .pdt-desc {
            font-size: 16px;
            color: #2D2B2D;
        }
        .pdt-add {
            width: 100%;
            background: #C00A27;
            font-size: 16px;
            color: #fff;
            border: 0;
            padding: 10px 0;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 50px;
        }

        /* [SHOPPING CART] */
        .ninja {
            display: none !important;
        }
        #page-cart {
            padding: 10px;
        }
        #cart-table {
            border-collapse: collapse;
            width: 100%;
        }
        #cart-table th {
            text-align: left;
        }
        #cart-table th, #cart-table td {
            padding: 10px;
        }
        #cart-table tr:nth-child(odd) {
            background: #f2f2f2;
        }
        #cart-table input[type=number] {
            width: 60px;
            padding: 5px;
        }
        .cart-remove {
            background: #d63b3b;
            color: #fff;
            border: 0;
            padding: 10px;
            cursor: pointer;
        }

        /* [CHECKOUT FORM] */
        #cart-checkout {
            margin-top: 10px;
            max-width: 320px;
        }
        #cart-checkout input {
            box-sizing: border-box;
            padding: 5px;
            margin: 5px;
            width: 100%;
        }
        #cart-checkout input[type=submit] {
            background: #3e70c1;
            color: #fff;
            border: 0;
            padding: 10px 0;
            cursor: pointer;
            font-size: 16px;
        }
        /*EXPAND SHIT*/
        .collapsible {
            background-color: #fff;
            color: #2D2B2D;
            cursor: pointer;
            padding: 0;
            height: 40px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active, .collapsible:hover {
            background-color: #fff;
        }

        .collapsible:after {
            content: '\002B';
            color: #2D2B2D;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }

        .active:after {
            content: "\2212";
        }

        .content-products {
            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }
        .linking:link, .linking:visited {
            color: white;
            text-decoration: none;

        }
        .linking:hover, .linking:active{
            text-decoration: none;
        }
        .footer{
            position: absolute;
            margin-left: -200px;
            color: grey;
            width: 100%;
            height: 100px;
            background-color: #2D2B2D;
        }
        .footer a{
            text-decoration: none;
            color: #d8d8d8;
        }
        .footer hr{
            border: 0.5px solid grey;
            border-radius: 5px;
        }
        .footer-text{
            margin-left: 100px;
            margin-right: 100px;
            margin-top: 15px;
        }
        #left-texted{
            float: right;
        }
    </style>
</head>
<body>
<header id="page-header">

    <a class="linking" href="3b-products.php" ><img id="logo" src="http://placehold.it/65x35"></a>

    <span id="header-title" ><a class="linking" href="3b-products.php">Simple Cart Demo</a></span>

    <!-- [CART BUTTON] -->

    <div id="page-cart-icon" onclick="cart.toggle();">
        &#128722; <span id="page-cart-count">0</span>
    </div>
</header>
<?php  //$data = file_get_contents("slider.html");
//echo $data;
?>
<!-- [PRODUCTS] -->
<div id="page-products">

    <!--!!!!! SQL FAULT-->

    <?php
    if (is_array($products)) {
        foreach ($products as $id => $row) { ?>
            <div class="pdt">
                <img class="pdt-img" src="images/<?= $row['product_image'] ?>"/>
                <h3 class="pdt-name"><?= $row['product_name'] ?></h3>
                <div class="pdt-price">$<?= $row['product_price'] ?></div>
                <button class="collapsible">Details...</button>
                <div class="content-products">
                    <div class="pdt-desc"><?= $row['product_description'] ?></div>

                </div>
                <input class="pdt-add" type="button" value="Add to cart" onclick="cart.add(<?= $row['product_id'] ?>);"/>
            </div>
        <?php }
    } else {
        //!!!!!!SQL FAULT
        echo "";
    }
    ?></div>

<!-- [CART] -->
<div id="page-cart" class="ninja"></div>

<script>

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
</script>
</body>
<footer class="footer">
    <div class="footer-text">
        İletişim için: abdurrahmanuzmez@outlook.com &#124; <span id="left-texted"><a href="https://www.instagram.com/abdurrahmanuzmez" target="_blank">instagram</a></span>
    <hr>
    Copyright &#9400; Site Sahibi Tüm hakları saklıdır. Designed and Developed by <a href="https://uzmez.co" target="_blank">uzmez.co</a>
    </div>
</footer>
</html>
