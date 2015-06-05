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
       window.location.href='http://localhost/apps/checkin/overview_campus_area.php?dateREQUESTED='+dateGIVENBYDROPDOWN;
        
    });
    
    

});