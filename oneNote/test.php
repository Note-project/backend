
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 
 <script>
     $.post("registration.php",{email:"test2",password:"aaaa"},function(data){
         console.log(data);
     })
 </script>