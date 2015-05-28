<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php 
$attributes = array('class' => 'product_create', 'id' => 'product_create');
echo form_open_multipart('../product/create', $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	  <!-- Upload Image-->
	<fieldset>
      <div id="legend" class="hidden">
        <legend class=""><?php echo $this->lang->line('uploadimage'); ?></legend>
    <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- img-->
			<div class="controls hidden imgRow" id="imgTemplate">
          		 <input type="file",  class="input-xlarge"  id='thumbnail'>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') . $this->lang->line('product')  ; ?> </button>
         	 </div>
          <div class="controls imgRow" id='thumbnailContainer1'>
            <input type="file", name="thumbnail1"  class="input-xlarge"  id='thumbnail1'>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeImage(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete') . $this->lang->line('product') ; ?> 
            </button>
          </div>
 		  <label class="control-label label-warning" for="thumbnail1" style='margin-top:5px;padding:3px;'><?php echo $this->lang->line('imgsizelimit'); ?></label>
 					<!-- Button -->
          <div class="controls">
            <button type='button' id='addImg' onclick="javascript:addImage();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('addImg'); ?>
            </button>
          </div>
          
    </div>
 
	</div>
    </fieldset>
	<!-- Prod Info-->
    <fieldset>
      <div id="legend" class="">
        <div class="hidden"><?php echo $this->lang->line('addprice'); ?></div>
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="agent_name"><?php echo $this->lang->line('agent_name'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='agent_name' id='agent_name'  value=''>
          </div>
          <!-- category-->
		  <label class="control-label " for="product_category"><?php echo $this->lang->line('product_category'); ?></label>
          <div class="controls ">
            <input type="text"  class="input-xlarge" name='product_category' id='product_category' value=''>
          </div>
           <!-- price-->
		  <label class="control-label" for="price"><?php echo $this->lang->line('price'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='price' id='price' value=''>
          </div>
          <!-- desc-->
          <label class="control-label" for="awb_instruction"><?php echo 'awb_instruction';//$this->lang->line('description'); ?></label>
          <div class="controls">
            <textarea  class="input-xlarge" name='awb_instruction' id='awb_instruction'></textarea>
          </div>
          <!-- entity-->
          <label class="control-label hidden"><?php echo $this->lang->line('entity'); ?></label>
          <div class="controls hidden">
            <select class="input-xlarge" name='entity' id='entity'>
              <option value=''></option>
              <?php foreach($user['roles'] as $role):?>
              	<?php if($role['entity_type'] == 'entity' && !$role['is_deleted']):?>
	               <option value='<?php echo $role["entity_id"];?>'><?php echo $role["entity_name"];?></option>";
	             <?php endif;?>
             <?php endforeach;?>
            </select>
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
       var avail_img_index = [];
       function addImage()
        {
          var index  = $('div.imgRow').length;
         
              if(avail_img_index.length)
              {
            	  index = avail_img_index[0];
            	  avail_img_index.splice(0, 1);
              }
          if(index < 10)
          {
	          $("#imgTemplate").clone().removeClass('hidden').attr('id','thumbnailContainer' +　index ).insertAfter("div.imgRow:last");
	          $("div.imgRow:last").find('input').attr('name','thumbnail' +　index).attr('id','thumbnail' +　index );
	          $('#thumbnailContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.imgRow').attr('id');
					var index = id.substring(18);
					removeImage(index);
	             });
          }
        }
       function removeImage(index){
    	   $('#thumbnailContainer' +　index).fadeOut().remove();
    	   avail_img_index.push (index);
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