$(document).ready(function(){
	var client_sort = false;
	var ajax_sort = false;
	var cur_col =-1;
	var sortdir = 'up';

	$('#link-sort').click(function(){	
		client_sort = false;
		ajax_sort = false;		
	});		
	$('#client-sort').click(function(){	
		client_sort = $(this).prop('checked');
		// alert(client_sort)	
	});	
	$('#ajax-sort').click(function(){	
		ajax_sort = $(this).prop('checked');
		// alert(client_sort)	
	});

	$(document).on('click','.sortable',function(e){	
		if( client_sort ){
			e.preventDefault();	
			sort($(this).parent());
			return false;
		}else if(ajax_sort)	{	
			e.preventDefault();
			var sortfield = $(this).parent().data('sort'); // графа сортировки
			if(cur_col != $(this).parent().index()+1 ) {
				cur_col = $(this).parent().index()+1;
				sortfield = '-' + sortfield;
			}			
			$.ajax({
				type: 'get',
				url: '/main/filter?sort='+sortfield +'&type=ajax', 
				dataType: 'html',				
				success: function(data){
					$('#table-world').html(data);
				},
				error: function(jqxhr, status, errorMsg) {
					alert('Статус: ' + status + ' Ошибка: ' + errorMsg );				
				}
			});	
			return false;
		}
	});

	function sort(td) {
		var a = new Array();
		var col = td.index()+1;
		if(cur_col==col) {
			sortdir='down';
		}else{
			sortdir='up';
		}	
		cur_col = col;
		var td = $('#table-world td:nth-child('+col+')');
		var type = $(td).data('type');
		$(td).each(function(i){
			if(i>0){ // 0 - заголовок
				a[i] = new Array();
				a[i][0]= $(this).html();
				a[i][1]= i;
			}
		})
		if(type=='number'){
			if(sortdir=='up'){
				a.sort(sortNumber);
			}else{	
				a.reverse(sortNumber);  // обратный порядок
			}	
		}else if(type=='float'){
			if(sortdir=='up'){
				a.sort(sortFloat);
			}else{	
				a.reverse(sortFloat);  // обратный порядок
			}	
		}else{
			if(sortdir=='up'){
				a.sort();
			}else{	
				a.reverse(); // обратный порядок
			}
		}
		var new_table = '<tr>'+ $('#table-world tr:nth-child(1)').html() +'</tr>'; // берем заголовок
		var row = 0;
		for(i=0; i<a.length-1; i++) {
			row = a[i][1]+1;
			new_table += '<tr>' + $('#table-world tr:nth-child('+ row +')').html() + '</tr>'; // берем строку 
		}
		
		$('#table-world').html(new_table);
		return false;
		
	}
	function sortNumber(a, b) {
	  if (parseInt(a) > parseInt(b)) return 1;
	  if (parseInt(a) < parseInt(b)) return -1;
	  //return 1; // если пусто
	}	
	function sortFloat(a, b) {
	  if (parseFloat(a) > parseFloat(b)) return 1;
	  if (parseFloat(a) < parseFloat(b)) return -1;
	  //return 1; // если пусто
	}
});