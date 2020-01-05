
;(function(){
	
	//request index for list latest 50 posts;
	
	$.ajax({
		url:api.host + 'index.php',
		type:"get",
		data:{
			'maxpostsnum':50
		},
		cache:true,
		success:function(data){
			
			var  posts= JSON.parse(data);
			
			var tmplate = "";
			for(var i=0;i<posts.length;i++){
				
				var id = posts[i].id;
				var time = posts[i].time;
				var nickname = posts[i].nickname;
				var textcontent = posts[i].textcontent;
				
				tmplate = "<li data-id=\""+id+"\"><div><span class=\"nickname\">"+
				nickname+"</span><span class=\"time\">"+time+"</span></div><div class=\"textcontent\">"+textcontent+"</div></li>";
				
				$("#postslist ul").prepend(tmplate);
			}
		},
		error:function(xhr){
			
		}
	});
	
	$("#menu").on({
//		touchend:function(){
//			$(this).toggleClass("showed");
//			console.log('touchend');
//		},
	
		click:function(){
			$(this).addClass("showed");
			$(".ops").fadeIn(2000);
		}
		
	})
	
	
	
	$(".ops span").first().on({
		click:function(){
			$(".panel").show();
		}
	});
	
	
	$("#shadow").click(function(){
		shou();
	});
	function shou(){
		$(".panel").hide();
		$("#menu").removeClass("showed");
		$(".ops").fadeOut(1000);
	}
	
	
	//make a new post; must add a password for protexct;
	$(".submit").click(function(){
		
		var purl = api.host + 'newpost.php';
		
		var textcontent = $("#context").text();
		var nickname = $("#addform input.nickname").val();
		if(textcontent=='' || nickname==''){
			alert("para is error");
			return;
		}
		
		var pdata = {
			'data':{
				'nickname':nickname,
				'uploadedpicurl':"",
				'netimageurl':"",
				'textcontent':textcontent
			},
			'op':'add'
		};
		
		$.ajax({
			url:purl,
			type:"post",
			data:pdata,
			success:function(data){
				
				var  posts= JSON.parse(data);
				
				var id = posts._id;
				var time = posts.time;
				var nickname = posts.nickname;
				var textcontent = posts.textcontent;
				
				var tmplate = "<li data-id=\""+id+"\"><div><span class=\"nickname\">"+
				nickname+"</span><span class=\"time\">"+time+"</span></div><div class=\"textcontent\">"+textcontent+"</div></li>";
					
				$("#postslist ul").prepend(tmplate);
				shou();
				
			},
			error:function(xhr){
				
			}
		});
		
	});



	//custom-content-scroller plugin.
	$(window).on("load",function(){
        $(".content").mCustomScrollbar();
    });
	
})(jQuery);





