<?php 

?>

<div class="container">
			 
<h2>Страны</h2>
<label>
	<input type="radio" name="sorting" id="link-sort" checked> Сортировка по ссылке
</label>
<label>
	<input type="radio" name="sorting" id="client-sort"> Клиентская сортировка 
</label>
<label>
	<input type="radio"  name="sorting" id="ajax-sort"> Ajax сортировка 
</label>

<?php if(isset( $data) ) { ?>

<?php 
	echo '<pre>' . $query . '</pre>';
?>

<table class="table table-striped" id="table-world">
<tr>
	<td class="sort-col" data-type="string" data-sort="continent"><a href="/main/filter?sort=<?=$sort=='continent'?$sort_direct:''?>continent" class="sortable">Континент</a></td>
	<td class="sort-col" data-type="string" data-sort="region"><a href="/main/filter?sort=<?=$sort=='region'?$sort_direct:''?>region" class="sortable">Регион</a></td>
	<td class="sort-col" data-type="number" data-sort="countries"><a href="/main/filter?sort=<?=$sort=='countries'?$sort_direct:''?>countries" class="sortable">Стран</a></td>
	<td class="sort-col" data-type="float" data-sort="lifeexpectancy"><a href="/main/filter?sort=<?=$sort=='lifeexpectancy'?$sort_direct:''?>lifeexpectancy" class="sortable">Продолжительность жизни</a></td>
	<td class="sort-col" data-type="number" data-sort="population"><a href="/main/filter?sort=<?=$sort=='population'?$sort_direct:''?>population" class="sortable">Население</a></td>
	<td class="sort-col" data-type="number" data-sort="cities"><a href="/main/filter?sort=<?=$sort=='cities'?$sort_direct:''?>cities" class="sortable">Городов</a></td>
	<td class="sort-col" data-type="number" data-sort="language"><a href="/main/filter?sort=<?=$sort=='language'?$sort_direct:''?>language" class="sortable">Языков</a></td>
</tr>	
<?php 

foreach($data as $key=>$row){ ?>
	<tr>
		<td><?=$row['continent']?></td>
		<td><?=$row['region']?></td>
		<td><?=$row['countries']?></td>
		<td><?=$row['lifeexpectancy']?></td>
		<td><?=$row['population']?></td>
		<td><?=$row['cities']?></td>
		<td><?=$row['language']?></td>
	</tr>		
	<?php } ?>

</table>
<?php }else{ ?>
<p>Нет данных для отображения</p>
<?php } ?>
</div>
