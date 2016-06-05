	<div class="top-bar" id="example-menu">
        <div class="top-bar-left">
          <ul class="dropdown menu" data-dropdown-menu>
            <li><a href="<?php echo $path ?>main">Home</a></li>
            <li class="has-submenu">
              <a href="#">Products</a>
              <ul class="submenu menu vertical" data-submenu>
		  <?php
					$cat = new category();
					$cat->con=$con;
					$cat->path=$path;
					echo $cat->startCategory();
			?>
              </ul>
            </li>

            <li class="has-submenu">
              <a href="#">Data</a>
              <ul class="submenu menu vertical" data-submenu>
					<li><a href="quality_report">Quality report</a></li>
					<li><a href="download_csv_catalog">Download csv catalog</a></li>
					<li><a href="ERA">ERA</a></li>
              </ul>
            </li>



             <li class="has-submenu">
              <a href="#"><?php menu_name(); ?></a>
              <ul class="submenu menu vertical" data-submenu>
				<?php menu_user_pages(); ?>
              </ul>
            </li>
            <li><a href="<?php echo $path ?>contact">Contact</a></li>

          		<?php if(isset($_COOKIE['user_first_name'])){
				echo '<li class="show-for-large"><a href="#">Welcome ' . $_COOKIE['user_first_name'] . '</a></li>';
				} ?>

          </ul>
        </div>
        <div class="top-bar-right">
		   <form id="buttonAjax">
           <input type="search" placeholder="Search" id="term">
           </form>
        </div>
      </div>
