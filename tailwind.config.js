module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.css",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            boxShadow: {
                green: "0 0 8px 0 rgba(16, 185, 129, 0.6)", 
                "green-lg": "0 0 20px 0 rgba(16, 185, 129, 0.8)",
                'hero-green': '0 10px 20px rgba(16, 185, 129, 0.6)',
            },
        },
    },
    plugins: [require("flowbite/plugin")],
    darkMode: "class",
};
