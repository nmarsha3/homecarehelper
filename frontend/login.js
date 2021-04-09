console.log('page load - entered login.js');

var submitButton = document.getElementById("submit-button");
submitButton.onmouseup = getFormInfo;
//var clearButton = document.getElementById('bsr-clear-button');
//clearButton.onmouseup = clearForm;

// Resets the response text to original state
function clearForm(){

   console.log("entered clearForm");

}

function getFormInfo(){
    console.log('entered getFormInfo');

    // get username
    var input_username = document.getElementById('input-username').value;
    console.log("username = ", input_username);

    // get password
    var input_password = document.getElementById('input-password').value;
    console.log("password = ", input_password);

    // Redirect to our main.html
    window.open("./main.html");

}
