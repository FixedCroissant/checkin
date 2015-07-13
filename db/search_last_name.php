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
$last_name;

//if(isset($_GET['lname']))
//{
    $last_name = '%'.$_POST['last_name'].'%';
    
    
    //Query to use; remember to look into the right table.
	//06 04 2015 -- Commented out as this view does not give me the future terms. 
    //$query="SELECT * FROM PS_NC_HIS_PPE_VW WHERE NC_LAST_NAME_PRI LIKE :lname";
    
	//Term break down
	//2157 Summer Term 2
	//$term="2157";
	
	//2158 Fall Term
	//Commented out 06 15 2015.
	$term = "2158";
	
	
	//Updated on 06 15 2015 to look for specifically Summer Term 2.
    //Add ability to change term.
	$query="SELECT * FROM PS_NC_HIS_PP2_VW WHERE EFFECTIVE_TERM=:term_needed AND NC_LAST_NAME_PRI LIKE :lname";
	
	
	//Testing Environment.
    //Make the connection with the new query.
    //$statement=oci_parse($connPS,$query);
    
	//Production Environment
	$statement=oci_parse($psconnect,$query);		//In production the variable we use to connect is $psconnect.
	//End Production Environment connection.	
	
    //Bind variable to the query search.
	//Term Needed
	oci_bind_by_name($statement,':term_needed',$term);
	//Last Name
    oci_bind_by_name($statement,':lname',$last_name);
    //Execute the query.
    oci_execute($statement);
     
     /********
      * SHOW THE RESULTS HERE!!!!
      */
     
     //count number
     $count=1;
     echo "<div id=search_result_details>";
                while($row = oci_fetch_array($statement,OCI_ASSOC)){
                    //echo "<input type=radio id='personNEEDED' name='personNEEDED'></input>";
					
					//Comment out on 07 09 2015 @ 4:55pm.
					echo "<script type='text/javascript'>";
					//echo "var numberNeeded = parseInt('".$row["EMPLID"]."',10);";
					//echo "console.log('The number is:'+numberNeeded);";		
					echo "</script>";
					
                    //Old way of doing it, see if this works.
					//echo "STUDENT ID:"."<span id=student_ID_needed style='color:red; font-weight:bold; margin-left: 28px;'><a href='#' name='IDNeeded".$count."' onclick='Notification(".$row["EMPLID"]."); return false;'>".$row["EMPLID"]."</a></span>";
                    
					//Comment out below on 07 09 2015 @ $4:55pm.
					echo "STUDENT ID:"."<span id=student_ID_needed style='color:red; font-weight:bold; margin-left: 28px;'><a href='#' name='IDNeeded".$count."' onclick='Notification(parseInt(".$row["EMPLID"].",10)); return false;'>".$row["EMPLID"]."</a></span>";
                    
					
					echo "<br/>";
					//April 29 -- For testing purposes to see what term these students are coming from
                    //and making sure that we're getting the correct information on our students.
                    echo "Student's Term: &nbsp; <strong>".$row["EFFECTIVE_TERM"]."</strong>";
                    echo "<br/>";
                    echo "LAST:"."<span id=last_name_needed style='margin-left:75px; font-weight:bold; color:#CC0000'>".$row["NC_LAST_NAME_PRI"]."</span>";
					echo "<br/>";
					echo "MIDDLE:"."<span id=middle_name_needed style='margin-left:60px;'>".$row["NC_MIDDLE_NAME_PRI"]."</span>";
					echo "<br/>";
                    echo "FIRST:"."<span id=first_name_needed style='margin-left:70px;'>".$row["NC_FIRST_NAME_PRI"]."</span>";
                    echo "<br/>";
                    echo "BLDG:"."<span id=residence_bldg_needed style='margin-left:75px;'>".$row["BUILDING"]."</span>";
                    echo "<br/>";
                    echo "<div style='border-bottom:2px solid black;'></div>";
                    
                    //For testing purposes only.
//                                                
//                    echo "<br/>";
//                    echo "The count is:"."<span id=current_count>".$count."</span>";
//                    echo "<br/>";                                        
                    $count++;
                }                
                
                
    echo "</div>"; //Close div            
                //Provide the number of rows needed.
                //echo "Total Number of Rows:"."<span id=number_of_rows_needed>". oci_num_rows($statement)."</span>";

//} //CLOSE IF STATEMENT

?>


