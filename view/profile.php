<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/ProfileController.php';

$profileController = new ProfileController($pdo);
$profileData = $profileController->showProfile();
$is_admin = $profileController->is_admin;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/view/src/styles/profile.css">
</head>
<body>

<div id="navbarHeader">
    <?php include __DIR__ . '/../view/partials/header.php'; ?>
</div>

<div class="profile-container">
    <img src="/uploads/<?php echo $profileData['profile_image'] ?: 'default.jpg'; ?>" alt="Profile Image" class="profile-image">
    <div class="profile-details">
        <h2><?php echo $profileData['admin_name'] ?? $profileData['username']; ?></h2>
        <p>Email: <?php echo $profileData['admin_email'] ?? $profileData['email']; ?></p>
        <p>Phone: <?php echo $profileData['phone_number']; ?></p>
        <p>Bio: <?php echo $profileData['bio']; ?></p>
        <?php if ($is_admin): ?>
            <p>Role: Admin</p>
        <?php endif; ?>
    </div>
    <button class="edit-button" onclick="openModal()">Edit Profile</button>
</div>

<!-- Modal for Editing Profile -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="modal-header">
            <h2>Edit Profile</h2>
        </div>
        <form action="/controller/ProfileController.php?action=update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $profileData['admin_id'] ?? $profileData['user_id']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $profileData['admin_name'] ?? $profileData['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $profileData['admin_email'] ?? $profileData['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="<?php echo $profileData['phone_number']; ?>">
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio"><?php echo $profileData['bio']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image">
            </div>
            <button type="submit" class="submit-button">Save Changes</button>
        </form>
    </div>
</div>
<div class="footer_div">
    <?php include __DIR__ . '/../view/partials/footer.php'; ?>
</div>

<script>
    function openModal() {
        document.getElementById("editModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
    }
</script>
</body>
</html>
