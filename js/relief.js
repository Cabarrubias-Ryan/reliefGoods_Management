document.addEventListener('DOMContentLoaded', () => {
    const searchIcon = document.getElementById('search-icon');
    const searchInput = document.getElementById('search-input');
    const filterIcon = document.getElementById('filter-icon');
    const filterMenu = document.getElementById('filter-menu');

    // Toggle search input visibility
    searchIcon.addEventListener('click', () => {
        if (searchInput.style.display === 'block') {
            searchInput.style.display = 'none';
        } else {
            searchInput.style.display = 'block';
        }
    });

    // Toggle filter menu visibility
    filterIcon.addEventListener('click', () => {
        if (filterMenu.style.display === 'block') {
            filterMenu.style.display = 'none';
        } else {
            filterMenu.style.display = 'block';
        }
    });
});
