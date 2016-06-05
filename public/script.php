<script src="<?php echo $path; ?>js/vendor/jquery.min.js"></script>
<script src="<?php echo $path; ?>js/vendor/what-input.min.js"></script>
<script src="<?php echo $path; ?>js/foundation.min.js"></script>
<script src="<?php echo $path; ?>js/app.js"></script>

<!-- scripts for jquery search -->

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>

    	$(function (){

    		$("#buttonAjax").click(function(){
				return false;
    		});

    		var option = {source: "ccc", minLength:2};
    		$("#term").autocomplete({
				    source: "admin/admin_data_for_search_menu.php",
				    minLength: 2,
				    focus: function( event, ui ) {
				    	event.preventDefault();
				    	},
				    select: function(event, ui) {
				        $(this).val('').blur();
				        event.preventDefault();

				       document.location.href="product.php?category=" + ui.item.categoryId
				        + "&product=" + ui.item.productId;

				    }
					}).data( "ui-autocomplete" )._renderItem = function( ul, object ) {
				      return $( "<p style='background: #403C36; max-width: 12.5rem; margin-bottom: 0'>" )
				        .append( "<a>" + object.categoryName + ": " + object.productName
				         + "</a>" )
				        .appendTo( ul );
				    };

    			});
    </script>

<p style='background: grey; max-width: 10em'>
