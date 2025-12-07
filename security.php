<?php
session_start();
include('db.php');
if ($conn) {
} else {
    header("Location: db.php");
}

if (!$_SESSION['username']) {
    header('Location: index.php');
}
?>