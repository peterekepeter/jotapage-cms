<script>

	function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

	function checkUser()
	{
		if (document.getElementById("name").value.length <= 3)
			throw "Username is too short! A username of at least 3 characters is required!";
	}
	
	function checkPassFormat()
	{
		if (document.getElementById("pass1").value.length < 6)
			throw "Password is too short! A password of at least 6 characters long is required!";
	}
	
	function checkPassSame()
	{
		var s1 = document.getElementById("pass1").value;
		var s2 = document.getElementById("pass2").value;
		if (s1.localeCompare(s2) != 0)
			throw "Password mismatch! You must type the same password twice to prevent typos.";
	}
	
	function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
	
	
	function checkMailFormat()
	{
		var s = document.getElementById("mail1").value;
		var r = validateEmail(s);
		if (!r)
			throw "Bad email format! Emails should look something like john@domain.com";
	}
	
	function checkMailSame()
	{
		var s1 = document.getElementById("mail1").value;
		var s2 = document.getElementById("mail2").value;
		if (s1.localeCompare(s2) != 0)
			throw "Email mismatch! You must type your email twice to prevent accidental typos.";
	}
	
	function tpr(f,id)
	{
		try
		{
			f();
			document.getElementById(id).innerHTML = "";
		}
		catch (s)
		{
			document.getElementById(id).innerHTML = "<p class='error'>"+s+"</p>";
		}
	}
	
	function submit()
	{
		try
		{
			checkUser();
			checkPassFormat();
			checkPassSame();
			checkMailFormat();
			checkMailSame();
			
			post_to_url('register.php', 
				{
					'name': document.getElementById("name").value,
					'pass': document.getElementById("pass1").value,
					'mail': document.getElementById("mail1").value
				});
			/*window.location.href = "register.php?"+
				"name="+document.getElementById("name").value+"&"+
				"pass="+sha1(document.getElementById("pass1").value)+"&"+
				"mail="+document.getElementById("mail1").value+"&";*/
		}
		catch(s)
		{
			
		}
	}

</script>

<div>
	<table>
	<tr>
		<td>Username</td>
		<td><input id="name" type="text"  onchange="tpr(checkUser,'e1')"></input></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input id="pass1" type="password" onchange="tpr(checkPassFormat,'e2')"></input></td>
	</tr>
	<tr>
		<td>Password Again</td>
		<td><input id="pass2" type="password" onchange="tpr(checkPassSame,'e3')"></input></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input id="mail1" type="text" onchange="tpr(checkMailFormat,'e4')"></input></td>
	</tr>
	<tr>
		<td>Email Again</td>
		<td><input id="mail2" type="text" onchange="tpr(checkMailSame,'e5')"></input></td>
	</tr>
	</table>
	<div id="e1"></div>
	<div id="e2"></div>
	<div id="e3"></div>
	<div id="e4"></div>
	<div id="e5"></div>
	<div class="button" onclick="submit()">Submit</div>
</div>

<?php

		include 'connect.php';
		
		// query

		if (isset($_POST['name'])&&isset($_POST['pass'])&&isset($_POST['mail']))
		{
			$user = $_POST['name'];
			$pass = crypt($_POST['pass'],"poster".$_POST['name']);
			$mail = $_POST['mail'];
			date_default_timezone_set("Etc/GMT-2");
			$date = date("Y-m-d H:i:s"); //YYYY-MM-DD HH:MM:SS
			$db = connect();
			print_r($db);
			$sql = "INSERT INTO `devcms`.`poster` (`name`, `password`, `mail`, `date_joined`, `date_login`) VALUES (:user, :pass, :mail, :date, :date);";
			$q = $db->prepare($sql);
			$q->execute(array(
				':user'=>$user,
				':pass'=>$pass,
				':mail'=>$mail,
				':date'=>$date,
				':date'=>$date
				));
		}
		else
		{
			echo "something went wrong";
		}

		echo "<table style='margin:auto;border:solid 1px black'>";
		echo "<tr style='border:solid 1px black'><td style='border:solid 1px black'>GET</td><td style='border:solid 1px black'>POST</td><td style='border:solid 1px black'>SESSION</td></tr><tr><td style='border:solid 1px black'>";
		print_r($_GET);
		echo "</td><td style='border:solid 1px black'>";
		print_r($_POST);
		echo "</td><td style='border:solid 1px black'>";
		if (isset($_SESSION))
			print_r($_SESSION);
		echo "</td></tr></table>";


?>

