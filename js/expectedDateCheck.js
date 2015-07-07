/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('document').ready(function(){

	//Additions made on 06 25 2015
	(function($)
{
    /*
     * $.import_js() helper (for JavaScript importing within JavaScript code).
     */
    var import_js_imported = [];

    $.extend(true,
    {
        import_js : function(script)
        {
            var found = false;
            for (var i = 0; i < import_js_imported.length; i++)
                if (import_js_imported[i] == script) {
                    found = true;
                    break;
                }

            if (found == false) {
                $("head").append('<script type="text/javascript" src="' + script + '"></script>');
                import_js_imported.push(script);
            }
        }
    });

})(jQuery);
	
	
	/****
	 *  ANY DATE PRIOR TO FRIDAY, AUGUST 19 2015 STUDENT WILL BE DEEMED ARRIVING EARLY.
	 ****/
	 
	 var earlyCheckInCuttOff = "08-19-2015";
	 
	 /****
	 * END MAIN EARLY ARRIVAL DATE CUT OFF.
	 *****/
	
	
	//Import moments.js from the function created above.
	$.import_js('js/moment.js');
	
	
	//Searched for student's expected date.
	//Pulled from database and is in the format dd-AUG-YY
	var searchedResidentExpectedDate = $("#searched_residence_expected_date").text();
	
	//Only format the date if it is not blank.
	if(searchedResidentExpectedDate!=''){
	//Format the expected date for the searched resident.
	expectedDateFormat = moment(searchedResidentExpectedDate,'D-MMM-YY').format('MM-DD-YYYY');
	
	//Reinsert the new formatted value.
	$("#expected_check_in_date").val(expectedDateFormat);
	}
	
	//Double check the dates that are pulling from the webpage and from the system.
	//Testing.
	var todaysDate = $('#todays_date').val();
	var expectedDate = $('#expected_check_in_date').val();
	
	//alert ('todays date is: '+todaysDate);
	//alert ('expected arrival dates is: '+expectedDate);
	//End double checking the dates that are pulling from the webpage and the from the system.
	//End testing.

	
	
	if(searchedResidentExpectedDate==='' && todaysDate<earlyCheckInCuttOff){
	var no_expected_date='No Expected Date';
	
	//Disable the check-in student button, make sure employee or voluntee reads message to incoming student.   
	$('#submit_button').prop("disabled",true);
	
	
	//If there is no expected arrival date currently in SIS, not penalize, but create a message like above.
	//New Message of no expected date.
	$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>This student currently <span style=\'font-weight:bold;\'>does not</span> have an expected arrival date in the student system and is arriving early. <br/><br/> <span style=\'font-weight:bold;\'>If their room is ready</span>, please click the \'Allow student to checkin before the expected checkin date\' check-box on your bottom left to continue.</p>');
	//var searchedResidentExpectedDate = "06-25-2015";
	$("#expected_check_in_date").val(no_expected_date);
	}
	
	
	
	//If the student has an expected arrival date, but today's date is earlier than their expected arrival date, let the person know and provide a message
	//that they've arrived early and they will be charged per day. 
	//temporary comment out.
	//else if( $('#todays_date').val() < $('#expected_check_in_date').val()){
	
	
	
	
	//If today's date is greater than Friday August 19, no early arrival charges are processed. Hide the messages all together.
	else if(todaysDate>=earlyCheckInCuttOff){
	//Hide the entire row concerning the expected arrival date and their messages.
	//Hide the early check-in checkbox as it's not necessary after  Friday 8/19.
	$('.expected_arrival_date_group').hide();
	
	//After August 19 2015, there will be no extra charges and there is no need for Early Checkin tracking. 
	
	}
	
	
	else if(expectedDate<earlyCheckInCuttOff){
	
	
	
			//Disable the check-in button, as the current date is not past the anticipated check-in date.  
			$('#submit_button').prop("disabled",true);

			//New Message
			//temporary comment out.
			//$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>This student has arrived earlier than their expected check-in date,. If approved, you may override by clicking the "Allow Check-In Early" check-box button to your left.</p>');
			
			//Student is checking in prior to Friday August 19 and will be charged.
			$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>Note: This student is checking in early. To continue, please click the Allow Check-In Early check-box on your left.</p>');
			
	
			//moment(searchedResidentExpectedDate).format('D[-]MMM[-]YY');	
			
			//temporary comment out.
			//expectedDateFormat = moment(searchedResidentExpectedDate,'D-MMM-YY').format('MM-DD-YYYY');
	
			//Set the text in the Expected Arrival Date to 'No Expected Date.'
			$("#expected_check_in_date").val(expectedDateFormat);	
			//End additions made on 06 25 2015
	}//end else if statement.


});//Close the document ready function.



