<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>NCSU Housing Availability</title>
    </head>
    <body>
        <?php
        // put your code here
        
          //When included with the overview.php
		//Used for testing
        //include('db/oracleconnect.php');
        
        //When running by itself.
        //include('../db/oracleconnect.php');
        
		//When Running in Production environment
		//Using CS900rpt; day old information.
		//REPORTING INFORMATION
		//include('../../mysql/psdb.php');
		
		//PRODUCTION INFORMATION
		include('psdb-PROD.php');
		
		//Trying PRE side on April 27, 2015.
		//include('psdb-PRE.php');
		
		
        //Pull all data from the fake room_availability table.
		//Note:This availability is only in a test environment, need to get the correct view to get building views.
        //$query="SELECT * FROM ROOM_AVAILABILITY";
	
		//Production Query, as of April 23, 2015, @3:30p this table does not exist in production.
		$query = "SELECT * FROM PS_NC_HIS_BLCNT_VW";	

        //Production Environment Connection, $psconnect is used for a production environment.
        $statement=oci_parse($psconnect,$query);

        //Execute the query.
        oci_execute($statement);
        
        //echo "<p>";
        //echo "This is what is currently in the database table:";
        //echo "</p>";
        
        //4-1-2015--Below works 
        //$initial_bed_count=array("Alexander Hall"=>"","Avent Ferry"=>"","Bagwell Hall"=>"","Becton Hall"=>"","Berry Hall"=>"","Bowen Hall"=>"","Bragaw Hall"=>"","Carroll Hall"=>"","Gold Hall"=>"","Lee Hall"=>"","Metcalf Hall"=>"","North Hall"=>"","Owen Hall"=>"","Sullivan Hall"=>"","Syme Hall"=>"","Tucker Hall"=>"","Turlington Hall"=>"","Watauga Hall"=>"","Welch Hall"=>"","Wood Hall"=>"","Wolf Village"=>"","Wolf Ridge"=>"");
        
        $initial_bed_count=array("east"=>"","central"=>"","west"=>"","apt"=>"");
        
        $condenced_buildings_bed_count=array();
        
        //Condensed groups for regions.
        $condenced_east=array();
        $condenced_central=array();
        $condenced_west=array();
        $condenced_apt=array();
        
        
        $building_names=array();
        
        
        while($row=  oci_fetch_assoc($statement)){
            //Assign the building name as the correct array key and the contents
            //of the array will be the availability of the building.
            $building_names[$row["BUILDING"]]=$row["COUNT1"];
        }
        
        //Array Manipulation Here
        foreach ($building_names as $availability =>$x_value){
            if($availability==="Alexander"){
                        array_push($condenced_central,$x_value);
            }            
            //Condensing the values as Avent Ferry, Wood Hall, Wolf Village, Wolf Ridge are
            //all separate buildings that are broken down into smaller segments.
            //Avent Ferry Complex.
            else if($availability==="AFC - A"||$availability==="AFC - B"||$availability==="AFC - E"||$availability==="AFC - F"){
                        //Push to the end of the Array
                        array_push($condenced_east,$x_value);
            }
            //Wood Hall
            else if($availability==="Wood - A"||$availability==="Wood - B"){
                        //Push to the end of the Array
                        array_push($condenced_east,$x_value);
            }
            
            //Wolf Village
            else if($availability==="Wolf Vlg A"||$availability==="Wolf Vlg B"||$availability==="Wolf Vlg C"||$availability==="Wolf Vlg D"||$availability==="Wolf Vlg E"||$availability==="Wolf Vlg F"||$availability==="Wolf Vlg G"||$availability==="Wolf Vlg H"){
                        //Push to the end of the Array
                        array_push($condenced_apt,$x_value);
                        
            }
            //Wolf Ridge
            else if($availability==="WR Grove"||$availability==="WR Innovat"||$availability==="WR Lakevw"||$availability==="WR Plaza"||$availability==="WR Tower"||$availability==="WR Valley"){
                        //Push to the end of the Array
                        array_push($condenced_apt,$x_value);
            }
            //End consolidation of buildings: Avent Ferry Complex, Wood Hall, Wolf Ridge and Wolf Village Apartments
            
            else if($availability==="Bagwell"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Becton"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Berry"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Bowen"){
                         array_push($condenced_central,$x_value);
            }
            else if($availability==="Bragaw"){
                        array_push($condenced_west,$x_value);
            }
            else if($availability==="Carroll"){
                        array_push($condenced_central,$x_value);
            }
            else if($availability==="Gold"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Lee"){
                        array_push($condenced_west,$x_value);
            }
            else if($availability==="Metcalf"){
                        array_push($condenced_central,$x_value);
            }
            else if($availability==="North"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Owen"){
                        array_push($condenced_central,$x_value);
            }
            else if($availability==="Sullivan"){
                        array_push($condenced_west,$x_value);
            }
            else if($availability==="Syme"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Tucker"){
                        array_push($condenced_central,$x_value);
            }
            else if($availability==="Turlington"){
                        array_push($condenced_central,$x_value);
            }
            else if($availability==="Watauga"){
                        array_push($condenced_east,$x_value);
            }
            else if($availability==="Welch"){
                       array_push($condenced_east,$x_value);
            }
        }//Close For Each
        
        //Add to the central list;        
        
        //Add total values to the Central Campus Array.
        $initial_bed_count["central"]=array_sum($condenced_central);
        //Add total values to the West Campus Array.
        $initial_bed_count["west"]=array_sum($condenced_west);
        //Add total values tot he East Campus Array.
        $initial_bed_count["east"]=array_sum($condenced_east);
        //Add total values to the Apartment Portion of the Array.
        $initial_bed_count["apt"]=array_sum($condenced_apt);
        
        
        
        
        //Read the new "condensed buildings array"
        
        //foreach($condenced_buildings_bed_count as $condenced_BUILDINGTOTALS){
        //    echo $condenced_BUILDINGTOTALS;
        //    echo "<br/>";
        //}
        //End read the new condensed buildings array
        
        //Attach the summation of the building numbers to the building name array.
        
        //Add to Avent Ferry Complex
        //$initial_bed_count["Avent Ferry"]=array_sum($condenced_buildings_bed_count);
        
        //Get the sum of the array and print out the correct summation.
        //echo "This is the total that is in the array that is holding Avent Ferry:".array_sum($condenced_buildings_bed_count);
       
        //Uncomment here -- 4-1-2015.
        
        //echo "Properties of the initial_bed_count:";
        //echo "<br/>";
        //var_dump($initial_bed_count);
        
        //var_dump($condenced_buildings_bed_count);
        
        //End array Manipulation       
        
        
        //BELOW IS STRICTLY FOR TESTING PURPOSES ONLY.
        //List what is currently in each building, based of the index
        //set by the 
//        foreach ($initial_bed_count as $availability =>$x_value){
//           echo $availability.",".$x_value;
//            echo "<br/>";
//           }
        
        ?>
    </body>
</html>
