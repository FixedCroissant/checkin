$(document).ready(function() {
    
    
    /*
     * VARIABLES
     */
    
    //Create boolean initially set to false.
    var hasBeenRun="";
    
    //Set minimum length to start looking for information on the server database
    //at this point, the search query will look for anything LIKE this last name.
    var minlength = 4;
    
    
    //Begin jQuery Function
    
    $(function () {
        
    function ignoreLookup(){
        alert("Hello World!");
    }
    
    
    function getInfo(){
        
        //Radio Button of listings
        var  personNeeded= document.getElementsByName("personNEEDED");
        
        //Look for the results div and and in there, check and see if a radio button has been selected.        
        
        alert("test");
        
            
//            if (personNeeded[i].checked) {
//                        // do whatever you want with the checked radio
//                        alert(personNeeded[i].checked.valueOf());
//                        
//                        //alert($("span#last_name_needed").text());
//                        
//                        /***
//                         * SET VALUES OF SELECTED TEXT BOXES
//                         */
//                
//                         //Insert Last Name
//                        $("#last").val($("span#last_name_needed").text());                        
//                        //Insert First Name
//                        $("#first").val($("span#first_name_needed").text());
//                        //Insert Room                        
//                        $("#room").val($("span#residence_room_needed").text());
//                    }//end if statement
                    
                    // only one radio can be logically checked, don't check the rest
                     //break;
    
       }//Closes function


  
  //Search for students by first name
    $("#first_name").keyup(function () {
        var that = this,
        value = $(this).val();

       
        //Only provide information if the characters in the text box is greater than 3 and it has NEVER been run once AND
        //the checkbox labled "Disable Lookup" IS NOT checked.
        //If all conditions are true, then it will provide a lookup from the table.
        if (value.length >= minlength && Boolean(hasBeenRun)===false) {
            $.ajax({
                type: "POST",
                url: "db/search_first_name.php",
                data: {
                    'first_name' : value
                },
                dataType: "text",
                success: function(msg){
                    //we need to check if the value is the same                    
                    //Position of the text box for last name.
                    var pos = $("#first_name").position();                    
                    
                        $('<div id=\'search_results\' />')
                                .html(msg)
                                .css({
                                    top: pos.top  -20,
                                    left: pos.left +270,
                                    width: '400px',
                                    position: 'absolute',                                   
                                    'background-color': '#CCCCCC',                                    
                                    
                                }).insertAfter($("#first_name"));
                                $('</div>');                                
                               
                    
                    if (value==$(that).val()) {
                    //Receiving the result of search here
                    
                    };
                }//end success
            });//end AJAX
            
            
            //Set value of Boolean value "hasBeenRun" to TRUE, so that it can only run 1 time.
            hasBeenRun="true";
            
        } //END IF STATEMENT
        
        //If there is nothing in the first name text box, go ahead and close the results.
         if (!document.getElementById("first_name").value)
                {
                    closeResults();
                    
                }
   

    }); //End Search by first name

    //Search for students by first name
    $("#middle_name").keyup(function () {
        var that = this,
        value = $(this).val();

        var minimumLengthForMiddleName=2;
       
        //Only provide information if the characters in the text box is greater than 3 and it has NEVER been run once AND
        //the checkbox labled "Disable Lookup" IS NOT checked.
        //If all conditions are true, then it will provide a lookup from the table.
        if (value.length >= minimumLengthForMiddleName && Boolean(hasBeenRun)===false) {
            $.ajax({
                type: "POST",
                url: "db/search_middle_name.php",
                data: {
                    'middle_name' : value
                },
                dataType: "text",
                success: function(msg){
                    //we need to check if the value is the same                    
                    //Position of the text box for last name.
                    var pos = $("#middle_name").position();                    
                    
                        $('<div id=\'search_results\' />')
                                .html(msg)
                                .css({
                                    top: pos.top  -20,
                                    left: pos.left +270,
                                    width: '400px',
                                    position: 'absolute',                                   
                                    'background-color': '#CCCCCC',                                    
                                    
                                }).insertAfter($("#middle_name"));
                                $('</div>');                                
                               
                    
                    if (value==$(that).val()) {
                    //Receiving the result of search here
                    
                    };
                }//end success
            });//end AJAX
            
            
            //Set value of Boolean value "hasBeenRun" to TRUE, so that it can only run 1 time.
            hasBeenRun="true";
            
        } //END IF STATEMENT
        
        
        if (!document.getElementById("middle_name").value)
                {
                    closeResults();
                    alert("middle name is empty!");
                    
                }
   

    }); //End Search by middle name


    //Search for students by last name
    $("#last_name").keyup(function () {
        var that = this,
        value = $(this).val();
        
        var minimumLengthforLastName=2;

       
        //Only provide information if the characters in the text box is greater than 3 and it has NEVER been run once AND
        //the checkbox labled "Disable Lookup" IS NOT checked.
        //If all conditions are true, then it will provide a lookup from the table.
        if (value.length >= minimumLengthforLastName && Boolean(hasBeenRun)===false) {
            $.ajax({
                type: "POST",
                url: "db/search_last_name.php",
                data: {
                    'last_name' : value
                },
                dataType: "text",
                success: function(msg){
                    //we need to check if the value is the same                    
                    //Position of the text box for last name.
                    var pos = $("#last_name").position();                    
                    
                        $('<div id=\'search_results\' />')
                                .html(msg)
                                .css({
                                    top: pos.top  -20,
                                    left: pos.left +270,
                                    width: '400px',
                                    position: 'absolute',                                   
                                    'background-color': '#CCCCCC',                                    
                                    
                                }).insertAfter($("#last_name"));
                                $('</div>');                                
                               
                    
                    if (value==$(that).val()) {
                    //Receiving the result of search here
                    
                    };
                }//end success
            });//end AJAX
            
            
            //Set value of Boolean value "hasBeenRun" to TRUE, so that it can only run 1 time.
            hasBeenRun="true";
            
        } //END IF STATEMENT
        
        //If the textbox for "Last Name","First Name", "Middle Name" is completely blank, then remove the search results div that appears on the side
        //of the screen.
        if (!document.getElementById("last_name").value)
                {
                    closeResults();
                    alert("empty!");
                }
        
                                
                
                
       //If the text that is input in the "Last Name" search box, is shorter than the minimum needed characters (4), we will remove the search results
       //div that appears on the side.
       else if (value.length < minlength)
                {
                    closeResults();
                }         
    });
    
   
     $("#personNEEDED").click(function () {
        
         
     });
    
    
});     //End function call


  function removeClass(divID){
             $("."+divID).remove();
         }
         
   function removeDiv(divID){
             $("#"+divID).remove();
         }      


  function closeResults(){
            removeClass('results'); 
            removeDiv('search_results');
             
             //removeDiv('search_result_details');
            //Reset value of the boolean var.
            hasBeenRun="";
        }
    
     });