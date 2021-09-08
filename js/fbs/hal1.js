(function($){
    console.log('test');
    $.ajax({
        url:'/dataprovider/getfb/1',
        dataType:'json',
        "headers": {
            "accept": "application/json",
            "Access-Control-Allow-Origin":"*"
        }
    })
    .done(function(res){
        console.log('Res',res);
    })
    .fail(function(err){
        console.log('err',err);
    });
}(jQuery))