<!-- Filter Form -->
<form method="GET" action="">
    <select class="form-select" name="category" style="width: 200px;" onchange="this.form.submit()">
        <option value="">Sort by Category:</option>
        <?php
        if (isset($conn)) {
            $query = "SELECT DISTINCT category FROM events ORDER BY category ASC";
            $result = $conn->query($query);
            $selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
            while ($row = $result->fetch_assoc()) {
                $category = trim($row['category']);
                $selected = ($selectedCategory == $category) ? 'selected' : '';
                echo "<option value=\"$category\" $selected>$category</option>";

            }
        }
        ?>
    </select>
</form>