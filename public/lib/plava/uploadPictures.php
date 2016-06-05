<?php
	namespace plava;
	
	class uploadPictures{
		
		var $file;
		var $con;
		var $product;
		
	function uploadPictures(){
	  
	  									// Dio za dodavanje featured slike
	  									
	  		// Prvo koristimo "$_FILES", te izvlačimo potrebne podatke
	  
      if(isset($_FILES['featured_image'])){
      $errors = '';
      $file_name = $_FILES['featured_image']['name'];
      $file_size =$_FILES['featured_image']['size'];
      $file_tmp =$_FILES['featured_image']['tmp_name'];
      $file_type=$_FILES['featured_image']['type'];
	  
####
	  
	  // $file_ext=strtolower(end(explode('.',$_FILES['non_featured_image']['name'])));
	  
	  // prepravljeni kod za net -- "end" je ubacen zasebno
	  
      $tmp=explode('.',$_FILES['featured_image']['name']);
	  $file_ext = strtolower(end($tmp));	   
		  
####	  
		   		   
	  // Zadajemo prihvatljive ekstenzije i veličinu fila 
	  
      $expensions= array('jpeg','jpg','png','gif');
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="extension not allowed, please choose a JPEG, JPG, PNG or GIF file.";
      }
      
      if($file_size > 2097152){
         $errors='File size must be less then 2 MB';
      }
      
	  // Dodajemo file kod korisnika (direktorij smo napravili kod registracije)
	  
      if(empty($errors)==true){
      		
      	 $dir = __DIR__ . '/../../img/products/' . $this->product . '/'; 	
         move_uploaded_file($file_tmp, $dir.$file_name);
         $_SESSION['check'] = "Success";
       
	  // Postavljamo novu sliku za profilnu 
	  	  			
	  	  			
	  	  		$test_featured = $this->con->prepare(' select path from images where product = :product and featured = 1 ');
				$test_featured->execute(array('product' => $this->product));
				$test = $test_featured->fetch(\PDO::FETCH_OBJ);
	
	// provijeravamo da li je postavljena featured slika "placeholder"
	// ako je, nakon zadavanje nove "featured slike" posojeći brišemo iz baze,
	// ako slika nije "placeholder", sliku ostavljamo kao ne "featured"
				
				if($test->path == '../placeholder.jpg'){
				$delete_featured = $this->con->prepare(' delete from images where product = :product and featured = 1 ');
				$delete_featured->execute(array('product' => $this->product));
				}else{		
				$remove_featured = $this->con->prepare(' update images set featured = 0 where product = :product and featured = 1 ');
				$remove_featured->execute(array('product' => $this->product));
				}
	
				$featured_image = $this->con->prepare(' insert into images (product, path, featured) values
																	 (:product, :path, 1)
				  								');
				$featured_image->execute(array(
											'product' => $this->product,
											'path'    => $file_name,
					));			
				}
			}

										// Dio za non-featured sliku

	  if(isset($_FILES['non_featured_image'])){
      $errors = '';
      $file_name = $_FILES['non_featured_image']['name'];
      $file_size =$_FILES['non_featured_image']['size'];
      $file_tmp =$_FILES['non_featured_image']['tmp_name'];
      $file_type=$_FILES['non_featured_image']['type'];
	  
####
	  
	  // $file_ext=strtolower(end(explode('.',$_FILES['non_featured_image']['name'])));
	  
	  // prepravljeni kod za net -- "end" je ubacen zasebno
	  
      $tmp=explode('.',$_FILES['non_featured_image']['name']);
	  $file_ext = strtolower(end($tmp));	   
		  
####	
      
	  // Zadajemo prihvatljive ekstenzije i veličinu fila 
	  
      $expensions= array('jpeg','jpg','png','gif');
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="extension not allowed, please choose a JPEG, JPG, PNG or GIF file.";
      }
      
      if($file_size > 2097152){
         $errors='File size must be less then 2 MB';
      }
      
	  // Dodajemo file kod korisnika (direktorij smo napravili kod registracije)
	  
      if(empty($errors)==true){
      		
      	 $dir = __DIR__ . '/../../img/products/' . $this->product . '/'; 	
         move_uploaded_file($file_tmp, $dir.$file_name);
         $_SESSION['check'] = "Success";
       
	  // Postavljamo novu sliku za non-featured 
	  	  			
				$non_featured_image = $this->con->prepare(' insert into images (product, path, featured) values
																	 (:product, :path, 0)
				  								');
				$non_featured_image->execute(array(
											'product' => $this->product,
											'path'    => $file_name,
					));			
				}
			}
   		}
	}
?>
