<?php
session_start();

if (!isset($_SESSION['user_type'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user_type'] === 'teacher') {
    header('Location: teacher/dashboard.php');
    exit();
} else if ($_SESSION['user_type'] === 'student') {
    header('Location: student/dashboard.php');
    exit();
}
?>