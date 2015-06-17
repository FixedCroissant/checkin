/**
 * Title: change_form_action.js
 * Date: 06 09 2015
 * Version: 1.0
 * Description:
 */

$(document).ready(function() {

 //If there is no activity on the checkbox, then let's set it to go to the checkin-done.php automatically.
 $("#check_in_form_students").attr('action', '../processing/checkin-done.php');

// Function to change form action.
    $('#student_missing_in_system').change(function() {
        //If a new student is added that is not in the search box, and the person must be added manually,
        //let the form submit to the checkin-manual_student-done.php page, instead of the normal checkin-done.php that the searched
        //students end up being processed.
        if (this.checked) {
            $("#check_in_form_students").attr('action', '../processing/checkin-manual_student-done.php');
        }
        //If the add new student checkbox is not checked, must go to the regular check-in done page.
        else if (!$('#student_missing_in_system').is(":checked")) {
            $("#check_in_form_students").attr('action', '../processing/checkin-done.php');
            //Testing message if necessary, commented out as it's not needed.
            //alert("Form Action is Changed to 'checkin-manual_student-done.php'\n Press Submit to Confirm");
        }
        //By default go to the normal "checkin-done.php" page.
        else {
            $("#check_in_form_students").attr('action', 'checkin-done.php');
        }
    }); //close .change function
// Function For Back Button
    $(".back").click(function() {
        parent.history.back();
        return false;
    });
});