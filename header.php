<?php

require_once('functions.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: optionspage.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="style/AdminDashboard.css">
    <link rel="stylesheet" href="style/SAdashboard.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        window.console = window.console || function (t) { };

        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }

        $(document).ready(function() {
            var currentPath = (location.pathname).substring(1, (location.pathname).length);

            $('.left li').each(function (index, elem) {
                var aHref = $(this).find('a').attr('href');

                if (aHref != undefined && aHref == currentPath) {
                    $(elem).addClass('active');
                } else {
                    $(elem).removeClass('active');
                }
            });
        });
    </script>

    <style>
        .alertify-notifier {
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body translate="no">
<div class="main">
    <!-- Navigation Panel -->
    <?php include_once('navigation.php');?>

    <div class="right">
        <div class="tab-content">