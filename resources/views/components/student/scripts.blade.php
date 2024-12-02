<script>
    // Store sidebar state in sessionStorage (will reset when browser is closed)
    function setSidebarState(isOpen) {
        sessionStorage.setItem('sidebarOpen', isOpen);
    }

    // Get sidebar state from sessionStorage
    function getSidebarState() {
        return sessionStorage.getItem('sidebarOpen') === 'true';
    }

    // Initialize sidebar state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const navLinks = document.querySelectorAll('.sidebar a');

        // Apply saved state or default to open
        const isOpen = getSidebarState();
        if (isOpen || isOpen === null) { // Default to open if no state is saved
            sidebar.classList.remove('-translate-x-full');
            mainContent.style.marginLeft = '16rem';
        } else {
            sidebar.classList.add('-translate-x-full');
            mainContent.style.marginLeft = '0';
        }

        // Set active link based on current path
        const currentPath = window.location.pathname;
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // Preserve sidebar state during navigation
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                const sidebarState = !sidebar.classList.contains('-translate-x-full');
                setSidebarState(sidebarState);
            });
        });
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        sidebar.classList.toggle('-translate-x-full');
        const isOpen = !sidebar.classList.contains('-translate-x-full');

        if (isOpen) {
            mainContent.style.marginLeft = '16rem';
        } else {
            mainContent.style.marginLeft = '0';
        }

        // Save state to sessionStorage
        setSidebarState(isOpen);
    }

    function toggleProfileMenu() {
        const profileMenu = document.getElementById('profileMenuDropdown');
        profileMenu.classList.toggle('hidden');
    }
</script>
