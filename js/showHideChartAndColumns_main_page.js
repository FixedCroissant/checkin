/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$( document ).ready(function() {




    //Initial columns and charts that we are going
    //to want to hide on page load.
    $('#overview_of_results').hide();

    $('.bed_information').hide();

    //Automatically hide the total check-in numbers
    $('#totalNumbers').hide();

    //Automatically hide the early morning columns.
    $('.earlyMorning').hide();
    //early morning  time groups are 0-6 time groups , class = timeGroupX
    $('.timeGroup0').hide();
    $('.timeGroup1').hide();
    $('.timeGroup2').hide();
    $('.timeGroup3').hide();
    $('.timeGroup4').hide();
    $('.timeGroup5').hide();
    $('.timeGroup6').hide();
    //$('.timeGroup7').hide();
    //Hide totals at the bottom for the early morning hours...
    $('#total_area0').hide();
    $('#total_area1').hide();
    $('#total_area2').hide();
    $('#total_area3').hide();
    $('#total_area4').hide();
    $('#total_area5').hide();
    $('#total_area6').hide();
    //$('#total_area7').hide();
    //end hiding time groups

    //HIDE LATE EVENING HOURS
    //Hide Early Morning Columns
    $('.lateEvening').hide();

    //early morning  time groups are 17-23 time groups , class = timeGroupX
    $('.timeGroup17').hide();
    $('.timeGroup18').hide();
    $('.timeGroup19').hide();
    $('.timeGroup20').hide();
    $('.timeGroup21').hide();
    $('.timeGroup22').hide();
    $('.timeGroup23').hide();

    //Hide totals at the bottom too - 17-23
    $('#total_area17').hide();
    $('#total_area18').hide();
    $('#total_area19').hide();
    $('#total_area20').hide();
    $('#total_area21').hide();
    $('#total_area22').hide();
    $('#total_area23').hide();


    //END HIDE LATE EVENING HOURS





    //On link clicks on the top right rectangle, let's show
    //the columns that are initially hidden upon page load.
    $( "#show_bed_information" ).click(function() {
        //Show column for the beginning bed amounts.
        $('.bed_information').toggle('3000');
    });

    //Initialize the option(s) of showing the Google Chart as needed.
    $( "#displayChart" ).click(function() {

        //Show Chart....
        $('#overview_of_results').show();
    });

    //Initialize the option(s) of showing the Google Chart as needed.
    $( "#hideChart" ).click(function() {

        //Show Chart....
        $('#overview_of_results').hide();
    });

    //Allow the option of showing and hiding the total number of checkins.
    $("#showTotalCheckins").click(function( ){
        $('#totalNumbers').toggle();
    });

    //Hide early morning hours
    //12:00 am through 7:00am
    $( "#showEarlyMorning" ).click(function() {

        //Hide Early Morning Columns
        $('.earlyMorning').toggle();

        //early morning  time groups are 0-7 time groups , class = timeGroupX
        $('.timeGroup0').toggle();
        $('.timeGroup1').toggle();
        $('.timeGroup2').toggle();
        $('.timeGroup3').toggle();
        $('.timeGroup4').toggle();
        $('.timeGroup5').toggle();
        $('.timeGroup6').toggle();

        //Hide totals at the bottom too - 0-6
        $('#total_area0').toggle();
        $('#total_area1').toggle();
        $('#total_area2').toggle();
        $('#total_area3').toggle();
        $('#total_area4').toggle();
        $('#total_area5').toggle();
        $('#total_area6').toggle();
        //end hiding time groups


    });

    //Allow the ability to hide/show late evening hours 5:00 - 11:59pm
    $( "#showEvening" ).click(function() {

        //Hide Early Morning Columns
        $('.lateEvening').toggle();

        //early morning  time groups are 17-23 time groups , class = timeGroupX
        $('.timeGroup17').toggle();
        $('.timeGroup18').toggle();
        $('.timeGroup19').toggle();
        $('.timeGroup20').toggle();
        $('.timeGroup21').toggle();
        $('.timeGroup22').toggle();
        $('.timeGroup23').toggle();

        //Hide totals at the bottom too - 17-23
        $('#total_area17').toggle();
        $('#total_area18').toggle();
        $('#total_area19').toggle();
        $('#total_area20').toggle();
        $('#total_area21').toggle();
        $('#total_area22').toggle();
        $('#total_area23').toggle();
        //end hiding time groups


    });

});