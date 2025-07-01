<?php
session_start();
include("assets/shared/connect.php");

if (isset($_GET['delete_user']) && isset($_GET['confirm_delete'])) {
    $user_id = $_GET['delete_user'];
    $confirm_delete = $_GET['confirm_delete'];

    if ($confirm_delete == 'yes') {
        $user_id = (int)$user_id; 

        $delete_query = "DELETE FROM users WHERE userID = $user_id";

        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('User deleted successfully'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error deleting user'); window.location.href='profile.php';</script>";
        }
    }
}
?>
