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
    var med = document.getElementById('input-med').value;
    var start_date = document.getElementById('input-start-date').value;
    var end_date = document.getElementById('input-end-date').value;
    var times_taken = document.getElementById('input-times-taken').value;
    var notes = document.getElementById('input-notes').value;

    // Query Database
    inputIntoDatabase(doctor_ssn, patient_ssn, med, start_date, end_date, times_taken, notes);

}

function inputIntoDatabase(doctor_ssn, ssn, med, start_date, end_date, times_taken, notes){
       $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/edit_prescriptions_handler.php?patient_ssn=" + ssn + "&doctor_ssn=" + doctor_ssn + "&med=" + med + "&start_date=" + start_date + "&end_date=" + end_date + "&times_taken=" + times_taken + "&notes=" + notes, 
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
