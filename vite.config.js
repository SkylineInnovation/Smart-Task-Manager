import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Main application files
                'resources/css/app.css',
                'resources/js/app.js',
                
                // Main SCSS file
                'resources/assets/scss/style.scss',
                
                // Core JavaScript modules
                'resources/assets/js/custom.js',
                'resources/assets/js/left-menu.js',
                'resources/assets/js/sweet-alert.js',
                
                // Dashboard modules
                'resources/assets/js/index.js',
                'resources/assets/js/index1.js',
                'resources/assets/js/index2.js',
                'resources/assets/js/index3.js',
                'resources/assets/js/index4.js',
                'resources/assets/js/index5.js',
                
                // Chart libraries
                'resources/assets/js/charts.js',
                'resources/assets/js/chart.js',
                'resources/assets/js/echarts.js',
                'resources/assets/js/morris.js',
                'resources/assets/js/nvd3.js',
                'resources/assets/js/flot.js',
                
                // Form and UI components
                'resources/assets/js/form-elements.js',
                'resources/assets/js/advancedform.js',
                'resources/assets/js/formeditor.js',
                'resources/assets/js/summernote.js',
                'resources/assets/js/datatable.js',
                'resources/assets/js/fullcalendar.js',
                
                // UI enhancements
                'resources/assets/js/widget.js',
                'resources/assets/js/popover.js',
                'resources/assets/js/range.js',
                'resources/assets/js/stiky.js',
                'resources/assets/js/color-change.js',
            ],
            refresh: true,
        }),
    ],
    
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources'),
            '@js': resolve(__dirname, 'resources/assets/js'),
            '@scss': resolve(__dirname, 'resources/assets/scss'),
            '@images': resolve(__dirname, 'resources/assets/images'),
            '@plugins': resolve(__dirname, 'resources/assets/plugins'),
        },
    },
    
    build: {
        // Output directory
        outDir: 'public/build',
        
        // Generate manifest for Laravel
        manifest: true,
        
        // Enable source maps for debugging
        sourcemap: process.env.NODE_ENV === 'development',
        
        // Minification
        minify: 'terser',
        
        // Rollup options for advanced bundling
        rollupOptions: {
            output: {
                // Manual chunk splitting for better caching
                manualChunks: {
                    // Vendor libraries
                    vendor: ['axios', 'lodash'],
                    
                    // Chart libraries
                    charts: [
                        'resources/assets/js/charts.js',
                        'resources/assets/js/chart.js',
                        'resources/assets/js/echarts.js',
                        'resources/assets/js/morris.js',
                        'resources/assets/js/nvd3.js',
                        'resources/assets/js/flot.js',
                    ],
                    
                    // Dashboard modules
                    dashboard: [
                        'resources/assets/js/index.js',
                        'resources/assets/js/index1.js',
                        'resources/assets/js/index2.js',
                        'resources/assets/js/index3.js',
                        'resources/assets/js/index4.js',
                        'resources/assets/js/index5.js',
                    ],
                    
                    // Form components
                    forms: [
                        'resources/assets/js/form-elements.js',
                        'resources/assets/js/advancedform.js',
                        'resources/assets/js/formeditor.js',
                        'resources/assets/js/summernote.js',
                    ],
                    
                    // UI components
                    ui: [
                        'resources/assets/js/widget.js',
                        'resources/assets/js/popover.js',
                        'resources/assets/js/range.js',
                        'resources/assets/js/datatable.js',
                        'resources/assets/js/fullcalendar.js',
                    ],
                },
                
                // Asset file naming
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const ext = info[info.length - 1];
                    
                    if (/\.(png|jpe?g|gif|svg|webp|ico)$/i.test(assetInfo.name)) {
                        return `images/[name]-[hash][extname]`;
                    }
                    
                    if (/\.(woff2?|eot|ttf|otf)$/i.test(assetInfo.name)) {
                        return `fonts/[name]-[hash][extname]`;
                    }
                    
                    return `assets/[name]-[hash][extname]`;
                },
                
                // Chunk file naming
                chunkFileNames: 'js/[name]-[hash].js',
                entryFileNames: 'js/[name]-[hash].js',
            },
        },
        
        // Terser options for better minification
        terserOptions: {
            compress: {
                drop_console: process.env.NODE_ENV === 'production',
                drop_debugger: process.env.NODE_ENV === 'production',
            },
        },
        
        // Asset size warning limit (500kb)
        chunkSizeWarningLimit: 500,
    },
    
    // CSS preprocessing
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@scss/_variables.scss";`,
            },
        },
        
        // PostCSS plugins
        postcss: {
            plugins: [
                require('autoprefixer'),
                require('tailwindcss'),
            ],
        },
    },
    
    // Development server configuration
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true,
        },
    },
    
    // Optimization
    optimizeDeps: {
        include: [
            'axios',
            'lodash',
            'alpinejs',
        ],
    },
});
