<!-- Left Column -->
<div class="col-md-3 left-column">
    <div class="logo m-0">
        <a href="index.php?userID=<?php echo $userID; ?>">
            <img src="assets/icons/wordMark big.svg" alt="NowUKnow Logo" width="100" height="100">
        </a>
    </div>
    <div class="sidebar">
        <ul>
            <li>
                <a href="index.php?userID=<?php echo $userID; ?>"
                    style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #06080F;">
                    <i class="fa-solid fa-house nav-icon" style="font-size: 24px; color: #06080F;"></i>
                    <span class="nav-title"
                        style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; font-size: 20px;">Home</span>
                </a>
            </li>
            <li>
                <a href="profile.php?userID=<?php echo $userID; ?>"
                    style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #06080F;">
                    <i class="fa-solid fa-user nav-icon" style="font-size: 24px; color: #06080F;"></i>
                    <span class="nav-title"
                        style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; font-size: 20px;">Profile</span>
                </a>
            </li>
            <li>
                <a href="explore.php?userID=<?php echo $userID; ?>"
                    style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #06080F;">
                    <i class="fa-solid fa-hashtag nav-icon" style="font-size: 24px; color: #06080F;"></i>
                    <span class="nav-title"
                        style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; font-size: 20px;">Tags</span>
                </a>
            </li>
            <li>
                <a href="bookmarks.php?userID=<?php echo $userID; ?>"
                    style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #06080F">
                    <i class="fa-solid fa-bookmark nav-icon" style="font-size: 24px; color: #06080F;"></i>
                    <span class="nav-title"
                        style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; font-size: 20px;">Bookmarks</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="logout-container">
        <form action="login.php" method="POST">
            <button type="submit" class="btn-logout">Log Out</button>
        </form>

    </div>
</div>