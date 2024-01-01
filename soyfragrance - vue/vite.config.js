import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  server: {
    port: 3000,
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
      '@vuex': path.resolve(__dirname, './vuex'),
      '@subpages': path.resolve(__dirname, './src/subpages'),
      '@documents': path.resolve(__dirname, './src/documents'),
      '@blog': path.resolve(__dirname, './src/blog'),
      '@authentication': path.resolve(__dirname, './src/authentication'),
      '@shop': path.resolve(__dirname, './src/shop'),
      //Panel administratora
      '@admin-blog': path.resolve(__dirname, './src/admin-panel/blog'),
      '@admin-category': path.resolve(__dirname, './src/admin-panel/category'),
      '@admin-newsletter': path.resolve(__dirname, './src/admin-panel/newsletter'),
      '@admin-orders': path.resolve(__dirname, './src/admin-panel/orders'),
      '@admin-products': path.resolve(__dirname, './src/admin-panel/products'),
      '@admin-promo-code': path.resolve(__dirname, './src/admin-panel/promo-code'),
      '@admin-users': path.resolve(__dirname, './src/admin-panel/users'),
      '@admin-analitics': path.resolve(__dirname, './src/admin-panel/analitics'),
      '@admin-settings': path.resolve(__dirname, './src/admin-panel/settings'),
      //Panel użytkownika
      '@user-orders': path.resolve(__dirname, './src/user-panel/orders'),
      '@user-settings': path.resolve(__dirname, './src/user-panel/settings'),
      '@admin-components': path.resolve(__dirname, './src/components/admin'),
      '@main-components': path.resolve(__dirname, './src/components/main'),
      '@user-components': path.resolve(__dirname, './src/components/user'),
    }
  }
})
