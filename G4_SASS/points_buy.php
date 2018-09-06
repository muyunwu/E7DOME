<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>E7DOME</title>
	<link rel="stylesheet" href="css/payment.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
</head>
<body>
	<?php include 'header.php';?>
	<?php 
		require_once('php/connect_g4.php');
		// $_SESSION["MEM_ID"] = 'WESLEY';
		// $CARD_NO = $_GET['CARD_NO'];
		// $sql = "select * from pointcard where CARD_NO = '$CARD_NO'";             
		// $query = $pdo->query($sql);
		// $row = $query->fetch(PDO::FETCH_ASSOC);	
	?>
	<h1 class="payment_title">儲值點數</h1>
	<div class="wrapper">
		<div class="payment_select">
			<h3 class="payment_select_title">付費方式</h3>
			<label class="payment_method active">
			<div class="outline2"></div>
				<img src="images/points/visa.png" alt="">
				<input type="radio" name="CARD_METHOD" id="" class="CARD_METHOD" value="1" checked="checked">
			</label>
			<label class="payment_method">
			<div class="outline2"></div>
				<img src="images/points/familymart.png" alt="">
				<input type="radio" name="CARD_METHOD" id="" class="CARD_METHOD" value="2">
			</label>
			<label class="payment_method">
			<div class="outline2"></div>
				<img src="images/points/linepay.png" alt="">
				<input type="radio" name="CARD_METHOD" id="" class="CARD_METHOD" value="3">
			</label>
			<h3 class="payment_select_title">選擇點數</h3>
			<div id="payment_points">
				<div class="payment_points_title">
					<div class="payment_points_left">價格</div>
					<div class="payment_points_right">點數</div>
				</div>


				<?php
				$sql = "select * from pointcard";             
				$query = $pdo->query($sql);	
				$rows = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach($rows as $keys => $row){
					if(isset($_GET['CARD_NO'])){
						if($row['CARD_NO']==$_GET['CARD_NO']){
							echo '<label class="payment_points_list active">
									<div class="outline"></div>
									<div class="payment_points_left">
										<span class="points_checked"></span>
										NT$'.$row['CARD_PRICE'].
									'</div>
									<div class="payment_points_right">
										一起動點數 X'.$row['CARD_POINTS'].
									'</div>
									<input type="radio" name="CARD_NO" id="" class="CARD_NO" value="'.$row["CARD_NO"].'"checked='.'"checked" \">
								</label>';
									}			
						else{				
							echo '<label class="payment_points_list">
									<div class="outline"></div>
									<div class="payment_points_left">
										<span class="points_checked"></span>
										NT$'.$row['CARD_PRICE'].
									'</div>
									<div class="payment_points_right">
										一起動點數 X'.$row['CARD_POINTS'].
									'</div>
									<input type="radio" name="CARD_NO" id="" class="CARD_NO" value="'.$row["CARD_NO"].'">
								</label>';			
							}	
					}	
					else{
						if($keys==0){
							echo '<label class="payment_points_list active">
									<div class="outline"></div>
									<div class="payment_points_left">
										<span class="points_checked"></span>
										NT$'.$row['CARD_PRICE'].
									'</div>
									<div class="payment_points_right">
										一起動點數 X'.$row['CARD_POINTS'].
									'</div>
									<input type="radio" name="CARD_NO" id="" class="CARD_NO" value="'.$row["CARD_NO"].'"checked='.'"checked"'.'">
								</label>';
									}			
						else{				
							echo '<label class="payment_points_list">
									<div class="outline"></div>
									<div class="payment_points_left">
										<span class="points_checked"></span>
										NT$'.$row['CARD_PRICE'].
									'</div>
									<div class="payment_points_right">
										一起動點數 X'.$row['CARD_POINTS'].
									'</div>
									<input type="radio" name="CARD_NO" id="" class="CARD_NO" value="'.$row["CARD_NO"].'">
								</label>';			
							}	
					}
				}
				?>
			</div>
		</div>
		<div class="payment_confirm">
			
		</div>
	</div>
	
	<script>
		$(document).ready(function () {
			function show(){
				$.ajax({
				url: 'php/points_confirm.php',
				dataType: 'text',
				data:{
					CARD_NO:parseInt($("input[name='CARD_NO']:checked").val()),
					CARD_METHOD:parseInt($("input[name='CARD_METHOD']:checked").val()),
				},
				success: function (data) {
					// alert(data);
					$('.payment_confirm').children().remove();
					$('.payment_confirm').append(data);
					$('form').submit(function (e) {
						var form = this;
						e.preventDefault();
						setTimeout(function () {
							form.submit();
						}, 3000); // in milliseconds
					});
				}
			})
		}

		show();
		$('.CARD_METHOD').click(function(){
			show();
			$(this).parent().addClass('active');
			$('.CARD_METHOD').not(this).parent().removeClass('active');
		});	
		$('.CARD_NO').click(function(){
			$(this).parent().addClass('active');
			$('.CARD_NO').not(this).parent().removeClass('active');
			show();
		});

	})

	</script>
</body>
</html>
