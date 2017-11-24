<script>

    function setBackground(e){
        if (e.type == "focus") {
            e.target.style.backgroundColor = "CAEEAA";
        }
        else if (e.type == "blur") {
            e.target.style.backgroundColor = "white";
            checkForEmptyFields(e);
        }
    }
    
    window.addEventListener("load",	function(){
    	var	cssSelector	=	"input[name=firstname],input[name=lastname],input[name=address],input[name=city],input[name=region],input[name=country],input[name=postal],input[name=phone],input[name=email],input[name=password],input[name=confirm-password]";
    	var	fields	=	document.querySelectorAll(cssSelector);
    	for	(var i=0; i<fields.length; i++)
    	{
    		fields[i].addEventListener("focus",	setBackground);
    		fields[i].addEventListener("blur",	setBackground);
    	}
    }); 
    
    window.addEventListener("submit", checkForEmptyFields);

    function checkForEmptyFields(e){

    	var	fields	=	document.getElementsByClassName("required");
        
        for (var i=0; i<fields.length; i++) {
            if (fields[i].value == null || fields[i].value == "") 
            {
                e.preventDefault();
                fields[i].classList.add("error");
            }
            else
                fields[i].classList.remove("error");
        }
    };

</script>