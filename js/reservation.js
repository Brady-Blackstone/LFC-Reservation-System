document.addEventListener("DOMContentLoaded", function() 
{
    fetchData();

    // Add event listener to the "Book" button
    document.getElementById("bookButton").addEventListener("click", function() 
    {
        bookReservation();
    });

    // Add event listener to the "Edit" button
    document.getElementById("editButton").addEventListener("click", function() 
    {
        showEditForm();
    });

    // Add event listener to the "Cancel" button
    document.getElementById("cancelButton").addEventListener("click", function() 
    {
        showCancelForm();
    });

    function bookReservation() 
    {
        const date = document.getElementById('dateInput').value;
        if (!date) 
        {
            alert('Please select a date.');
            return;
        }

        fetch('./handlers/reservationHandler.php', 
        {
            method: 'POST',
            headers: 
            {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=bookData&date=' + encodeURIComponent(date)
        })
        .then(response => response.text())
        .then(text => 
        {
            try 
            {
                const data = JSON.parse(text);
                if (data.success) 
                {
                    alert('Reservation booked successfully! ' + data.message);
                    fetchData();
                } 
                else 
                {
                    throw new Error(data.error || 'Failed to book reservation');
                }
            } catch (error) 
            {
                alert('Error booking reservation: ' + error.message);
            }
        })
        .catch(error => 
        {
            alert('Error booking reservation: ' + error.message);
        });
    }

    // Function to display the edit form
    function showEditForm() 
    {
        const formHtml = `
            <form id="editReservationForm">
                <input type="text" id="reservationIdInput" class="inWidth" placeholder="Enter Reservation ID" required>
                <input type="date" id="newDateInput" class="inWidth" placeholder="New Date" required>
                <button type="button" class="btn btn-warning" onclick="submitEditReservation()">Submit Changes</button>
            </form>
        `;
        document.getElementById('editFormContainer').innerHTML = formHtml;

        // Allow only numeric characters and limit length to 4
        document.getElementById("reservationIdInput").addEventListener("input", function() 
        {
            this.value = this.value.replace(/[^\d]/g, '').slice(0, 4);
        });
    }

    function showCancelForm() 
    {
        const formHtml = `
            <form id="cancelReservationForm">
                <input type="text" id="cancelReservationIdInput" class="inWidth" placeholder="Enter Reservation ID to Cancel" required>
                <button type="button" class="btn btn-danger" onclick="cancelReservation()">Submit Cancellation</button>
            </form>`;
        document.getElementById('cancelFormContainer').innerHTML = formHtml;

        // Allow only numeric characters and limit length to 4
        document.getElementById("cancelReservationIdInput").addEventListener("input", function() 
        {
            this.value = this.value.replace(/[^\d]/g, '').slice(0, 4);
        });
    }
});

function fetchData()
{
    var rtable = document.querySelector("#rtable tbody");

    // Fetch financial transaction data using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './handlers/reservationHandler.php?action=fetchData', true);
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && xhr.status == 200) 
        {
            rtable.innerHTML = '';

            var responseData = JSON.parse(xhr.responseText);

            // Iterate over responseData array and populate table
            responseData.forEach(function(item) 
            {
                if (item.TRANS_TYPE.toUpperCase() !== 'CANCEL')
                {
                    // Format the date as MM/DD/YYYY
                    // Also adjust for the timezone difference between the server and database
                    var curDate = new Date(item.CUR_DATE);
                    curDate = new Date(curDate.getTime() + curDate.getTimezoneOffset() * 60000);
                    var formattedDate = (curDate.getMonth() + 1) + '/' + curDate.getDate() + '/' + curDate.getFullYear();

                    // Format the incoming transaction type from all uppercase to only capitalized words
                    var transType = item.TRANS_TYPE.toLowerCase().charAt(0).toUpperCase() + item.TRANS_TYPE.toLowerCase().slice(1);

                    var row = document.createElement("tr");
                    row.innerHTML = "<td>" + item.RESERVATION_ID + "</td>" +
                                    "<td>" + item.MEMBER_ID + "</td>" +
                                    "<td>" + formattedDate + "</td>" +
                                    "<td>" + transType + "</td>";
                    rtable.appendChild(row);
                }
            });
        }
    };
    xhr.send();
}

// Function to handle the reservation update
function submitEditReservation() 
{
    const reservationId = document.getElementById('reservationIdInput').value;
    const newDate = document.getElementById('newDateInput').value;

    if (!reservationId || !newDate) 
    {
        alert('Please fill in all fields.');
        return;
    }

    fetch('./handlers/reservationHandler.php', 
    {
        method: 'POST',
        headers: 
        {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=editData&reservationId=${encodeURIComponent(reservationId)}&newDate=${encodeURIComponent(newDate)}`
    })
    .then(response => response.text())
    .then(text => 
    {
        try 
        {
            const data = JSON.parse(text);
            if (data.success) 
            {
                alert('Reservation updated successfully! ' + data.message);
                document.getElementById('editFormContainer').innerHTML = ''; // Clear the form on successful update
                fetchData();
            } 
            else 
            {
                throw new Error(data.error || 'Failed to update reservation');
            }
        } catch (error) 
        {
            alert('Error updating reservation: ' + error.message);
        }
    })
    .catch(error => 
    {
        alert('Error updating reservation: ' + error.message);
    });
}

function cancelReservation() 
{
    const reservationId = document.getElementById('cancelReservationIdInput').value;

    if (!reservationId) 
    {
        alert('Please enter the Reservation ID to cancel.');
        return;
    }

    fetch('./handlers/reservationHandler.php', 
    {
        method: 'POST',
        headers: 
        {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=cancelData&reservationId=${encodeURIComponent(reservationId)}`
    })
    .then(response => response.text())
    .then(text => 
    {
        try 
        {
            const data = JSON.parse(text);
            if (data.success) 
            {
                alert('Reservation canceled successfully!');
                document.getElementById('cancelFormContainer').style.display = 'none'; // Hide the form on success
                document.getElementById('cancelReservationIdInput').value = ''; // Clear input on success
                fetchData();
            } 
            else 
            {
                throw new Error(data.error || 'Failed to cancel reservation');
            }
        } catch (error) 
        {
            alert('Error canceling reservation: ' + error.message);
        }
    })
    .catch(error => 
    {
        alert('Error canceling reservation: ' + error.message);
    });
}