$(function () {
    $('#links').jscroll({
    	loadingHtml: '<center><img src="/img/loading.gif" alt="Carregando" /></center>',    	
        pagingSelector:'.paging',
        nextSelector: '.next:last',
        callback:function(){

        },
        debug:true
    });
});