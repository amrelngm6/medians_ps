import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'

// https://vitejs.dev/config/
export default defineConfig({
  build:{
    outDir: '../dist',
    manifest: true
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
