module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#201b50',
            },
            textColors: {
                primary: '#201b50'
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography')
    ],
};
