var xhr = new XMLHttpRequest();

xhr.open("GET", "script.php", true);


xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr.send("firstname=Roger&lastname=Holden");
