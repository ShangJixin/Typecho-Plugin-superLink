$(".JixinParser-card .JixinParser-card-meta span.fold").click(function(){
    if ($(this).parent().next().children().length > 0 ) {
        $(this).parent().next().empty();
    } else {
        $(this).parent().next().append('<iframe src="'+ $(this).parent().parent().attr('data-src') +'" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>');
    }
});

function JixinParser_Github(iframe) {
    $(".JixinParser-card[data-src=\'"+iframe+"\'] .iframe-container").attr("style","padding: 3px 10px;font-size: 13px;");
    $.ajax({
        url: iframe,
        type: "get",
        success: function(data){
        
            //console.log(data);
            $(".JixinParser-card[data-src=\'"+iframe+"\'] .iframe-container").empty();
            $(".JixinParser-card[data-src=\'"+iframe+"\'] .iframe-container").append(`
                ${data.description != null ? data.description : ""}<br>
                ${data.homepage != null ? data.homepage : ""}<br><br>
                <span style="color:#666">Star: ${data.stargazers_count}</span>&nbsp;&nbsp;
                <span style="color:#666">Fork: ${data.forks_count}</span>&nbsp;&nbsp;
                <span style="color:#666">Lang: ${data.language}</span>&nbsp;&nbsp;
                <span style="color:#666">Branch: ${data.default_branch}</span>&nbsp;&nbsp;
            `);

        },
        error: function(){
            $(".JixinParser-card[data-src=\'"+iframe+"\'] .iframe-container").append("Ajax Request Failed!");
        }
    });
}
