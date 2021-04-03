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
    input_username = document.getElementById('input-username').value;
    console.log("username = ", input_username);

    // get password
    input_password = document.getElementById('input-password').value;
    console.log("password = ", input_password);

    // This is where we would add the username and password to a database
    var request = new XMLHttpRequest();
    var request_string = "form_handler.php?username=" + input_username + "&password=" + input_password;
    console.log("request string = ", request_string);
    request.open("GET", request_string, true);
    request.send();

    // Redirect to our main.html
    window.open("./main.html");

}
