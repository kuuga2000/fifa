<script src="<?=base_url();?>assets/js/jquery-1.10.0.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" href="<?=base_url();?>assets/js/jquery-ui-1.10.3.custom/css/ui-darkness/jquery-ui-1.10.3.custom.css" type="text/css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/jquery-ui-1.10.3.custom/development-bundle/themes/ui-darkness/jquery.ui.dialog.css" type="text/css"> 
<script src="<?=base_url();?>assets/js/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js"></script> 

<!--<script src="<?=base_url();?>assets/complete.min.js"></script> 
<script src="<?=base_url();?>assets/jquery.dataTables.min.js"></script> 
-->

<script>
$(document).ready(function(){
	//$('#example').dataTable();
	/*$('#example').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );*/
});

	/*$(document).ready(function(){
		
		
});*/
</script> 
<button id="create-club">Create new club</button>

<div id="content"></div>

 
<div id="dialog-form" title="Add new players">
  <p class="validateTips">All form fields are required.</p>
  <form action="" id="myform" method="post">
  <fieldset>
    <label for="name">Club Name</label><br>
    <input type="text" value="" name="name" id="name" class="text ui-widget-content ui-corner-all" />
    <br>
    <label for="country">Country</label><br>
    <select class="select ui-widget-content ui-corner-all" name="country" id="country">
    	<? foreach($countries as $country):?>
    	<option value="<?=$country->id;?>"><?=$country->country_name;?></option>
    	<? endforeach;?>
    </select>
    <br>
    <label for="country">Nickname</label><br>
    <input type="text" name="nickname" id="nickname" value="" class="text ui-widget-content ui-corner-all" />
    <br>
    <label for="birthdate">On Stand</label><br>
    <input type="text" name="onstand" id="onstand" value="" class="text ui-widget-content ui-corner-all" />
    <br>
    
    
  </fieldset>
  </form>
   
</div>

<script>
  $(document).ready(function() {
  	$( "#onstand" ).datepicker({
  	  //dateFormat  : "dd MM yy", 
      dateFormat  : "yy-mm-dd", 
      changeMonth: true,
      changeYear: true
    });
    		
		
	function showData(){
			var data_club = [];
			data_club += "<table border='0' class='ui-widget ui-widget-content'><tr><th>No</th><th>Name</th><th>Nickname</th><th>Country</th><th>On Stand</th><th>#</th></tr>";
			$.getJSON("<?=site_url();?>clubs/getallclubs",function(data){
				var i=1;
				$.each(data, function(key,value){
					
					data_club += '<tr>';
					data_club += '<td>'+i+'</td>';
		    		data_club += '<td>'+ value.club_name +'</td>';
		    		data_club += '<td>'+ value.nickname+'</td>';
		    		data_club += '<td>'+ value.country_name +'</td>';
		    		data_club += '<td>'+ value.on_stand +'</td>'; 
		    		data_club += "<td><a id='"+value.on_stand+"' class='edit' href='#'>Edit</a> &nbsp;&nbsp; <a id='"+value.id+"' class='delete' href='#'>Delete</a></td>";
		    		data_club += '</tr>';
    	        i++;
    	        });
    	        data_club += '</table>';
				$('#content').html(data_club);
				
				$('.edit').click(function(){		
					
					$.ajax({
						type:'POST',
						url:'<?=site_url();?>players/index/'+$(this).attr('id'),
						
						success:function(data){
							
						}
					});
					$( "#dialog-form" ).dialog("open");
					return false;
    			});
    			
    			$('.delete').click(function(){
    				$.ajax({
						type:'POST',
						url:'<?=site_url();?>clubs/delete/'+$(this).attr('id'),
						success:function(data){
							showData();
						}
					});
					 
					return false;
    			});
    			
			});		 
	}	
	
  	showData();
  	
  	var allFields = $( [] ).add( name );
    
    tips = $( ".validateTips" );
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 650,
      modal: true,
      resizable: false,
      //button for save data
      buttons: {
        "Save": function() {
        	var myform = $('#myform').serialize();
        	$.ajax({
				type:'POST',
				url:'<?=site_url();?>clubs/create',
				data:myform,
				success:function(data){
					$('#myform')[0].reset();
					showData();
				}
			});
            $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#create-club" )
      .button()
      .click(function() {
      	
        $( "#dialog-form" ).dialog( "open" );
        $('#myform')[0].reset();
      });
  });
</script>   