var uploadField = document.getElementById("cover_image");

uploadField.onchange = function() {
    if(this.files[0].size > 2200000){
        alert("File is too big!");
        this.value = "";
    };

    {
 var id_value = document.getElementById('cover_image').value;

 if(id_value != '')
 {
  var valid_extensions = /(.jpg|.jpeg|.gif|.png)$/i;
  if(!valid_extensions.test(id_value))
  {
      alert('Invalid File! Please upload an image file.')
      document.getElementById('cover_image').value = "";
  }else{
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }

 }
}

};
