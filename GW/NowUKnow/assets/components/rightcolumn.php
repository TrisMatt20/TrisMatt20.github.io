<div class="col-md-3 right-column d-none d-md-block">
    <div class="right-search-bar" style="margin-bottom: 15px;">
        <form action="search.php" method="GET">
            <input type="hidden" name="userID" value="<?php echo isset($_GET['userID']) ? $_GET['userID'] : ''; ?>">
            <input type="text" class="form-control" name="searchTerm" placeholder="Search..."
                value="<?php echo isset($_GET['searchTerm']) ? htmlspecialchars($_GET['searchTerm']) : ''; ?>">
        </form>
    </div>
    <div class="announcement-tab">
        <h5 style="margin-bottom: 15px;">Announcements</h5>
        <div class="announcement-box">
            <?php
            // Announcement
            $announcementQuery = "SELECT * FROM posts WHERE isAnnouncement = 'YES' ORDER BY dateUploaded DESC";
            $announcementResults = executeQuery($announcementQuery);

            // Process announcements or display them
            if ($announcementResults && mysqli_num_rows($announcementResults) > 0) {
                while ($announcement = mysqli_fetch_assoc($announcementResults)) {
                    // Output each announcement (example)
                    echo "
                    <div class='card mb-3'>
                        <div class='card-body'>
                            <h6 class='card-title'>{$announcement['title']}</h6>
                                <p class='card-text'>{$announcement['description']}</p>
                        </div>
                   </div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <p class="text-center"><img src="assets/icons/Copyright.svg" class="footer-icon" alt="icon" width="20"
                    height="20">2025 NowUKnow Corp. All Rights Reserved</p>
            <p class="text-center">
                <a href="footer.php?content=terms" class="footer-link">Terms of Services</a> |
                <a href="footer.php?content=guidelines" class="footer-link">Privacy Policy</a> |
                <a href="footer.php?content=about" class="footer-link">About</a>
            </p>

        </div>
    </footer>
</div>