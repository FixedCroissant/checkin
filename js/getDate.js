/* 
 * Author: J. Williams
 * Date: 03-13-2015
 * Description: Provide a way of assigning 
 */

//Variables
var selectedDate;

$( document ).ready(function() {
    
    //Provide the date specifed.
    function getDate(){
        return selectedDate;
    }
    
    //Set a date by the string given in the str variable.
    function setDate(str){
        selectedDate=str;        
    }
        
    
    $('.dateSELECT').change(function(){
       //Selected Date 
       dateGIVENBYDROPDOWN = $("#datebox option:selected").val();
       setDate(dateGIVENBYDROPDOWN);
       //alert('The date selected is:'+getDate());
       //Check for custom dates
       if(dateGIVENBYDROPDOWN==="custom"){
           //Don't go anywhere.
           //Automatically check the checkbox.
           $("#customDatesSelected").prop("checked",true);
                        $("#customDatesWanted").show();
                     //Use a date picker the beginning date
                     $( "#customBeginDate" ).datepicker({
                         dateFormat: "yy-mm-dd"
                            });
                     //Use a date picker for the ending date       
                     $( "#customEndDate" ).datepicker({
                         dateFormat: "yy-mm-dd"
                            });  
       }
       else{
           //Hide everything else
            $("#customDatesWanted").hide();
            $("#customDatesSelected").prop("checked",false);
        window.location.href='http://localhost/apps/checkin/overview.php?dateREQUESTED='+dateGIVENBYDROPDOWN;
        }
    });
    
    

});