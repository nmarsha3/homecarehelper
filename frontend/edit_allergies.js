console.log('page load - entered login.js');

var submitButton = document.getElementById("submit-button");
submitButton.onmouseup = getFormInfo;

// Resets the response text to original state
function clearForm(){

   console.log("entered clearForm");

}

function getFormInfo(){
    console.log('entered getFormInfo');

    // get username
    var patient_ssn = document.getElementById('patient-ssn').value;
    console.log("patient-ssn = ", patient_ssn);
    var doctor_ssn = document.getElementById('input_ssn').value;
    console.log("doctor-ssn = ", doctor_ssn);
    var input_item = document.getElementById('input-item').value;
    console.log("item = ", input_item);
    var input_severity = document.getElementById('input-severity').value;
    console.log("severity = ", input_severity);

    // Query Database
    inputIntoDatabase(doctor_ssn, patient_ssn, input_item, input_severity);

}

function inputIntoDatabase(doctor_ssn, ssn, item, severity){
       $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/edit_allergies_handler.php?input_ssn=" + ssn + "&input_item=" + item + "&input_severity=" + severity, 
                         success: function(result){
                            console.log('result: ', result);
                         }
					  })
				});
                         
       $(document).ready(function() {
                      $.ajax({
    					// Redirect to our main.html
						 url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/login_handler.php?input_ssn=" + ssn, 
                         success: function(result){
    						console.log("result = ", result);
							 // Redirect to our main.html
    						window.open("./main_doctor.html?"+ doctor_ssn);
						}
					})
				});
}
