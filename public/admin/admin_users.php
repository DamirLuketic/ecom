<?php
	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../index.php');
		}
?>
<?php include '../config.php' ?>
<?php include '../functions.php' ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include '../head.php' ?>
  </head>
  <body>
	<?php include '../menu.php'; ?>

<body>

<!-- function -->

	<?php admin_update_user_data(); ?>

<!-- catch data for test and showing -->

		<?php
	if(isset($_GET['user_id'])){
					include '../config.php';

					$data = $con->prepare(' select b.role_name, b.role_id, a.active
											from users as a
											inner join roles as b on a.role = b.role_id
											where a.user_id = :user_id ');
					$data->execute(array('user_id' => $_GET['user_id']));
					$info = $data->fetch(PDO::FETCH_OBJ);
		}
	?>

	    <div class="row">
<?php include 'admin_nav.php'; ?>

		<div class="large-10 columns">
			<div class="row"></div>
			<h1>Change user status</h1>
				<form>
				<fieldset class="fieldset">
					<legend>Input:</legend>
				  <div class="large-4 columns">

	<!-- jquery search - first - set input -->

				  <label for="term_name">User:</label>
      			  <input required="required" name="user"  type="search" placeholder="Search by first or last name"
            	  		 id="term_name"  value="<?php if(isset($_GET['user'])){ echo $_GET['user']; } ?>" />
    <!-- until here -->

      			  </div>
      			  <div class="large-4 columns">
      			  <label for="role">Status <?php echo isset($_GET['user_id']) ? '(' . $info->role_name . ')': ''; ?></label>
         		  <select name="role" id="role" required="required" />
			      <option value="<?php echo $info->role_id; ?>">No change</option>
					<?php
	/* part for roles - set option - on code start we collect all data for test */
					$role = $con->query(' select role_name, role_id from roles');
					$roles = $role->fetchAll(PDO::FETCH_OBJ);
					foreach($roles as $role){
					if($info->role_name!=$role->role_name){
					echo '<option value="' . $role->role_id . '">' . $role->role_name . "</option>\n";
						}
					}
                    ?>
                  </select>
				  </div>
	<!-- part for active - set option - on code start we collect all date for test -->
			      <div class="large-2 columns">
      			  <label for="active">Active <?php echo isset($_GET['user_id']) ? ($info->active == 1 ? '(Yes)' : '(No)') : ''; ?></label>
         		  <select name="active" id="active" required="required" />
			      <option value="<?php echo $info->active; ?>">No change</option>
					<?php
					if($info->active == 1){
					echo '<option value="0">Remove</option>';
						}else{
					echo '<option value="1">Restore</option>';
					}
                    ?>
                  </select>
				  </div>
	<!-- hidden input for sendin what we need (automatically) -->
				  <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>" />
				  <div class="large-2 columns">
				  <label for="submit">Submit</label>
				  <input type="submit" value="submit" id="submit" class="button expanded" />
      			  </div>
      			  </fieldset>
        </form>
        
        
    

	<h3>Not buy from carts</h3>

     <table>
        <tr>
        	<th>From cart deleted</th>
            <th>Price</th>           
        </tr>
           <?php carts_deleted(); ?>
          </tr>
    </table>
        

        
        
        
        
        </div>
    </div>
</div>
	<?php include '../footer.php' ?>
	<?php include '../script.php' ?>
	    <script>
/* jquery search - second - set search input/output */
	    	$(function (){

    		$("#buttonAjax_name").click(function(){
				return false;
    		});

    		var option = {source: "ccc", minLength:2};
    		$("#term_name").autocomplete({

   /* set source */
				    source: "admin/admin_data_for_search_user.php",
				    minLength: 2,
				    focus: function( event, ui ) {
				    	event.preventDefault();
				    	},
				    select: function(event, ui) {
				        $(this).val('').blur();
				        event.preventDefault();
   /* set what showing, and where after selection */
				       document.location.href="admin_users?user=" + ui.item.firstname + " " + ui.item.lastname + "&user_id=" + ui.item.user_id;

				    }
					}).data( "ui-autocomplete" )._renderItem = function( ul, object ) {
	/* set what show in menu */

				      return $( "<p style='background: #DFE8EB; max-width: 17.48rem; margin-bottom: 0'>" )
	/* set what in selection */

				        .append( "<a>" + object.firstname + " " + object.lastname
				         + "</a>" )
				        .appendTo( ul );
				    };
	/* jquery search - third part - set quastion to data base - view - admin_user_search.php */
    			});
    </script>
  </body>
</html>
