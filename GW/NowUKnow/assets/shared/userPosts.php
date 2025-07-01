<?php

if (isset($_GET['userID']) && !isset($_SESSION['userID'])) {
    $_SESSION['userID'] = $_GET['userID']; 
}
    


$userID = $_SESSION['userID'];



    // array for population of posts
    $postsList = array();

    // Query for Post
    $postQuery = "SELECT 
                        posts.userID AS postUserID,
                        posts.postID,
                        users.userID, 
                        users.userName, 
                        users.profilePicture, 
                        posts.title, 
                        posts.description, 
                        posts.attachment, 
                        tags.tags AS tags, 
                        ratings.ratingValue AS rating
                    FROM posts
                    LEFT JOIN users ON users.userID = posts.userID
                    LEFT JOIN tags ON posts.tagID = tags.tagID
                    LEFT JOIN ratings ON posts.postID = ratings.postID
                    WHERE users.userID = '$userID'
                    ORDER BY posts.postID DESC";

    $postResults = executeQuery($postQuery);

    
    // Assuming $postResults is the result of your query
    if (mysqli_num_rows($postResults) > 0) {
        // Initialize an empty array to hold the posts
        $postsList = array();
        
        // Loop through the result set
        while ($postRow = mysqli_fetch_assoc($postResults)) {
            // Create a Post object for each row
            $post = new Post(
                $postRow['postID'],
                $postRow['title'],
                $postRow['description'],
                $postRow['tags'],
                $postRow['attachment'],
                $postRow['userName'],
                $postRow['rating'],
                null,
                $postRow['profilePicture'],
                null,
                null,
                null,
                $postRow['postUserID']
            );
        
            // Add the post to the list
            array_push($postsList, $post);
        }
        
    }
    

    

    if (isset($_GET['postID'])) {
        // to get the unique postID of each post
        $postID = $_GET['postID'];
        // Query for Comments from Post
        $commentsQuery = "SELECT posts.postID, posts.title, posts.description, users.userName, users.profilePicture, attachments.attachmentName, comments.content AS comment, tags.tags AS tags
                            FROM posts
                            LEFT JOIN users ON posts.userID = users.userID
                            LEFT JOIN comments ON posts.postID = comments.postID
                            LEFT JOIN attachments ON posts.postID = attachments.postID
                            LEFT JOIN tags ON posts.tagID = tags.tagID
                            WHERE posts.postID = posts.userID";

        $commentsResults = executeQuery($commentsQuery);

        

        if (mysqli_num_rows($commentsResults) > 0) {
            while ($commentRows = mysqli_fetch_assoc($commentsResults)) {
                $postID = $commentRows['postID'];
                $title = $commentRows['title'];
                $description = $commentRows['description'];
                $userName = $commentRows['userName'];
                $profilePicture = $commentRows['profilePicture'];
                $attachmentName = $commentRows['attachmentName'];
                $comment = $commentRows['comment'];
                $tags = $commentRows['tags'];

            }
        } else {
            echo "<p>No comments yet.</p>";
        }
    }
?>