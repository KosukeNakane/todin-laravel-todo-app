const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

const applyTheme = (isDark) => {
    document.documentElement.classList.toggle('dark', isDark);
    document.documentElement.dataset.theme = isDark ? 'dark' : 'light';
};

const initialIsDark = document.documentElement.dataset.theme
    ? document.documentElement.dataset.theme === 'dark'
    : mediaQuery.matches;

applyTheme(initialIsDark);

const handleChange = (event) => applyTheme(event.matches);

if (mediaQuery.addEventListener) {
    mediaQuery.addEventListener('change', handleChange);
} else if (mediaQuery.addListener) {
    mediaQuery.addListener(handleChange);
}
