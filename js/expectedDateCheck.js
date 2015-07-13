/* 
 * Author: J. Williams
 * Date: June 29 2015
 * Description: Shows and hides information based on the kind of student that is being searched for and whether or not to notify
 * of an early arrival on campus. (Only applies to Residence Halls)
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
	 *  UNLESS IT IS A UNIVERSITY APARTMENT. IF IT IS A UNIVERSITY APARTMENT, THEN WE WILL IGNORE THE EARLY CHECK-IN INFORMATION DATE.
	 ****/
	 
	//Check if apartments.
	var isApartment;
    isApartment=checkifApartment();
	var earlyCheckInCuttOff = "08-19-2015";				//Date that early check-in stops happening for Fall 2015. After or ON this date, no early arrival charges will happen.
	 
	 /****
	 * END MAIN EARLY ARRIVAL DATE CUT OFF.
	 *****/
	
	
	//Import moments.js from the function created above.
	$.import_js('js/moment.js');
	
	
	//Searched for student's expected date.
	//Pulled from database and is in the format dd-AUG-YY
	var searchedResidentExpectedDate = $("#searched_residence_expected_date").text();
	var todaysDate = $('#todays_date').val();
	var expectedDate = $('#expected_check_in_date').val();
	var expectedDateFormat;
	
	/**
     * FUNCTION TO CHECK AND SEE IF ANY OF THE RESIDENCE BUILDINGS ARE EITHER WOLF RIDGE, WOLF VILLAGE
     */

    function checkifApartment(){
        var buildingProvided = $('span#residence_bldg_needed').text();

        switch (buildingProvided){


        /**
         *  CHECK WOLF VILLAGE APARTMENTS
         */
            //Check Wolf Village A
            case "Wolf Vlg A":
                ignoreExpectedDate("Y");
				return "Y";
            break;
            //Check Wolf Village B
            case "Wolf Vlg B":
                ignoreExpectedDate("Y");
				return "Y";
                break;
            //Check Wolf Village C
            case "Wolf Vlg C":
                ignoreExpectedDate("Y");
				return "Y";
                break;
            //Check Wolf Village D
            case "Wolf Vlg D":
                ignoreExpectedDate("Y");
				return "Y";
                break;
            //Check Wolf Village E
            case "Wolf Vlg E":
                ignoreExpectedDate("Y");
				return "Y";
                break;
            //Check Wolf Village F
            case "Wolf Vlg F":
                ignoreExpectedDate("Y");
				return "Y";
                break;

            //Check Wolf Village G
            case "Wolf Vlg G":
                ignoreExpectedDate("Y");
				return "Y";
                break;

            //Check Wolf Village H
            case "Wolf Vlg H":
                ignoreExpectedDate("Y");
				return "Y";
                break;


        /**
         *  CHECK WOLF RIDGE APARTMENTS
         */
            //Check Wolf Ridge Groove
            case "WR Grove":
                ignoreExpectedDate("Y");
				return "Y";
                break;
            //Check Wolf Ridge Innovation
            case "WR Innovat":
                ignoreExpectedDate("Y");
				return "Y";
                break;
            //Check Wolf Ridge Lakeview
            case "WR Lakevw":
                ignoreExpectedDate("Y");
				return "Y";
            break;
            //Check Wolf Ridge Plaza
            case "WR Plaza":
                ignoreExpectedDate("Y");
				return "Y";
            break;
            //Check Wolf Ridge Tower
            case "WR Tower":
                ignoreExpectedDate("Y");
				return "Y";
            break;
            //Check Wolf Ridge Valley
            case "WR Valley":
                ignoreExpectedDate("Y");
				return "Y";
            break;
			
			//If none of the above options, then it will default to N.
			default:
				ignoreExpectedDate("N");
					return "N";
        }
			
    }
	
	//IGNORE EXPECTED DATE
    function ignoreExpectedDate(flag){
        if(flag==="Y"){
            //Allow to check-in regardless.
            $('#submit_button').prop("enabled",true);
            //Remove expected date class from appearing (causing problems)
            $('.expected_arrival_date_group').hide();
			
			

        }else {
			flag==="N";				//Not an apartment, but a residence hall.
			
			//Continue to show the two expected arrival groups
			$('.expected_arrival_date_group').show();
			$('.expected_arrival_date_group').css("display: show;");
			$('#expected_check_in_date_message').css("display: block;");
        }
        return flag;

    }
	
	
	
	//Only format the date if it is not blank.
	if(searchedResidentExpectedDate!=''){
	//Format the expected date for the searched resident.
	expectedDateFormat = moment(searchedResidentExpectedDate,'D-MMM-YY').format('MM-DD-YYYY');
	
	//Reinsert the new formatted value.
	$("#expected_check_in_date").val(expectedDateFormat);
	}	//close top if statement that checks and see whether or not the expected arrival date is  blank or not.
	
	
	//alert("todays date is: "+todaysDate);
	//alert("expected arrival dates is: "+expectedDate);
	//alert ("expected arrival date CORRECT FORMAT: "+expectedDateFormat);
	//End double checking the dates that are pulling from the webpage and the from the system.
	//End testing.	
	
	if(expectedDate<earlyCheckInCuttOff && isApartment==="N" && searchedResidentExpectedDate!=''){
	
			//Disable the check-in button, as the current date is not past the anticipated check-in date.  
			$('#submit_button').prop("disabled",true);

			//Student is checking in prior to Friday August 19 and will be charged.
			$('#expected_check_in_date_message').show();
			$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>This student is an early arrival (prior to August 19). <br/><br/> <span style=\'font-weight:bold;\'>If their room is ready</span>, please click the \'Allow student to checkin before the expected checkin date\' check-box on your bottom left to continue.</p>');
		
			//moment(searchedResidentExpectedDate).format('D[-]MMM[-]YY');	
			
			//temporary comment out.
			//expectedDateFormat = moment(searchedResidentExpectedDate,'D-MMM-YY').format('MM-DD-YYYY');
	
			//Set the text in the Expected Arrival Date to 'No Expected Date.'
			$("#expected_check_in_date").val(expectedDateFormat);	
			//End additions made on 06 25 2015
	}
	
	
	//If it is not an apartment, and there is no expected date and today's date is less than the earlyCheckinCutOff Date (08-19-2015),
	//then display a message to those that there is No Expected Date in the system
	//this only applies to Residence Halls and not Apartments.
	if(searchedResidentExpectedDate==='' && todaysDate<earlyCheckInCuttOff && isApartment==="N"){
		//Show group Expected date panel.
        $('.expected_arrival_date_group').show();
		
		var no_expected_date='No Expected Date';
	
		//Disable the check-in student button, make sure employee reads message to incoming student.   
		$('#submit_button').prop("disabled",true);	
		
		//If there is no expected arrival date currently in SIS, not penalize, but create a message like above.
		//New Message of no expected date.
		$('#expected_check_in_date_message').css('display:show;');
		$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>This student currently <span style=\'font-weight:bold;\'>does not</span> have an expected arrival date in the student system and is arriving early. <br/><br/> <span style=\'font-weight:bold;\'>If their room is ready</span>, please click the \'Allow student to checkin before the expected checkin date\' check-box on your bottom left to continue.</p>');
		//var searchedResidentExpectedDate = "06-25-2015";
		
		
		$("#expected_check_in_date").val(no_expected_date);
	}
	
	
	//If Expected Date is earlier than August 19, 2015, then we want to notify the person using the system that it's an early arrival.
	//Only applicable to Residence Halls.
	else if(expectedDate<earlyCheckInCuttOff && isApartment==="N"){
	
			//Disable the check-in button, as the current date is not past the anticipated check-in date.  
			$('#submit_button').prop("disabled",true);

			//Student is checking in prior to Friday August 19 and will be charged.
			$('#expected_check_in_date_message').show();
			$('#expected_check_in_date_message').html('<p style=\'border: 1px solid black;\'>This student is an early arrival (prior to August 19). <br/><br/> <span style=\'font-weight:bold;\'>If their room is ready</span>, please click the \'Allow student to checkin before the expected checkin date\' check-box on your bottom left to continue.</p>');
		
	
			//moment(searchedResidentExpectedDate).format('D[-]MMM[-]YY');	
			
			//temporary comment out.
			//expectedDateFormat = moment(searchedResidentExpectedDate,'D-MMM-YY').format('MM-DD-YYYY');
	
			//Set the text in the Expected Arrival Date to 'No Expected Date.'
			$("#expected_check_in_date").val(expectedDateFormat);	
			//End additions made on 06 25 2015
	}//end else if statement.


	
	
	
	else if(isApartment==="Y"){
        //Allow to check-in regardless.
        $('#submit_button').prop("enabled",true);
    }
	
	//If the person we search for resides in an Apartment Community, continue to keep the submit button active.
	//The section regarding expected arrival date will be hidden as early arrivals are only effective for residence
    //halls.
	
	/*
	else if(isApartment=="Y"){
        //Allow to check-in regardless.
        $('#submit_button').prop("enabled",true);

    }
    //For Residence Halls, we will want to show the information regarding the expected students arrival date.
    else if(isApartment=="N"){
        //Show group Expected date panel.
        //Remove expected date class from appearing
        $('.expected_arrival_date_group').show();
		
    }*/
	
	//If the student has an expected arrival date, but today's date is earlier than their expected arrival date, let the person know and provide a message
	//that they've arrived early and they will be charged per day. 
	//temporary comment out.
	//else if( $('#todays_date').val() < $('#expected_check_in_date').val()){	
	
	
	//If today's date is greater than Friday August 19, no early arrival charges are processed. Hide the messages row all together.
	else if(todaysDate>=earlyCheckInCuttOff){
	//Hide the entire row concerning the expected arrival date and their messages.
	//Hide the early check-in checkbox as it's not necessary after  Friday 8/19.
	$('.expected_arrival_date_group').hide();
	
	//After August 19 2015, there will be no extra charges and there is no need for Early Checkin tracking.	
	}	
});//Close the document ready function.



