<?php 

require('inc/fns-inc.php');
require_once('inc/header-inc.php');

$taxfile   = 'data/tax-tables.json';

try {
    
    // $json = @file_get_contents($jsonfile) or die("cannot open file - $jsonfile");
    $taxjson = @file_get_contents($taxfile); 
} catch (Exception $e) {

   // echo 'Caught exception: ',  $e->getMessage(), "\n";

    include('inc/error-inc.php');
    include('inc/footer-inc.php');
    exit;
}

restore_error_handler();
// https://www.php.net/manual/en/function.restore-error-handler.php


$tax_rates_array = json_decode($taxjson, true); 

// var_dump($tax_rates_array);
// exit;

$header_array = array("name"=>"Name", "description"=>"Description", "minsalary"=>"Min Salary", "maxsalary"=>"Max Salary","rate"=>"Rate", "exceptions"=>"Exceptions");
// var_dump( json_decode($json, false));

?>

<main class="container">
<h1>Tax Rates <?php echo date("Y");?></h1>
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
        <tr>
<?php

// echo "<pre>"; print_r($tax_rates_array); echo "</pre>";

// print header row
foreach ($header_array as $header => $label){
    echo "<th>" . $label . "</th>";
}
?>

</tr>


<?php
 foreach($tax_rates_array as $data){
    echo "<tr>";  
    foreach ($header_array as $header => $label){
        

        // handle the exceptions field - this is probably much easier as an array than object!
        

        echo "<td>";

        if (is_array($data[$header])) {
          
            $implode = '';

            foreach ($data[$header] as $key => $value) {

                foreach ($value as $key => $data)
                $implode .= $key . ": " .$data;
                $implode .= ", ";

            }
            echo substr($implode, 0, -2);
            // $header = $implode;
            // echo "<pre>"; print_r($data[$header]); echo "</pre>";

        }

        else {
            if ($header == 'minsalary' OR $header == 'maxsalary'){
               echo "&pound;"; 
               $data[$header] = number_format($data[$header],2);
            } 

            
            echo $data[$header];
        
        }
            if ($header == 'rate') echo '%';


        echo "</td>";
        }
    
   

echo "</tr>";
} // end outer foreach


// exit;




?>
        </table>
    </div>
</div>
<hr>
<div class="row">

		<section class="content">
			<h1>Tax rates</h1>
			<div class="col-md-12">
			<!-- <div class="col-md-12 col-md-offset-2"> -->
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-success btn-filter" data-target="paid">paid</button>
								<button type="button" class="btn btn-warning btn-filter" data-target="pending">pending</button>
								<button type="button" class="btn btn-danger btn-filter" data-target="cancelled">cancelled</button>
								<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
							</div>
						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody>

                                <?php

                                foreach($tax_rates_array as $data){ 



                                }

?>

									<tr data-status="paid">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox1">
												<label for="checkbox1"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right paid">(paid)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="pending">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox3">
												<label for="checkbox3"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right pending">(pending)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="cancelled">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox2">
												<label for="checkbox2"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right cancelled">(cancelled)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="paid" class="selected">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox4" checked>
												<label for="checkbox4"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star star-checked">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right paid">(paid)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="pending">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox5">
												<label for="checkbox5"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right pending">(pending)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

</main>


 






<?php require_once('inc/footer-inc.php');?>