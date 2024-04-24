document.addEventListener("DOMContentLoaded", function() 
{

    var rtable = document.querySelector("#rtable tbody");

    // Fetch financial transaction data using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './handlers/reservationHandler.php?action=fetchData', true);
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && xhr.status == 200) 
        {
            var responseData = JSON.parse(xhr.responseText);

            // Iterate over responseData array and populate table
            responseData.forEach(function(item) 
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
            });
        }
    };
    xhr.send();
});