import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  server: {
    host: '0.0.0.0', // allow LAN access
    port: 5173,
    hmr: {
      host: '0.0.0.0', // 👈 your PC’s IPv4 (same as above)
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
