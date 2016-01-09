<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width">
	<title>Garage | IIM SAMARPAN</title>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,700">
	<link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
</head>
<style type="text/css">
	body {
	  font-family: "Roboto", Arial;
	  background: #EDEDED;
	  padding: 20px;
	  font-size: 16px;
	}

	h1, h2,h4 {
	  text-align: center;
	  color: #333;
	}
	main {
		margin: 30px auto;
		padding: 10px 40px 50px;
		background: #FFF;
		box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
	}

	#exportExcel a {
		text-align: center;
	}

	th {
		text-transform: uppercase;
	}

</style>
<body>

<main>
	<div class="table-responsive">
  <h2>
  <a href="../">Go back</a> Or
  <a id="exportExcel" href>Export to excel</a>
  </h2>
  <table class="table table-striped table-condensed">
  	<thead>
      <tr>
      	<th>No</th>
      	@foreach ($keys as $key)
          <th>{{$key}}</th>
        @endforeach  
      </tr>
    </thead>
    <tbody>
    	@foreach ($list as $i => $item)
      <tr>
    	<td>{{$i}}</td>
        @foreach ($keys as $key)
        	<td> {{json_decode($item['data'],true)[$key]}}</td>
 				@endforeach
			</tr>
			@endforeach
		</tbody>
  </table>
  </div>
</main>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script src="/jquery.table2excel.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		function getCSV() {
			var event = window.location.pathname.split('/')[2]
			$("table").table2excel({
			    name: event,
			    filename: event 
			});
		}

		$('#exportExcel').click(function (event) {
			event.preventDefault();
			getCSV();
		})

	})
</script>
</body>
</html>