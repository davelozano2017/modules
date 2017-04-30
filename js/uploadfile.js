 function getFile(){
   document.getElementById("file").click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("file").innerHTML = fileName[fileName.length-1];
    document.changeprofile.submit();
    event.preventDefault();
  }
