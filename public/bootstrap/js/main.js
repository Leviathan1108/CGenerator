document.addEventListener("DOMContentLoaded", function () {
    const customBgCard = document.getElementById("custom-bg-card");
    const templateCard = document.getElementById("template-card");
  
    customBgCard.addEventListener("click", function () {
      goToStep(3); // menuju Upload Background (Custom)
    });
  
    templateCard.addEventListener("click", function () {
      goToStep(2); // menuju Select Template
    });
  });
  