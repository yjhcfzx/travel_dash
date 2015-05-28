var current_page = default_page = 'bussiness';

function move(ele,selector,dir){
    var target;
    var me = $(ele).parents(selector);
    if(dir == 'up')
    {
 	   target = me.prev(selector + ':visible').find('input');
        }
    else{
 	   target = me.next(selector + ':visible').find('input');
    }
    if(!target.length)
    {  
        return;
    }
   var target_val = target.val();
   var my_val = me.find('input').val();
   me.find('input').val(target_val);
   target.val(my_val);
}

function moveItem(ele,selector,dir,callback){
    var target;
    var me = $(ele).parents(selector);
    var idStr = me.attr('id');
    var idStrArr = idStr.split('-');
    var id = idStrArr[1];
    if(dir == 'up')
    {
 	   target = me.prev(selector + ':visible');
 	   if( target.length ){
 		   me.insertBefore(target);
 		   callback(id, 'add');
 	   }

    }
    else{
 	   target = me.next(selector + ':visible');
 	  if( target.length ){
 		  me.insertAfter(target);
 		 callback(id, 'reduce');
 	  }
    }
    if(!target.length)
    {  
        return;
    }
   var target_val = target.val();
   var my_val = me.find('input').val();
   me.find('input').val(target_val);
   target.val(my_val);
}

$(document).ready(function(){
	
	var current_page = getHash() || default_page;
	
	/*$('#nav-item-' + current_page).addClass('active');
	var docHeight = $(document).height();
	$('.page-section').css('min-height', docHeight + 'px');*/
	
	
	/*$('.nav li.nav-item').click(function(){
		var prev_page = current_page;
		var hash = $(this).find('a').attr('href').substring(1);
		$('#nav-item-' + current_page).removeClass('active');
		//$('#' + current_page + '-content').fadeOut();
		current_page = hash;
		$('#nav-item-' + current_page).addClass('active');
		$('#' + current_page + '-content').hide().fadeIn();
		
		var page_diff = Math.abs(prev_page - current_page);
		
		var time_diff = 800*0;
		
		//$('html body').animate({ scrollTop: 580 }, 800);
		$('html body').animate({ scrollTop: $('#' + current_page + '-content').offset().top - 50 }, time_diff);
	});*/
	//alert($('.nav li.nav-item.active').attr('id'));
	//$('.nav li.nav-item.active').trigger('click');
	
});