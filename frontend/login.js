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
    var input_ssn = document.getElementById('input-ssn').value;
    console.log("username = ", input_ssn);

    // Query Database
    queryDatabase(input_ssn);

    // Redirect to our main.html
    window.open("./main.html");

}

function queryDatabase(query){
       console.log('entered queryDatabase with input: ', query);

           $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/login_handler.php?input-code=" + query, 
                         success: function(result){
                            console.log('result: ', result);
                         }
                      })
           });

}
