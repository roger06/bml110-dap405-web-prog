18 errors
<DOCTYPE! xhtml>   // 2 - ! in wrong place. x is wrong
<htm>   // 1 - should be html
	<head width="100">   // 1 - no width attribute for head
       <title>Debug me!</title>
        
    <body colour="blue'>    //2 no colour attribute and would be US spelling
        
        <FORM name=="my form" action='process.php' method='post'>   // 3 UPPER case tag, double equals, space in name
               
            Your name: <input type='character' name='customer'></br>   // 2   no character input type, old BR tag                          
            Your salary: <input type='number' name='salary'></br>   // 1   old BR tag                                     
            Your Postcode: <<input type='text' name='post code'></br>   // 3  Double <, space in name attiribure,  old BR tag                                    
            <input type='submit' name='submit me'>                            
                             
                             
                  
        <//form>    // 1    double forward slash      
        
         
        <script>
            alert('you're near the end!'):  // 1   colon instead of semi colon
        </script>
        
          </head>   // 1  closing head tag in wrong place
     </body>
        </html>
  
