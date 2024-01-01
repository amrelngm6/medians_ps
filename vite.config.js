import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import { minify } from 'vite-plugin-legacy';

// https://vitejs.dev/config/
export default defineConfig({
  build:{
    outDir: './dist'
  },
  root: './src',
  rollupOptions: {
    output: {
      entryFileNames: 'index.min.js',
      chunkFileNames: '[name]-[hash].min.js',
      assetFileNames: '[name]-[hash].[ext]',
    },
  },
  
  base: '/dist',
  plugins: [
    minify({
      target: 'es2015',
      // other minification options...
    }),
    vue(),
    vueJsx(),
  ],
  css: {
    // Rename the entry CSS file to index.css
    // The 'index.css' here will become the main entry point for your styles
    // Make sure your CSS is imported or linked from this file
    entry: 'main.css',
  },
  

  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
