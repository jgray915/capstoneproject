<!DOCTYPE html>
<html>
	<head>
		<title> Week 6 Demo </title>
		<style>
			.contentBox {
				width: 300px;
				margin: 1em;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
	</head>
<body>
	<div id="content" class="contentBox"></div>
	<input type="button" id="showResults" value="Show Results" />
        <script type="text/javascript">
            /* 
                https://developer.mozilla.org/en-US/docs/AJAX
                AJAX stands for Asynchronous JavaScript and XML.  It allows us to make a call'
                to a server( like accessing another page) without having to leave or refresh
                the current page.  
    
                In order to create a request object, we can store the object in a variable like so.
                var xhr = new XMLHttpRequest();
                This will create an AJAX object that will have properties and methods(functions) we
                can use.
    
                To read more about AJAX go here
                https://developer.mozilla.org/en-US/docs/AJAX/Getting_Started
             */
                                       
		// XML HTTP Request
		var xhr = new XMLHttpRequest();
		var content = document.getElementById('content');  
		var showResults = document.getElementById('showResults');  
		var url = "index2.php?page=";
        var step = 1;
	
        showResults.addEventListener('click',makeAJAXCall);
		
        function makeAJAXCall(){
            if ( step < 5 ) {      
                        xhr.open('GET', url+step, true);  
                        xhr.send();   
                    }
                };      
	
		xhr.onreadystatechange = function() { 
            if (xhr.readyState==4 && xhr.status==200) {  
			callback();  
		   } 
		};  

		function callback() {
			var response = xhr.responseText;  
			content.innerHTML += response;
                        step++;                
		};
	</script>
</body>
</html>