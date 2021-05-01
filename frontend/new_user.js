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
    var input_ssn = document.getElementById('input-ssn').value;
    console.log("ssn = ", input_ssn);
    var input_address = document.getElementById('input-address').value;
    console.log("addr = ", input_address);
    var input_city = document.getElementById('input-city').value;
    console.log("city = ", input_city);
    var input_country = document.getElementById('input-country').value;
    console.log("country = ", input_country);
    var input_zip = document.getElementById('input-zip').value;
    console.log("zip = ", input_zip);

    // Query Database
    inputIntoDatabase(input_ssn, input_address, input_city, input_country, input_zip);

    // Redirect to our main.html
    window.open("./main.html");

}

function inputIntoDatabase(ssn, addr, city, country, zip){
       console.log('entered queryDatabase with input: ');
       console.log(ssn);
       console.log(addr);
       console.log(city);
       console.log(country);
       console.log(zip);

       $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/new_user_handler.php?input-ssn=" + ssn + "&input-address=" + addr + "&input-city=" + city + "&input-country=" + country + "&zip=" + zip, 
                         success: function(result){
                            console.log('result: ', result);
                         }
                      })
           });

}
