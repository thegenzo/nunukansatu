let data = [];
const loadingSpinner = document.querySelector(".loading-screen");
window.onload = async function () {
    // Show the loading spinner
    loadingSpinner.style.display = "block";

    fetch("https://admin.nunukankab.go.id/api/v1/urusan-cat/random")
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            displayData(data.data.datasetUrusan);
            displayData2(data.data.datasetOpd);
            // Hide the loading spinner
            loadingSpinner.style.display = "none";
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );

            // Hide the loading spinner in case of error
            loadingSpinner.style.display = "none";
        });
};

function displayData(dataToDisplay) {
    // Select the urusan-data element
    let urusanData = document.querySelector("#urusanShow");
    let showDataset = document.querySelector("#showDataset");

    // Clear the urusan-data before displaying new data
    urusanData.innerHTML = "";

    // Display the data
    dataToDisplay.forEach((item, index) => {
        let div = document.createElement("div");
        div.className = "accordion-item";
        div.innerHTML = `
      <h2>${item.urusan}</h2>
      <div class="accordion-content">
        <p>
            ${item.desc ? item.desc : "Tidak ada deskripsi"}
        </p>
        <a
          class="btn"
          href="https://developer.mozilla.org/en-US/docs/Web/HTML"
          >Read more about HTML</a
        >
      </div>
    `;

        // Add click event listener to the div
        div.addEventListener("click", () => {
            let url =
                "https://kibana-view.nunukankab.go.id/app/dashboards#/view/e49c6c41-8ac4-4ee9-9564-5363538ce124?embed=true&_g=(refreshInterval%3A(pause%3A!t%2Cvalue%3A60000)%2Ctime%3A(from%3Anow-5y%2Cto%3Anow))&&_a=(query:(language:kuery,query:'bidang.keyword :\"" +
                item.urusan +
                "\"'))&hide-filter-bar=true";
            showDataset.src = url;
            console.log(url);
            document.querySelectorAll(".accordion-item").forEach((item) => {
                item.classList.remove("active");
                div.classList.add("active");
            });
            // Replace item.url with the url you want to load in the iframe
        });

        urusanData.appendChild(div);
    });

    // Set the src of the iframe to the url of the first item
    if (dataToDisplay.length > 0) {
        let firstItem = dataToDisplay[0];
        document.querySelector(".accordion-item").classList.add("active");
        let url =
            "https://kibana-view.nunukankab.go.id/app/dashboards#/view/e49c6c41-8ac4-4ee9-9564-5363538ce124?embed=true&_g=(refreshInterval%3A(pause%3A!t%2Cvalue%3A60000)%2Ctime%3A(from%3Anow-5y%2Cto%3Anow))&&_a=(query:(language:kuery,query:'bidang.keyword :\"" +
            firstItem.urusan +
            "\"'))&hide-filter-bar=true";
        showDataset.src = url;
    }

    fetch("https://admin.nunukankab.go.id/api/v1/urusan-cat/random")
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            document.getElementById("opd").innerHTML = data.data.opd;
            document.getElementById("urusan").innerHTML = data.data.urusan;
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });
}

function displayData2(dataToDisplay2) {
    // Select the urusan-data element
    let urusanData = document.querySelector("#opdShow");
    let showDataset = document.querySelector("#showDataset2");

    // Clear the urusan-data before displaying new data
    urusanData.innerHTML = "";

    // Display the data
    dataToDisplay2.forEach((item, index) => {
        let div = document.createElement("div");
        div.className = "accordion-item";
        div.innerHTML = `
      <h2>${item.dinas}</h2>
      <div class="accordion-content">
        <p>
            ${item.desc ? item.desc : "Tidak ada deskripsi"}
        </p>
        <a
          class="btn"
          href="https://developer.mozilla.org/en-US/docs/Web/HTML"
          >Read more about HTML</a
        >
      </div>
    `;

        // Add click event listener to the div
        div.addEventListener("click", () => {
            let url =
                "https://kibana-view.nunukankab.go.id/app/dashboards#/view/e49c6c41-8ac4-4ee9-9564-5363538ce124?embed=true&_g=(refreshInterval%3A(pause%3A!t%2Cvalue%3A60000)%2Ctime%3A(from%3Anow-5y%2Cto%3Anow))&&_a=(query:(language:kuery,query:'bidang.keyword :\"" +
                item.dinas +
                "\"'))&hide-filter-bar=true";
            showDataset.src = url;
            console.log(url);
            document.querySelectorAll(".accordion-item").forEach((item) => {
                item.classList.remove("active");
                div.classList.add("active");
            });
            // Replace item.url with the url you want to load in the iframe
        });

        urusanData.appendChild(div);
    });

    // Set the src of the iframe to the url of the first item
    if (dataToDisplay2.length > 0) {
        let firstItem = dataToDisplay2[0];
        document.querySelector(".accordion-item").classList.add("active");
        let url =
            "https://kibana-view.nunukankab.go.id/app/dashboards#/view/e49c6c41-8ac4-4ee9-9564-5363538ce124?embed=true&_g=(refreshInterval%3A(pause%3A!t%2Cvalue%3A60000)%2Ctime%3A(from%3Anow-5y%2Cto%3Anow))&&_a=(query:(language:kuery,query:'bidang.keyword :\"" +
            firstItem.dinas +
            "\"'))&hide-filter-bar=true";
        showDataset.src = url;
    }
}
