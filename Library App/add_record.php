<?php
include 'config.php';
$table = $_POST['table'];

switch ($table) {
    case "book":
        $conn->query("INSERT INTO BOOK (title, price, pub_id, category_id)
                      VALUES ('{$_POST['title']}', '{$_POST['price']}', '{$_POST['pub_id']}', '{$_POST['category_id']}')");
        break;

    case "member":
        $conn->query("INSERT INTO MEMBER (name, address, join_date)
                      VALUES ('{$_POST['name']}', '{$_POST['address']}', '{$_POST['join_date']}')");
        break;

    case "publisher":
        $conn->query("INSERT INTO PUBLISHER (name, address)
                      VALUES ('{$_POST['name']}', '{$_POST['address']}')");
        break;

    case "category":
        $conn->query("INSERT INTO CATEGORY (name)
                      VALUES ('{$_POST['name']}')");
        break;

    case "borrowing":
        $conn->query("INSERT INTO BORROWING_BOOK (member_id, book_id, borrow_date, due_date, return_date)
                      VALUES ('{$_POST['member_id']}', '{$_POST['book_id']}', '{$_POST['borrow_date']}', '{$_POST['due_date']}', '{$_POST['return_date']}')");
        break;
}

header("Location: {$table}s.php");
?>
