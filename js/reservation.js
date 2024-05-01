document.addEventListener("DOMContentLoaded", function() 
{

    // var rtable = document.querySelector("#rtable tbody");

    // // Fetch financial transaction data using AJAX
    // var xhr = new XMLHttpRequest();
    // xhr.open('GET', './handlers/reservationHandler.php?action=fetchData', true);
    // xhr.onreadystatechange = function()
    // {
    //     if (xhr.readyState == 4 && xhr.status == 200) 
    //     {
    //         var responseData = JSON.parse(xhr.responseText);

    //         // Iterate over responseData array and populate table
    //         responseData.forEach(function(item) 
    //         {
    //             // Format the date as MM/DD/YYYY
    //             // Also adjust for the timezone difference between the server and database
    //             var curDate = new Date(item.CUR_DATE);
    //             curDate = new Date(curDate.getTime() + curDate.getTimezoneOffset() * 60000);
    //             var formattedDate = (curDate.getMonth() + 1) + '/' + curDate.getDate() + '/' + curDate.getFullYear();

    //             // Format the incoming transaction type from all uppercase to only capitalized words
    //             var transType = item.TRANS_TYPE.toLowerCase().charAt(0).toUpperCase() + item.TRANS_TYPE.toLowerCase().slice(1);

    //             var row = document.createElement("tr");
    //             row.innerHTML = "<td>" + item.RESERVATION_ID + "</td>" +
    //                             "<td>" + item.MEMBER_ID + "</td>" +
    //                             "<td>" + formattedDate + "</td>" +
    //                             "<td>" + transType + "</td>";
    //             rtable.appendChild(row);
    //         });
    //     }
    // };
    // xhr.send();

    function handleReservation(action, data) {
        var xhr = new XMLHttpRequest();
        var url = './handlers/reservationHandler.php';
        var params = '';
    
        if (action === 'fetchData') {
            url += '?action=fetchData'; // GET request
        } else {
            // For POST requests like bookData, editData, cancelData
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            params = 'action=' + action + '&' + data; // Data must be a URL-encoded string
        }
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (action === 'fetchData') {
                    var responseData = JSON.parse(xhr.responseText);
                    responseData.forEach(function(item) {
                        // Assume CUR_DATE and TRANS_TYPE exist in the response
                        var formattedDate = new Date(item.CUR_DATE).toLocaleDateString();
                        var transType = item.TRANS_TYPE.charAt(0).toUpperCase() + item.TRANS_TYPE.slice(1).toLowerCase();
    
                        var row = document.createElement("tr");
                        row.innerHTML = "<td>" + item.RESERVATION_ID + "</td>" +
                                        "<td>" + item.MEMBER_ID + "</td>" +
                                        "<td>" + formattedDate + "</td>" +
                                        "<td>" + transType + "</td>";
                        document.getElementById('rtable').appendChild(row);
                    });
                } else {
                    alert(xhr.responseText); // Handle response for POST actions
                }
            }
        };
    
        if (action === 'fetchData') {
            xhr.open('GET', url, true);
            xhr.send();
        } else {
            xhr.send(params); // Send POST request with data
        }
    }    
});