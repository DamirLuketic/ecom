<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>
  </head>
  <body>
	<?php include 'menu.php'; ?>
	<br />
		<!-- part two - show -->
	
	
		<div class="row">
		<div class="large-12 columns">
			<div id="container" class="alert callout" style="min-height: 600px">
			</div>
		</div>	
	</div>	
	<?php include 'footer.php' ?>
	<?php include 'script.php' ?>

	<!-- part one - scripts -->
	
<script src="<?php echo $path; ?>js/highcharts/highcharts.js"></script>
<script src="<?php echo $path; ?>js/highcharts/exporting.js"></script>

<script>
	
	$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Basic categories by reviews grade.'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Proizvodi',
                colorByPoint: true,
                data: [
                <?php 
                
                $expression = $con->query("
					 select a.name, ifnull(avg(d.grade),0) as averagegrade
					 from categories as a 
					 inner join categories_products as b on a.category_id = b.category
					 inner join products as c on b.product = c.product_id
					 left join reviews as d on c.product_id = d.product
					 where a.parent is null
					 group by a.category_id
					");
					$result = $expression->fetchAll(PDO::FETCH_OBJ);
					foreach($result as $red):
                ?>
                {
                    name: '<?php echo str_replace("'", "\\'", $red->name) ?>',
                    y: <?php echo $red->averagegrade ?>
                }, 
                <?php 
                endforeach;
                ?>
                               
                ]
            }]
        });
    });
});
		
</script>

  </body>
</html>
