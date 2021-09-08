let menuShown = true

$("#navigator").click(function(){
    if(menuShown){
console.log("should hide");
        hideMenu()
    }else{
console.log("should show");
        showMenu()
    }
})
hideMenu = _=>{
    console.log('Hide Menu');
    $(".content").css("margin-left","0px");
    $(".menu").hide();
    $("#hideMenu").hide();
    $("#showMenu").show();
    $("#mynavigatorIcon").addClass("icon-chevron-right")    
    $("#mynavigatorIcon").removeClass("icon-chevron-left")
    menuShown = false
}
showMenu = _=>{
    console.log('Show Menu');
    $(".content").css("margin-left","240px");
    $(".menu").show();
    $("#showMenu").hide();
    $("#hideMenu").show();
    $("#mynavigatorIcon").addClass("icon-chevron-left")    
    $("#mynavigatorIcon").removeClass("icon-chevron-right")
    menuShown = true
}
