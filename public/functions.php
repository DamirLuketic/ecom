<?php
							// index - categories

function index_category(){

include 'config.php';

$category = $con->query(' select name, category_order from categories where parent is null');

$categories = $category->fetchAll(PDO::FETCH_OBJ);

foreach($categories as $category){
	include 'index_category_each.php';
	}
}

						// function login - use what you need

function login(){

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){

include 'config.php';

$user = $con->prepare(" select *
						from users as a
						inner join roles as b on a.role = b.role_id
						where email=:email and password = md5(:password) and active = 1 ");

$user->execute(array(
			'email'    => $_POST["email"],
			'password' => $_POST["password"]
));

$user = $user->fetch(PDO::FETCH_OBJ);

if(isset($user->user_id)){

			setcookie('user_id', $user->user_id, time() + 86400);
			setcookie('user_role', $user->role, time() + 86400);
			setcookie('user_active', $user->active, time() + 86400);
			setcookie('user_email', $user->email, time() + 86400);
			setcookie('user_first_name', $user->firstname, time() + 86400);
			setcookie('user_last_name', $user->lastname, time() + 86400);
//			setcookie('user_address', $user->address, time() + 86400);
//			setcookie('user_postoffice', $user->postoffice, time() + 86400);
//			setcookie('user_city', $user->city, time() + 86400);
//			setcookie('user_state', $user->state, time() + 86400);
//			setcookie('user_country', $user->country, time() + 86400);

					header('location: main');

			}
				}
			};

function login_try(){
			if(!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) || empty($_POST['email'])){
			echo 'Enter email and password';
       		 }else{
        	if(!isset($_COOKIE['user_id'])){
        	echo 'Wrong e-mail and/or password';
        		}
      	  }
}

						// function logout

function logout(){

			$past = time() - 3600;
			foreach ( $_COOKIE as $key => $value ){
   	 			setcookie( $key, $value, $past);
				}

						// if unset only user data

			//	setcookie('user_id','', 1);
			//	setcookie('user_email','', 1);
			//	setcookie('user_firstname','', 1);
			//	setcookie('user_lastName','', 1);
			//	setcookie('user_address','', 1);
			//	setcookie('user_city','', 1);
			//	setcookie('user_state','', 1);
			//	setcookie('user_state','', 1);

				header('location: main');
}

					// function for menu name

function menu_name(){
				if(isset($_COOKIE['user_id'])){
					if($_COOKIE['user_role']=='1'){
						echo 'Admin';
					}else{
					echo 'User';
					}
			}else{
				echo 'Login\Register';
			}
}


				// function for menu user pages (user and admin part)

function menu_user_pages(){

	include 'config.php';

				if(isset($_COOKIE['user_id'])){
					if($_COOKIE['user_role']=='1'){
				$pages = array(
						 'admin_add' => 'Admin pages',
				);

				foreach($pages as $address => $name){
					echo '<li><a href="' . $path . $address . '">' . $name . '</a></li>';
						}

					}
				$pages = array(
						'user_personal' 			=> 'Personal data',
						'cart' 						=> 'Shoping Cart',
						'logout' 					=> 'Logout'

				);

				foreach($pages as $address => $name){
					echo '<li><a href="' . $path . $address . '">' . $name . '</a></li>';
						}

			}else{
					$pages = array(
							'login' 					=> 'Login',
							'register'  				=> 'Register'
				);

				foreach($pages as $address => $name){
					echo '<li><a href="' . $path . $address . '">' . $name . '</a></li>';

		}
	}
}

						// class and function for categoris menu

	class category {
	var $menu;
	var $con;
	var $path;

	function startCategory() {

		$menu = array(0 => array('children' => array()));
		$expression = $this->con->query("select * from categories order by parent asc, category_order");
		$array = $expression->fetchAll(PDO::FETCH_ASSOC);
		foreach ($array as $data){
			$menu[$data['category_id']] = $data;
			$menu[(is_null($data['parent']) ? '0' : $data['parent'])]['children'][] = $data['category_id'];
		}
		$this -> menu = $menu;
		$nav = '<ul class="dropdown menu" data-dropdown-menu>';
		foreach ($menu[0]['children'] as $child_id) {
			$nav .= $this -> makeNav($menu[$child_id]);
		}
		$nav .= '</ul>';
		return $nav;
	}

	function makeNav($menu) {

		$nav_one = '<li>' . "\n\t" . '<a href="' . $this->path . 'category.php?category=' . $menu["category_id"] . '">' . $menu['name'] . '</a>';
		if (isset($menu['children']) && !empty($menu['children'])) {
			$nav_one .= "<ul  class=\"menu vertical\">\n";
			foreach ($menu['children'] as $child_id) {
				$nav_one .= $this -> makeNav($this -> menu[$child_id]);
			}
			$nav_one .= "</ul>\n";
		}
		$nav_one .= "</li>\n";
		return $nav_one;
	}

}

										// function that show select all in one category buttons (category.php)

		function show_all_button(){

		include 'config.php';

		$show_button = $con->query(' select name, category_order from categories where parent is null ');
		$show = $show_button->fetchAll(PDO::FETCH_OBJ);

		foreach($show as $button){
			echo '<div class="large-4 columns"><a class="tiny button" href="' . $path . 'category.php?category=' . $button->category_order . '">' . $button->name . '</a></div>';
		}
		}

							// show all item in one category (in category.php, but start in index.php) -
							// repare - make show pa ultimate parent (which parent is null)???

 function show_all_in_category(){

	if(isset($_GET['category'])){

	include 'config.php';

	$cat = $con->prepare(' select a.category, a.product, b.model, b.price, b.date_created, b.quantity_in_stock, c.path, count(d.id) as reviewcount,
							    ifnull(avg(d.grade),0) as averagegrade
								from categories_products as a
								inner join products as b on a.product=b.product_id
								inner join categories as e on a.category = e.category_id
								inner join images as c on b.product_id=c.product
								left join reviews as d on b.product_id = d.product
						  		where a.category = :category  and
						        b.deleted = 0 and
						   		b.quantity_in_stock > 0 and
								b.deleted = 0 and
								c.featured = true
								group by b.model, b.price, c.path
						   		order by :order ' . $_GET['value']);

	$cat->bindValue(':category', $_GET['category']);
	$cat->bindValue(':order',intval($_GET["group"]),PDO::PARAM_INT);
	$cat->execute();

	$categories = $cat->fetchAll(PDO::FETCH_OBJ);

	foreach ($categories as $item) {
		include 'category_each_item.php';
		}
	}
}

						// registration

		function register(){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			if($_POST['password']===$_POST['password_confirm']){

			include 'config.php';

			$check_email = $con->prepare(' select email from users where email = :email ');
			$check_email->execute(array(
										'email' => $_POST['email']
			));

			$check_emails = $check_email->fetchAll(PDO::FETCH_OBJ);

				foreach($check_emails as $check){
				if($_POST['email']==$check->email){
					$_SESSION['test'] = 'positive';
					echo '<div class="row large-12 columns">
       	       			  <p><input type="submit" value="Email address already in use" class="button expanded" /></p>
      					 </div>';
				}}

			if(!isset($_SESSION['test'])){

			$reg = $con->prepare(' insert into users(email,password,firstname,lastname,address,postoffice,city,state,country,date_created) values
								(:email, md5(:password), :firstname, :lastname, :address, :postoffice, :city, :state, :country,now())
			');

			$reg->execute(array(
						'email' 		=> $_POST['email'],
						'password' 		=> $_POST['password'],
						'firstname' 	=> $_POST['firstname'],
						'lastname' 		=> $_POST['lastname'],
						'address' 		=> $_POST['address'],
						'postoffice' 	=> $_POST['postoffice'],
						'city' 			=> $_POST['city'],
						'state' 		=> $_POST['state'],
						'country' 		=> $_POST['country'],

			));
			login();
				}
			session_unset($_SESSION['test']);
			}else{
					echo '<div class="row large-12 columns">
       	       			  <p><input type="submit" value="Password and confirm password not match" class="button expanded" /></p>
      					 </div>';
			}

					}else{
						echo '<div class="row large-12 columns">
       	       			  <p><input type="submit" value="Automatic Login after Successful Registration" class="button expanded" /></p>
      					 </div>';
					}
				}

							// login \ register for buying product (work in category_each_item.php)

		function login_buy(){
		if(isset($_COOKIE['user_id'])){
		echo 'Buy';
		}else{
		echo '<a href="login.php">Login</a> \ <a href="register.php">Register</a>';
		}
	}

								// border for quantity in add item (category.php) with echo

		function border($product){
			include 'config.php';

			$border = $con->prepare(' select ifnull(a.quantity_in_stock,0) as quantity_in_stock, sum(ifnull(b.quantity,0)) as in_cart
									from products as a
									left join carts as b on a.product_id = b.product
									where a.product_id = :product
			');
			$border->execute(array('product' => $product));
			$borders = $border->fetch(PDO::FETCH_OBJ);

			echo $borders->quantity_in_stock-$borders->in_cart;
		}

								// shoping cart

								// add item in cart (one item from category)

		function add_item(){

		if(isset($_GET['product_id'])){

		include 'config.php';

		$border = $con->prepare(' select ifnull(a.quantity_in_stock,0) as quantity_in_stock, sum(ifnull(b.quantity,0)) as in_cart
									from products as a
									left join carts as b on a.product_id = b.product
									where a.product_id = :product
			');
			$border->execute(array('product' => $_GET['product_id']));
			$borders = $border->fetch(PDO::FETCH_OBJ);
			$item_border = $borders->quantity_in_stock-$borders->in_cart;

		$item = $con->prepare(" select ifnull(a.quantity_in_stock,0) as quantity_in_stock, a.price ,count(b.product) as test, ifnull(b.quantity,0) as quantity
								from products as a
								left join carts as b on a.product_id = b.product
								where a.product_id = :product_id and user = :user ");

		$item->execute(array(
			'product_id' => $_GET["product_id"],
			'user'       => $_COOKIE['user_id']
		));

		$items = $item->fetch(PDO::FETCH_OBJ);

		if(isset($_GET['quantity'])){
			if($_GET['quantity']<=$item_border){
				if($items->test>0){
			$update_quantity = $con->prepare(' update carts set quantity = :update_quantity where product = :product and user = :user');
			$update_quantity->execute(array(
								'update_quantity' => $items->quantity+$_GET['quantity'],
								'product'         => $_GET['product_id'],
								'user'            => $_COOKIE['user_id'],
			));
			header('location: cart');
		}
		else{

		$cart_insert = $con->prepare(' insert into carts (user, product, quantity, price) values
			 				(:user, :product, :quantity, :price)
							  ');

					$cart_insert->execute(array(
								'user' => $_COOKIE['user_id'],
								'product' => $_GET['product_id'],
								'quantity' => $_GET['quantity'],
								'price' => $items->price,
							));
		header('location: cart');
					}
				}
			}
		}
	}
						// show cart (in cart.php)

		function show_cart(){

			if(isset($_COOKIE['user_id'])){

			include 'config.php';

			$cart = $con->prepare(' select * from carts as a inner join products as b on a.product = b.product_id
									where a.user = :user and a.quantity >0
									order by model  ');

			$cart->execute(array('user' => $_COOKIE['user_id']));

			$carts = $cart->fetchAll(PDO::FETCH_OBJ);

			foreach ($carts as $cart) {
										if($cart->quantity_in_stock > $cart->quantity){
                            			$item = '<a href=cart.php?update='. $cart->product_id . '&val=' . $cart->quantity . '&func=p>' . '[+] ' . '</a>';
                            			}else{
                            				$item = '<a href="#">[max quantity reached] </a>';
                            			}


				$sub = $cart->quantity*$cart->price;
			     echo       '<tr>
                            <td>' . $cart->model . '</td>
                            <td style="text-align: center">' . $cart->quantity . '</td>
                            <td style="text-align: center">' . number_format($cart->price, 2) . ' €</td>
                            <td style="text-align: center">' . number_format($cart->quantity*$cart->price, 2) . ' €</td>
                            <td style="text-align: center">' . $item .
                            								   '<a href=cart.php?update='. $cart->product_id . '&val=' . $cart->quantity . '&func=m>' . '[-] ' . '</a>' .
                            								   '<a href=cart.php?update='. $cart->product_id . '&val=' . $cart->quantity . '&func=d>' . '[delete] ' . '</a>
                        </tr>';
					@$totalprice+=$sub;

				}@$_SESSION['totalprice']=$totalprice;

			}
		}

							// update quantity (in chart)

		function update_cart_quantity(){

			if(isset($_GET['update']) && isset($_GET['val']) && isset($_GET['func']) && !empty($_GET['update']) && !empty($_GET['val']) && !empty($_GET['func'])){

			include 'config.php';

			if($_GET['func']=='p'){
			$_GET['val']++;
			}elseif($_GET['func']=='m'){
			$_GET['val']--;
			}else{
				$delete = $con->prepare(' delete from carts where product = :product and user = :user ');
				$delete->execute(array(
				'product'  => $_GET['update'],
				'user'     => $_COOKIE['user_id']
				));
			}

			$update_cart = $con->prepare(' update carts set quantity = :quantity where product = :product and user = :user');
			$update_cart->execute(array(
							'product'  => $_GET['update'],
							'quantity' => $_GET['val'],
							'user'     => $_COOKIE['user_id']
			));
					}
				}

								// Order

								// part - catch data for order

	function catch_data_for_order(){

if(isset($_COOKIE['user_id'])){
include 'config.php';

$order_data = $con->prepare(' select * from users where user_id = :user_id ');
$order_data->execute(array(
						'user_id' => $_COOKIE['user_id']
));
$orders_data = $order_data->fetchAll(PDO::FETCH_OBJ);
foreach($orders_data as $data){
	$_SESSION['user_email']         = $data->email;
	$_SESSION['user_address'] 		= $data->address;
	$_SESSION['user_postoffice']    = $data->postoffice;
	$_SESSION['user_city'] 			= $data->city;
	$_SESSION['user_state'] 		= $data->state;
	$_SESSION['user_country'] 		= $data->country;
	}

	if(isset($_POST['user_email']) && !empty($_POST['user_email'])){
	$_SESSION['user_email'] 		= $_POST['user_email'];
	}

	if(isset($_POST['user_address']) && !empty($_POST['user_address'])){
	$_SESSION['user_address'] 		= $_POST['user_address'];
	}

	if(isset($_POST['user_postoffice']) && !empty($_POST['user_postoffice'])){
	$_SESSION['user_postoffice'] 		= $_POST['user_postoffice'];
	}

	if(isset($_POST['user_city']) && !empty($_POST['user_city'])){
	$_SESSION['user_city'] 		= $_POST['user_city'];
	}

	if(isset($_POST['user_state']) && !empty($_POST['user_state'])){
	$_SESSION['user_state'] 		= $_POST['user_state'];
	}

	if(isset($_POST['user_country']) && !empty($_POST['user_country'])){
	$_SESSION['user_country'] 		= $_POST['user_country'];
	}

	if(isset($_POST['billing_address']) && !empty($_POST['billing_address'])){
	$_SESSION['billing_address'] 		= $_POST['billing_address'];
	}else{
		$_SESSION['billing_address']    = $_SESSION['user_address'];
	}

	if(isset($_POST['billing_postoffice']) && !empty($_POST['billing_postoffice'])){
	$_SESSION['billing_postoffice'] 		= $_POST['billing_postoffice'];
	}else{
		$_SESSION['billing_postoffice']    = $_SESSION['user_postoffice'];
	}

	if(isset($_POST['billing_city']) && !empty($_POST['billing_city'])){
	$_SESSION['billing_city'] 		= $_POST['billing_city'];
	}else{
		$_SESSION['billing_city']    = $_SESSION['user_city'];
	}

	if(isset($_POST['billing_state']) && !empty($_POST['billing_state'])){
	$_SESSION['billing_state'] 		  = $_POST['billing_state'];
	}else{
		$_SESSION['billing_state']    = $_SESSION['user_state'];
	}

	if(isset($_POST['billing_country']) && !empty($_POST['billing_country'])){
	$_SESSION['billing_country'] 		= $_POST['billing_country'];
	}else{
		$_SESSION['billing_country']    = $_SESSION['user_country'];
				}
			}
		}

						// show order  (order.php)

		function show_order(){

			if(isset($_COOKIE['user_id'])){

			include 'config.php';

			$cart = $con->prepare(' select * from carts as a inner join products as b on a.product = b.product_id where user = :user and quantity>0 group by product  ');

			$cart->execute(array('user' => $_COOKIE['user_id']));

			$carts = $cart->fetchAll(PDO::FETCH_OBJ);

			foreach ($carts as $cart) {

				$sub = $cart->quantity*$cart->price;
			     echo       '<tr>
                            <td>' . $cart->model . '</td>
                            <td style="text-align: center">' . $cart->quantity . '</td>
                            <td style="text-align: center">' . number_format($cart->price, 2) . ' €</td>
                            <td style="text-align: center">' . number_format($cart->quantity*$cart->price, 2) . ' €</td>

                        </tr>';
					@$totalprice+=$sub;

				}@$_SESSION['totalprice']=$totalprice;

				}
			}

							// insert from cart to invoices, and invoices_items

	function insert_from_cart(){

	include 'config.php';

	try {

	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$con->beginTransaction();
													// part - insert into invoices

	$invoice =$con->prepare(' insert into invoices (user,payment,shipping_address,shipping_postoffice,
													shipping_city,shipping_state,shipping_country,
												    billing_address,billing_postoffice,billing_city,
													billing_state,billing_country) values
												   (:user,:payment,:shipping_address,:shipping_postoffice,:shipping_city,
												    :shipping_state,:shipping_country,
												    :billing_address,:billing_postoffice,:billing_city,:billing_state,:billing_country)
 						');

	$invoice->execute(array(
						'user' 					=> $_COOKIE['user_id'],
						'payment' 				=> $_SESSION['payment'],
						'shipping_address' 		=> $_SESSION['user_address'] ,
						'shipping_postoffice' 	=> $_SESSION['user_postoffice'],
						'shipping_city' 		=> $_SESSION['user_city'] ,
						'shipping_state' 		=> $_SESSION['user_state'],
						'shipping_country' 		=> $_SESSION['user_country'],
						'billing_address' 		=> $_SESSION['billing_address'],
						'billing_postoffice' 	=> $_SESSION['billing_postoffice'],
						'billing_city' 			=> $_SESSION['billing_city'],
						'billing_state' 		=> $_SESSION['billing_state'],
						'billing_country' 		=> $_SESSION['billing_country'],
				));

												// part - take id from invoices

	$invoice_id = $con->lastInsertId();

												// part - insert into invoices_items

	$cart = $con->prepare(' select * from carts as a left join products as b on a.product = b.product_id
							where a.user = :user and a.quantity > 0 ');
	$cart->execute(array('user' => $_COOKIE['user_id']));
	$carts = $cart->fetchAll(PDO::FETCH_OBJ);
	foreach ($carts as $cart) {
	$in = $con->prepare(' insert into invoices_items (invoice,user,product,quantity,price) values
						(:invoice, :user, :product, :quantity, :price)
	');
	$in->execute(array(
			'invoice'  => $invoice_id,
			'user'     => $_COOKIE['user_id'],
			'product'  => $cart->product,
			'quantity' => $cart->quantity,
			'price'    => $cart->price

	));

							// part - reduce quantity_in_stock - use same foreach as insert into invoices_items

		$update_qu = $con->prepare(" update products set quantity_in_stock = :itemq  where product_id = :product_id ");

		$update_qu->execute(array(
								'itemq' => $cart->quantity_in_stock - $cart->quantity,
								'product_id' => $cart->product,
					));
		}

													// part - delete carts

					$delete_carts = $con->prepare(' delete from carts where user = :user');
					$delete_carts->execute(array('user' => $_COOKIE['user_id']));

					$con->commit();

				} catch (Exception $e) {
 				 $con->rollBack();
 				 echo "Failed: " . $e->getMessage();
				}
			}


					// order.php -- payment

				// order.php - pay with pay pal -- or can addopt with paymet for all payment

				function pay_pal_payment(){

				if(isset($_GET['payment']) && $_GET['payment']==1){
				include 'config.php';
				$_SESSION['payment'] = $_GET['payment'];
				insert_from_cart();
				unset($_SESSION['payment']);
				?>

				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="luketic.damir@gmail.com">
				<input type="hidden" name="item_name" value="Item Name">
				<input type="hidden" name="currency_code" value="EUR">
				<input type="hidden" name="amount" value="<?php echo $_SESSION['totalprice']; ?>">
				</form>

				<script type="text/javascript">
  				  document.getElementById('paypal').submit();
				</script>

				<?php
					}
				}

					// count item in cart - count number of models

			function cart_model_count(){
				if(isset($_COOKIE['user_id'])){
				include 'config.php';
				$cart_count = $con->prepare(' select product from carts where user = :user and quantity>0 group by product ; ');
				$cart_count->execute(array("user"=>$_COOKIE['user_id']));
				$count = $cart_count->rowCount();
				$_SESSION['count_model'] = $count;
				}
			}

					// count item in cart - count each product

					function cart_item_count(){

			if(isset($_COOKIE['user_id'])){

			include 'config.php';

			$cart_item = $con->prepare(' select * from carts where user = :user and quantity>0 group by product ');

			$cart_item->execute(array('user' => $_COOKIE['user_id']));

			$carts = $cart_item->fetchAll(PDO::FETCH_OBJ);

			foreach ($carts as $cart) {
				$sub = $cart->quantity;
					@$quantity+=$sub;
				}@$_SESSION['cart_item']=$quantity;

			}
		}

							// user pages - catch personal data (user_personal_data.php)

				function catch_personal_data_user(){

if(isset($_COOKIE['user_id'])){
include 'config.php';

$order_data = $con->prepare(' select * from users where user_id = :user_id ');
$order_data->execute(array(
						'user_id' => $_COOKIE['user_id']
));
$orders_data = $order_data->fetchAll(PDO::FETCH_OBJ);
foreach($orders_data as $data){
	$_SESSION['user_email']         = $data->email;
	$_SESSION['user_address'] 		= $data->address;
	$_SESSION['user_postoffice']    = $data->postoffice;
	$_SESSION['user_city'] 			= $data->city;
	$_SESSION['user_state'] 		= $data->state;
	$_SESSION['user_country'] 		= $data->country;
	}
					}
				}

						// user pages - update personal data (user_personal_data.php)

				function update_personal_data(){

	if(isset($_COOKIE['user_id'])){
		if(isset($_POST['user_address']) && isset($_POST['user_postoffice']) && isset($_POST['user_city']) && isset($_POST['user_country']) && isset($_POST['user_email']) &&
	   !empty($_POST['user_address']) && !empty($_POST['user_postoffice']) && !empty($_POST['user_city']) && !empty($_POST['user_country']) && !empty($_POST['user_email'])){

		include 'config.php';
		$update_personal_data = $con->prepare(' update users set email = :email, address = :address, postoffice = :postoffice, city = :city,
												state = :state, country = :country where user_id = :user_id ');
		$update_personal_data->execute(array(
											'user_id'	 => $_COOKIE['user_id'],
											'email' 	 => $_POST['user_email'],
											'address' 	 => $_POST['user_address'],
											'postoffice' => $_POST['user_postoffice'],
											'city'       => $_POST['user_city'],
											'state'      => $_POST['user_state'],
											'country'    => $_POST['user_country'],
										));
	   		}
	 	  }
	   }

					// user pages - update password (user_personal_data.php)

			function update_password(){
				if(isset($_COOKIE['user_id'])){
					if(isset($_POST['password']) && isset($_POST['password_confirm']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
						if($_POST['password']===$_POST['password_confirm']){
							include 'config.php';
								$update_password = $con->prepare(' update users set password = md5(:password) where user_id = :user_id ');
								$update_password->execute(array(
											'user_id'	 => $_COOKIE['user_id'],
											'password' 	 => $_POST['password'],
										));
							echo '<div class="row large-12 columns">
       	       					  <p><input type="submit" value="Password updated" class="button expanded" /></p>
      							  </div>';
						}else{
							echo '<div class="row large-12 columns">
       	       					  <p><input type="submit" value="Password and confirm password not match" class="button expanded" /></p>
      							  </div>';
						}
					}
				}
			}

					// user pages - purchaise history (user_purchaise_history.php)

			function purchaise_history(){
				if(isset($_COOKIE['user_id'])){
					include 'config.php';
					$purchaise = $con->prepare(' select a.invoices_id, a.date, sum(b.quantity * b.price) as price
												 from invoices as a
												 inner join invoices_items as b on a.invoices_id = b.invoice
												 where a.user = :user
												 group by a.invoices_id
												 order by date desc
												   ');

					$purchaise->execute(array('user' => $_COOKIE['user_id']));
					$purchaises = $purchaise->fetchAll(PDO::FETCH_OBJ);
						$purchaises_cost = 0;
					foreach ($purchaises as $purchaise) {
						$sub = $purchaise->price;
						echo '<tr>
							<td style="text-align: center">' . $purchaise->invoices_id . '</td>
							<td style="text-align: center">' . $purchaise->date . '</td>
                            <td style="text-align: center">' . number_format($purchaise->price, 2) . ' €</td>
                            <td style="text-align: center">
                            		<a target="_blank" href="tcpdf_min/user_purchaise_details_PDF.php?purchaise_id=' .
                            		$purchaise->invoices_id . '&date=' . $purchaise->date . '">PDF</a>,
                          		    <a href="user_purchaise_details.php?purchaise_id=' . $purchaise->invoices_id . '">details</a></td>
                        </tr>';
						$purchaises_cost+=$sub;
					}$_SESSION['purchaises_cost'] = $purchaises_cost;
				}
			}

					// 	user pages - purchaise history details (user_purchaise_history_details.php)


				function purchaise_history_details(){
								if(isset($_COOKIE['user_id'])){
					include 'config.php';
					$purchaise = $con->prepare(' select a.invoices_id, a.date, c.model, b.price, b.quantity, b.quantity * b.price as total
												 from invoices as a
												 inner join invoices_items as b on a.invoices_id = b.invoice
												 inner join products as c on b.product = c.product_id
												 where a.invoices_id = :purchaise_id  ');

					$purchaise->execute(array('purchaise_id' => $_GET['purchaise_id']));
					$purchaises = $purchaise->fetchAll(PDO::FETCH_OBJ);
						$purchaises_cost = 0;
					foreach ($purchaises as $purchaise) {
						$sub = $purchaise->total;
						echo '<tr>
                            <td>' . $purchaise->model . '</td>
                            <td style="text-align: center">' . $purchaise->quantity . '</td>
                            <td style="text-align: center">' . number_format($purchaise->price, 2) . ' €</td>
                            <td style="text-align: center">' . number_format($sub, 2) . ' €</td>
                        </tr>';
						$purchaises_cost+=$sub;
					}$_SESSION['purchaises_cost'] = $purchaises_cost;
				}
			}

													// admin pages - orders history (admin_orders.php)

						function orders_history(){

					include 'config.php';
					$order = $con->query(' select a.user, a.invoices_id, a.date, sum(b.quantity * b.price) as total
										   from invoices as a
										   inner join invoices_items as b on a.invoices_id = b.invoice
										   group by a.invoices_id
										   order by a.invoices_id desc	 
										 ');

					$orders = $order->fetchAll(PDO::FETCH_OBJ);
						$orders_cost = 0;
					foreach ($orders as $order) {
						$sub = $order->total;
						echo '<tr style="text-align: center">
							<td>' . $order->invoices_id . '</td>
							<td>' . $order->user . '</td>
                            <td>' . $order->date . '</td>
                            <td>' . number_format($sub, 2) . ' €</td>
                        </tr>';
						$orders_cost+=$sub;
					}$_SESSION['orders_cost'] = $orders_cost;
				}

												// admin pages - add products (admin_add.php)

												// admin pages - add products - show category (admin_add.php)

				function show_category(){
					include 'config.php';
					$category = $con->query(' select name from categories where parent is null ');
					$categories = $category->fetchAll(PDO::FETCH_OBJ);
					foreach ($categories as $category) {
						echo '<option value="' . $category->name . '">' . $category->name . '</option>';
					}
				}

	class category_subcategory{
	var $optionGroup;

	function startCategory() {

		include 'config.php';

		$optionGroup = array(0 => array('children' => array()));
		$expression = $con->query("select * from categories order by parent asc, category_order");
		$array = $expression->fetchAll(PDO::FETCH_ASSOC);
		foreach ($array as $data){
			$optionGroup[$data['category_id']] = $data;
			$optionGroup[(is_null($data['parent']) ? '0' : $data['parent'])]['children'][] = $data['category_id'];
		}
		$this -> optionGroup = $optionGroup;
		$nav = '';
		foreach ($optionGroup[0]['children'] as $child_id) {
			$nav .= $this -> makeOpt($optionGroup[$child_id]);
		}
		return $nav;
	}

	function makeOpt($optionGroup) {
		if(!isset($optionGroup['children']) && empty($optionGroup['children'])){
		$nav_one = '<option value="' . $optionGroup['category_id'] . '">' . $optionGroup['name'] . "</option>\n";
		}
		if (isset($optionGroup['children']) && !empty($optionGroup['children'])) {
			$nav_one = '<optgroup label="' .$optionGroup['name'] . "\">\n";
			foreach ($optionGroup['children'] as $child_id) {
				$nav_one .= $this -> makeOpt($this -> optionGroup[$child_id]);
			}
			$nav_one .= "</optgroup>\n";
		}
		return $nav_one;
	}

}
							// admin pages - add product - show units (admin_add.php)

		function show_units(){
			include 'config.php';

			$unit = $con->query(' select * from units ');
			$units = $unit->fetchAll(PDO::FETCH_OBJ);
			foreach($units as $unit){
				echo '<option value="' . $unit->unit_id . '">' . $unit->name . "</option>\n";
			}
		}


												// admin pages - add product - add new item (admin_add.php)
												// use function for show data

		function admin_add_item(){

			include 'config.php';

			try {

			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$con->beginTransaction();

			if(isset($_GET['product_model']) && isset($_GET['product_category']) && isset($_GET['unit']) && isset($_GET['product_price']) && isset($_GET['quantity']) &&
			   !empty($_GET['product_model']) && !empty($_GET['product_category']) && !empty($_GET['unit']) && !empty($_GET['product_price']) && !empty($_GET['quantity'])
			){

																// insert into product and create lastInsertId

			$insert_product = $con->prepare(' insert into products (model, quantity_in_stock, price, unit, details, more_information, user_created, date_created) values
																(:model, :quantity_in_stock, :price, :unit, :details, :more_information, :user_created, now())
											');
			$insert_product->execute(array(
										'model'				 => $_GET['product_model'],
										'quantity_in_stock'  => $_GET['quantity'],
										'price' 			 => $_GET['product_price'],
										'unit' 				 => $_GET['unit'],
										'details' 			 => $_GET['product_specification'],
										'more_information' 	 => $_GET['product_description'],
										'user_created' 		 => $_COOKIE['user_id'],
										));
			$product_last_id = $con->lastInsertId();


																// create directore for images
																
			$dir_profile = '../img/products/' . $product_last_id;
			mkdir($dir_profile, 0755, true);

																// insert into categories (also includ all parent category to null)

	class category_parent {
	var $menu;
	var $db;

	function startCategory_parent($id) {

		$o=new stdClass();

		$parent_name=true;
		$key=$id;
		$items=array();
		$sku=array();
		while($parent_name){
		$expression = $this->db->prepare("select * from categories where category_id = :category_id order by parent asc, category_order");
		$expression->execute(array(":category_id"=>$key));
		$array = $expression->fetchAll(PDO::FETCH_ASSOC);
		if(count($array)==0){
			$parent_name=false;
		}
		foreach ($array as $data){
			$items[]= $data['category_id'];
			$sku[]= $data['name'];
			if($data["parent"]!=null){
				$key=$data["parent"];
			}else{
				$parent_name=false;
			}
		}
		}
		$sku = array_reverse($sku);
		$o->sku=$sku;
		$o->nav=$items;
		return $o;
	}
}

					$cat = new category_parent();
					$cat->db = $con;
					$o = $cat->startCategory_parent($_GET["product_category"]);

					foreach($o->nav as $category){

					$insert_categories = $con->prepare(' insert into categories_products (product, category, price) values
																(:product, :category, :price)
											');
					$insert_categories->execute(array(
										'product' 	=> $product_last_id,
										'category'  => $category,
										'price'     => $_GET['product_price'],
										));

					}

										// SKU generator and updater (data is for class_category parent)

			$sku= '';
			for($i=0;$i<2;$i++){
			$sk = strtoupper(substr($o->sku[$i],0,2)) . '-';
			$sku.= $sk;
			}
			$sku.= sprintf("%04d", $product_last_id);


			$update_sku = $con->prepare(' update products set sku = :sku where product_id = :product_id
											');

			$update_sku->execute(array(
										'product_id' 	=> $product_last_id,
										'sku' 	    	=> $sku,
										));

											// end sku

											// part insert into images
			
			$img = !empty($_GET['product_image']) ? $_GET['product_image'] : '../placeholder.jpg';
			
			
			
			$insert_images = $con->prepare(' insert into images (product, path, featured) values
																(:product, :path, true)
											');
			$insert_images->execute(array(
										'product' 	=> $product_last_id,
										'path' 	    => '../placeholder.jpg'
										));						
						}
						$con->commit();
					} catch (exception $e) {
  						$con->rollBack();
  						echo "Failed: " . $e->getMessage();
					}
				}

											// bread crumps (category.php & product.php) - catch data

	class bread_crumps {
	var $menu;
	var $db;

	function startBread_crumps($id) {

		$o=new stdClass();

		$parent_name=true;
		$key=$_GET['category'];
		$first_pass=true;
		$items=array();
		while($parent_name){
		$expression = $this->db->prepare("select * from categories where category_id = :category_id order by parent asc, category_order");
		$expression->execute(array(":category_id"=>$key));
		$array = $expression->fetchAll(PDO::FETCH_ASSOC);
		if(count($array)==0){
			$parent_name=false;
			$o->naslov = "error";
		}
		foreach ($array as $data){
			if($first_pass){
				$o->title = $data["name"];
				$first_pass=false;
			}
			$items[]='<a href="category.php?category=' . $data['category_id'] . '">' .  $data['name'] . '</a>';
			if($data["parent"]!=null){
				$key=$data["parent"];
			}else{
				$parent_name=false;
			}
		}
		}
		$items = array_reverse ($items);

		$o->nav=$items;
		return $o;
	}
}
								// bread crumps - show data inside bread crumps (category.php & product.php)

					function bread_crumps(){
			 		include 'config.php';
					if(isset($_GET['product']) || isset($_GET['category'])){

					$cat = new bread_crumps();
					$cat->db = $con;
					$o = $cat->startBread_crumps($_GET["category"]);

					if($o->title=="error"){
						header("location: index.php");
					}else{
						$_SESSION['title'] = $o->title;
					}

					foreach ($o->nav as $n) {
				 		echo '<li>' . $n . '</li>';
						 }
					}
			 	}

									// address for featured images (product.php)

	function featured_images(){
						include 'config.php';
						if(isset($_GET['product'])){
					$img = $con->prepare("select path from images where product=:product and featured = 1");
					$img->execute(array("product"=>$_GET["product"]));
					$o = $img->fetch(PDO::FETCH_OBJ);
						echo $path . 'img/products/' . $_GET['product'] . '/' . $o->path;						
						}
					}
	
									// pictures for not featured images (product.php)

	 function show_not_featured_images(){
					 	include 'config.php';
						if(isset($_GET['product'])){
						$img_all = $con->prepare("select * from images where product=:product and featured = 0");
						$img_all->execute(array("product"=>$_GET["product"]));
						$img_all = $img_all->fetchAll(PDO::FETCH_OBJ);
						foreach ($img_all as $img){							
						$img_src = $path . 'img/products/' . $_GET['product'] . '/' . $img->path;
						echo '<img style="max-width: 30%;" src="' . $img_src . '" />';
						 }
					   }
	 				}
									// admin_page -- update product (admin_update.php) -- function for show information about
									//													  products, is on page

	function update_product(){
		if(isset($_GET['product']) && !empty($_GET['product'])){
		include 'config.php';

			try {

				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$con->beginTransaction();

										// part for remove category

		if(isset($_GET['remove_category'])){
			if($_GET['remove_category'] == 'yes'){
				$remove_cat = $con->prepare(' delete from categories_products where product = :product ');
				$remove_cat->execute(array('product' => $_GET['product']));
				}
			}

										// part for add category (this part i tako from admin_add_data function)

					if(isset($_GET['product_category'])){
					if($_GET['product_category']!='no'){

					class category_parent {
					var $menu;
					var $db;

					function startCategory_parent($id) {

					$o=new stdClass();

					$parent_name=true;
					$key=$id;
					$items=array();
					while($parent_name){
					$expression = $this->db->prepare("select * from categories where category_id = :category_id order by parent asc, category_order");
					$expression->execute(array(":category_id"=>$key));
					$array = $expression->fetchAll(PDO::FETCH_ASSOC);
					if(count($array)==0){
					$parent_name=false;
					}
					foreach ($array as $data){
					$items[]= $data['category_id'];
					if($data["parent"]!=null){
					$key=$data["parent"];
					}else{
					$parent_name=false;
								}
							}
						}

					$o->nav=$items;
					return $o;
									}
								}

					$cat = new category_parent();
					$cat->db = $con;
					$o = $cat->startCategory_parent($_GET["product_category"]);

					foreach($o->nav as $category){

					$insert_categories = $con->prepare(' insert into categories_products (product, category, price) values
																(:product, :category, :price)
											');
					$insert_categories->execute(array(
										'product' 	=> $_GET['product'],
										'category'  => $category,
										'price'     => $_GET['product_price'],
										));

								}
							}
						}

							// part for add special offer

			if(isset($_GET['special_offer'])){


				if($_GET['special_offer'] == 'no'){

					$no_offer = $con->prepare(' update special_offer
												set active = 0 and
												date_deleted = now() and
												user_deleted = :user
												where product = :product ');
					$no_offer->execute(array(
					'product' => $_GET['product'],
					'user'    => $_COOKIE['user_id']
					));
				}

				if($_GET['special_offer'] == 'yes'){

					$offer = $con->prepare(' insert into special_offer (product, date_created, user_created) values
											 (:product, now(), :user) ');
					$offer->execute(array(
							'product' => $_GET['product'],
							'user'    => $_COOKIE['user_id']
					));
						}
				}

							// part for update product

		if(isset($_GET['unit']) && isset($_GET['product_price']) && isset($_GET['quantity']) &&
		   isset($_GET['product_specification']) && isset($_GET['product_description']) &&
	       !empty($_GET['unit']) && !empty($_GET['product_price']) && !empty($_GET['quantity']))
	       {

			$update_products = $con->prepare('  update products set
												unit = :unit,
												price = :price,
												quantity_in_stock = :quantity,
												details = :details,
												more_information = :more_information,
												user_accessed = :user,
												date_accessed = now(),
												deleted = :deleted
												where product_id = :product
												');

			$update_products->execute(array(
								'unit' 				=> $_GET['unit'],
								'price' 			=> $_GET['product_price'],
								'quantity' 			=> $_GET['quantity'],
								'details' 			=> $_GET['product_specification'],
								'more_information' 	=> $_GET['product_description'],
								'user' 				=> $_COOKIE['user_id'],
								'product' 			=> $_GET['product'],
								'deleted' 			=> $_GET['active']
								));
		       }
				$con->commit();
			} catch (Exception $e) {
  $con->rollBack();
  echo "Failed: " . $e->getMessage();
			}
		}
	}

					// function for admin update users data (admin_users.php)

// osobno - kada se u "if" ubaci $_GET['active'] - onda šteka (ne mjenja podatke)

	function admin_update_user_data(){
		include 'config.php';

		if(isset($_GET['user_id']) && !empty($_GET['user_id']) &&
		   isset($_GET['role']) && !empty($_GET['role'])){

				$update = $con->prepare(' update users
										  set role	    = :role,
										  active 		= :active,
										  date_accessed = now(),
										  user_accessed = :user_accessed
										  where user_id = :user_id ');
				$update->execute(array(
								'role' 			=> $_GET['role'],
								'active'		=> $_GET['active'],
								'user_accessed' => $_COOKIE['user_id'],
								'user_id' 		=> $_GET['user_id'],
				));
		}
	}

					// function for add review

		function add_review(){
			include 'config.php';

			if(isset($_GET['product']) && !empty($_GET['product']) &&
			   isset($_POST['grade']) && !empty($_POST['grade'])
			 ){
			 		if($_SESSION['user_review_test'] == 'n'){
			$add_review = $con->prepare(' insert into reviews(user, product, grade, review) values
										  (:user, :product, :grade ,:review)
			');
			$add_review->execute(array(
									'user' 		=> $_COOKIE['user_id'],
									'product' 	=> $_GET['product'],
									'grade'	 	=> $_POST['grade'],
									'review' 	=> $_POST['new_review']
			));
					$_SESSION['user_review_test'] == 'p';
				}else{
					$change_review = $con->prepare(' update reviews set review = :review, grade = :grade
													 where user = :user and
													 product = :product
													');
					$change_review->execute(array(
									'user' 		=> $_COOKIE['user_id'],
									'product' 	=> $_GET['product'],
									'grade'	 	=> $_POST['grade'],
									'review' 	=> $_POST['new_review']
										));
				   }
			 	}
			}

													// admin pages - hold on carts (carts_deleted.php)

						function carts_deleted(){

					include 'config.php';
					
					if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
					$deleted = $con->prepare(' select in_cart_deleted, sum(price*quantity) as total 
											   from users_hold_on_carts 
											   where user = :user 
											   group by in_cart_deleted
											   order by in_cart_deleted');
					$deleted->execute(array('user' => $_GET['user_id']));

					$removed = $deleted->fetchAll(PDO::FETCH_OBJ);
					foreach ($removed as $deleted) {
						echo '<tr style="text-align: center">
							<td>' . $deleted->in_cart_deleted . '</td>
                            <td>' . number_format($deleted->total, 2) . ' €</td>                          
                        </tr>';

						}
					}
				}

?>
