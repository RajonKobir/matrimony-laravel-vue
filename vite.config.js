import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VitePWA({
            registerType: 'autoUpdate',
            injectRegister: 'auto',
            workbox: {
                maximumFileSizeToCacheInBytes: 3000000
            },
            devOptions: {
                enabled: true,
                type: 'module',
            },
            outDir: 'public/build',
            scope: '/',
            base: '/',
            manifest: {
                id: '/',
                scope: '/',
                name: 'Shadibari',
                short_name: 'Shadibari',
                description: 'Shadibari',
                theme_color: '#ad277c',
                icons: [
                    {
                        src: '/assets/images/icons/icon-192x192.png',
                        sizes: '192x192',
                        type: 'image/png'
                    },
                    {
                        src: '/assets/images/icons/icon-512x512.png',
                        sizes: '512x512',
                        type: 'image/png'
                    }
                ]
            }
        }),
    ],
    build: {
        chunkSizeWarningLimit: 5000 // Set limit in KB (Default: 500KB)
    }
});
