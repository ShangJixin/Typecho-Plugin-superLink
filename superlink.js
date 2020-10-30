$(".JixinParser-card .JixinParser-card-meta span.fold").click(function(){
    if ($(this).parent().next().children().length > 0 ) {
        $(this).parent().next().empty();
    } else {
        $(this).parent().next().append('<iframe src="'+ $(this).parent().parent().attr('data-src') +'" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>');
    }
});
