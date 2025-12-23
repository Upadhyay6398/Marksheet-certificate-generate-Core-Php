/****
 * Numeric Validation
 */ 
function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var $ele=$(evt.target);
	var str =$ele.val();
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	var substrings = str.split(".");
	
   //alert(substrings.length -1);
   	if((substrings.length - 1)==1 && charCode==46 )
	  {
		return false;  
	  }

	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !=46) {
			return false;
	      }
			return true;
	}	
