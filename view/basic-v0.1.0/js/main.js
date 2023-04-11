function paginacaoInfinita(){
	$('#links').jscroll({
		pagingSelector:'.paging',
		loadingHtml: '<div class="text-center"><img src="/img/loading.gif" alt="Carregando..." /></div>',		
		nextSelector: '.next:last',
		callback:function(){

		},
		debug:true
	});
}

$(function(){
	// paginação infinita
	paginacaoInfinita();

	// pjax
	var containerSel='#pjax-container';
	var pjaxOpts={
		fragment: containerSel,
		timeout: 10000,
	};
	$(document).pjax('a', containerSel, pjaxOpts);
	var proBarOpts={
		color   : "white",
		bgColor : "white", 
		finishAnimation : true,
		speed   : 0.5,
		wrapper : "body", 
	};	
	var probar = new ProBar(proBarOpts);		
	$(document).on('pjax:send', function() {
		$(containerSel).LoadingOverlay("show");
		probar.setColor("black");			
		probar.setWrapperColor("#ecf0f1");		
		probar.goto(33);

	});
	$(document).on('pjax:timeout', function(event) {
		probar.goto(66);	  
		event.preventDefault();
	});	
	$(document).on('pjax:complete', function() {	
		$(containerSel).LoadingOverlay("hide");
		probar.goto(100);
	});	
	$(document).on('pjax:end', function() {	
		paginacaoInfinita();
	});		
});
