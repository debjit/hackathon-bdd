import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // valetTls: env.APP_HOST,
            cors: {
                allowedOrigins: ['https://hackathon-bdd.test'],
                allowedMethods: ["GET", "POST", "PUT"],
                allowedHeaders: ["Content-Type", "Authorization"]
            }
        }),
    ],
});
