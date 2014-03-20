    </div>
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	function update()
	{
		var memtotal, memused, memper;

		$.get("functions/functions.php", { info: "temp" }, function(data) { $('.temp span').text(data + "°C"); } );
		$.get("functions/functions.php", { info: "uptime" }, function(data) { $('.time span').text(data); } );		
		$.get("functions/functions.php", { info: "memtotal" }, function(data) { $('.memory .total').text(data + 'MB'); } );
		$.get("functions/functions.php", { info: "memused" }, function(data) { $('.memory .used').text(data + 'MB'); } );
		$.get("functions/functions.php", { info: "memper" }, function(data) { $('.memory .now').css({ 'width' : data + '%' }); } );
		$.get("functions/functions.php", { info: "swaptotal" }, function(data) { $('.memory .swaptotal').text(data + 'MB'); } );
		$.get("functions/functions.php", { info: "swapused" }, function(data) { $('.memory .swapused').text(data + 'MB'); } );
		$.get("functions/functions.php", { info: "swapper" }, function(data) { $('.memory .swapnow').css({ 'width' : data + '%' }); } );

		$.get("index.php", function(data, status) { if(status != 'success') $('html').html('连接中断'); } );
	}
	
	window.setInterval(update, 1000); 	
	</script>

</body>
</html>