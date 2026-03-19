import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // слушает все интерфейсы внутри контейнера
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost', // хост для HMR (с точки зрения браузера)
            protocol: 'ws', // WebSocket для HMR
            clientPort: 5173
        }
    }
});
