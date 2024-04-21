function validateSignupForm()
{
    const userID = document.getElementById('userID').value;
    const pwd = document.getElementById('pwd').value;
    const cpwd = document.getElementById('cpwd').value;
    const fname = document.getElementById('fname').value; 
    const lname = document.getElementById('lname').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;

    // If both passwords do not match, stop further execution
    if (pwd !== cpwd)
    {
        alert("Error: Passwords do not match!");
        return false;
    }

    // Validate username
    let userRegex = /^[a-zA-Z0-9_-]+$/;
    if (!userRegex.test(userID))
    {
        // Send an error message if the username contains invalid characters
        displayErrMsg("Error: Username can only contain alphanumeric characters, underscores, and hyphens");
        return false;
    }

    // Validate password
    let pwdRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^\s`\'"\\<>%$&+=]{12,}$/;
    if (!pwdRegex.test(pwd))
    {
        // Send an error message if the password doesn't meet the criteria
        displayErrMsg("Error: Password must be at least 12 characters long and contain at least one uppercase letter, one lowercase letter, one number, one symbol, and not contain backticks (`), double and single quotes (\" '), backslashes (/), angle brackets (< >), ampersands (&), percent signs (%), dollar signs ($), or plus signs (+)");
        return false;
    }

    // Validate first name and last name
    let nameRegex = /^[a-zA-Z]+$/;
    if (!nameRegex.test(fname) || !nameRegex.test(lname))
    {
        // Send an error message if the first or last name contain non-alphabetic characters
        displayErrMsg("Error: First Name and Last Name must contain only alphabetic characters");
        return false;
    }

    // Validate phone number
    let phoneRegex = /^\d{3}-\d{3}-\d{4}$/;
    if (!phoneRegex.test(phone))
    {
        // Send an error message if the phone number is invalid
        displayErrMsg("Error: Invalid Phone Number, it should be XXX-XXX-XXXX");
        return false;
    }

    // Validate email address
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email))
    {
        // Send an error message if the email address is invalid
        displayErrMsg("Error: Invalid Email Address, it should be X@X.X");
        return false;
    }

    displayErrMsg("");
    return true;
}

function displayErrMsg(msg)
{
    // Display the error message where the id = errMsg and set the display to block
    // else set the display to none
    const errMsg = document.getElementById('errMsg');
    errMsg.textContent = msg;
    errMsg.style.display = msg ? 'block' : 'none';
}