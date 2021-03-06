Coming soon
<div class="container-fluid hidden">
		<div class='subnav'>
			<ul class="nav navbar nav-pills">
			  <li role="presentation" class="create"><a href="<?php echo $this->config->item('base_url');?>price/create/"><?php echo $this->lang->line('createprice'); ?></a></li>
			</ul>
		</div>
	    <div class='product-list'>
	    <?php 
	    if(isset($error)){
	    	//var_dump($error);
	    }
	    else{ foreach($items as $product):?>
	       <div class="panel panel-warning">
	            <div class="panel-heading"><?php echo $product['name']?></div>
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class=" col-md-4 col-sm-4 col-xs-4">
				    	<img style='max-width:100%' src="<?php echo isset($product['img']) ?
				    	 $this->config->item( 'cdn_url_upload_img') .'product/' .  $product['img'] 
				    	: '';?>"></div>
				    	<div class=" col-md-8 col-sm-8 col-xs-8 ">
					    	  <div class = 'row price'>
						    	  	<div class=" col-md-2 col-sm-3 col-xs-4">
						    	  		<span class="label label-primary">
						    	  			<span class="glyphicon glyphicon-usd"></span>价格
						    	  		</span>
						    	  	</div>
					    			<div class=" col-md-10 col-sm-9 col-xs-8 ">
					    				<?php echo $product['price']?>
					    			</div>
					    	  </div>
					    	  <div class = 'row address'>
						    	  	<div class=" col-md-2 col-sm-3 col-xs-4">
						    	  		<span class="label label-primary">
						    	  			<span class="glyphicon glyphicon-road"></span>产地
						    	  		</span>
						    	  	</div>
					    			<div class=" col-md-10 col-sm-9 col-xs-8 ">
					    				<?php echo isset($product['address']) ? $product['address'] : ''; ?>
					    			</div>
					    	  </div>
					    	  <div class = 'row tag'>
						    	  	<div class=" col-md-2 col-sm-3 col-xs-4">
						    	  		<span class="label label-primary">
						    	  			<span class="glyphicon glyphicon-tag"></span>标签
						    	  		</span>
						    	  	</div>
					    			<div class=" col-md-10 col-sm-9 col-xs-8 ">
					    				<?php echo isset($product['tag']) ? $product['tag'] : '';?>
					    			</div>
					    	  </div>
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer">
 		   			<a href = 'product/update/id/<?php echo $product['id'] ;?>'  class="btn btn-success btn-mini"><i class="icon-white icon-pencil"></i> <?php echo $this->lang->line('edit') ; ?> </a>
 		   		</div>
	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
