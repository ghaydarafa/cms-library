import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
var themeToggleBtn = document.getElementById("theme-toggle");

function setTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add("dark");
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        localStorage.setItem("color-theme", "dark");
        themeToggleLightIcon.classList.remove("hidden");
        themeToggleDarkIcon.classList.add("hidden");
    } else {
        document.documentElement.classList.remove("dark");
        document.documentElement.setAttribute('data-bs-theme', 'light');
        localStorage.setItem("color-theme", "light");
        themeToggleDarkIcon.classList.remove("hidden");
        themeToggleLightIcon.classList.add("hidden");
    }
}

if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    setTheme('dark');
} else {
    setTheme('light');
}

themeToggleBtn.addEventListener("click", function () {
    if (localStorage.getItem("color-theme") === "light") {
        setTheme('dark');
    } else {
        setTheme('light');
    }
});
