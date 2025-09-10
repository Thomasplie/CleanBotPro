window.addEventListener('load', init);

function init() {
    const startBtn = document.getElementById("startBtn");
    const progressEl = document.getElementById("progressFill");
    const statusEl = document.getElementById("status");
    const percentEl = document.getElementById("progressPercent");


    // Adjust width
    function updateProgressBar(downloaded, total) {
        if (total === 0) {
            progressEl.style.width = "0%";
            return;
        }

        const fraction = downloaded / total;
        const percentage = fraction * 100;
        progressEl.style.width = percentage + "%";
    }

    // Event listeners (Nu alleen voor knop)
    startBtn.addEventListener("click", () => {
        let downloaded = 0;
        const total = 500; // stel dat de update 500 MB groot is

        statusEl.textContent = "📥 Began cleaning...";

        const interval = setInterval(() => {
            downloaded += Math.floor(Math.random() * 20) + 5;
            if (downloaded > total) downloaded = total;

            updateProgressBar(downloaded, total);

            const percentage = Math.floor((downloaded / total) * 100);
            percentEl.textContent = percentage + "%";

            if (percentage < 40) {
                statusEl.textContent = "📥 Began cleaning...";
            } else if (percentage < 80) {
                statusEl.textContent = "⚙️ Tidying up...";
            } else if (percentage < 100) {
                statusEl.textContent = "🔄 Vacuuming last corners...";
            } else {
                statusEl.textContent = "✅ Deepclean complete!";
                clearInterval(interval);
            }
        }, 300);
    });
}