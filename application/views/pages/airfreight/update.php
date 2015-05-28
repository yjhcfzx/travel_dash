<?php if(isset($resp) && $resp == 'true'):?>
<script>
alert('sucessfully updated');
setTimeout(function(){window.location.href = "<?php echo $this->config->item( 'base_url'), $router;?>";}, 1000);
</script>
<?php endif;?>
<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php

$attributes = array (
		'class' => $router . '_' . $action,
		'id' => $router . '_' . $action 
);
echo form_open_multipart ( '../' . uri_string(), $attributes );
?>

<input type="hidden" id='_method' name="_method" value="CREATE">
<input type='hidden' name='postback' value='1' />

<!-- Prod Info-->
<fieldset>
	<div id="legend" class="">
		<div class="control-group">
			<!-- Text input-->
			<label class="control-label" for="product_type_name"><?php echo $this->lang->line('airfreight_name')   ; ?></label>
			<div class="controls">
				<input type="text" class="input-xlarge required"
					name='product_type_name' id='product_type_name' value="<?php echo $detail['name'];?>">
			</div>
		</div>

</fieldset>



<!-- location-->
<fieldset>
	<div id="legend">
		
		<div class="control-group">

			<!-- greeting-->
			<div class="controls hidden locationRow" id="locationTemplate">
				<div class='panel panel-primary'>
					<div class='panel-body'>
					    <label class="control-label"><?php echo $this->lang->line("site_name"); ?></label>
					    <div class='controls'>
							<input type="text" name="location" class="input-xlarge">
						
							<button type='button' class="btn btn-danger btn-mini delete-location">
								<i class="icon-white icon-remove"></i>
		            				<?php echo $this->lang->line('delete') . $this->lang->line('site') ; ?> 
	           				</button>
	           			</div>
           				<div class='panel panel-warning'>
								<div class='panel-body'>
									<div class="row control-group">
										<h4><?php echo $this->lang->line('upload'),$this->lang->line('file'); ?></h4>
										<div class="control-group   ">
											<!-- img-->
											
											<!-- Button -->
											<div class="controls">
												<button type='button' class="addImg btn btn-success">
													<i class="icon-white icon-plus"></i><?php echo $this->lang->line('add'),$this->lang->line('file'); ?>
							            </button>
											</div>
	
										</div>
									</div>
								</div>
						</div><!-- end images -->

					</div>
				</div>
			
			</div>
			<div class="controls hidden imgRow" id="imgTemplate">
				<input type="file" ,  class="input-xlarge" id='thumbnail'>
				<button type='button' class="btn btn-danger btn-mini delete-img">
					<i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') . $this->lang->line('file')  ; ?> </button>
			</div>

			<?php foreach($detail['sites'] as $index => $site):$index = $index + 1;?>
			<div class="controls locationRow" id='locationContainer<?php echo $index;?>'>
				<div class='panel panel-primary'>
					<div class='panel-body'>
							<label class="control-label"><?php echo $this->lang->line("site_name"); ?></label>
						    <div class='controls'>
								<input type="text" name="location1" class="input-xlarge"
									id='location<?php echo $index;?>' value="<?php echo $site['name'];?>">
							
								<button type='button' class="btn btn-danger btn-mini delete-location"
									onclick='removeLocation(<?php echo $index;?>);'>
									<i class="icon-white icon-remove"></i>
			            				<?php echo $this->lang->line('delete') . $this->lang->line('site') ; ?> 
		           				</button>
		           			</div>
           				<div class='panel panel-warning'>
								<div class='panel-body'>
									<div class="row control-group">
										<h4><?php echo $this->lang->line('upload'),$this->lang->line('file'); ?></h4>
										<div class="control-group   ">
											<!-- img-->
											<?php foreach($site['files'] as $j => $file): $j = $j + 1;?>
											<div class="controls imgRow" id='thumbnailContainer<?php echo $index , '_' , $j;?>'>
												<input  readonly type="text" , name="thumbnail<?php echo $index , '_' , $j;?>" class="input-xlarge my-disabled"
													id='thumbnail<?php echo $index , '_' , $j;?>' value="<?php echo $file;?>">
												<button type='button' class="btn btn-danger btn-mini delete-img"
													onclick='removeImage(<?php echo $index;?>,<?php echo $j;?>);'>
													<i class="icon-white icon-remove"></i>
									            <?php echo $this->lang->line('delete') . $this->lang->line('file') ; ?> 
									            </button>
											</div>
											<?php endforeach;?>
											<!-- Button -->
											<div class="controls">
												<button type='button' 
													onclick="javascript:addImage(1);" class="addImg btn btn-success">
													<i class="icon-white icon-plus"></i><?php echo $this->lang->line('add'),$this->lang->line('file'); ?>
							            </button>
											</div>
	
										</div>
									</div>
								</div>
						</div><!-- end images -->

					</div>
				</div>

			</div>
			<?php endforeach;?>
			<!-- Button -->
			<div class="controls">
				<button type='button' id='addlocation'
					onclick="javascript:addLocation();" class="btn btn-success">
					<i class="icon-white icon-plus"></i><?php echo $this->lang->line('add'), $this->lang->line('site'); ?>
            </button>
			</div>

		</div>

	</div>

</fieldset>

<div class="control-group">
	<!-- Button -->
	<div class="controls">
		<button id='submit' class="btn btn-success">
			<i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('submit'); ?></button>
	</div>
</div>
</div>

</form>
<script>  
      
       var avail_location_index = [];
       var avail_img_index = [];
       
       function addImage(loc_index)
        {
          var index  = $('#locationContainer' + loc_index + ' div.imgRow').length + 1;
         
              if(avail_img_index[loc_index] && avail_img_index[loc_index].length)
              {
            	  index = avail_img_index[loc_index][0];
            	  avail_img_index[loc_index].splice(0, 1);
              }
              //alert(loc_index + '_' + index);
          if(index < 10)
          {
              //alert(loc_index + '_' + index);
        	  $("#imgTemplate").clone().removeClass('hidden').attr('id','thumbnailContainer' + loc_index + '_' +　index ).insertBefore('#locationContainer' + loc_index + ' .addImg');
	          $('#locationContainer' + loc_index + ' div.imgRow:last').find('input').attr('name','thumbnail' + loc_index + '_' +　index).attr('id','thumbnail' + loc_index + '_' +　index );
	          $('#thumbnailContainer'+ loc_index + '_' +　index  + ' .btn-danger.delete-img').click(function(){
					var id = $(this).parents('.imgRow').attr('id');
					var indexStr = id.substring(18);
					var indexArr = indexStr.split('_');
					removeImage(indexArr[0],indexArr[1]);
	             });
          }
        }
       function removeImage(loc,index){
           //alert(loc + '_' + index);
    	   $('#thumbnailContainer' + loc + '_' +　index).fadeOut().remove();
    	   if(!avail_img_index[loc] || !avail_img_index[loc].length){
    		   avail_img_index[loc] = [];
    	   }
    	   avail_img_index[loc].push (index);
       }
      

       function addLocation()
       {
         var index  = $('div.locationRow').length;
        
             if(avail_location_index.length)
             {
           	  	index = avail_location_index[0];
           		avail_location_index.splice(0, 1);
             }
         if(index < 10)
         { 
	          $("#locationTemplate").clone().removeClass('hidden').attr('id','locationContainer' +　index ).insertAfter("div.locationRow:last");
	          $("div.locationRow:last").find('input').attr('name','location' +　index).attr('id','location' +　index );
	          addImage(index);
	          $('#locationContainer' +　index  + ' .addImg').click(function(){
					var id = $(this).parents('.locationRow').attr('id');
					var index = id.substring(17);
					addImage(index);
	             });
	          $('#locationContainer' +　index  + ' .btn-danger.delete-location').click(function(){
					var id = $(this).parents('.locationRow').attr('id');
					var index = id.substring(17);
					removeLocation(index);
	             });
         }
       }
      function removeLocation(index){
    	  var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
          if(!conf)
              return false;
   	   $('#locationContainer' +　index).fadeOut().remove();
   		avail_location_index.push (index);
      }
      
       var validator_messages = {

    	         'price': {

    	             required: "<?php echo $this->lang->line('required_error') . $this->lang->line('price');?>"
    	         },
    	         'productname': {

    	             required: "<?php echo $this->lang->line('required_error') . $this->lang->line('productname');?>"
    	         }
       };
       function validator_show_errors(errorMap,errorList, form){

    	   jQuery('label.my-error').remove();
    	  
    	   for (var i in errorMap) {

    	       var rst = errorMap[i];

    	         console.log(i, ":", rst);

    	         var selector = i.replace(/\[/ig, '');

    	         selector = selector.replace(/\]/ig, '');

    	       

    	         switch (i)

    	         {    
    	               default:             
    	               $('#' + i).after('<label class="error my-error for_' + selector +  '">' + rst + '</label>');

    	                   break;

    	              }

    	   }

    	  }
       $(document).ready(function(){ 
    	   var add_validator = jQuery('#<?php echo $router . "_" . $action;?>').validate({

    	         ignore: "",

    	         onkeyup: false,//function(element) {},

    	         onfocusout: false,

    	         messages : validator_messages ,

    	         showErrors: function(errorMap, errorList)

    	         {           

    	          validator_show_errors(errorMap, errorList,'#<?php echo $router . "_" . $action;?>');            

    	         },

    	         submitHandler: function(form) {

    	             form.submit();

    	         },           

    	     });

       
           });
        </script>