<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservations | Little Fishing Creek</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        caption {
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Little Fishing Creek Golf Course</h1>
    <?php
    require_once './functions/pageFormat.php';
    $arr = ["Home", "About", "Rates", "Events", "Logout", "Reservations", "Profile", "Contact Us"];
    pageHeader("Reservations", $arr);
    ?>
    <h2>Reservations</h2>

    <form method="post" id="reservationForm">
        <input type="date" id="dateInput">
        <button type="button" class="btn btn-success" onclick="bookReservation()">Book</button>
        <button type="button" class="btn btn-warning" onclick="showEditForm()">Edit</button>
        <button type="button" class="btn btn-danger" onclick="showCancelForm()">Cancel</button>
    </form>
    <div id="editFormContainer"></div>
    <div id="cancelFormContainer" style="display: none;"></div>


    <script>
    function bookReservation() {
        const date = document.getElementById('dateInput').value;
        if (!date) {
            alert('Please select a date.');
            return;
        }

        fetch('./handlers/reservationHandler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=bookData&date=' + encodeURIComponent(date)
        })
        .then(response => response.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    alert('Reservation booked successfully! ' + data.message);
                } else {
                    throw new Error(data.error || 'Failed to book reservation');
                }
            } catch (error) {
                alert('Error booking reservation: ' + error.message);
            }
        })
        .catch(error => {
            alert('Error booking reservation: ' + error.message);
        });
    }
    </script>




<script>
// Function to display the edit form
function showEditForm() {
    const formHtml = `
        <form id="editReservationForm">
            <input type="number" id="reservationIdInput" placeholder="Enter Reservation ID" required>
            <input type="date" id="newDateInput" placeholder="New Date" required>
            <button type="button" class="btn btn-warning" onclick="submitEditReservation()">Submit Changes</button>
        </form>
    `;
    document.getElementById('editFormContainer').innerHTML = formHtml;
}

// Function to handle the reservation update
function submitEditReservation() {
    const reservationId = document.getElementById('reservationIdInput').value;
    const newDate = document.getElementById('newDateInput').value;

    if (!reservationId || !newDate) {
        alert('Please fill in all fields.');
        return;
    }

    fetch('./handlers/reservationHandler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=editData&reservationId=${encodeURIComponent(reservationId)}&newDate=${encodeURIComponent(newDate)}`
    })
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.success) {
                alert('Reservation updated successfully! ' + data.message);
                document.getElementById('editFormContainer').innerHTML = ''; // Clear the form on successful update
            } else {
                throw new Error(data.error || 'Failed to update reservation');
            }
        } catch (error) {
            alert('Error updating reservation: ' + error.message);
        }
    })
    .catch(error => {
        alert('Error updating reservation: ' + error.message);
    });
}
</script>

<script>
    function showCancelForm() {
    const formHtml = `
        <form id="cancelReservationForm">
            <input type="number" id="cancelReservationIdInput" placeholder="Enter Reservation ID to Cancel" required>
            <button type="button" class="btn btn-danger" onclick="cancelReservation()">Submit Cancellation</button>
        </form>
    `;
    document.getElementById('cancelFormContainer').innerHTML = formHtml;
    document.getElementById('cancelFormContainer').style.display = 'block'; // Show the cancel form
}

function cancelReservation() {
    const reservationId = document.getElementById('cancelReservationIdInput').value;

    if (!reservationId) {
        alert('Please enter the Reservation ID to cancel.');
        return;
    }

    fetch('./handlers/reservationHandler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=cancelData&reservationId=${encodeURIComponent(reservationId)}`
    })
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.success) {
                alert('Reservation canceled successfully!');
                document.getElementById('cancelFormContainer').style.display = 'none'; // Hide the form on success
                document.getElementById('cancelReservationIdInput').value = ''; // Clear input on success
            } else {
                throw new Error(data.error || 'Failed to cancel reservation');
            }
        } catch (error) {
            alert('Error canceling reservation: ' + error.message);
        }
    })
    .catch(error => {
        alert('Error canceling reservation: ' + error.message);
    });
}

</script>



    <br>

    <div class="container">
        <div class="row gx-5 mt-4">
            <div class="col">
                <table id="rtable" class="table table-hover table-success table-md">
                    <caption>Member reservations</caption>
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">Reservation ID</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Transaction Type</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="./js/reservation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
