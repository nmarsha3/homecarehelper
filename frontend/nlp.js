console.log('page load - entered nlp.js');

var submitButton = document.getElementById("submit-button");
submitButton.onmouseup = getFormInfo;

// Resets the response text to original state
function clearForm(){

   console.log("entered clearForm");

}


function getFormInfo(){

    // get username
    var input_question = document.getElementById('input-question').value;
    console.log("question = ", input_question);

    translate(input_question);

}

function translate(question){
       console.log('entered translate with question: ', question);
       
       $(document).ready(function() {
                      $.ajax({
                         url: "http://db.cse.nd.edu/cse30246/homecarehelper/nick/homecarehelper/frontend/nlp.php?input-question=" + question, 
                         success: function(result){
                            console.log('result: ', result);
                         }
                      })
           });
       
}
