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
        include('db/oracleconnect.php');
        
        //When running by itself.
        //include('../db/oracleconnect.php');
        
        //Pull all data from the fake room_availability table.
        $query="SELECT * FROM ROOM_AVAILABILITY";

        //Make the connection with the new query.
        $statement=oci_parse($connPS,$query);

        //Execute the query.
        oci_execute($statement);
        
        //echo "<p>";
        //echo "This is what is currently in the database table:";
        //echo "</p>";
        
        $initial_bed_count=array("Alexander Hall"=>"","Avent Ferry"=>"","Bagwell Hall"=>"","Becton Hall"=>"","Berry Hall"=>"","Bowen Hall"=>"","Bragaw Hall"=>"","Carroll Hall"=>"","Gold Hall"=>"","Lee Hall"=>"","Metcalf Hall"=>"","North Hall"=>"","Owen Hall"=>"","Sullivan Hall"=>"","Syme Hall"=>"","Tucker Hall"=>"","Turlington Hall"=>"","Watauga Hall"=>"","Welch Hall"=>"","Wood Hall"=>"","Wolf Village"=>"","Wolf Ridge"=>"");
        
        $condenced_buildings_bed_count=array();
        
        //We are going need 4 different arrays to hold the condenced
        //values of each separate rooms.
        //One for Avent Ferry
        $condenced_building_avent_ferry=array();
        //One for Wood Hall, since there is a Wood Hall-A & Wood Hall-B
        $condenced_building_wood_hall=array();
        //One for Wolf Village
        $condenced_building_wolf_village=array();
        //One for Wolf Ridge
        $condenced_building_wolf_ridge=array();
        
        $building_names=array();
        
        while($row=  oci_fetch_assoc($statement)){
            //Assign the building name as the correct array key and the contents
            //of the array will be the availability of the building.
            $building_names[$row["BUILDING"]]=$row["AVAILABLE"];
        }
        
        //Array Manipulation Here
        foreach ($building_names as $availability =>$x_value){
            if($availability==="Alexander"){
                        $initial_bed_count["Alexander Hall"]=$x_value;
            }
            
            //Condensing the values as Avent Ferry, Wood Hall, Wolf Village, Wolf Ridge are
            //all separate buildings that are broken down into smaller segments.
            //Avent Ferry Complex.
            else if($availability==="AFC - A"||$availability==="AFC - B"||$availability==="AFC - E"||$availability==="AFC - F"){
                        //Push to the end of the Array
                        array_push($condenced_building_avent_ferry,$x_value);
            }
            //Wood Hall (Removed on 4/17/2015)
            
            /*
            else if($availability==="Wood - A"||$availability==="Wood - B"){
                        //Push to the end of the Array
                        array_push($condenced_building_wood_hall,$x_value);
            }
            */
            /*For the overview_detailed_list.php, which shows the normal room names, we do not need to consolidate Wood Hall, and
            others, but we need their normal array type.*/
            
            //Wood Hall, individual amounts
            //Set Wood A, initial bed counts
            if($availability==="Wood - A"){
                $initial_bed_count["Wood - A"]=$x_value;
            }
            //Set Wood B initial bed count
            if($availability==="Wood - B"){
                $initial_bed_count["Wood - B"]=$x_value;
            }
            
            /*Wolf Village Apartments*/
            if($availability==="Wolf Vlg A"){
                $initial_bed_count["Wolf Vlg A"]=$x_value;
            }
            if($availability==="Wolf Vlg B"){
                $initial_bed_count["Wolf Vlg B"]=$x_value;
            }
            if($availability==="Wolf Vlg C"){
                $initial_bed_count["Wolf Vlg C"]=$x_value;
            }
            if($availability==="Wolf Vlg D"){
                $initial_bed_count["Wolf Vlg D"]=$x_value;
            }
            if($availability==="Wolf Vlg E"){
                $initial_bed_count["Wolf Vlg E"]=$x_value;
            }
            if($availability==="Wolf Vlg F"){
                $initial_bed_count["Wolf Vlg F"]=$x_value;
            }
            if($availability==="Wolf Vlg G"){
                $initial_bed_count["Wolf Vlg G"]=$x_value;
            }
            if($availability==="Wolf Vlg H"){
                $initial_bed_count["Wolf Vlg H"]=$x_value;
            }
            
            
            /*Wolf Ridge Apartments*/
            if($availability==="WR Grove"){
                $initial_bed_count["WR Grove"]=$x_value;
            }
            if($availability==="WR Innovat"){
                $initial_bed_count["WR Innovat"]=$x_value;
            }
            if($availability==="WR Lakevw"){
                $initial_bed_count["WR Lakevw"]=$x_value;
            }
            if($availability==="WR Plaza"){
                $initial_bed_count["WR Plaza"]=$x_value;
            }
            if($availability==="WR Tower"){
                $initial_bed_count["WR Tower"]=$x_value;
            }
            if($availability==="WR Valley"){
                $initial_bed_count["WR Valley"]=$x_value;
            }
            
            
            else if($availability==="Bagwell"){
                        $initial_bed_count["Bagwell Hall"]=$x_value;
            }
            else if($availability==="Becton"){
                        $initial_bed_count["Becton Hall"]=$x_value;
            }
            else if($availability==="Berry"){
                        $initial_bed_count["Berry Hall"]=$x_value;
            }
            else if($availability==="Bowen"){
                        $initial_bed_count["Bowen Hall"]=$x_value;
            }
            else if($availability==="Bragaw"){
                        $initial_bed_count["Bragaw Hall"]=$x_value;
            }
            else if($availability==="Carroll"){
                        $initial_bed_count["Carroll Hall"]=$x_value;
            }
            else if($availability==="Gold"){
                        $initial_bed_count["Gold Hall"]=$x_value;
            }
            else if($availability==="Lee"){
                        $initial_bed_count["Lee Hall"]=$x_value;
            }
            else if($availability==="Metcalf"){
                        $initial_bed_count["Metcalf Hall"]=$x_value;
            }
            else if($availability==="North"){
                        $initial_bed_count["North Hall"]=$x_value;
            }
            else if($availability==="Owen"){
                        $initial_bed_count["Owen Hall"]=$x_value;
            }
            else if($availability==="Sullivan"){
                        $initial_bed_count["Sullivan Hall"]=$x_value;
            }
            else if($availability==="Syme"){
                        $initial_bed_count["Syme Hall"]=$x_value;
            }
            else if($availability==="Tucker"){
                        $initial_bed_count["Tucker Hall"]=$x_value;
            }
            else if($availability==="Turlington"){
                        $initial_bed_count["Turlington Hall"]=$x_value;
            }
            else if($availability==="Watauga"){
                        $initial_bed_count["Watauga Hall"]=$x_value;
            }
            else if($availability==="Welch"){
                        $initial_bed_count["Welch Hall"]=$x_value;
            }
            
            
            
        }//Close For Each
        //Add to Avent Ferry
        $initial_bed_count["Avent Ferry"]=array_sum($condenced_building_avent_ferry);        
        //Add to Wood Hall
        //$initial_bed_count["Wood Hall"]=array_sum($condenced_building_wood_hall);
        
        
        
        //Add to Wolf Village
        $initial_bed_count["Wolf Village"]=array_sum($condenced_building_wolf_village);
        //Add to Wolf Ridge
        $initial_bed_count["Wolf Ridge"]=array_sum($condenced_building_wolf_ridge);
        
        //Read the new "condenced buildings array"
        
        //foreach($condenced_buildings_bed_count as $condenced_BUILDINGTOTALS){
        //    echo $condenced_BUILDINGTOTALS;
        //    echo "<br/>";
        //}
        //End read the new condenced buildings array
        
        //Attach the summation of the building numbers to the building name array.
        
        //Add to Avent Ferry Complex
        //$initial_bed_count["Avent Ferry"]=array_sum($condenced_buildings_bed_count);
        
        //Get the sum of the array and print out the correct summation.
        //echo "This is the total that is in the array that is holding Avent Ferry:".array_sum($condenced_buildings_bed_count);
       
        //var_dump($initial_bed_count);
        
        //var_dump($condenced_buildings_bed_count);
        
        
        //End array Manipulation
        
        
        
        
        
        //List what is currently in each building, based of the index
        //set by the 
//        foreach ($initial_bed_count as $availability =>$x_value){
//           echo $availability.",".$x_value;
//            echo "<br/>";
//           }
        
        ?>
    </body>
</html>
