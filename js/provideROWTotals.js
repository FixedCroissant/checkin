//Title: provideROWTotals.js
//Date: 04 15 2015
//Description: Provides a way of tallying the total bottom row of the table for the overview pages.
//The overview pages are:
//1.) overview.php
//2.) overview_campus_area.php
//3.) overview_detailed_list.php
//4.) overview_FSL.php

//Variables to keep the totals.
var total_mid_to_seven=0.0;
var total_one_am_to_two_am=0.0;
var total_two_am_to_three_am=0.0;
var total_three_am_to_four_am=0.0;
var total_four_am_to_five_am=0.0;
var total_five_am_to_six_am=0.0;
var total_six_am_to_seven_am=0.0;
var total_seven_am_to_eight_am=0.0;
var total_8 = 0.0;
var total_9 = 0.0;
var total_10 = 0.0;
var total_11 = 0.0;
var total_12 = 0.0;
var total_13 = 0.0;
var total_14 = 0.0;
var total_15 = 0.0;
var total_16 = 0.0;
var total_17=0.0;

//6:00pm
var total_18=0.0;
//7:00pm
var total_19=0.0;
//8:00pm
var total_20=0.0;
//9:00pm
var total_21=0.0;
//10:00pm
var total_22=0.0;
//11:00pm
var total_23=0.0;
//complete total
var completeTOTAL = 0.0;

//Variable to set the initial bed total.
var initialbed_allotment=0.0;
//Varaible to set the remaining bed total.
var remaining_bed_number=0.0;

//Calculate the total amount of beds that we have to utilize
//from the very beginning before any are taken away.
$('#initial_bed_number ' ).each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        initialbed_allotment+= val;
        //console.log(initialbed_allotment);
    }
});//End Function

$('#amount_of_beds_left ' ).each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        remaining_bed_number+= val;
    }
});//End Function




//12:01-7:00am
//only count the links that show up.
$('#welcome_week_checkin .timeGroup0 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_mid_to_seven+= val;
    }
});//End Function

//01:01 to 01:59:59 in the morning
$('#welcome_week_checkin .timeGroup1 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_one_am_to_two_am+= val;
    }
});//End Function

//02:01 to 02:59:59 in the morning
$('#welcome_week_checkin .timeGroup2 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_two_am_to_three_am+= val;
    }
});//End Function
//03:01 to 03:59:59 in the morning
$('#welcome_week_checkin .timeGroup3 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_three_am_to_four_am+= val;
    }
});//End Function
//04:01 to 04:59:59 in the morning
$('#welcome_week_checkin .timeGroup4 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_four_am_to_five_am+= val;
    }
});//End Function
//05:01 to 05:59:59 in the morning
$('#welcome_week_checkin .timeGroup5 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_five_am_to_six_am+= val;
    }
});//End Function

//06:01 to 06:59:59 in the morning
$('#welcome_week_checkin .timeGroup6 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_six_am_to_seven_am+= val;
    }
});//End Function

//07:01 to 07:59:59 in the morning
$('#welcome_week_checkin .timeGroup7 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_seven_am_to_eight_am+= val;
    }
});//End Function






//8-9
$('#welcome_week_checkin .timeGroup8 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_8+= val;
    }
});//End Function
//9-10
$('#welcome_week_checkin .timeGroup9 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_9+= val;
    }
});//End Function
//10-11
$('#welcome_week_checkin .timeGroup10 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_10+= val;
    }
    console.log(total_10);
});//End Function
//11-12
$('#welcome_week_checkin .timeGroup11 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_11+= val;
    }
    console.log(total_11);
});//End Function
//12-1
$('#welcome_week_checkin .timeGroup12 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_12+= val;
    }
});//End Function
//1-2
$('#welcome_week_checkin .timeGroup13 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_13+= val;
    }
});//End Function
//2-3
$('#welcome_week_checkin .timeGroup14 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_14+= val;
    }
});//End Function
//3-4
$('#welcome_week_checkin .timeGroup15 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_15+= val;
    }

});//End Function
//4-5
$('#welcome_week_checkin .timeGroup16 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_16+= val;
    }
});//End Function

//5:00:00 - 05:59:59
$('#welcome_week_checkin .timeGroup17 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_17+= val;
    }
});//End Function

//6:00:00 - 06:59:59
$('#welcome_week_checkin .timeGroup18 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_18+= val;
    }
});//End Function

//7:00:00 - 07:59:59
$('#welcome_week_checkin .timeGroup19 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_19+= val;
    }
});//End Function

//8:00:00 - 08:59:59
$('#welcome_week_checkin .timeGroup20 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_20+= val;
    }
});//End Function

//9:00:00 - 09:59:59
$('#welcome_week_checkin .timeGroup21 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_21+= val;
    }
});//End Function

//10:00:00 - 10:59:59
$('#welcome_week_checkin .timeGroup22 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_22+= val;
    }
});//End Function

//11:00:00 - 11:59:59
$('#welcome_week_checkin .timeGroup23 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_23+= val;
    }
});//End Function






//Testing
//Complete totals:
$('#welcome_week_checkin .timeGroup24 a').each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        completeTOTAL+= val;
        //console.log(completeTOTAL);
    }
});//End Function



//Display results on the bottom most row in the table.


//12:01am to 7:00am time frame
$('#total_area0').html(total_mid_to_seven);

//1:01am to 01:59:59 time frame
$('#total_area1').html(total_one_am_to_two_am);

//2:01am to 02:59:59 time frame
$('#total_area2').html(total_two_am_to_three_am);
//3:01am to 03:59:59 time frame
$('#total_area3').html(total_three_am_to_four_am);
//4:01am to 04:59:59 time frame
$('#total_area4').html(total_four_am_to_five_am);
//5:01am to 05:59:59 time frame
$('#total_area5').html(total_five_am_to_six_am);
//6:01am to 06:59:59 time frame
$('#total_area6').html(total_six_am_to_seven_am);
//7:01am to 07:59:59 time frame
$('#total_area7').html(total_seven_am_to_eight_am);



//8-9 am time period
$('#total_area8').html(total_8);
//9-10am time period
$('#total_area9').html(total_9);
//10-11am time period
$('#total_area10').html(total_10);
//11-12noon time period
$('#total_area11').html(total_11);
//12-1pm time period
$('#total_area12').html(total_12);
//1-2pm time period
$('#total_area13').html(total_13);
//2-3pm time period
$('#total_area14').html(total_14);
//3-4pm time period
$('#total_area15').html(total_15);
//4-5pm time period
$('#total_area16').html(total_16);
//5:00-05:59:59 time perdio
$('#total_area17').html(total_17);
//6:00-06:59:59 time perdio
$('#total_area18').html(total_18);
//7:00-07:59:59 time perdio
$('#total_area19').html(total_19);
//8:00-08:59:59 time perdio
$('#total_area20').html(total_20);
//9:00-09:59:59 time perdio
$('#total_area21').html(total_21);
//10:00-10:59:59 time perdio
$('#total_area22').html(total_22);
//11:00-11:59:59 time perdio
$('#total_area23').html(total_23);






//Complete totals:
$('#total_area24').html(completeTOTAL);

//Create a total of the initial bed number
$('#total_initial_bed_allotment').html(initialbed_allotment);
//Also put it in the beginning at the very top

//End the display of the total amount of initial beds that we have.

//Provide the total REMAINING beds available.
$('#remaining_bed_total').html(remaining_bed_number)


//Provide the percent of beds used.
var percent_of_beds_used = (completeTOTAL/initialbed_allotment);


//Stick it in the last column... entitled, "% of Beds Used"...
$('#remaining_bed_percentage').html(Math.floor((percent_of_beds_used)*100)+'%');
//End providing the percentage...


//END END END END
//End display results.
