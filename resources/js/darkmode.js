document.addEventListener("DOMContentLoaded", function () {
    const darkModeTrigger = document.getElementById("js-dark-mode-trigger");
    const htmlElement = document.documentElement;

    // Cek preferensi tema yang disimpan di localStorage
    if (localStorage.getItem("theme") === "dark") {
        htmlElement.classList.add("dark");
    }

    // Tambahkan event listener untuk tombol dark mode
    darkModeTrigger.addEventListener("click", function (e) {
        e.preventDefault();
        if (htmlElement.classList.contains("dark")) {
            htmlElement.classList.remove("dark");
            localStorage.setItem("theme", "light"); // Simpan preferensi tema
        } else {
            htmlElement.classList.add("dark");
            localStorage.setItem("theme", "dark"); // Simpan preferensi tema
        }
    });
});
