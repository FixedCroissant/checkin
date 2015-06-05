/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// A $( document ).ready() block.
$( document ).ready(function() {
    //Initially hide last name option.
    //Hide the last name search box.
    $("#searchBY_LASTNAME").hide();
    //Hide the middle name search box.
    $("#searchBY_MIDDLENAME").hide();
    //Hide the first name search box.
    $("#searchBY_FIRSTNAME").hide();
    
    
    
    $( "#searchSTUDENT_CHOSEN" ).change(function() {
          //If a certain option is chosen go ahead and show the the text
    //box that will allow the person to search for a given student.
    
    //If the person wants to search by last name, go ahead and show the last name option.
    if($("#searchSTUDENT_CHOSEN").val()===""){
            //Hide all divs as nothing is selected.
            $("#searchBY_LASTNAME").hide();
            $("#searchBY_FIRSTNAME").hide();
            $("#searchBY_MIDDLENAME").hide();
    }
    
    
    //If the person wants to search by last name, go ahead and show the last name option.
    if($("#searchSTUDENT_CHOSEN").val()==="lname"){
            //Hide all other divs.
            $("#searchBY_MIDDLENAME").hide();
            $("#searchBY_FIRSTNAME").hide();
        
            //Show last name textbox, no delay.
            $("#searchBY_LASTNAME").show();
        
    }
    //If the person wants to search by last name, go ahead and show the last name option.
    if($("#searchSTUDENT_CHOSEN").val()==="fname"){
            //Hide all other divs.
            $("#searchBY_LASTNAME").hide();
            $("#searchBY_MIDDLENAME").hide();
            
            //Show first name textbox, no delay.
            $("#searchBY_FIRSTNAME").show();
        
    }
    //If the person wants to search by last name, go ahead and show the last name option.
    if($("#searchSTUDENT_CHOSEN").val()==="mname"){
            //Hide all other divs.
            $("#searchBY_LASTNAME").hide();
            $("#searchBY_FIRSTNAME").hide();
        
            //Show middle name textbox, no delay.
            $("#searchBY_MIDDLENAME").show();
        
    }
                
                
    });
    
    
});