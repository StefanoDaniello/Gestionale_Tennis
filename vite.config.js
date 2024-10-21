import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        // host: "0.0.0.0", // Per permettere a Vite di essere accessibile da altre macchine
        port: 5174, // porta scelta per il backend
    },
});
