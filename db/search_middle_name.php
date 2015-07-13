<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Grab information from Oracle Connection.
//This only works in the test environment.
//include ('oracleconnect.php');

//Production information
//Temporarily removed on July 10 @ 8:20am.
//include('../../mysql/psdb.php');
//End Production Information

//Development Server
include('../../mysql/psdb-DV1.php');
//End Development Server

//Variables
$middle_name;

    $middle_name = '%'.$_POST['middle_name'].'%';
	
	//Commented out 06 15 2015.
	$term = "2158";    //2158 Fall Term
	
	//Updated on 06 15 2015 to look for specifically Summer Term 2.
	//Updated on 06 29 2015 to look for specifically Fall 2015 term.
    //Add ability to change term.
	$query="SELECT * FROM PS_NC_HIS_PP2_VW WHERE EFFECTIVE_TERM=:term_needed AND NC_MIDDLE_NAME_PRI LIKE :mname";
    
    //Make the connection with the new query. (PRODUCTION)
    $statement=oci_parse($psconnect,$query);
    
    //Bind variable to the query search.
	//Term Needed
	oci_bind_by_name($statement,':term_needed',$term);
	//middle name
    oci_bind_by_name($statement,':mname',$middle_name);

     //Execute the query.
     oci_execute($statement);
     
     /********
      * SHOW THE RESULTS HERE!!!!
	  * FOR MIDDLE NAME
      */
     
     //count number
     $count=1;
     echo "<div id=search_result_details>";
                while($row = oci_fetch_array($statement,OCI_ASSOC)){
                    
                    //Use the javascript function inside /js/getRetreivedID.js to set the value stored in $row["EMPLID"] in a cookie value.
					//Then, if the user clicks the "GoBack" button, that value will be added to the textbox automatically.
					
					echo "STUDENT ID:"."<span id=student_ID_needed style='color:red; font-weight:bold; margin-left: 28px;'><a href='#' name='IDNeeded".$count."' onclick='Notification(parseInt(".$row["EMPLID"].",10)); return false;'>".$row["EMPLID"]."</a></span>";
                    echo "<br/>";
					//June 15 -- For testing purposes to see what term these students are coming from
                    //and making sure that we're getting the correct information on our students.
                    echo "Student's Term: &nbsp; <strong>".$row["EFFECTIVE_TERM"]."</strong>";
                    echo "<br/>";
                    echo "MIDDLE:"."<span id=last_name_needed style='margin-left:58px; color:#CC0000; font-weight:bold;'>".$row["NC_MIDDLE_NAME_PRI"]."</span>";
                    echo "<br/>";
                    echo "LAST:"."<span id=last_name_needed style='margin-left:75px;'>".$row["NC_LAST_NAME_PRI"]."</span>";
                    echo "<br/>";
                    echo "FIRST:"."<span id=first_name_needed style='margin-left:75px;'>".$row["NC_FIRST_NAME_PRI"]."</span>";
                    echo "<br/>";
                    echo "BLDG:"."<span id=residence_bldg_needed style='margin-left:75px;'>".$row["BUILDING"]."</span>";
                    echo "<br/>";
                    echo "<div style='border-bottom:2px solid black;'></div>";
                    
                    //For testing purposes only.
//                                                
//                    echo "<br/>";
//                    echo "The count is:"."<span id=current_count>".$count."</span>";
//                    echo "<br/>";                                        
//                    $count++;
                }                
                
                
    echo "</div>"; //Close div            
                //Provide the number of rows needed.
                //echo "Total Number of Rows:"."<span id=number_of_rows_needed>". oci_num_rows($statement)."</span>";


?>