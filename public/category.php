<?php include 'config.php' ?>
<?php include 'functions.php' ?>
<?php include 'vendor/autoload.php'; ?>
<?php add_item(); ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>

  	<style type="text/css">
		span.stars, span.stars span {
			display: block;
			background: url("<?php echo $path . "img/page/stars.png" ?>") 0 -16px repeat-x;
			width: 80px;
			height: 16px;
		}

		span.stars span {
			background-position: 0 0;
		}
	</style>

	<style>
  			.row {
    			max-width: 95%;
			}
  		</style>

  </head>
  <body>

				<?php
								if(!isset($_GET["group"])){
													$_GET["group"]=1;
														}
								if(!isset($_GET["value"])){
													$_GET["value"]="asc";
														}
								if(!isset($_GET["category"])){
													$_GET["category"]="1";
														}

				?>


	<?php include 'menu.php'; ?>
	<?php

	// Prvo zadajemo uvjete za slaganje stranica,
	// tj. prvotna stranica i broj objava po stranici

if(!isset($_GET["page"])){
	$page=1;
}else{
	$page = $_GET["page"];
}
if($page==0){
	$page=1;
}

$npp = 8;

  // Šaljemo parametre klasi koju smo prvotno napravili u „composor“u.
  // Prvotno izvlačimo podatke za podjelu stranica, te potom izvlačimo i same podatke.

use plava\pagination;

$cat = new pagination();

$cat->con=$con;
$cat->page=$page;
$cat->npp=$npp;

$data = $cat->pagination('a.product_id','products as a inner join categories_products as b on a.product_id = b.product',
						 'where a.deleted = 0 and b.category = ' . $_GET["category"]);
$catch = $cat->paginationCatch('a.category, a.product, b.model, b.price, b.date_created, b.quantity_in_stock, c.path, count(d.id) as reviewcount,
							    ifnull(avg(d.grade),0) as averagegrade',
							 	'categories_products as a
								inner join products as b on a.product=b.product_id
								inner join categories as e on a.category = e.category_id
								inner join images as c on b.product_id=c.product
								left join reviews as d on b.product_id = d.product',
								'where a.category =  ' . $_GET["category"] . ' and ' .
						       'b.deleted = 0 and
						   		b.quantity_in_stock > 0 and
								b.deleted = 0 and
								c.featured = true',
							   'group by b.model, b.price, c.path
						   		order by ' . $_GET['group'] . ' ' . $_GET['value']);

$totalPages = $data->totalPages;

if($page==$totalPages+1){
	$page=$totalPages;
				}

?>

	<br />
	<div class="row">
		<div class="large-3 columns">
			<br />
			<h4 style="float: left;">Order by</h4>
			<br /><br />


							<!-- order by buttons -->



								<a class="small button" href="<?php echo $_SERVER["PHP_SELF"] ?>?category=<?php echo $_GET['category']; ?>&group=4&value=<?php echo $_GET["value"]; ?>">
									price
								</a> <a class="small button" href="<?php echo $_SERVER["PHP_SELF"] ?>?category=<?php echo $_GET['category']; ?>&group=3&value=<?php echo $_GET["value"]; ?>">
									model name
								</a> <a class="small button" href="<?php echo $_SERVER["PHP_SELF"] ?>?category=<?php echo $_GET['category']; ?>&group=5&value=<?php echo $_GET["value"]; ?>">
									date
								</a> <a class="small button" href="<?php echo $_SERVER["PHP_SELF"] ?>?category=<?php echo $_GET['category']; ?>&group=8&value=<?php echo $_GET["value"]; ?>">
									review
								</a>
								<?php if ($_GET["value"]=="asc"): ?>
								<h6></h6>
								<a class="small button" href="<?php echo $_SERVER["PHP_SELF"] ?>?category=<?php echo $_GET['category']; ?>&group=<?php echo $_GET["group"]?>&value=desc">
									descending
								</a>
								<?php else: ?>
								<h6></h6>
								<a class="small button" href="<?php echo $_SERVER["PHP_SELF"] ?>?category=<?php echo $_GET['category']; ?>&group=<?php echo $_GET["group"]?>&value=asc">
									ascending
								</a>

				<br />
			<?php endif; ?>
				</div>
							<!-- end order by buttons -->


			<div class="large-9 columns">


	<div class="row">

					<!-- bread crumbs -->


		<div class="large-6 show-for-large columns">
				<ul class="breadcrumbs">
				 	<?php bread_crumps(); ?>
				 </ul>

	</div>

					<!-- end bread crumbs -->

	<div class="large-6 columns show-for-large">
	<?php show_all_button(); ?>
	</div>
	</div>
	<br />
	<h4 style="float: left;"><?php echo $_SESSION['title']; ?></h4>


		      <div class="row small-up-2 medium-up-3 large-up-4">
		     <br />
		      <?php

		      foreach ($catch->array as $item) {
			  include 'category_each_item.php';
				}
		       ?>
		      </div>

		 			<div class="pagination-centered">
		<ul class="pagination">
			<li><a href="category.php?page=1&category=<?php echo $_GET['category'] . '&group=' . $_GET['group'];?>">First</a></li>
			<li class="arrow"><a href="category.php?page=<?php echo $page-1 . '&category=' . $_GET['category'] . '&group=' . $_GET['group']; ?>">&laquo;</a></li>
			 <?php
				for($i=1; $i<=$totalPages;$i++):
					if($i-5<=$page && $i+5>=$page):
					    ?>
					    <li <?php if($i==$page){ echo "class=\"current\""; } ?>><a href="category.php?page=<?php echo $i . '&category=' . $_GET['category'] . '&group=' . $_GET['group']; ?>"><?php echo $i; ?></a></li>
					    <?php endif; endfor;?>
					    <li class="arrow"><a href="category.php?page=<?php echo ($page==$totalPages ? $page : $page+1) . '&category=' . $_GET['category'] . '&group=' . $_GET['group'] ?>">&raquo;</a></li>
					    <li ><a href="category.php?page=<?php echo $totalPages . '&category=' . $_GET['category'] . '&group=' . $_GET['group'] ?>">Last</a></li>
					  </ul>
					</div>

		     </div>
				</div>

	<?php include 'footer.php' ?>
	<?php include 'script.php' ?>

	    <script>

    	$.fn.stars = function() {
			return $(this).each(function() {
				$(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * 16));
			});
		}

		$('span.stars').stars();

    </script>

  </body>
</html>
