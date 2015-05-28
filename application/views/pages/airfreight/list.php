
<div class="container-fluid ">
		<div class='subnav'>
			<ul class="nav navbar nav-pills">
			  <li role="presentation" class="create"><a href="<?php echo $this->config->item('base_url') , $router;?>/create/"><?php echo $this->lang->line('create'),$this->lang->line($router); ?></a></li>
			</ul>
		</div>
	    <div class='product-list'>
	    <?php 
	    if(isset($error)){
	    	//var_dump($error);
	    }
	    else{ foreach($items as $item):?>
	       <div class="panel panel-warning item-row" id = "item-<?php echo $item['id'];?>">
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
				    		<p><?php echo $item['name']?></p>
				    	</div>
				    	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
						    		<a href = '<?php echo $this->config->item('base_url'), $router;?>/update/id/<?php echo $item['id'] ;?>'  class="btn btn-success btn-mini"><i class="icon-white icon-pencil"></i> <?php echo $this->lang->line('edit') ; ?> </a>  	
				    	 			<button type='button' class="btn btn-danger btn-mini" onclick="javascript:removeItem(<?php echo $item['id'];?>);"><i class="icon-white icon-remove"></i>
          		 						<?php echo $this->lang->line('delete') ; ?> 
          		 					</button>
          		 					<button type='button' class="btn btn-success btn-large" onclick="javascript:moveItem(this,'.item-row','up',changeWeight)"><i class="icon-white icon-arrow-up"></i><?php echo $this->lang->line('move_up')?></button>
         							<button type='button' class="btn btn-success btn-large" onclick="javascript:moveItem(this,'.item-row','down',changeWeight)"><i class="icon-white icon-arrow-down"></i><?php echo $this->lang->line('move_down')?></button>
        
				    	</div>
				    </div>
				</div>

	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
<script>
function changeWeight(id,action){
	 $.ajax({
			url: "ajax",
			type: "POST",
			data: { 'url':'<?php echo $router;?>/weight/id/' + id + '/format/json' ,
				'method': 'put',
				'request':{'action':action}},
			dataType: "json"
			}).done(function(data){
					if(data)
					{
					
					}
				});
}
	    function removeItem(id){
			var yes = confirm("Are you sure you want to delete?");
			if(!yes)
			{
 				return false;
			}
		    $.ajax({
				url: "ajax",
				type: "POST",
				data: { 'url':'<?php echo $router;?>/detail/id/' + id + '/format/json' ,
					'method': 'delete'},
				dataType: "json"
				}).done(function(data){
					if(data)
					{
						$('#item-' + data).fadeOut().remove();
						}
					});
	    }
</script>