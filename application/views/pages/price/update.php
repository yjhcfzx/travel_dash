<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php
if(isset($resp)) var_dump($resp);
$attributes = array('class' => 'product_create', 'id' => 'product_create');
echo form_open_multipart('../' . uri_string(), $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	  <!-- Upload Image-->
	<fieldset>
      <div id="legend" class="">
        <legend class=""><?php echo $this->lang->line('uploadimage'); ?></legend>
     <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- img-->
			<div class="controls hidden imgRow" id="imgTemplate">
          		 <input type="file",  class="input-xlarge"  id='thumbnail'>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') . $this->lang->line('product')  ; ?> </button>
         	 </div>
         <?php 
         	$imgs = array();
         	if($detail['img'])
         	{
         		$imgs = explode(',', $detail['img']);
         	}
         	foreach($imgs as $index => $img):?>
         	 <div class="controls imgRow" id='thumbnailContainer<?php echo $index;?>'>
           <img class='my-thumbnail' src = <?php echo $this->config->item( 'cdn_url_upload_img') .'product/' . $img; ?> />
           <button type='button' class="btn btn-danger btn-mini" onclick='removeImage(<?php echo $index;?>);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete') . $this->lang->line('product') ; ?> </button>
          </div>
         <?php endforeach;?>
          
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
        <legend class=""><?php echo $this->lang->line('addproduct'); ?></legend>
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="username"><?php echo $this->lang->line('productname'); ?></label>
           <input type="hidden"  name='removed_img' id='removed_img' />
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='productname' id='productname'  value="<?php echo $detail['name'];?>">
          </div>
          <!-- category-->
		  <label class="control-label hidden" for="phone"><?php echo $this->lang->line('category'); ?></label>
          <div class="controls hidden">
            <input type="text"  class="input-xlarge" name='category' id='category' value=''>
          </div>
           <!-- price-->
		  <label class="control-label" for="price"><?php echo $this->lang->line('price'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='price' id='price' value="<?php echo $detail['price'];?>">
          </div>
          <!-- desc-->
          <label class="control-label" for="phone"><?php echo $this->lang->line('description'); ?></label>
          <div class="controls">
            <textarea  class="input-xlarge" name='description' id='description'><?php echo $detail['description'];?></textarea>
          </div>
          <!-- entity-->
          <label class="control-label"><?php echo $this->lang->line('entity'); ?></label>
          <div class="controls">
            <select class="input-xlarge" name='entity' id='entity'>
              <option value=''></option>
              <?php foreach($user['roles'] as $role):?>
              	<?php if($role['entity_type'] == 'entity' && !$role['is_deleted']):?>
	               <option value='<?php echo $role["entity_id"];?>'    <?php if($detail['entity_id'] == $role["entity_id"]){ echo ' selected';} ?>><?php echo $role["entity_name"];?></option>";
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
    	  
    	  var removed_img = $('#removed_img').val();
    	  var remove_src = $('#thumbnailContainer' + index + ' img').attr('src');

    	  var root_index = remove_src.lastIndexOf('product/') + 8;

    	  remove_src = remove_src.substring(root_index);

    	  if(!removed_img)
    	  {
    		  removed_img = remove_src;
          }
    	  else
    	  {
    		  removed_img += ',' + remove_src;
          } 
    	  $('#removed_img').val(removed_img);

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