document.addEventListener("DOMContentLoaded", function () {
    const customBgCard = document.getElementById("custom-bg-card");
    const templateCard = document.getElementById("template-card");
  
    customBgCard.addEventListener("click", function () {
      goToStep(2); // menuju Upload Background (Custom)
    });
  
    templateCard.addEventListener("click", function () {
      goToStep(2); // menuju Select Template
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("customBg");
    const preview = document.getElementById("file-preview");
  
    if (dropArea) {
      // Prevent default behavior (Prevent file from being opened)
      ["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
        dropArea.addEventListener(eventName, e => e.preventDefault(), false);
        dropArea.addEventListener(eventName, e => e.stopPropagation(), false);
      });
  
      dropArea.addEventListener("dragover", () => {
        dropArea.classList.add("border-blue-500");
      });
  
      dropArea.addEventListener("dragleave", () => {
        dropArea.classList.remove("border-blue-500");
      });
  
      dropArea.addEventListener("drop", (e) => {
        const files = e.dataTransfer.files;
        if (files.length) {
          fileInput.files = files;
          showPreview(files[0]);
          autoProceedAfterUpload(); // Tambahkan ini
        }
        dropArea.classList.remove("border-blue-500");
      });
      
  
      fileInput.addEventListener("change", () => {
        if (fileInput.files.length) {
          showPreview(fileInput.files[0]);
          autoProceedAfterUpload(); // Tambahkan ini
        }
      });
      
  
      function showPreview(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="mx-auto mt-2 max-h-48 rounded shadow" />`;
        };
        reader.readAsDataURL(file);
      }
    }
  });
  function autoProceedAfterUpload() {
    // Pastikan ada file yang dipilih sebelum lanjut
    const fileInput = document.getElementById("customBg");
    if (fileInput && fileInput.files.length > 0) {
      validateCustomUpload(); // Fungsi ini bisa lanjut ke step berikutnya
    }
  }
  function validateCustomUpload() {
    const fileInput = document.getElementById("customBg");
  
    if (!fileInput || fileInput.files.length === 0) {
      alert("Silakan upload background terlebih dahulu.");
      return;
    }
  
    // Jika sudah ada file, lanjut ke step berikutnya (misalnya step 4)
    goToStep(3);
  }
  