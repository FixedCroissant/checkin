<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of getInfo
 *
 * @author jjwill10
 */

class checkinPopulation {
    //Variables down here    
    public $residenceHall;    
    public $beginTIME;
    public $endTIME;
    public $date;
    
    public $dateStart;
    public $dateEnd;
    
    public $unitNUMBER;
    
    public $centralizedarea;
    
    //When searching for our roommate, we need to specify the searched student's ID, so that
    //we return only the roommate's ID to utlize.
    public $excludeSearchedStudent;
    
//03-13-2015 -- WORKING SQL  
//public $sql="SELECT * FROM welcome_week_signup WHERE residence=? && time_of_swipe >=?&&time_of_swipe<?";
 
    public $sql_individual_building="SELECT * FROM welcome_week_signup WHERE residence=? && date_of_swipe=? && time_of_swipe >=?&&time_of_swipe<?";
    
    public $sql_individual_building_date_range="SELECT * FROM welcome_week_signup WHERE residence=? && date_of_swipe>=? && date_of_swipe<=? && time_of_swipe >=? && time_of_swipe<?";
    
    public $sql="SELECT * FROM welcome_week_signup WHERE residence_group=? && date_of_swipe=? && time_of_swipe >=?&&time_of_swipe<?";
    
    public $sql_central_areas="SELECT * FROM welcome_week_signup WHERE residence_campus_area=? && date_of_swipe=? && time_of_swipe >=?&&time_of_swipe<? ;";
    
    public $sql_all = "SELECT * FROM `welcome_week_signup`;";
    
    public $sql_date_range = "SELECT * FROM welcome_week_signup WHERE residence_group=? && date_of_swipe>=? && date_of_swipe<=? && time_of_swipe >=? && time_of_swipe<?";
    
    public $sql_date_range_central_campus_area= "SELECT * FROM welcome_week_signup WHERE residence_campus_area=? && date_of_swipe>=? && date_of_swipe<=? && time_of_swipe >=? && time_of_swipe<?";
    
    //The below query will produce MORE than just 1 ID if there is more than 1 roommate in the building.
    //Example:001106532; will provide 7 roommates for Bragaw; so 8 total roommates.
    //public $sql_roommate= "SELECT PS_NC_HIS_PPE_VW.EMPLID FROM PS_NC_HIS_PPE_VW WHERE PS_NC_HIS_PPE_VW.EMPLID != :searchedSTUDENT AND PS_NC_HIS_PPE_VW.building = :building AND PS_NC_HIS_PPE_VW.NC_HIS_UNIT_NUM = :unitNUMBER";
    
	//June 22 2015: Commented current term information and moved it to PS_NC_HIS_PP2_VW which allows for current term and future terms.
    //public $sql_roommate="SELECT PS_NC_HIS_PPE_VW.EMPLID FROM PS_NC_HIS_PPE_VW WHERE PS_NC_HIS_PPE_VW.EMPLID != :searchedSTUDENT AND PS_NC_HIS_PPE_VW.building = :building AND PS_NC_HIS_PPE_VW.NC_HIS_UNIT_NUM = :unitNUMBER AND PS_NC_HIS_PPE_VW.NC_HIS_UNIT_SUFFIX=:unitSUFFIXNUMBER";
    
	//Commented out on June 22 2015 -- works perfectly find, but does not limit it based on term.
	//public $sql_roommate="SELECT PS_NC_HIS_PP2_VW.EMPLID FROM PS_NC_HIS_PP2_VW WHERE PS_NC_HIS_PP2_VW.EMPLID != :searchedSTUDENT AND PS_NC_HIS_PP2_VW.building = :building AND PS_NC_HIS_PP2_VW.NC_HIS_UNIT_NUM = :unitNUMBER AND PS_NC_HIS_PP2_VW.NC_HIS_UNIT_SUFFIX=:unitSUFFIXNUMBER";
    
	//Updated June 22 2015
	public $sql_roommate="SELECT PS_NC_HIS_PP2_VW.EMPLID FROM PS_NC_HIS_PP2_VW WHERE PS_NC_HIS_PP2_VW.EMPLID != :searchedSTUDENT AND PS_NC_HIS_PP2_VW.building = :building AND PS_NC_HIS_PP2_VW.NC_HIS_UNIT_NUM = :unitNUMBER AND PS_NC_HIS_PP2_VW.NC_HIS_UNIT_SUFFIX=:unitSUFFIXNUMBER AND PS_NC_HIS_PP2_VW.EFFECTIVE_TERM= :term";
    //End update June 22 2015
	
	
	//June 22 2015: Commented out current term view (PS_NC_HIS_PPE_VW) and replaced with the current and future view created, (NC_HIS_PP2_VW).
    //public $sql_getunitnumber="SELECT PS_NC_HIS_PPE_VW.EFFECTIVE_TERM, PS_NC_HIS_PPE_VW.BUILDING, PS_NC_HIS_PPE_VW.NC_HIS_UNIT_SUFFIX, PS_NC_HIS_PPE_VW.NC_HIS_UNIT_NUM FROM PS_NC_HIS_PPE_VW WHERE PS_NC_HIS_PPE_VW.EMPLID = :searchedSTUDENT";
    
	//Below works, but lets limit it to one returned item only.
	//Unfortunately, it provides student information that matches Summer Term II (2157) and Fall (2158)Terms
    //Comment out on 06 22 2015.
	//public $sql_getunitnumber="SELECT PS_NC_HIS_PP2_VW.EFFECTIVE_TERM, PS_NC_HIS_PP2_VW.BUILDING, PS_NC_HIS_PP2_VW.NC_HIS_UNIT_SUFFIX, PS_NC_HIS_PP2_VW.NC_HIS_UNIT_NUM FROM PS_NC_HIS_PP2_VW WHERE PS_NC_HIS_PP2_VW.EMPLID = :searchedSTUDENT";
    public $sql_getunitnumber="SELECT PS_NC_HIS_PP2_VW.EFFECTIVE_TERM, PS_NC_HIS_PP2_VW.BUILDING, PS_NC_HIS_PP2_VW.NC_HIS_UNIT_SUFFIX, PS_NC_HIS_PP2_VW.NC_HIS_UNIT_NUM FROM PS_NC_HIS_PP2_VW WHERE PS_NC_HIS_PP2_VW.EFFECTIVE_TERM= :term AND PS_NC_HIS_PP2_VW.EMPLID = :searchedSTUDENT";
    
	
	
        
    
    public function getResidenceHall(){        
        return $this->residenceHall;
    }
    
    public function setResidenceHall($stringValue){
        (String) $this->residenceHall=$stringValue;        
    }
    
    public function setCentralAreas($setCentralizedArea){
        (String) $this->centralizedarea=$setCentralizedArea;
    }
    
    public function getCentralArea(){
        return $this->centralizedarea;
    }
    
    public function getDateNeeded(){        
        return $this->date;
    }
    
    public function setDateNeeded($dateProvided){
        (String) $this->date=$dateProvided;        
    }
    
    public function setDateNeededRange($dateProvidedStart,$dateProvidedEnd){
        (String) $this->dateStart=$dateProvidedStart;
        (String) $this->dateEnd=$dateProvidedEnd;
    }
    
    public function setConnection ($connectionValue){        
        $this->connection=$connectionValue;
    }
    
    public function getConnection (){
        return $this->connection;
    }
    
    public function setUnitNumber($unitNumberNEEDED){
        $this->unitNUMBER=$unitNumberNEEDED;
    }
    
    public function getUnitNumber(){
        return $this->unitNUMBER;
        
    }
    
    public function setExcludedSearchStudent($searchedStudentsID){
         $this->excludeSearchedStudent=$searchedStudentsID;   
    }
    
    public function setBeginTime($beginTimePassed){
        $this->beginTIME=$beginTimePassed;
    }
    public function getBeginTime(){
        return $this->beginTIME;
    }
    public function setEndTime($endTimePassed){
        $this->endTIME=$endTimePassed;
    }
    public function getEndTime(){
        return $this->endTIME;
    }
    
    public function __toString()
  {
      //echo "Using the toString method: ";
      return $this->getResidenceHall();
  }
  
  public function setNecessaryInformation($location,$beginTIME,$endTIME){
      $this->residenceHall=$location;
      $this->beginTIME=$beginTIME;
      $this->endTIME=$endTIME;
  }
  
  public function getSQL(){      
      return $this->sql;
  }
  
  //Provide SQL statement that is needed to search for centralized area of campus and not just specify the residence halls
  //as the "getSQL" function above provides.
  public function getSQLFORCENTRALCAMPUSSEARCH(){
       return $this->sql_central_areas;
  }
  
  //Provides the user with just the possible roommmate information
  public function getRoommateSQL(){
      return $this->sql_roommate;
  }
  
  public function getSQLUNITNumber(){
      return $this->sql_getunitnumber;
  }
  
  //Provides the user with everything, is not nearly as specific as the above SQL information.
  public function getSQLNotSpecific(){
      return $this->sql_all;
  }
  
  public function getSQLProvideBuilding(){
      return $this->sql_individual_building;
  }
  public function getSQLProvideBuilding_ProvideDateRange(){
      return $this->sql_individual_building_date_range;
  }
  
  public function getSQLNeededforDateRange(){
      return $this->sql_date_range;
  }
  
  public function getSQLNeededforDateRange_CampusArea(){
      return $this->sql_date_range_central_campus_area;
  }
  
}
