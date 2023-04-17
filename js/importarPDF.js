const imprimir = document.querySelector("#imprimir");

const formCharacterProfile = document.querySelector("#pdf");
const handleOnSubmitForm = (e) => {
  e.preventDefault();
  const characterProperties = Array.from(e.target.querySelectorAll("[name]"));
  const characterData = {};
  for (let i = 0; i < characterProperties.length; i++) {
    const field = characterProperties[i];
    const attribute = field.getAttribute("name");
    const value = field.value;
    characterData[attribute] = value;
  }
  generatePDF(characterData);
};

// Generar el PDF
const generatePDF = (characterData) => {
  const doc = new jsPDF();
  doc.setFontSize(40);
  doc.setFont("helvetica", "bold");
  doc.text(characterData.nombre, 60, 30);
  doc.setFont("helvetica", "normal");
  doc.text(characterData.mail, 60, 42);
  doc.text(characterData.motivo, 60, 54);
  doc.text(characterData.reclamo, 60, 68);
  doc.save(`${characterData.nombre}-${characterData.mail}-${characterData.motivo}`);
};

formCharacterProfile.addEventListener("submit", handleOnSubmitForm);