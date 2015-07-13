//July 08 2015-- errors with SyntaxError:
//08 is not a legal ECMA-262 octal constant, continually
//making this search fail.

//Function is being called in the db/search_last_name.php or db/search_first_name.php files.


function Notification(number){
    var message;    
    message = number;
   //Not working as well as I want.
   //Trying cookies.
   //localStorage.setItem("IDNumber", message);
   //Set a cookie that will expire at the end of September.
      
   //Temporarily comment out.
   document.cookie ='IDNumber='+number+'; expires=Wed, 30 Sept 2015 20:47:11 UTC; path=/'
 
   //Temporarily comment out.
   alert("Student ID: "+number+" has been saved, please click the 'go back' button to search for this student automatically.");
   
 	
   return message;
}