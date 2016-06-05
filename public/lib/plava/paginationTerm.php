<?php
	
namespace plava;

// Koristimo kod "user/user_people.php" - koristimo obilježavanje stranica s "uvjetom", 
// buduči da na ovom dijelu koristimo tražilicu 

	class paginationTerm{
		
		var $con;
		var $term;
		var $page;
		var $npp;	
		
  function paginationTerm($select, $dbt, $what){
  	
	$t=new \stdClass();

$terms=$this->con->prepare(" select count($select) from $dbt where $what like :term ");
$terms->execute(array('term' => '%' . $this->term .'%' ));
$totalPages = ceil($terms->fetchColumn() / $this->npp);

		$t->totalPages=$totalPages;
			
		return $t; 
  }
  
  
	function paginationCatch($select, $dbt, $what, $option = ''){
		
		$c=new \stdClass();
		
		$expression = $this->con->prepare("
									select $select
									from $dbt
									where $what like :term
									$option
						 			limit " . 
									(($this->page * $this->npp - $this->npp)<=0 ? 0 : ($this->page * $this->npp - $this->npp)) . ", " . $this->npp
									);
					$expression->execute(array("term" => "%" . $this->term . "%"));
					$array = $expression->fetchAll(\PDO::FETCH_OBJ);
					
		$c->array=$array;
		
		return $c; 			
		}	 
	}

?>