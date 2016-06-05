<?php
// Koristimo kod "index.php", "user/user_my_post.php" i "user/user_follow_post.php" 	
// Klasa koja sadrži funkcije za podjelu podataka po stranici.
// Razlika između navedene klase i klase „paginationTerm“ je jedino u tome što
// Navedena klasa ne prima uvjet, te samim time za PDO vezu ne koristi pripremu za podatke ('prepare'), 
// već dohvaća podatke izravno nakon unosa ('query').
// Klasa „paginationTerm“ se naravno može koristiti umjesto ove, zadavanjem ranije pripremljenog uvjeta.
	
namespace plava;

	class pagination{
		
		var $con;
		var $page;
		var $npp;	
		
  function pagination($select, $dbt, $where='' ,$order = ''){

	// Funkcija koja nam priprema podatke za podjelu podataka po stranicama.
  	
$t=new \stdClass();
$terms=$this->con->query(" select count($select) from $dbt $where $order ");
$totalPages = ceil($terms->fetchColumn() / $this->npp);

		$t->totalPages=$totalPages;
			
		return $t; 
  }
  
  
	function paginationCatch($select, $dbt, $where='' ,$order = ''){
		
		$c=new \stdClass();
		
		$expression = $this->con->query("
									select $select
									from $dbt 
									$where
									$order
						 			limit " . 
									(($this->page * $this->npp - $this->npp)<=0 ? 0 : ($this->page * $this->npp - $this->npp)) . ", " . $this->npp
									);
		$array = $expression->fetchAll(\PDO::FETCH_OBJ);
					
		$c->array=$array;
		
		return $c; 			
		}	 
	}

?>