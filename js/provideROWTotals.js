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
$('#welcome_week_checkin .timeGroup0 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_mid_to_seven+= val;
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

//5:01-midnight
$('#welcome_week_checkin .timeGroup17 a').each(function(){
    val = parseFloat($(this).html());

    if (val > 0){
        total_17+= val;
    }
});//End Function

//Testing
//Complete totals:
$('#welcome_week_checkin .timeGroup18 a').each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        completeTOTAL+= val;
        //console.log(completeTOTAL);
    }
});//End Function



//Display results on the bottom most row in the table.


//12:01am to 7:00am time frame
$('#total_area0').html(total_mid_to_seven);

//8-9 am time period
$('#total_area1').html(total_8);
//9-10am time period
$('#total_area2').html(total_9);
//10-11am time period
$('#total_area3').html(total_10);
//11-12noon time period
$('#total_area4').html(total_11);
//12-1pm time period
$('#total_area5').html(total_12);
//1-2pm time period
$('#total_area6').html(total_13);
//2-3pm time period
$('#total_area7').html(total_14);
//3-4pm time period
$('#total_area8').html(total_15);
//4-5pm time period
$('#total_area9').html(total_16);
//5:01-12:00mid time perdio
$('#total_area10').html(total_17);

//Complete totals:
$('#total_area11').html(completeTOTAL);

//Create a total of the initial bed number
$('#total_initial_bed_allotment').html(initialbed_allotment);
//End the display of the total amount of initial beds that we have.

//Provide the total REMAINING beds available.
$('#remaining_bed_total').html(remaining_bed_number);
//End the total REMAINING beds available.


//END END END END
//End display results.
