// Get the search input and button elements
const searchInputData = document.querySelector(".search-input");
const searchButton = document.querySelector(".search-btn"); // Replace with your actual search button selector
const row = document.querySelector(".row"); // Replace with your actual row selector
let data = [];
const loadingSpinner = document.querySelector(".loading-screen");
// Fetch and display all data when the page loads
window.onload = async function () {
    try {
        const response = await fetch(
            "https://admin-mall.nunukankab.go.id/api/opd"
        ); // Replace with your API endpoint
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        data = await response.json();
        displayData(data.data);
    } catch (error) {
        console.error(error);
    } finally {
        loadingSpinner.style.display = "none";
    }
};

// Function to display data
function displayData(dataToDisplay) {
    // Get the row element
    const row = document.querySelector("#row");

    // Clear the row before displaying new data
    row.innerHTML = "";

    // Display the data
    dataToDisplay.forEach((item) => {
        const card = document.createElement("div");
        card.classList.add("col-lg-4");

        // Add the data-id attribute to the card
        card.setAttribute("data-id", item.id);

        card.innerHTML = `
      <a href="" 
      data-bs-toggle="modal"
     data-bs-target="#exampleModal">
        <div class="card mb-4">
          <div class="card-body">
            <img
                src="${
                    item.image &&
                    item.image !== "" &&
                    item.image !== "https://admin.nunukankab.go.id/images"
                        ? item.image
                        : "/assets/logos/items-datas.svg"
                }"
              alt="Mall Data"
              width="auto"
              height="100px"
              class="mb-4 card-image"
              style="left: 0; right: 0; margin: auto; display: block"
            />

            <p class="card-text text-center">${item.dinas}</p>
          </div>
        </div>
      </a>
    `;

        row.appendChild(card);

        // Add click event listener to the card
        // card.addEventListener("click", handleCardClick);
    });
}

// Function to handle card click
// function handleCardClick(event) {
//     // Prevent the default link click action
//     event.preventDefault();
//     localStorage.removeItem("selectedItem");
//     // get the selected item
//     const selectedItem = event.currentTarget.getAttribute("data-id");

//     // Find the selected item from the data array
//     const dataDetail = data.data.find((item) => item.id == selectedItem);

//     // Save the item data to localStorage
//     localStorage.setItem("selectedItem", JSON.stringify(dataDetail));
//     localStorage.setItem("type", JSON.stringify("pemerintahan"));

//     // Navigate to the detail page
//     window.location.href = "/mall-data/detail";
// }

function performSearch() {
    const searchValue = searchInputData.value.toLowerCase();

    // Filter the data based on the search input
    const filteredData = data.data.filter((item) =>
        item.dinas.toLowerCase().includes(searchValue)
    );

    // Display the filtered data
    displayData(filteredData);
}

searchButton.addEventListener("click", function () {
    performSearch();
});

searchInputData.addEventListener("keyup", function (event) {
    if (event.keyCode === 13) {
        performSearch();
    }
});
