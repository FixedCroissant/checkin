<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Grab information from Oracle Connection.
include ('oracleconnect.php');

//Variables
$middle_name;

//if(isset($_GET['lname']))
//{
    $middle_name = '%'.$_POST['middle_name'].'%';
    
    
    //Query to use; remember to look into the right table.
    $query="SELECT * FROM PS_NC_HIS_PPE_VW WHERE NC_MIDDLE_NAME_PRI LIKE :mname";
    
    //Make the connection with the new query.
    $statement=oci_parse($connPS,$query);
    
    //Bind variable to the query search.
    oci_bind_by_name($statement,':mname',$middle_name);

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
                    echo "STUDENT ID:"."<span id=student_ID_needed style='color:red; font-weight:bold; margin-left: 28px;'><a href='#' name='IDNeeded".$count."' onclick='Notification(".$row["EMPLID"]."); return false;'>".$row["EMPLID"]."</a></span>";
                    echo "<br/>";
                    echo "MIDDLE:"."<span id=last_name_needed style='margin-left:58px; color:red; font-weight:bold;'>".$row["NC_MIDDLE_NAME_PRI"]."</span>";
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
                    $count++;
                }                
                
                
    echo "</div>"; //Close div            
                //Provide the number of rows needed.
                //echo "Total Number of Rows:"."<span id=number_of_rows_needed>". oci_num_rows($statement)."</span>";

//} //CLOSE IF STATEMENT

?>


