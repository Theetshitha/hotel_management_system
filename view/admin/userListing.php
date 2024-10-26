<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controller/userListingController.php';

$controller = new UserListingController($pdo);
$users = $controller->listUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - User Listing</title>
    <link rel="stylesheet" href="/view/src/styles/userListing.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <section class="dashboard-section">
        <h2>Manage Users</h2>
        <div class="tableListingUser">

        <table class="user-table">
            <thead>
                <tr>
                    <th>Profile Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Bio</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Hobbies</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><img src="../uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" class="profile-img"></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['bio']); ?></td>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($user['hobbies']); ?></td>
                            <td>
                                <button onclick="viewProfile(<?php echo htmlspecialchars(json_encode($user)); ?>)">View Profile</button> <br>
                                <br>
                                <button onclick="deleteProfile(<?php echo htmlspecialchars($user['user_id']); ?>)">Remove User</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </section>

    <div id="profilePopup" style="display:none;">
        <div id="popupContent">
            <span id="closePopup" onclick="closePopup()">&times;</span>
            <img id="profileImage" src="" alt="Profile Image" class="popup-img" >
            <h3 style="text-align: center;">User Profile</h3>
            <p><strong>Username:</strong> <span id="profileUsername"></span></p>
            <p><strong>Email:</strong> <span id="profileEmail"></span></p>
            <p><strong>Bio:</strong> <span id="profileBio"></span></p>
            <p><strong>Address:</strong> <span id="profileAddress"></span></p>
            <p><strong>Phone Number:</strong> <span id="profilePhoneNumber"></span></p>
            <p><strong>Hobbies:</strong> <span id="profileHobbies"></span></p>
        </div>
    </div>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script>
        function viewProfile(user) {
            $('#profileImage').attr('src', '../uploads/' + user.profile_image);
            $('#profileUsername').text(user.username);
            $('#profileEmail').text(user.email);
            $('#profileBio').text(user.bio);
            $('#profileAddress').text(user.address);
            $('#profilePhoneNumber').text(user.phone_number);
            $('#profileHobbies').text(user.hobbies);
            $('#profilePopup').show();
        }

        function closePopup() {
            $('#profilePopup').hide();
        }

        function deleteProfile(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action is irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/controller/userListingController.php',
                        type: 'POST',
                        data: { user_id: userId },
                        success: function(response) {
                            if (response === 'success') {
                                Swal.fire("Deleted!", "User deleted successfully.", "success").then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Error!", "Failed to delete the user.", "error");
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>
