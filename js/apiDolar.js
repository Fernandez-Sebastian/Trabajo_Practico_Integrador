document.querySelector("#oficial").addEventListener("click", function () {
  obtenerDatos("Oficial");
});
document.querySelector("#blue").addEventListener("click", function () {
  obtenerDatos("Blue");
});

function obtenerDatos(valor) {
  let url = "https://www.dolarsi.com/api/api.php?type=dolar";
  const api = new XMLHttpRequest();
  api.open("GET", url, true);
  api.send();

  api.onreadystatechange = function () {
    if (this.status == 200 && this.readyState == 4) {
      let datos = JSON.parse(this.responseText);
      let resultado = document.querySelector("#resultado");
      resultado.innerHTML = "";
      for (let item of datos) {
        if (item.casa.nombre === valor) {
          resultado.innerHTML = `<div>Precio Venta:  ${item.casa.venta} Precio Compra:  ${item.casa.compra}</div>`;
        }
      }
    }
  };
}
