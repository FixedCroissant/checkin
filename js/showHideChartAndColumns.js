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
    
    $('.early_morning_column').hide();
    
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

});