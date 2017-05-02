<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<script
	src="https://code.jquery.com/jquery-3.2.1.js"
	integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
	crossorigin="anonymous">
</script>
<div id="submitButton" class="button" onclick=submitList()>
	Submit
</div>

<form id="operationsList"></form>

<textarea id="inputData" height="20" cols="40">
one
two
three
four
</textarea>
<textarea id="inputData2" height="20" cols="40">
three
one
</textarea>
<textarea id="outputData" height="20" cols="40"></textarea>

<script>

	function getOperations(){
		var response = ""
		$.get("manipulate.php",'getOperations',function(results) {
			response = JSON.parse(results);
			populateOperations(response);
		})
	}

	function populateOperations(operations) {
		console.log(operations);
		$.each(operations,function(i,v) {
			var newLi = $('<li class="' + i + '">');
			var newOption = ($('<input type="radio" name="operation">'));
			newOption.attr('value',v);
			if (i === 0) {
				newOption.prop("checked", true);
			}
			newLi.append(newOption);
			newLi.append(v);
			$("#operationsList").append(newLi);
		})
	}

	getOperations();

	function submitList(){
		var textContents = {};
		textContents['list'] = $('#inputData').val().split('\n');
		textContents['list2'] = $('#inputData2').val().split('\n');
		textContents['operation'] = $('input[name=operation]:checked').val();
		
		$.post("manipulate.php",textContents,function(results) {
			var outputList = JSON.parse(results).join("\n");
			$('#outputData').val(outputList);
		});
	}

</script>
</body>
</html>