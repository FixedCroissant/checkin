/**
 * Created by jjwill10 on 6/11/2015.
 * Description: If there is a phone number given in the "Current Phone" text box, this script will prevent others from being able to event
 & add any phone number information into the housing database or SIS.
 * 
 */

$( document ).ready(function() {

    var studentPhoneNumberProvided = $('#current_phone_number').val();    
if(studentPhoneNumberProvided!=''){
//Hide Cell Phone class that has the text box in it.
$('.add_cell_phone_number').hide();
//Add a message why we cannot update the phone number.
$('span#cellphone_update_yes_spanned_text').text('Unfortunately, we cannot update phone number as there is already one in the system.');
}

});