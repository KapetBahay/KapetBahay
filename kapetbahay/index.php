<?php
    $route = isset($_GET["route"]) ? $_GET["route"] : "";

    switch($route) {
        case "":
            include "pages/index.php";
            break;
        case "about":
            include "pages/about.php";
            break;
        case "branches":
            include "pages/branches.php";
            break;
        case "contact":
            include "pages/contact.php";
            break;
        case "customer/login":
            include "pages/customer/logincustomer.php";
            break;
        case "customer/register":
            include "pages/customer/register.php";
            break;
        case "customer/profile":
            include "pages/customer/userd_profilemember.php";
            break;
        case "customer/change-password":
            include "pages/customer/userd_pwmember.php";
            break;
        case "customer/reservation":
            include "pages/customer/makereservation_member.php";
            break;
        case "customer/my-reservation":
            include "pages/customer/myreservation.php";
            break;
        case "customer/logout":
            include "pages/customer/logout.php";
            break;
        case "admin/login":
            include "pages/admin/loginadmin.php";
            break;
        case "admin/user-list":
            include "pages/admin/userlist.php";
            break;
        case "admin/reservation-list":
            include "pages/admin/reservationlist.php";
            break;
        case "admin/logout":
            include "pages/admin/logout.php";
            break;
    }
?> 