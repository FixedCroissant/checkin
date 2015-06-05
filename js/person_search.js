 function ignoreLookup(){
        alert("Hello World!");
    }

function runSearchManual(value){
    $(document).ready(function() {
    
    $.ajax({
                                                                        type: "POST",
                                                                        url: "db/search.php",
                                                                        data: {
                                                                            'ID' : value
                                                                        },
                                                                        dataType: "text",
                                                                        success: function(msg){
                                                                            //we need to check if the value is the same                    
                                                                            //Position of the text box for card swipe.
                                                                            //var pos = $("#student_cardswipe").position();                    
                                                                                
                                                                            $('<div class=\'row\' />')
                                                                                $('<div id=\'results\' class=\'\' />')
                                                                                        .html(msg)
                                                                                        .insertAfter($("#results_placeholder"));
                                                                                $('</div>');   //close the newly created #results div.                                                                                
                                                                             $('</div>');          // close the outer div created called row.                                                                              
                                                                             
                                                                        }//end success
                                                                    });//end AJAX
            //Set value of Boolean value "hasBeenRun" to TRUE, so that it can only run 1 time.
            hasBeenRun="true";
 


});



};

//jQuery Information here
$(document).ready(function() {
    /*
     * VARIABLES
     */    
    //Create boolean initially set to false.
    var hasBeenRun="";
    
    //Set minimum length to start looking for information on the server database
    //at this point, the search query will look for anything LIKE this last name.
    var minlength = 9;    
    
    var count="0";
    
   
    
    //Begin jQuery Function
    $(function () {
        
    
    
    
//    function runSearchManual(){
//        $.ajax({
//                                                                        type: "POST",
//                                                                        url: "db/search.php",
//                                                                        data: {
//                                                                            'ID' : value
//                                                                        },
//                                                                        dataType: "text",
//                                                                        success: function(msg){
//                                                                            //we need to check if the value is the same                    
//                                                                            //Position of the text box for card swipe.
//                                                                            //var pos = $("#student_cardswipe").position();                    
//                                                                                
//                                                                            $('<div class=\'row\' />')
//                                                                                $('<div id=\'results\' class=\'\' />')
//                                                                                        .html(msg)
//                                                                                        .insertAfter($("#results_placeholder"));
//                                                                                $('</div>');   //close the newly created #results div.                                                                                
//                                                                             $('</div>');          // close the outer div created called row.                                                                              
//                                                                             
//                                                                        }//end success
//                                                                    });//end AJAX
//            //Set value of Boolean value "hasBeenRun" to TRUE, so that it can only run 1 time.
//            hasBeenRun="true";
//           } //END AJAX REQUEST
     

   
    
    
    function getInfo(){        
        //Radio Button of listings
        var  personNeeded= document.getElementsByName("personNEEDED");        
        //Look for the results div and and in there, check and see if a radio button has been selected.
        alert("test");    
       }//Closes function
    
        //Add glyphicon when someone puts information in the correct text boxes notifying correct action.
        $("#student_cardswipe").bind('input',function() {
            value = $(this).val();
            if(value.length===minlength && hasBeenRun==="")
            {
                $('<div id=\'checkbox\' class=\'checkbox\' />')
                .html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>")
                .insertAfter($("#student_cardswipe"));
                $('</div>');                
            }

        });
        
        //When a 9-digit number is put in the textbox labeled "CardSwipe" or div called, "student_cardswipe"; 
        //Note: 03-06-2015: Cannot use jQuery's keyup function, as with copy/paste it fires two actions (and returns TWO return divs) as it technically is two key presses.
        //For reference, see this issue on stackoverflow: (http://stackoverflow.com/questions/22778854/ctrl-v-paste-triggers-jquerys-keyup-function-twice)
        $("#student_cardswipe").bind('input',function() {
        var that = this,
        value = $(this).val();
            if (value.length === minlength && hasBeenRun===""){
                //Reset the submit button, incase someone adds a number that is not in the 
                //SIS housing database side.
               //submit_button.disabled=false;
                        
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "db/search.php",
                                                                        data: {
                                                                            'ID' : value
                                                                        },
                                                                        dataType: "text",
                                                                        success: function(msg){
                                                                            //we need to check if the value is the same                    
                                                                            //Position of the text box for card swipe.
                                                                            //var pos = $("#student_cardswipe").position();                    
                                                                                
                                                                            $('<div class=\'row\' />')
                                                                                $('<div id=\'results\' class=\'\' />')
                                                                                        .html(msg)
                                                                                        .insertAfter($("#results_placeholder"));
                                                                                $('</div>');   //close the newly created #results div.                                                                                
                                                                             $('</div>');          // close the outer div created called row.                                                                              
                                                                             
                                                                        }//end success
                                                                    });//end AJAX
            //Set value of Boolean value "hasBeenRun" to TRUE, so that it can only run 1 time.
            hasBeenRun="true";            
            
           } //END IF STATEMENT
           
           
            
        
        //Remove Results & Remove Glyph icon; if there is nothing inside the text value for the scanned numbers.
        if (!document.getElementById("student_cardswipe").value)
                {
                    closeResults();
                    clearGlypicons();
                }
    
        //Remove Results & Remove Glyph icon; if there are NOT 9 characters in the text box.
        if (value.length < minlength)
                {
                    closeResults();
                    clearGlypicons();
                }
        
        });
    
   //If the reset button on the form is clicked, then clear the icon and the text inside the card scan value.
     $("#reset_button").click(function () {
        closeResults();
         //clear icons
         clearGlypicons();
     });
});


 function clearGlypicons(){
             removeDiv('checkbox')
         }

  function removeDiv(divID){
             $("#"+divID).remove();
         }
  function closeResults(){
             removeDiv('results');                    
            //Reset value of the boolean var.
            hasBeenRun="";
        }
    
     });