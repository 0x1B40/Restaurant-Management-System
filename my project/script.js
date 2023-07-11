


document.getElementById('searchButton').addEventListener('click',function(){


  var model = document.getElementById('model');
  var brand = document.getElementById('brand');
  var price = document.getElementById('price');

  if((model.value!="Model" && brand.value!="Brand") && price.value!="Price Range")
  {
var retrievedModel = model.value;
var retrievedBrand = brand.value;
var retrievedPrice = price.value;
alert(retrievedModel);
alert(retrievedBrand);
alert(retrievedPrice);
  }

});
