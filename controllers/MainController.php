<?php
	
Class MainController extends Controller{	
	
	
	public function index(){
	
		return $this->render('index');
		
	}
			
	public function filter(){
		
		$sort = $_GET['sort'];
		
		$type = $_GET['type'];
		
		$sort_asc = true;
		$sort_direct = '-';
		if( mb_substr($sort,0,1)=='-' ) {
			$sort = str_replace('-','',$sort);
			$sort_asc = false;
			$sort_direct = ''; // направление поиска по выбранной колонке
		}	
		
		if( $world = $this->loadModel('World') ){
			$_sort = 'continent ASC'; // сорт по умолчанию
			// массив достпуных полей для сортировки
			$fields = ['continent','region','cities','population','countries','lifeexpectancy','language'];
			if(in_array($sort,$fields)){
				// направление сортировки
				if( $sort_asc ){					
					$_sort = $sort . ' ASC';
				}else{
					$_sort = $sort .' DESC';
				}
			}
			
			$query = "SELECT Country.continent as continent, 
	Country.region as region	
	FROM Country
		left JOIN City ON Country.code=City.CountryCode 					
		left JOIN CountryLanguage ON Country.code=CountryLanguage.CountryCode
		GROUP BY Country.continent, Country.region						
		ORDER BY {$_sort}";
			
			$data = $world->findBySQL($query);

		}else{
			$data = null;
		}
			
		if($type=='ajax'){
			$template = 'ajax';
			$this->layout = false;
		}else{
			$template = 'index';
		}
		
		return $this->render($template, [
			'data'=>$data,
			'sort'=>$sort,
			'sort_direct'=>$sort_direct,
			'query' => $query
		] );
		
	}
		
	public function error404(){

		return $this->render('error404');
		
	}
	
	
}	