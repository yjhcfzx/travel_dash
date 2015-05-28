<?php if(isset($resp) && $resp == 'true'):?>
<script>
alert('sucessfully updated');
setTimeout(function(){window.location.href = "<?php echo $this->config->item( 'base_url'),$router;?>";}, 1000);
</script>
<?php endif;?>
<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php 
$attributes = array('class' => $router. '_' . $action, 'id' => $router. '_' . $action);
echo form_open_multipart('../' . uri_string(), $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	
	<!-- Prod Info-->
    <fieldset>
      <div id="legend" class="">
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="name"><?php echo $this->lang->line($router . '_name'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='name' id='name'  value='<?php echo $detail["name"];?>'>
          </div>
           <!-- Text input-->
          <label class="control-label" for="content"><?php echo $this->lang->line($router); ?></label>
          <div class="controls">
            <textarea  rows="5" class="input-xlarge required" name='content' id='content'><?php echo $detail["content"];?></textarea>  
          </div>
         
    </div>
        
    </fieldset>

    
    
    
  
   

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button id='submit' class="btn btn-success"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('submit'); ?></button>
          </div>
        </div>
	</div>

</form>
<script>  
       
      
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