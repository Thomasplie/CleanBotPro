window.addEventListener('load', init);

function init() {
    // ---- Elementen ophalen ----
    const startBtn = document.getElementById("startBtn");
    const progressEl = document.getElementById("progressFill");
    const statusEl = document.getElementById("status");
    const percentEl = document.getElementById("progressPercent");
    const tasksBox = document.getElementById('tasks-box');

    const today = new Date();
    const monday = new Date(today);

    // ---- Kalender logica ----
    monday.setDate(today.getDate() - ((today.getDay() + 6) % 7)); // find Monday

    const days = document.querySelectorAll('.calendar-day');
    days.forEach((dayEl, idx) => {
        const date = new Date(monday);
        date.setDate(monday.getDate() + idx);

        const dateEl = dayEl.querySelector('.calendar-date');
        if (dateEl) {
            dateEl.textContent = date.getDate();

            // Highlight vandaag
            if (
                date.getDate() === today.getDate() &&
                date.getMonth() === today.getMonth() &&
                date.getFullYear() === today.getFullYear()
            ) {
                dateEl.classList.add('active');
            }
        }
    });

    // ---- Progress bar logica ----
    function updateProgressBar(downloaded, total) {
        if (total === 0) {
            progressEl.style.width = "0%";
            return;
        }
        const fraction = downloaded / total;
        const percentage = fraction * 100;
        progressEl.style.width = percentage + "%";
    }

    // Start knop logica
    startBtn.addEventListener("click", () => {
        let downloaded = 0;
        const total = 500; // voorbeeld grootte

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

    // ---- Kalender click handlers ----
    days.forEach(dayEl => {
        dayEl.addEventListener('click', () => {
            const day = dayEl.dataset.day;

            fetch(`dashboard.php?day=${day}`)
                .then(res => res.text())
                .then(html => {
                    // Parse de volledige HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Pak alleen de tasks-box
                    const newBox = doc.getElementById('tasks-box');
                    if (newBox && tasksBox) {
                        tasksBox.innerHTML = newBox.innerHTML;
                    }

                    // Optioneel: highlight aangeklikte dag
                    days.forEach(d => d.querySelector('.calendar-date')?.classList.remove('active'));
                    dayEl.querySelector('.calendar-date')?.classList.add('active');
                })
                .catch(err => console.error(err));
        });
    });
}
