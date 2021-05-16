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
    var input_first_name = document.getElementById('input-first-name').value;
    console.log("first-name = ", input_first_name);
    var input_last_name = document.getElementById('input-last-name').value;
    console.log("last-name = ", input_last_name);
    var input_birthday = document.getElementById('input-birthday').value;
    console.log("birthday = ", input_birthday);
    var input_phone = document.getElementById('input-phone').value;
    console.log("phone = ", input_phone);
    var input_ssn = document.getElementById('input_ssn').value;
    console.log("ssn = ", input_ssn);
    var input_specialty = document.getElementById('input-specialty').value;
    console.log("specialty = ", input_specialty);

    // Query Database
    inputIntoDatabase(input_first_name, input_last_name, input_birthday, input_phone, input_ssn, input_specialty);

}

function inputIntoDatabase(first_name, last_name, birthday, phone, ssn, specialty){
       console.log('entered queryDatabase with input: ');
       console.log(first_name);
       console.log(last_name);
       console.log(birthday);
       console.log(phone);
       console.log(ssn);
       console.log(specialty);

       $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/edit_info_doctor_handler.php?input_ssn=" + ssn + "&input-specialty=" + specialty + "&input-first-name=" + first_name + "&input-last-name=" + last_name + "&input-birthday=" + birthday + "&input-phone=" + phone, 
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
							 console.log('patient is a: ', result);
    						// Redirect to our main.html
							if(result == 0){
    							window.open("./main_patient.html?"+ ssn);
							}
							if(result == 1){
    							window.open("./main_doctor.html?"+ ssn);
							}
							if(result == 2){
    							window.open("./main_caregiver.html?"+ ssn);
							}
						}
					})
				});
}
