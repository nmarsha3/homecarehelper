console.log('page load - entered login.js');

var submitButton = document.getElementById('bsr-submit-button');
submitButton.onmouseup = getFormInfo;
var clearButton = document.getElementById('bsr-clear-button');
clearButton.onmouseup = clearForm;


// Resets the response text to original state
function clearForm(){

   console.log("entered clearForm");

}

function getFormInfo(){
    console.log('entered getFormInfo');

    // get username
    username = document.getElementById('input-username').value;
    console.log("username = ", username);

    // get password
    password = document.getElementById('input-password').value;
    console.log("password = ", password);

    // This is where we would add the username and password to a database

    // Redirect to our main.html
    window.open("./main.html");

}
