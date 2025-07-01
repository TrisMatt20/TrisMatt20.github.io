<?php
// Process
// Get current date to determine archived
$today = date('Y-m-d');

$sql = "SELECT * FROM events WHERE date < ?";
$params = [date('Y-m-d')];
$types = "s";

// Check if a category is selected
if (isset($_GET['category']) && $_GET['category'] !== '') {
    $selectedCategory = $_GET['category'];
    $sql .= " AND category = ?";
    $params[] = $selectedCategory;
    $types .= "s";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- card inputs -->
<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="../assets/img/events/<?= htmlspecialchars($row['image']) ?>" class="card-img-top"
                    alt="<?= htmlspecialchars($row['name']) ?>">
                <div class="card-body">
                    <h4 class="card-title" style="font-size: 15px;"><?= htmlspecialchars($row['name']) ?></h4>
                    <p class="card-text" style="font-size: 14px;">
                        <span class="fst-italic"><?= htmlspecialchars($row['venue']) ?>,
                            <?= htmlspecialchars($row['address']) ?></span><br>
                        <small class="text-muted"><?= date('F j, Y', strtotime($row['date'])) ?></small>
                    </p>
                    <button class="btn btn-primary">View Details</button>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No archived events available.</p>
<?php endif; ?>
</div>