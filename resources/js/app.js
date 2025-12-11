import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const leaves = document.getElementById("leaves");

    for (let i = 0; i < 20; i++) {
        const leaf = document.createElement("div");
        leaf.classList.add("leaf");
        leaf.style.left = `${Math.random() * 100}%`;
        leaf.style.animationDuration = `${5 + Math.random() * 5}s`;
        leaf.style.animationDelay = `${Math.random() * 5}s`;
        leaves.appendChild(leaf);
    }
});
