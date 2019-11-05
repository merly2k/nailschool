<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>jstree basic demos</title>
	<style>
	html { margin:0; padding:0; font-size:62.5%; }
	body { max-width:800px; min-width:300px; margin:0 auto; padding:20px 10px; font-size:14px; font-size:1.4em; }
	h1 { font-size:1.8em; }
	.demo { overflow:auto; border:1px solid silver; min-height:100px; }
	</style>
	<link rel="stylesheet" href="/css/tree.css" />
</head>
<body>
	<h1>AJAX demo</h1>
	<div id="ajax" class="demo"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="/js/jstree.js"></script>
	
	<script>
	$('#ajax').jstree({
		'core' : {
			'data' : {
				"url" : "root",
				"dataType" : "json" // needed only if you do not supply JSON headers
			}
		}
	});

	</script>
</body>
</html>
