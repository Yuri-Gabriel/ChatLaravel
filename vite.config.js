import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    return {
        plugins: [
            laravel({
                input: ['resources/css', 'resources/js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
        define: {
            'process.env': env,
        },
    };
});
