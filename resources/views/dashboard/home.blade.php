<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width">
	<title>Garage | IIM SAMARPAN</title>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,700">
</head>
<style type="text/css">
	@-webkit-keyframes grow-width {
	  from {
	    width: 0;
	  }
	}
	@keyframes grow-width {
	  from {
	    width: 0;
	  }
	}
	body {
	  font-family: "Roboto", Arial;
	  background: #EDEDED;
	}

	main {
	  width: 400px;
	  margin: 30px auto;
	  padding: 10px 40px 50px;
	  background: #FFF;
	  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
	}

	h1, h2,h4 {
	  text-align: center;
	  color: #333;
	}

	p {
	  font-size: 13px;
	}

	section {
	  vertical-align: top;
	  margin-top: 20px;
	}

	section:nth-of-type(odd) {
	  margin-right: 20px;
	}

	.style-1 {
	  list-style-type: none;
	  padding: 0;
	  width: 350px;
	}
	.style-1 li {
	  position: relative;
	  height: 50px;
	}
	.style-1 li em, .style-1 li span {
	  display: block;
	  border-bottom: 5px solid #FFE5E5;
	  padding-bottom: 5px;
	}
	.style-1 li em {
	  font-style: normal;
	  border-bottom-color: #DB6B6B;
	  position: absolute;
	  overflow: visible;
	  -webkit-animation: grow-width 2s;
	          animation: grow-width 2s;
	}
	.style-1 li span {
	  text-align: right;
	}

	.style-2 {
	  list-style-type: none;
	  padding: 0;
	  width: 350px;
	}
	.style-2 li {
	  height: 50px;
	}
	.style-2 li em, .style-2 li span {
	  padding: 5px 10px;
	}
	.style-2 li em {
	  text-align: right;
	  font-style: normal;
	  float: left;
	  width: 85px;
	}
	.style-2 li span {
	  display: inline-block;
	  background: #FFE5E5;
	  overflow: visible;
	  -webkit-animation: grow-width 2s;
	          animation: grow-width 2s;
	}
	em a{
		color:inherit;
		text-decoration: none;
	}
</style>
<body>

<main>
  <h2>Events</h2>
  <h5></h5>
  <section>
    <ul class="style-1">
@foreach($data as $item)
      <li>
        <em>
					<a href="/garage/{{$item->name}}"> {{$item->name}} </a>
        </em>
        <span>
					{{$item->count}}
        </span>
      </li>
@endforeach
    </ul>
  </section>  
</main>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script type="text/javascript">
	function setBarWidth(dataElement, barElement, cssProperty, barPercent) {
	  var listData = [];
	  $(dataElement).each(function() {
	    listData.push($(this).html());
	  });
	  var listMax = Math.max.apply(Math, listData);
	  $(barElement).each(function(index) {
	    $(this).css(cssProperty, (listData[index] / listMax) * barPercent + "%");
	  });
	}
	setBarWidth(".style-1 span", ".style-1 em", "width", 100);
</script>
</body>
</html>