<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<style>
			.container{
				width:80%;
				margin:auto;
				text-align: center;
			}

			.h3{
				margin-bottom: 5% !important;
				margin-top:7% !important;
			}
		</style>		
	</head>
	<body>
		<?php
			include_once('Menu.php');
		?>
		<div class="container">
			<?php
				if(!isset($_SESSION)){
					session_start();
				}
					if (!isset($_SESSION['Login'])) {
					echo "<br><br>Sorry the session has expired.<br><br><br><br>";
					echo "<a type='button' class='btn btn-outline-danger' href='login.php' >Return To Login Page</a>";
					die();
				} else {
				}
			?>
		<h3 class="h3 display-4">Current Tax Rates</h3>
		<table class="table table-striped table-hover table-bordered">
			<tr>
				<th>
					Tax Band
				</th>
				<th>
					Minimum Value
				</th>
				<th>
					Maximum Value
				</th>
				<th>
					Tax Rate
				</th>
			</tr>

		 
			<?php
            
				include_once('Functions.php');

				$FileData = GetJsonData("tax-tables.json");
				if ($FileData <> null){
					$Columns = array(0=>"name", 1=>"minsalary", 2=>"maxsalary",3=>"rate");
					$TableInfo = GetHomeTable($Columns, $FileData);//Displays Tax Table information
				}
			?>
		</table>
		</div>
	</body>
</html>

