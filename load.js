function loadPage(page) {
  fetch(page)
      .then((response) => response.text())
      .then((html) => {
          document.getElementById("content").innerHTML = html;
      })
      .catch((error) => console.error("Error:", error));
}

// Muat halaman default saat halaman pertama dimuat
window.onload = function () {
  loadPage("home.php");
};