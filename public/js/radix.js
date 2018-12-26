function ValidateEmail(mail)   
{  
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))  
	{  
		return (true);
	} 
	return (false);
} 


function ValidateMobile(mobile)
{
	var phoneno = /^\d{10}$/;
	if((mobile.match(phoneno)))
	{
		return (true);
	}
	return (false);
}

function ValidateDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  if(!dateString.match(regEx)) return false;  // Invalid format
  var d = new Date(dateString);
  if(Number.isNaN(d.getTime())) return false; // Invalid date
  return d.toISOString().slice(0,10) === dateString;
}


function ValidateTime(time){
   //var filter = new RegExp("(0[123456789]|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24)([:])(0[123456789]|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31|32|33|34|35|36|37|38|39|40|41|42|43|44|45|46|47|48|49|50|51|52|53|54|55|56|57|58|59)");
   var filter = new RegExp("^([0-1][0-9]|2[0-4]):([0-5][0-9])?$");
   if(filter.test(time))
   {
      return (true);
   }
   else
    {
     return (false);
    }   
}


function ValidateDateTime(date){
  var datefilter = new RegExp("(0[123456789]|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31)([/])(0[123456789]|10|11|12)([/])([2][0-9][0-9][0-9])");
  var timefilter = new RegExp("^([0-1][0-9]|2[0-4]):([0-5][0-9])?$");
  var string = date,
  substring = "/";
  let datestring = string.includes(substring);  
  if(datestring){
    if(datefilter.test(date)){
       //alert("date correct");
      return (true);
    }else{
      //alert("jkfdkf");
      return (false);
    }
  }
  else if(!datestring){
    if(timefilter.test(date)){
      //alert('correct time');
      console.log('correct time');
      return (true);
    }else{
      //alert('wrong time');
      return (false);
    }
  }   
} 
