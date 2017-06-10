<?php
	
Class World extends Model{	
		
	
	// получение данных по sql запросу 
	public function findBySQL($query){
			
			$arr = [];
			if($res = mysqli_query($this->connect,$query) ){
				while( $row = mysqli_fetch_assoc($res) ){
					$arr[] = $row;
				}				
			}

			return $arr;
		
	}	
	
	
		
	
}	