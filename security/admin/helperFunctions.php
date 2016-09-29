<?php

//Variables.
global $studentID;
function setStudentID($studentIDNeeded){    
        $studentID = $studentIDNeeded;   
        //For debugging only
        //echo 'This is the value that is being passed:   '.$studentID;
        //End debugging....
        return $studentID;
        }
//get our student id.
function getStudentID(){         
         return $studentID;
}
?>