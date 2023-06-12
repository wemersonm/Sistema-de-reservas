function showImg() {
  const formCar = document.querySelector("#form-car");
  const fileCar = formCar.querySelector("[name='fileCar']");
  const showImageCar = formCar.querySelector(".show-image-car img");
  const typeAllowed = ["image/jpg", "image/jpeg", "image/png"];

  const fileImg = fileCar.files[0];
  if (typeAllowed.includes(fileImg.type)) {
    const fileReader = new FileReader();
    fileReader.addEventListener("load", (e) => {
      showImageCar.src = fileReader.result;
    });
    showImageCar.style.display = "block";
    formCar.querySelector("#errorValidationFileImg").innerHTML = "";
    fileReader.readAsDataURL(fileImg);
  } else {
    formCar.querySelector("#errorValidationFileImg").innerHTML =
      "Formato de imagem invalido";
    showImageCar.style.display = "none";
  }
}
