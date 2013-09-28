$(document).ready(function(){

	if ($('#result').length) {
		$(window).scrollTo($('.results-anchor'), 800);
	}

	$('#small-menu').click(function(){
  	$('#small-menu-popup').toggle();
	});

	window.setInterval(counter, 1000);

	// counter
	function counter() {
		$('.person').each(function(index) {
			seconds = $(this).children('.cseconds').html();
			seconds++;
			$(this).children('.cseconds').html(seconds);
			if (Math.ceil(seconds/60) == seconds/60) {
				minutes = $(this).children('.cminutes').html();
				minutes++;
				$(this).children('.cminutes').html(minutes);
				if (Math.ceil(minutes/60) == minutes/60) {
					hours = $(this).children('.chours').html();
					hours++;
					$(this).children('.chours').html(hours);				
				}				
			}
		});
	}

	$('div.star').live('click', function() {
	   event.preventDefault();
	   var target = $(this).children('a').attr("href");
	   // load the url and show modal on success
	   $("#star-popup .modal-body").load(target, function() { 
  	   $("#star-popup").modal("show"); 
  	 });
	
	 /*
	
	
		if ($('#star-popup').is('.displayed')) {
			
		}
		else {
			$(this).parent().addClass('insert');
			$.ajax({
				url: $('#siteurl').html()+'/osobnost/popup/'+$(this).parent().attr('rel'),
				type: 'GET',
				success: function(data) {
					$('html').append(data);
					//$('#star-popup').addClass('displayed');
					
				}
			});
		}
		
		*/
	});
	
	$('#star-popup .name.label-info').live('click', function() {
		var id = $('#row-id').attr('rel');
		$('input[name="name['+id+']"]').val($(this).attr('name'));
		$('select[name="month['+id+']"]').val($(this).attr('month'));
		$('select[name="day['+id+']"]').val($(this).attr('day'));
		$('select[name="year['+id+']"]').val($(this).attr('year'));
		$('#star-popup').modal('hide');
		$('tr').removeClass('insert');
	})
	
	$('.popup-filter').live('change', function() {
	  $('#star-popup .name').removeClass('label-info');
	  $.post($('#siteurl').html()+'/osobnost/popup/'+$('#row-id').attr('rel'), $('form#kategorie').serialize(),
	  function (html) {
  	  $('#star-popup .modal-body').html(html);
	  });
	  
		if ($('#star-popup input:checked').length == 0) {
  		$('#star-popup tr').show();
		}
		else {
		  $('#star-popup tr').hide();
		  $('#star-popup tr').each(function(index) {
		    var katArray = $(this).attr('kat').split(',');
		    var checkboxArray = $('#star-popup input:checked').map(function () {
  		    return this.value;
  		  }).get();
		    //console.log(katArray);
		    //console.log(checkboxArray);
		  });
		}
		  
		  /*
  		$('#star-popup input:checked').each(function(index) {
  			checked = $(this);
  			
  				
  				if (jQuery.inArray(checked.val(), katArray) > -1) {
  					$(this).show();
  				}
  			});	
  		});   		
  		*/	
	});

	$('button.calculatexxx').click(function() {
		$(window).scrollTo($('#result'), 800);
		$('.result').animate({opacity: 1},1000);
		
		var json = new Array();
		var month = '';
		var year = '';
		var day = '';
		
		$('.calculator tr').each(function(index) {
			month = $('#calculator select[name=month['+index+']]').val();
			day = $('#calculator select[name=day['+index+']]').val();
			year = $('#calculator select[name=year['+index+']]').val();
			json[index] = day+','+month+','+year;
		});
		
		$.ajax({
			url: $('#siteurl').html()+'/calculator/calculate',
			type: 'POST',
			data: $('#calculator').serialize(),
			success: function(data) {
				$('.result').html(data);
			}
		});		
		
	});
	
	$('button.more').click(function() {
		var rows = $('table.calculator tr').length;
		$.ajax({
			url: $('#siteurl').html()+'/calculator/get_date_row/'+rows,
			success: function(html) {
				$('#calculator tr:last').after(html);
			}
		});
	});
	
	$('#start-over').live('click', function() {
		// $('.result').animate({opacity: 0},1000);
		$(window).scrollTo(0, 800);
	});
	
	$('ul.tabs li').click(function() {
		var tab = $(this).attr('class');
		$('ul.tabs li').removeClass('active');
		$(this).addClass('active');
		$('.result .tab').hide();
		$('.result .tab.'+tab).show();
		event.preventDefault();
	});
	
	// ckeditor config
	
	CKEDITOR.stylesSet.add( 'default',
	[
		// Block Styles
		{ name : 'Header 1'		, element : 'h1', styles : {} },
		{ name : 'Header 2'		, element : 'h2', styles : {} },
		{ name : 'Header 3'		, element : 'h3', styles : {} },
		{ name : 'Header 4'		, element : 'h4', styles : {} },
		{ name : 'Header 5'		, element : 'h5', styles : {} },
		{ name : 'Header 6'		, element : 'h6', styles : {} },

		// Inline Styles
		//{ name : 'Marker: Yellow'	, element : 'span', styles : { 'background-color' : 'Yellow' } },
		// { name : 'Marker: Green'	, element : 'span', styles : { 'background-color' : 'Lime' } },

		// Object Styles
		/*
		{
			name : 'Image on Left',
			element : 'img',
			attributes :
			{
				'style' : 'padding: 5px; margin-right: 5px',
				'border' : '2',
				'align' : 'left'
			}
		}
		*/
	]);
	
	CKEDITOR.replace( 'ckeditor',
						{
							toolbar : [ [ 'Styles', 'Bold', 'Italic', 'Underline' ], [ 'Link', 'Image' ], [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',  ], ['Table'] ]
						}
	 );
	
});