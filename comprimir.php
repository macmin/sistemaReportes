<!DOCTYPE html>
<html>
<head>
	<title>..</title>
</head>
<body>


	<input type="text" name="codigo" id="codigo">
	<button id="btn" onclick="ver()">ver </button>


	<script >
		
		function ver(){
		
			var codigo = document.getElementById("codigo").value;
			alert(codigo);

		}

	</script>

</body>
</html>