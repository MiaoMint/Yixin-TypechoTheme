<script>


$(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax])', {
  container: '.pjax',//DIV容器的ID
  fragment: '.pjax',//作为整个pjax框架，必须写上
  timeout: 8000 //超时就会被迫页面就会完全刷新，单位毫秒
})

$(document).on('pjax:start', function() { NProgress.start(); });
$(document).on('pjax:end',   function() { NProgress.done();ajaxcomment(); });



         // 当网页向下滑动 20px 出现"返回顶部" 按钮
          window.onscroll = function() {scrollFunction()};
          
          function scrollFunction() {
               if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    $('#top').css('display','block');
               } else {
                    $('#top').css('display','none');
               }
          }
       $('#top').click(function(){$('html,body').animate({scrollTop: '0px'}, 10);});

function ajaxcomment(options){ //AJAX评论

	$('#comment-form').submit(function(){
		var commentdata=$(this).serializeArray();
		$.ajax({
			url:$(this).attr('action'),
			type:$(this).attr('method'),
			data:commentdata,
			beforeSend:function() {$('#commentsumbit').css('display','none');$('#loading').css('display','block');},
			error:function() {
			    $('#comments-error').css('display','block');
			    $('#loading').css('display','none');
        		$('#commentsumbit').css('display','block');},
			success:function(data){
		
				var error=/<title>Error<\/title>/;
				if (error.test(data)){
					var text=data.match(/<div(.*?)>(.*?)<\/div>/is);
					var str='发生了未知错误';if (text!=null) str=text[2];
					$('#comments-error').css('display','block');
					x=document.getElementById("comments-error");
					x.innerHTML=str;
        			$('#loading').css('display','none');
        			$('#commentsumbit').css('display','block');
				} else {
					$('#commenttextarea').val('');$('#commenttextarea').css('height','');
					if ($('#cancel-comment-reply-link').css('display')!='none') $('#cancel-comment-reply-link').click();
					var target='#comments',parent=true,latest=-19260817;
					$.each(commentdata,function(i,field) {if (field.name=='parent') parent=false;});
					if (!parent || !$('div.page-navigator .prev').length){
						$('#comments .mdui-panel',data).each(function(){
							var id=$(this).attr('id'),coid=parseInt(id.substring(8));
							if (coid>latest) {latest=coid;target='#'+id;}
						});
					}
					$('#recentcomment').html($('#recentcomment',data).html());
					$('#commentsnumber').html($('#commentsnumber',data).html());
					$('#commentcontent').html($('#commentcontent',data).html());
    				$('#commentsumbit').css('display','block');
				    $('#loading').css('display','none');
				    $('#comments-error').css('display','none');
					$('html,body').animate({scrollTop:$(target).offset().top},'fast');
				
				}
			}
		});
		return false;
	});
}
ajaxcomment();

</script>