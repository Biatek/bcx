$(document).ready(function(){

	var baseurl = $('#baseurl').text();
	var siteurl = $('#siteurl').text();

	$('.remove.file').live('click', function() {
		name=$(this).attr('name');
		$(this).parent().remove();
		$.ajax({
		   type: "POST",
		   url: baseurl+"admin/delete",
		   data: "file="+name+"&folder="+$('#upload').attr('name'),
		   success: function(msg){
			alert( "Obrázok bol zmazaný zo servera." + msg );
			if ($('#files > li').length < $('#files').attr('rel')) {
				$('#upload').show();
			};
		   }
		 });
	});

	$(function(){
		var btnUpload=$('#upload');
		var folder=btnUpload.attr('name');
		var status=$('#progress');
		new AjaxUpload(btnUpload, {
			action: siteurl+'admin/upload/'+folder,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
	                // extension is not allowed 
					status.text('Sú povolené len súbory s príponou JPG, PNG alebo GIF!');
					return false;
				}
				if ($('#files > li').length >= $('#files').attr('rel')) {
					alert('Je dovolené pridať len '+$('#files').attr('rel')+' obrázkov!');
					return false;
				};
				
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				console.log(response);
				
				//Add uploaded file to list
				if(response){
					$.ajax({
						url: siteurl+'admin/file/'+folder+'/'+response,
						success: function(data) {
							$(data).appendTo('#files');
						}
					});
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
				if ($('#files > li').length >= $('#files').attr('rel')) {
					$('#upload').hide();
				};
			}
		});		
	});
});