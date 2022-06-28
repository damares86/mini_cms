<!DOCTYPE html>
<html>

<head>
	<style>
		h1 {
			color: green;
			display: flex;
			justify-content: center;
		}

		#mybutton {
			display: block;
			margin: 0 auto;
		}

		#innerdiv {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
	</style>
</head>

<body>

<?php
    $testo = "<p>Questo è il testo.</p>";
    $testo .= "<p>Anche questo.</p>";
?>

	<h1>
		GeeksforGeeks
	</h1>
	<div id="innerdiv"></div>
	<button id="mybutton">
		click me
	</button>
	<script>
        var php_var = '<?php echo $testo ?>';
		document.getElementById("mybutton").
			addEventListener("click", function () {
		document.getElementById("innerdiv").
			innerHTML += php_var;
		});
	</script>
</body>

</html>
