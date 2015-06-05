/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('document').ready(function(){
if( $('#todays_date').val() < $('#expected_check_in_date').val()){

//Disable the check-in button, as the current date is not past the anticipated check-in date.  
$('#submit_button').prop("disabled",true);

//Old Message
//$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>Given that the student\'s expected check-in date has <strong>NOT</strong> passed, this student will be unable to check-in. You may <span style=\'color:red;\'>override</span> this from happening by clicking the "Allow Check-In Early" button to your left.</p>');

//New Message
$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>This student has arrived earlier than their expected check-in date,. If approved, you may override by clicking the "Allow Check-In Early" check-box button to your left.</p>');

}
});


