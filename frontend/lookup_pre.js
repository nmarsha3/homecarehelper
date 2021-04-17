console.log('page load - entered lookup.js');

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

    // get password
    var input_code = document.getElementById('input-code').value;
    console.log("code = ", input_code);

    queryDatabase(input_code);

}

function queryDatabase(query){
    console.log('entered queryDatabase with input: ', query);

    var mysql = require('mysql');

    var con = mysql.createConnection({
         host: "localhost",
         user: "mrauch2",
         password: "frc254"
    });

    console.log('Successfully made a connection! (i think)');



}
