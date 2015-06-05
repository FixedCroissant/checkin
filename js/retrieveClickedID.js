    
function Notification(number){
    var message;
    
    message = number;
   localStorage.setItem("IDNumber", message);
   
   alert("Student ID saved, please go back to original screen.");
    
   return message;
}
