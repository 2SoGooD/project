<?php
include "models/Category.php";
include "models/Faq.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

$cat = new Category();
$faq = new Faq();

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['q'] == "faq-categories" && !$_GET['id']) {
    $res = $cat->getCategories();
    $json_res = json_encode($res);
    echo $json_res;
} elseif ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['q'] == "faq-categories" && $_GET['id']) {
    $res = $cat->getCategory($_GET['id']);
    $json_res = json_encode($res);
    echo $json_res;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['q'] == "faq-category") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $res = $cat->addCategory($_POST['title']);
    $json_res = json_encode($res);
    echo $json_res;
} elseif ($_SERVER['REQUEST_METHOD'] == "PUT" && $_GET['q'] == "faq-category" && $_GET['id']) {
    $res = $cat->updateCategory($_GET['id']);
    $json_res = json_encode($res);
    echo $json_res;
} elseif ($_SERVER['REQUEST_METHOD'] == "DELETE" && $_GET['q'] == "faq-category" && $_GET['id']) {
    $res = $cat->deleteCategory($_GET['id']);
    $json_res = json_encode($res);
    echo $json_res;
} elseif ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['q'] == "faqs" && !$_GET['id']) {
    $res = $faq->getFaqs();
    $json_res = json_encode($res);
    echo $json_res;
} elseif ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['q'] == "faq-category" && $_GET['id']) {
    $res = $cat->getCategoryWithFaqs($_GET['id']);
    $json_res = json_encode($res);
    echo $json_res;
} else {
    exit();
}
?>