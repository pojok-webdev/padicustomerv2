saveSites = function(){
    console.log('Save Sites invoked');
}
saveRequest = function(){
    console.log('Save Requests invoked');
    return {
        saveSites: saveSites
    }
}
install = function(opt){
    console.log('install invoked'+opt.name);
    return {
        saveRequest:saveRequest
    }
}

install({name:'abc'})
.saveRequest()
.saveSites()