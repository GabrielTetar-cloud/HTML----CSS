function openModal(pizza) {
  var txt1 = document.getElementById("txt1");
  var txt2 = document.getElementById("txt2");


  switch (pizza) {
    case "RemedioButton1":
      txt1.innerHTML = "Remedio para gripe";
      txt2.innerHTML = "Cura gripe";
    
      break;

    case "RemedioButton2":
      txt1.innerHTML = "Remedio para sarampo";
      txt2.innerHTML = "Cura sarampo";
    
      break;
    case "RemedioButton3":
      txt1.innerHTML = "Remedio para alegia";
      txt2.innerHTML = "Cura alergia";
    
      break;
    case "RemedioButton4":
      txt1.innerHTML = "Remedio para cataporra";
      txt2.innerHTML = "Cura cataporra";
    
      break;
    case "RemedioButton5":
      txt1.innerHTML = "Remedio pneumonia";
      txt2.innerHTML = "Cura pneumonia";
    
      break;
     case "RemedioButton1":
      txt1.innerHTML = "Remedio para dor articular";
      txt2.innerHTML = "Reduz dor articular";
    
      break;
  }

  document.getElementById("knowMore").style.display = "inline-block";
}