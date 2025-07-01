<?php 

if (isset($_POST['bmPostID'])) {
    $postID = $_POST['bmPostID'];

    $checkBookmark = "SELECT * FROM `savedbookmarks` WHERE `postID` = '$postID' AND `userID` = '$userID'";
    $result = executeQuery($checkBookmark);

    if (mysqli_num_rows($result) > 0) {
        
        $removeBookmark = "DELETE FROM `savedbookmarks` WHERE `postID` = '$postID' AND `userID` = '$userID'";
        executeQuery($removeBookmark);
    } else {
      
        $addBookmark = "INSERT INTO `savedbookmarks`(`postID`, `userID`) VALUES ('$postID','$userID')";
        executeQuery($addBookmark);
        header("Location: index.php?userID= " . $userID . "#postID$postID");
    exit();
    }
    
    $userID = $_GET['userID'];
    $lastInsertedId = mysqli_insert_id($conn);

}
?>