<?php

require_once __DIR__ . '/../model/bookingListingModel.php';

class BookingListingController {
    private $model;

    public function __construct($pdo) {
        $this->model = new BookingListingModel($pdo);
    }

    public function getAllBookings() {
        return $this->model->fetchBookings();
    }

    public function cancelBooking($booking_id) {
        $success = $this->model->deleteBooking($booking_id);

        if ($success) {
            echo "<script>
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Deleted!',
                    text: 'Booking has been successfully canceled.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '/view/admin/bookingListing.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href=\"#\">Why do I have this issue?</a>'
                });
            </script>";
        }
    }
}

// Handle cancel booking request
if (isset($_GET['cancelBookingId'])) {
    $controller = new BookingListingController($pdo);
    $controller->cancelBooking($_GET['cancelBookingId']);
}
?>
