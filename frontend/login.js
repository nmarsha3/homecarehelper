console.log('page load - entered login.js');

var submitButton = document.getElementById("submit-button");
submitButton.onmouseup = getFormInfo;
var newButton = document.getElementById("new-button");
newButton.onmouseup = newUser;
//var clearButton = document.getElementById('bsr-clear-button');
//clearButton.onmouseup = clearForm;

// Resets the response text to original state
function clearForm(){

   console.log("entered clearForm");

}

function newUser(){

   console.log("entered newUser");
   window.open("./new_user.html");

}

function getFormInfo(){
    console.log('entered getFormInfo');

    // get username
    var input_ssn = document.getElementById("input_ssn").value;
    console.log("ssn = ", input_ssn);

    // Query Database
	queryDatabase(input_ssn);

}

function queryDatabase(query){
       console.log('entered queryDatabase with input: ', query);

           $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/login_handler.php?input_ssn=" + query, 
                         success: function(result){
							 console.log('result: ', result);
    						// Redirect to our main.html
							if(result == 0){
    							window.open("./main_patient.html?"+ query);
							}
							if(result == 1){
    							window.open("./main_doctor.html?"+ query);
							}
							if(result == 2){
    							window.open("./main_caregiver.html?"+ query);
							}
                         }
                      })
           });
}
