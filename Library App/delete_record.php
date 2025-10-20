<?php
include 'config.php';
$table = $_GET['table'];

switch ($table) {
    case "book":
        $conn->query("DELETE FROM BOOK WHERE book_id = {$_GET['id']}");
        break;

    case "member":
        $conn->query("DELETE FROM MEMBER WHERE member_id = {$_GET['id']}");
        break;

    case "publisher":
        $conn->query("DELETE FROM PUBLISHER WHERE pub_id = {$_GET['id']}");
        break;

    case "category":
        $conn->query("DELETE FROM CATEGORY WHERE category_id = {$_GET['id']}");
        break;

    case "borrowing":
        $conn->query("DELETE FROM BORROWING_BOOK WHERE member_id = {$_GET['member_id']} AND book_id = {$_GET['book_id']}");
        break;
}

header("Location: {$table}s.php");
?>
