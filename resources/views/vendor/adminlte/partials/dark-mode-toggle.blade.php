<li class="nav-item custom-switch-container">
    <input type="checkbox" id="darkModeSwitch" onclick="handleThemeToggle()">
    <label class="dark-mode-switch-label" for="darkModeSwitch">
        <i class="fas fa-sun" id="sun-icon"></i>
        <i class="fas fa-moon" id="moon-icon"></i>
    </label>
</li>

<script>
    function handleThemeToggle() {
        const isChecked = document.getElementById('darkModeSwitch').checked;
        if (isChecked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            document.getElementById('darkModeSwitch').checked = true;
        }
    });
</script>