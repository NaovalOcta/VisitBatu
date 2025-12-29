import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import fs from "fs";

const host = "naoval-octa.test";
const certPath = "C:/laragon/etc/ssl/laragon.crt";
const keyPath = "C:/laragon/etc/ssl/laragon.key";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: host,
        hmr: { host: host }, // Hot Module Replacement ikut domain
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certPath),
        },
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
