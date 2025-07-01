<?php

class User
{
    public $userID;
    public $firstName;
    public $lastName;
    public $userName;
    public $userType;
}
class Post
{
    public $postID;
    public $userID;
    public $title;
    public $description;
    public $tags;
    public $attachment;
    public $userName;
    public $ratingID;
    public $comment;
    public $profilePicture;
    public $tagImg;
    public $ratingValue;
    public $avgRating;
    public $postUserID;




    public function __construct($postID, $title, $description, $tags, $attachment, $userName, $ratingID, $comment, $profilePicture, $tagImg, $ratingValue = 0, $avgRating = 0.0, $postUserID)
    {
        $this->postID = $postID;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
        $this->attachment = $attachment;
        $this->userName = $userName;
        $this->ratingID = $ratingID;
        $this->comment = $comment;
        $this->profilePicture = $profilePicture;
        $this->tagImg = $tagImg;
        $this->ratingValue = $ratingValue;
        $this->avgRating = $avgRating;
        $this->postUserID = $postUserID;
    }

    public function createPost()
    {
        $followButtonHTML = '';

        if (isset($_SESSION['userID'])) {
            $followerID = $_SESSION['userID'];
            $postOwnerID = $this->postUserID; // Use the correct property for the post owner

            if ($followerID !== $postOwnerID) {
                // Only show the follow button if the user is not the post owner
                $checkFollowQuery = "SELECT * FROM follows WHERE followerID = '$followerID' AND followedID = '$postOwnerID'";
                $followResult = executeQuery($checkFollowQuery);
                $isFollowing = mysqli_num_rows($followResult) > 0;

                if ($isFollowing) {
                    $followButton = '<button class="btn btn-primary ms-1 unfollow-btn" name="btnUnFollow" ' . $this->postID . '">Unfollow</button>';
                } else {
                    $followButton = '<button class="btn btn-primary ms-1 follow-btn" name="btnFollow" ' . $this->postID . '">Follow</button>';
                }

                $followButtonHTML = '
            <form method="POST" id="">
                <input type="hidden" name="followerID" value="' . $_SESSION['userID'] . '">
                <input type="hidden" name="followedID" value="' . $this->postUserID . '">
                <input type="hidden" name="postID" value="' . $this->postID . '"> 
            ' . $followButton . '
            </form>';
            }
        }


        $userRating = 0;

        $averageRatingQuery = "SELECT AVG(ratingValue) as avgRating FROM ratings WHERE postID = '$this->postID'";
        $averageRatingResult = executeQuery($averageRatingQuery);
        if ($averageRatingResult && mysqli_num_rows($averageRatingResult) > 0) {
            $avgRatingRow = mysqli_fetch_assoc($averageRatingResult);
            $avgRating = round($avgRatingRow['avgRating'], 1);
        }

        $this->avgRating = $avgRating;

        // Get the logged-in user's rating for the post
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $userRatingResult = executeQuery("SELECT ratingValue FROM ratings WHERE postID = '$this->postID' AND userID = '$userID'");
            if ($userRatingResult && mysqli_num_rows($userRatingResult) > 0) {
                $userRating = mysqli_fetch_assoc($userRatingResult)['ratingValue'];
            }
        }

        // Generate star rating HTML
        $starRatingHTML = '';
        for ($i = 5; $i >= 1; $i--) {
            $isSelected = ($userRating >= $i) ? 'selected' : '';
            $starRatingHTML .= "<button class='star-button $isSelected' type='submit' name='btnRatePost' value='$i' style='background:none; border:none; padding:0; cursor:pointer;'>
                            <img src='assets/icons/star.svg' class='star-icon'>
                        </button>";
        }

        // Strip tags to avoid breaking HTML
        $description = strip_tags($this->description);
        $description = nl2br($description); // Preserve line breaks

        if (strlen($description) > 200) {
            // Truncate string
            $stringCut = substr($description, 0, 200);
            $endPoint = strrpos($stringCut, ' ');

            // If no space is found, cut off at the limit
            $description = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $description .= '... <a href="#" class="read-more" style="text-decoration:none; color: #808080"data-bs-toggle="modal" data-bs-target="#cardModal' . $this->postID . '">Read More</a>';
        }

        return '
            <div class="card custom-card mb-4" id="postID' . $this->postID . '">
                <div class="card-header d-flex align-items-center p-3" style="border-color:white">
                    <img src="uploadProfile/' . $this->profilePicture . '" class="profile-pic me-1">
                    <div>
                        <h6 class="mb-0 profile-text">' . $this->userName . '</h6>
                    </div>
                    ' . $followButtonHTML . '
                    <div class="ms-auto d-flex align-items-center">
                        <button class="btn maximize-btn" data-bs-toggle="modal" data-bs-target="#cardModal' . $this->postID . '" data-post-id=btnViewPost"' . $this->postID . '" onclick="showModal(\'' . $this->postID . '\')
                        ">
                            <img src="assets/icons/maximize.svg">
                        </button>
                    </div>
                </div>


                <!-- uploaded media -->
                <img src="uploads/' . $this->attachment . '" class="card-img-top">
                <!-- body -->
                <div class="card-body px-5 pt-5">
                    <h2 class="card-text title-text p-1">' . $this->title . '</h2>
                    <p class="card-text body-text px-2">' . $description . '</p>
                    <button class="btn btn-primary follow-btn ms-1 mt-0 mb-2" style="background-color: grey;">' . $this->tags . '</button>
                    <!-- bottom buttons -->
                    <div class="d-flex justify-content-between" style="margin-top: -35px;">
                        <div class="d-flex align-items-center">
                            <span class="bottom-buttons icon-button me-3" data-bs-toggle="modal" data-bs-target="#cardModal' . $this->postID . '">
                                <img src="assets/icons/comment.svg" class="me-1">Comments
                            </span>
                            
                            <form method="POST">
                                <button type="submit" name="bookmark" class="bottom-buttons icon-button d-flex align-items-center" style="background: none; border: none; padding: 0;">
                                    <img src="assets/icons/bookmark2.svg" class="me-1">Bookmark
                                </button>
                                <input type="hidden" name="bmPostID" value="' . $this->postID . '">
                                <input type="hidden" name="userID" value="' . ($_SESSION['userID'] ?? '') . '">
                            </form>
                        </div>

                        <form method="POST" action="" id="setRating" name="postRatings">
                            <input type="hidden" name="postID" value="' . $this->postID . '">
                            <input type="hidden" name="userID" value="' . ($_SESSION['userID'] ?? '') . '">
                            <div class="ratingAvg" style="display: flex; justify-content: flex-end; margin-right: 10px;">
                                <p class=" rate-text "> ' . $this->avgRating . ' STARS</p>
                            </div>
                            <div class="mb-5">
                                <!-- Star Rating -->
                                ' . $starRatingHTML . '
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
    }


    public function showModal()
    {
        $followButtonHTML = '';

        if (isset($_SESSION['userID'])) {
            $followerID = $_SESSION['userID'];
            $postOwnerID = $this->postUserID; // Use the correct property for the post owner

            if ($followerID !== $postOwnerID) {
                // Only show the follow button if the user is not the post owner
                $checkFollowQuery = "SELECT * FROM follows WHERE followerID = '$followerID' AND followedID = '$postOwnerID'";
                $followResult = executeQuery($checkFollowQuery);
                $isFollowing = mysqli_num_rows($followResult) > 0;

                if ($isFollowing) {
                    $followButton = '<button class="btn btn-primary ms-1 unfollow-btn" name="btnUnFollow" ' . $this->postID . '">Unfollow</button>';
                } else {
                    $followButton = '<button class="btn btn-primary ms-1 follow-btn" name="btnFollow" ' . $this->postID . '">Follow</button>';
                }

                $followButtonHTML = '
            <form method="POST" id="">
                <input type="hidden" name="followerID" value="' . $_SESSION['userID'] . '">
                <input type="hidden" name="followedID" value="' . $this->postUserID . '">
                <input type="hidden" name="postID" value="' . $this->postID . '"> 
            ' . $followButton . '
            </form>';
            }
        }

        $commentQuery = "SELECT  users.*, comments.* FROM
                  users LEFT JOIN comments ON users.userID = comments.userID
                WHERE postID = '" . $this->postID . "' ORDER BY commentID DESC";
        $commentResult = executeQuery($commentQuery);



        $userRating = 0;

        $averageRatingQuery = "SELECT AVG(ratingValue) as avgRating FROM ratings WHERE postID = '$this->postID'";
        $averageRatingResult = executeQuery($averageRatingQuery);
        if ($averageRatingResult && mysqli_num_rows($averageRatingResult) > 0) {
            $avgRatingRow = mysqli_fetch_assoc($averageRatingResult);
            $avgRating = round($avgRatingRow['avgRating'], 1);
        }

        $this->avgRating = $avgRating;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $userRatingResult = executeQuery("SELECT ratingValue FROM ratings WHERE postID = '$this->postID' AND userID = '$userID'");
            if ($userRatingResult && mysqli_num_rows($userRatingResult) > 0) {
                $userRating = mysqli_fetch_assoc($userRatingResult)['ratingValue'];
            }
        }

        $starRatingHTML = '';
        for ($i = 5; $i >= 1; $i--) {
            $isSelected = ($userRating >= $i || (!$userRating && $avgRating >= $i)) ? 'selected' : '';
            $starRatingHTML .= "<button class='star-button $isSelected' type='submit' name='btnRatePost' value='$i' style='background:none; border:none; padding:0; cursor:pointer;'>
                                    <img src='assets/icons/star.svg' class='star-icon'>
                                </button>";
        }


        $modalCode = '<div class="modal fade" id="cardModal' . $this->postID . '" tabindex="-1"
                        aria-labelledby="cardModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="background-color: transparent; border: none;">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="card custom-card">
                                            <!-- user -->
                                            <div class="card-header d-flex align-items-center p-3"
                                                style="border-color:white">
                                                <img src="uploadProfile/' . $this->profilePicture . '" class="profile-pic me-1">
                                                <div>
                                                    <h6 class="mb-0 profile-text">' . $this->userName . '</h6>
                                                </div>
                                                <div>
                                                ' . $followButtonHTML . '
                                                </div>

                                                <div class="ms-auto d-flex align-items-center" data-bs-dismiss="modal">
                                                    <button class="btn maximize-btn"><img
                                                            src="assets/icons/minimize.svg"></button>
                                                </div>
                                            </div>
                                            <!-- uploaded media -->
                                            <img src="uploads/' . $this->attachment . '" class="card-img-top">
                                            <!-- body -->
                                            <div class="card-body">
                                                <h2 class="card-text title-text">' . $this->title . '</h2>
                                                <div class="modal-body">
                                                    <p class="card-text body-text px-2">' . nl2br(htmlspecialchars($this->description)) . '</p>
                                                </div>


                                                <button class="btn btn-primary follow-btn ms-1 mt-0 mb-2"
                                                    style="background-color: #808080;">' . $this->tags . '</button>
                                                <!-- bottom buttons -->
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <span class="bottom-buttons icon-button"
                                                            onclick="toggleCommentInput(this)">
                                                            <img src="assets/icons/comment.svg" class="me-1">Comment
                                                        </span>
                                                        <form method="POST">
                                                            <span class="bottom-buttons icon-button" onclick="toggleActive(this)">
                                                              <button type="submit" name="bookmark" class="bottom-buttons icon-button d-flex justify-content-between" style="background: none; border: none; padding: 0;">
                                                                 <img src="assets/icons/bookmark2.svg" class="me-1">Bookmark
                                                             </button>
                                                            </span>
                                                            <input type="hidden" name="bmPostID" value="' . $this->postID . '">
                                                            <input type="hidden" name="userID" value="' . ($_SESSION['userID'] ?? '') . '">
                                                        </form>
                                                    </div>
                                                     <div class="d-flex align-items-center">';

        if ($this->postUserID == $userID) {
            $modalCode .= '
                                                        <!-- Delete Button -->
                                                        <button class="btn btn-primary follow-btn button-text" style="background-color: #B23B3B; margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#deleteModal' . $this->postID . '                                                          ">
                                                            <img src="assets/icons/delete2.svg" alt="Delete Icon">
                                                            <span class="button-text">Delete</span>
                                                        </button>
                                                    
                                                        <!-- Edit Button -->
                                                        <button class="btn btn-primary follow-btn button-text" style="background-color: #7091E6; margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#editModal' . $this->postID . '">
                                                            <img src="assets/icons/edit2.svg" alt="Edit Icon">
                                                            <span class="button-text">Edit</span>
                                                        </button>';
        }

        $modalCode .= '
                                                        <form method="POST" action="" id="setRating" name="postRatings">
                                                            <input type="hidden" name="postID" value="' . $this->postID . '">
                                                            <input type="hidden" name="userID" value="' . ($_SESSION['userID'] ?? '') . '">
                                                            <div class="ratingAvg" style="display: flex; justify-content: flex-end; margin-right: 10px;">
                                                                <p class=" rate-text "> ' . $this->avgRating . ' STARS</p>
                                                            </div>
                                                            <div class="mb-5">
                                                                <!-- Star Rating -->
                                                                ' . $starRatingHTML . '
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- collapsible comment -->
                                            <div class="comment-input-container" style="background-color:#C9F6FF; display: block">
                                                <form method="POST" id="commentButton' . $this->postID . '">
                                                    <input type="hidden" name="insertPost" value="' . $this->postID . '">
                                                    <div class="mb-3">
                                                        <textarea class="form-control body-text" name="comment" rows="5"
                                                            placeholder="Write a comment..."></textarea>
                                                    </div>
                                                    <button type="button" class="btn btn-primary my-1 ms-1" 
                                                        onclick="document.getElementById(\'commentButton' . $this->postID . '\').submit();">
                                                        Comment
                                                    </button>
                                                </form>

                                                <div>
                                                    <h5 class="body-text mt-5 ms-2" style="color: #808080;">Comments
                                                    </h5>
                                                </div>

                                                <!-- Comments Section -->
                                                <div class="comment-list text-break">';

        while ($commentRow = mysqli_fetch_assoc($commentResult)) {
            $modalCode .=
                '<div class="comment-list text-break">
                                                        <div class="card comment-card mb-2 body-text">
                                                            <div class="comment-card-header d-flex align-items-center ms-3 mt-3"
                                                                style="border-color:white; background-color:white">
                                                                <img src="uploadProfile/' . $commentRow['profilePicture'] . '"
                                                                    class="profile-pic me-1">
                                                                <div>
                                                                    <h6 class="mb-0 profile-text">' . $commentRow['userName'] . '
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            <p class="ms-5 me-3 p-2">' . $commentRow['content'] . '</p>
                                                        </div>
                                                    </div>';
        }

        $modalCode .= ' 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $modalCode;
    }

    public function editModal()
    {
        return '
                        <!-- Edit Modal -->
                    <div class="modal fade" id="editModal' . $this->postID . '" tabindex="-1" aria-labelledby="editModalLabel"
                aria-hidden="true" style="font-family: Helvetica;">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #C9F6FF; border-radius: 20px; border: none; padding: 20px;">
                        <div class="modal-header" style="background-color: transparent; border-bottom: none;">
                            <h5 class="modal-title" id="editModalLabel" style="font-family: Helvetica-Rounded; font-size: 1.5rem; color: #333;">Edit Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="background: none; border: none; font-size: 1.5rem; color: #555; cursor: pointer;">
                            </button>
                        </div>
                        <form method="POST">
                            <div class="modal-body" style="padding: 15px; background-color: #e8faff; border-radius: 15px;">
                                <input type="hidden" name="postID" value="' . $this->postID . '">
                                <div class="mb-3" style="margin-bottom: 20px;">
                                    <label for="editedTitle" class="form-label" style="font-weight: bold; color: #555;">Title</label>
                                    <input type="text" class="form-control" id="editedTitle" name="editedTitle" 
                                        value="' . htmlspecialchars($this->title) . '" required
                                        style="width: 100%; border-radius: 15px; border: 1px solid #ddd; padding: 12px; font-size: 1rem; background-color: #fff;">
                                </div>
                                <div class="mb-3">
                                    <label for="editedDescription" class="form-label" style="font-weight: bold; color: #555;">Description</label>
                                    <textarea class="form-control" id="editedDescription" name="editedDescription" rows="5" required
                                        style="width: 100%; border-radius: 15px; border: 1px solid #ddd; padding: 12px; font-size: 1rem; background-color: #fff;">' . htmlspecialchars($this->description) . '</textarea>
                                </div>
                            </div>
                            <div class="modal-footer" style="padding-top: 15px; border-top: none; display: flex; justify-content: center; gap: 10px;">
                                <button type="button" class="btnCancel" data-bs-dismiss="modal"
                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #B23B3B; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    Cancel
                                </button>
                                <button type="submit" name="btnEdit" class="btnSave"
                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #7091E6; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
    }

    public function deleteModal()
    {
        return '
                        <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal' . $this->postID . '" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="font-family: Helvetica;">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #C9F6FF; border-radius: 20px; border: none; padding: 20px;">
                        <div class="modal-header" style="background-color: transparent; border-bottom: none;">
                            <h5 class="modal-title" id="deleteModalLabel" style="font-family: Helvetica-Rounded; font-size: 1.5rem; color: #333;">Delete Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="background: none; border: none; font-size: 1.5rem; color: #555; cursor: pointer;">
                            </button>
                        </div>
                        <form method="POST">
                            <div class="modal-body" style="padding: 15px; background-color: #e8faff; border-radius: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%; text-align: center; font-family: Helveticas">
                                    <input type="hidden" name="postID" value="' . $this->postID . '">
                                    <p style="font-size: 1rem; color: #555;" class="body-text" >Are you sure you want to delete this post?</p>
                                </div>
                            <div class="modal-footer" style="padding-top: 15px; border-top: none; display: flex; justify-content: center; gap: 10px;">
                                <button type="button" class="btnCancel" data-bs-dismiss="modal"
                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #808080; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    Cancel
                                </button>
                                <button type="submit" name="btnDelete" class="btnDelete"
                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #b23b3b; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
    }

    public function userDeletePost()
    {
        return '
       <div class="card custom-card mb-4">
                <div class="card-header d-flex align-items-center p-3" style="border-color:white">
                    <img src="../uploadProfile/' . $this->profilePicture . '" class="profile-pic me-1">
                    <div>
                        <h6 class="mb-0 profile-text">' . $this->userName . '</h6>
                    </div>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <button class="btn maximize-btn" data-bs-toggle="modal" data-bs-target="#cardModal' . $this->postID . '" data-post-id=btnViewPost"' . $this->postID . '" onclick="showModal(\'' . $this->postID . '\')
                        ">
                            <img src="../assets/icons/maximize.svg">
                        </button>
                    </div>
                </div>
                <!-- uploaded media -->
                <img src="../uploads/' . $this->attachment . '" class="card-img-top">
                <!-- body -->
                <div class="card-body p-5">
                    <h2 class="card-text title-text p-1">' . $this->title . '</h2>
                    <p class="card-text body-text px-2">' . nl2br(htmlspecialchars($this->description)) . '</p>
                    <button class="btn btn-primary me-auto ms-1 mt-0 mb-2" style="background-color: grey;">' . $this->tags . '</button>
                    <!-- bottom buttons -->
                    <div class="d-flex justify-content-between">
                        
                        <div class="d-flex">
                            
                        </div>
                    </div>
                </div>
            </div>';
    }

    public function userDeleteShowModal()
    {
        return '<div class="modal fade" id="cardModal' . $this->postID . '" tabindex="-1"
                        aria-labelledby="cardModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="background-color: transparent; border: none;">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="card custom-card">
                                            <!-- user -->
                                            <div class="card-header d-flex align-items-center p-3"
                                                style="border-color:white">
                                                <img src="../assets/imgs/' . $this->profilePicture . '" class="profile-pic me-1">
                                                <div>
                                                    <h6 class="mb-0 profile-text">' . $this->userName . '</h6>
                                                </div>
                                               

                                                <div class="ms-auto d-flex align-items-center" data-bs-dismiss="modal">
                                                    <button class="btn maximize-btn"><img
                                                            src="../assets/icons/minimize.svg"></button>
                                                </div>
                                            </div>
                                            <!-- uploaded media -->
                                            <img src="../assets/imgs/' . $this->attachment . '" class="card-img-top">
                                            <!-- body -->
                                            <div class="card-body">
                                                <h2 class="card-text title-text p-1">' . $this->title . '</h2>
                                                <div class="modal-body">
                                                    <p class="card-text body-text px-2">' . $this->description . '</p>
                                                </div>

                                                <!-- bottom buttons -->
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex">
                                                            <!-- Delete Button -->
                                                            <button class="btn btn-primary follow-btn button-text" style="background-color: #B23B3B; margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#deleteModal' . $this->postID . '                                                          ">
                                                                <img src="../assets/icons/delete2.svg" alt="Delete Icon">
                                                                <span class="button-text">Delete</span>
                                                            </button>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
    }

    public function adminDeletePostModal()
    {
        return '
                        <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal' . $this->postID . '" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="font-family: Helvetica;">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #C9F6FF; border-radius: 20px; border: none; padding: 20px;">
                        <div class="modal-header" style="background-color: transparent; border-bottom: none;">
                            <h5 class="modal-title" id="deleteModalLabel" style="font-family: Helvetica Rounded; font-size: 1.5rem; color: #333;">Delete Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="background: none; border: none; font-size: 1.5rem; color: #555; cursor: pointer;">
                            </button>
                        </div>
                        <form method="POST">
                            <div class="modal-body" style="padding: 15px; background-color: #e8faff; border-radius: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%; text-align: center; font-family: Helveticas">
                                    <input type="hidden" name="postID" value="' . $this->postID . '">
                                    <p style="font-size: 1rem; color: #555; font-family: Helvetica">Are you sure you want to delete this post?</p>
                                </div>
                            <div class="modal-footer" style="padding-top: 15px; border-top: none; display: flex; justify-content: center; gap: 10px;">
                                <button type="button" class="btnCancel" data-bs-dismiss="modal"
                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #808080; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    Cancel
                                </button>
                                <button type="submit" name="btnDelete" class="btnDelete"
                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #b23b3b; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
    }
}
