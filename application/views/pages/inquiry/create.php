<?php if(isset($resp) && is_numeric($resp) &&  $resp >= 0):?>
<script>
alert('sucessfully created');
setTimeout(function(){window.location.href = "<?php echo $this->config->item( 'base_url');?>inquiry";}, 1000);
</script>
<?php endif;?>
<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php 
$attributes = array('class' => 'product_create', 'id' => 'inquiry_create');
echo form_open_multipart($this->config->item('base_url') .'inquiry/create', $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	
	<!-- Prod Info-->
    <fieldset>
      <div id="legend" class="">
        <div class="hidden"><?php echo $this->lang->line('addprice'); ?></div>
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="product_type_name"><?php echo $this->lang->line('product_type_name'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='product_type_name' id='product_type_name'  value=''>
          </div>
          
         
    </div>
        
    </fieldset>

    
    
     <!-- greeting-->
	<fieldset>
      <div id="legend" >
        <legend class=""><?php echo $this->lang->line('addgreeting'); ?></legend>
    <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- greeting-->
			<div class="controls hidden greetingRow" id="greetingTemplate">
          		 <input type="text"  class="input-xlarge"  id='greeting'>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') . $this->lang->line('greeting')  ; ?> </button>
         	 	 <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.greetingRow','up')"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         		 <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.greetingRow','down')"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
         	 </div>
          <div class="controls greetingRow" id='greetingContainer1'>
            <input type="text" name="greeting1"  class="input-xlarge"  id='greeting1'>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeGreeting(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete') . $this->lang->line('greeting') ; ?> 
            </button>
            <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.greetingRow','up')"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         	<button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.greetingRow','down')"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
          </div>
 		  <label class="control-label label-warning hidden" for="thumbnail1" style='margin-top:5px;padding:3px;'><?php echo $this->lang->line('imgsizelimit'); ?></label>
 					<!-- Button -->
          <div class="controls">
            <button type='button' id='addgreeting' onclick="javascript:addGreeting();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('addgreeting'); ?>
            </button>
          </div>
          
    </div>
 
	</div>
    </fieldset>
  
    <!-- inquery-->
	<fieldset>
      <div id="legend" >
        <legend class=""><?php echo $this->lang->line('addquestion'); ?></legend>
    <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- question-->
			<div class="controls hidden questionRow" id="questionTemplate">
          		 <input type="text"  class="input-xlarge"  id='question'>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') . $this->lang->line('product')  ; ?> </button>
          		  <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.questionRow','up')"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         		  <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.questionRow','down')"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
         	 </div>
          <div class="controls questionRow" id='questionContainer1'>
            <input type="text" name="question1"  class="input-xlarge"  id='question1'>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeQuestion(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete') . $this->lang->line('product') ; ?> 
            </button>
             <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.questionRow','up')"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         	<button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.questionRow','down')"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
          </div>
 		  <label class="control-label label-warning hidden" for="thumbnail1" style='margin-top:5px;padding:3px;'><?php echo $this->lang->line('imgsizelimit'); ?></label>
 					<!-- Button -->
          <div class="controls">
            <button type='button' id='addQuest' onclick="javascript:addQuestion();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('addquestion'); ?>
            </button>
          </div>
          
    </div>
 
	</div>
    </fieldset>  
       <!-- inquery ending-->
	<fieldset>
      <div id="legend" >
        <legend class=""><?php echo $this->lang->line('addending'); ?></legend>
    <div class="control-group">
          
          <!-- ending-->
			<div class="controls hidden endingRow" id="endingTemplate">
          		 <input type="text"  class="input-xlarge"  id='ending'>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete'); ?> </button>
          		 <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.endingRow','up')"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         		 <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.endingRow','down')"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
         	 </div>
          <div class="controls endingRow" id='endingContainer1'>
            <input type="text" name="ending1"  class="input-xlarge"  id='ending1'>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeEnding(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete'); ?> 
            </button>
            <button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.endingRow','up')"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         	<button type='button' class="btn btn-success btn-large" onclick="javascript:move(this,'.endingRow','down')"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
          </div>
 		 
 		  <!-- Button -->
          <div class="controls">
            <button type='button' id='addEnding' onclick="javascript:addAEnding();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('addending'); ?>
            </button>
          </div>
          
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
       var avail_question_index = [];
       var avail_greeting_index = [];
       var avail_ending_index = [];
       function addAEnding()
       {
         var index  = $('div.endingRow').length;
        
             if(avail_ending_index.length)
             {
           	  index = avail_ending_index[0];
           	  avail_ending_index.splice(0, 1);
             }
         if(index < 10)
         { 
	          $("#endingTemplate").clone().removeClass('hidden').attr('id','endingContainer' +　index ).insertAfter("div.endingRow:last");
	          $("div.endingRow:last").find('input').attr('name','ending' +　index).attr('id','ending' +　index );
	          $('#endingContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.endingRow').attr('id');
					var index = id.substring(15);
					removeEnding(index);
	             });
         }
       }
      function removeEnding(index){
    	  var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
          if(!conf)
              return false;
   	   $('#endingContainer' +　index).fadeOut().remove();
   	   avail_ending_index.push (index);
      }
       function addQuestion()
        {
          var index  = $('div.questionRow').length;
         
              if(avail_question_index.length)
              {
            	  index = avail_question_index[0];
            	  avail_question_index.splice(0, 1);
              }
          if(index < 10)
          { 
	          $("#questionTemplate").clone().removeClass('hidden').attr('id','questionContainer' +　index ).insertAfter("div.questionRow:last");
	          $("div.questionRow:last").find('input').attr('name','question' +　index).attr('id','question' +　index );
	          $('#questionContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.questionRow').attr('id');
					var index = id.substring(17);
					removeQuestion(index);
	             });
          }
        }
       function removeQuestion(index){
    	   var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
           if(!conf)
               return false;
    	   $('#questionContainer' +　index).fadeOut().remove();
    	   avail_question_index.push (index);
       }

       function addGreeting()
       {
         var index  = $('div.greetingRow').length;
        
             if(avail_greeting_index.length)
             {
           	  index = avail_greeting_index[0];
           	avail_greeting_index.splice(0, 1);
             }
         if(index < 10)
         { 
	          $("#greetingTemplate").clone().removeClass('hidden').attr('id','greetingContainer' +　index ).insertAfter("div.greetingRow:last");
	          $("div.greetingRow:last").find('input').attr('name','greeting' +　index).attr('id','greeting' +　index );
	          $('#greetingContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.greetingRow').attr('id');
					var index = id.substring(17);
					removeGreeting(index);
	             });
         }
       }
      function removeGreeting(index){
    	  var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
          if(!conf)
              return false;
   	   $('#greetingContainer' +　index).fadeOut().remove();
   	   avail_greeting_index.push (index);
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