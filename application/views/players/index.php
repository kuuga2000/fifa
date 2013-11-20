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
<button id="create-user">Create new user</button>

<div id="contentt"></div>

 
<div id="dialog-form" title="Add new players">
  <p class="validateTips">All form fields are required.</p>
  <?=$player=0 ? $player->player_name : '' ;?>
  <form action="" id="myform" method="post">
  <fieldset>
    <label for="name">Player Name</label><br>
    <input type="text" value="" name="name" id="name" class="text ui-widget-content ui-corner-all" />
    <br>
    <label for="birthplace">Birth Place</label><br>
    <input type="text" name="birthplace" id="birthplace" value="" class="text ui-widget-content ui-corner-all" />
    <br>
    <label for="birthdate">Birth Date</label><br>
    <input type="text" name="birthdate" id="birthdate" value="" class="text ui-widget-content ui-corner-all" />
    <br>
    <label for="country">Country</label><br>
    <input type="text" name="country" id="country" value="" class="text ui-widget-content ui-corner-all" />
    <br>
    
  </fieldset>
  </form>
   
</div>
 
 
 



<script>
  $(document).ready(function() {
  	$( "#birthdate" ).datepicker({
  	  //dateFormat  : "dd MM yy", 
      dateFormat  : "yy-mm-dd", 
      changeMonth: true,
      changeYear: true
    });
    //edit
  	/*function showData(){
  		
			var data_payer = [];
			data_payer += "<table border='0' class='ui-widget ui-widget-content'><tr><th>No</th><th>Name</th><th>Place / Date Birth</th><th>Country</th><th>#</th></thead>";
			
			$.ajax({
				type:'POST',
				url:'?=site_url();?>players/getallplayers',
				dataType:'json',
				success:function(data){
					for(var x=0;x<data.length; x++){
						var i=x+1;
						data_payer += '<tr>';
						data_payer += '<td>'+ i +'</td>';
						data_payer += '<td>'+data[x].player_name+'</td>';
						data_payer += '<td>'+data[x].birth_place+', '+data[x].birth_date+'</td>';
						data_payer += '<td>'+data[x].country_id+'</td>';
						data_payer += "<td><a href='#' id='1' class='edit'>Edit</td>";
						data_payer += '</tr>';
					}
					data_payer += '</table>';
					$('#contentt').html(data_payer);
					
				}
			});
	}*/
		
		
	function showData(){
			var data_payer = [];
			data_payer += "<table border='0' class='ui-widget ui-widget-content'><tr><th>No</th><th>Name</th><th>Place / Date Birth</th><th>Country</th><th>#</th></tr>";
			$.getJSON("<?=site_url();?>players/getallplayers",function(data){
				$.each(data, function(key,value){
					data_payer += '<tr>';
					data_payer += '<td>1</td>';
		    		data_payer += '<td>'+ value.player_name +'</td>';
		    		data_payer += '<td>'+ value.birth_place +'-'+ value.birth_date +'</td>';
		    		data_payer += '<td>'+ value.country_id +'</td>'; 
		    		data_payer += "<td><a id='"+value.id+"' class='edit' href='#'>Edit</a> &nbsp;&nbsp; <a id='"+value.id+"' class='delete' href='#'>Delete</a></td>";
		    		data_payer +='</tr>';
    	        });
    	        data_payer +='</table>';
				$('#contentt').html(data_payer);
				
				$('.edit').click(function(){		
					
					$.ajax({
						type:'POST',
						url:'<?=site_url();?>players/index/'+$(this).attr('id'),
						
						success:function(data){
							
						}
					});
					$( "#dialog-form" ).dialog( "open" );
					return false;
    			});
    			
    			$('.delete').click(function(){
    				$.ajax({
						type:'POST',
						url:'<?=site_url();?>players/delete/'+$(this).attr('id'),
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
      //draggable: false,
      //height: "auto",
      //width: "auto",
      resizable: false,
      //position: [400,50],
      
      my: "center bottom",
 	  at: "center top",
      
      //my: "center",
   	  //at: "center",
      //of: window,
      buttons: {
        "Save": function() {
        	var myform = $('#myform').serialize();
        	$.ajax({
				type:'POST',
				url:'<?=site_url();?>players/create',
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
 
    $( "#create-user" )
      .button()
      .click(function() {
      	
        $( "#dialog-form" ).dialog( "open" );
        $('#myform')[0].reset();
      });
  });
</script>
   