<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controller/bookingListingController.php';

$controller = new BookingListingController($pdo); // Pass PDO connection to the controller
$bookings = $controller->getAllBookings();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/view/src/styles/bookingListing.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Booking List</title>
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <div class="booking-list-container">
        <?php foreach ($bookings as $booking) : ?>
            <div class="booking-card">
                <h3>Hotel: <?= htmlspecialchars($booking['hotel_name']); ?></h3>
                <p>User: <?= htmlspecialchars($booking['username']); ?></p>
                <p>Phone: <?= htmlspecialchars($booking['phone_number']); ?></p>
                <p>Location: <?= htmlspecialchars($booking['location']); ?></p>
                <p>Rooms Booked: <?= htmlspecialchars($booking['no_of_rooms']); ?> / <?= htmlspecialchars($booking['hotel_rooms']); ?></p>
                <p>Price per Room: ₹<?= htmlspecialchars($booking['price_per_room']); ?></p>
                <p>Check-in: <?= htmlspecialchars($booking['check_in_date']); ?></p>
                <p>Check-out: <?= htmlspecialchars($booking['check_out_date']); ?></p>
                <p>Total Price: ₹<?= htmlspecialchars($booking['total_price']); ?></p>
                <p>Booking Status: <?= htmlspecialchars($booking['booking_status']); ?></p>
                

                <button onclick="confirmCancelBooking(<?= $booking['booking_id']; ?>)" class="cancel-button">Cancel Booking</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script>
       function confirmCancelBooking(bookingId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'swal2-confirm',
            cancelButton: 'swal2-cancel'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: 'Deleted!',
                text: 'Booking has been successfully canceled.',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'swal2-confirm'
                }
            }).then(() => {
                window.location.href = '?cancelBookingId=' + bookingId;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your booking is safe :)',
                'error'
            );
        }
    });
}
    </script>
</body>
</html>
