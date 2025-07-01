<?php 

function showFollowing() {
    $followerID = $_SESSION['userID']; 
    
    
    $showFollowingQuery = "SELECT 
            posts.postID, 
            posts.title, 
            posts.description, 
            posts.attachment, 
            posts.userID, 
            users.userName, 
            users.profilePicture, 
            tags.tags, 
            ratings.ratingValue
        FROM 
            follows
        INNER JOIN users ON follows.followedID = users.userID
        INNER JOIN posts ON posts.userID = users.userID
        LEFT JOIN tags ON tags.tagID = posts.postID
        LEFT JOIN ratings ON ratings.postID = posts.postID
        WHERE follows.followerID = '$followerID'
        ORDER BY postID DESC"; 

    
    $showFollowingResults = executeQuery($showFollowingQuery);
    
    
    if (mysqli_num_rows($showFollowingResults) > 0) {
        $postsHTML = ''; 
        while ($showFollowingRow = mysqli_fetch_assoc($showFollowingResults)) {
            $post = new Post(
                $showFollowingRow['postID'],
                $showFollowingRow['title'],
                $showFollowingRow['description'],
                $showFollowingRow['tags'],
                $showFollowingRow['attachment'],
                $showFollowingRow['userName'],
                $showFollowingRow['ratingValue'],
                '',
                $showFollowingRow['profilePicture'],
                '', 
                0,   
                0.0, 
                $showFollowingRow['userID'] 
            );

            $postsHTML .= $post->createPost();
        }
        return $postsHTML; 
    } else {
        // if no post is found
        return '<p>No posts found from users you are following.</p>';
    }
}
?>