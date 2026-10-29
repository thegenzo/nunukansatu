const loadingSpinner = document.querySelector(".loading-screen");
const selectedItem = JSON.parse(localStorage.getItem("selectedItem"));
const tahun = selectedItem.tahun;
const desc = selectedItem.desc;
const title = selectedItem.title;
const datasShow = document.querySelector(".elastic-show");
const titleShow = document.querySelector(".title-show");

const cardDesc = document.querySelector(".desc-card");
const descShow = document.querySelector(".desc-show");
const tahunShow = document.querySelector(".tahun-show");

try {
  // get selectedItem from local storage and parse it into an object
  const type = JSON.parse(localStorage.getItem("type"));
  const dinas = selectedItem.dinas;
  const urusan = selectedItem.urusan;

  let urusanDatas, dinasDatas;

  if (selectedItem && typeof selectedItem.urusan === "string") {
    urusanDatas = selectedItem.urusan
      .replace(/\(/g, "\\(")
      .replace(/\)/g, "\\)");
  }

  if (selectedItem && typeof selectedItem.dinas === "string") {
    dinasDatas = selectedItem.dinas.replace(/\(/g, "\\(").replace(/\)/g, "\\)");
  }
  let result =
    type === "pemerintahan"
      ? dinasDatas
      : type === "urusan"
      ? urusanDatas
      : "none";
  const src = `https://kibana-view.nunukankab.go.id/app/dashboards#/view/e49c6c41-8ac4-4ee9-9564-5363538ce124?embed=true&_g=(refreshInterval%3A(pause%3A!t%2Cvalue%3A60000)%2Ctime%3A(from%3Anow-5y%2Cto%3Anow))&&_a=(query:(language:kuery,query:'bidang.keyword :${result}'))&hide-filter-bar=true`;
  //get all data from local storage
  console.log(src);
  const datasShow = document.querySelector(".elastic-show");

  // inner iframes to datas-show
  datasShow.innerHTML = `
        <iframe
        src="${src}"
        height="450px"
        width="100%"
        ></iframe>
        `;

  titleShow.innerHTML = `
          <h1 class="align-items-center">
             ${type === "pemerintahan" ? dinas : urusan}
          </h1>
        `;

  cardDesc.style.display = desc ? "block" : "none";
  descShow.innerHTML = `
          <p>
            ${desc ? desc : "Tidak ada deskripsi"}
          </p>
        `;

  tahunShow.style.display = tahun ? "block" : "none";
  tahunShow.innerHTML = `
      <h5 class="card-title text-center">${title} : ${tahun}</h5>
      `;
} catch (error) {
  // window.location.href = "index.html";
  console.log(error);
} finally {
  loadingSpinner.style.display = "none";
}
