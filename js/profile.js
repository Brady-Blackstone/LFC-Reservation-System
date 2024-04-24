document.addEventListener("DOMContentLoaded", function() 
{
    var table = document.querySelector("#table tbody");

    // Fetch financial transaction data using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './handlers/profileHandler.php?action=fetchData', true);
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && xhr.status == 200) 
        {
            var responseData = JSON.parse(xhr.responseText);

            // Iterate over responseData array and populate table
            responseData.forEach(function(item) 
            {
                var row = document.createElement("tr");
                row.innerHTML = "<td>" + item.USERNAME + "</td>" +
                                "<td>" + item.FIRST_NAME + " " + item.LAST_NAME + "</td>" +
                                "<td>" + item.PHONE_NUM + "</td>" +
                                "<td>" + item.EMAIL + "</td>";
                table.appendChild(row);
            });
        }
    };
    xhr.send();
});