import { createStore } from 'vuex';
import axios from 'axios'

const cartItemsFromLocalStorage = JSON.parse(localStorage.getItem('cartItems')) || [];

const saveCartToLocalStorage = (cartItems) => {
  localStorage.setItem('cartItems', JSON.stringify(cartItems));
};

const store = createStore({
    state: {
      //Menu
        authMenuActive: false,
        shoppingBagActive: false,
        mainMenuActive: false,

      //Admin Menu
        adminMenuActive: false,
        adminAuthMenuActive: false,

      //User Menu
      userMenuActive: false,
      userAuthMenuActive: false,

      //Cart
      cartItems: cartItemsFromLocalStorage,

      //przekazanie danych do do thanks fro order
      orderData: {},
      },
    mutations: {
      //Menu
        setAuthMenuActive(state, isActive) {
            state.authMenuActive = isActive;
            if (isActive) {
              state.shoppingBagActive = false;
              state.mainMenuActive = false;
            }
        },
        setShoppingBagActive(state, isActive) {
          state.shoppingBagActive = isActive;
        },
        setMainMenuActive(state, isActive) {
            state.mainMenuActive = isActive;
            if (isActive) {
              state.authMenuActive = false;
              state.shoppingBagActive = false;
            }
        },

        //Resetowanie menu przy przekierowaniu
        resetMenuStates(state, payload) {
          state.authMenuActive = payload.authMenuActive;
          state.shoppingBagActive = payload.shoppingBagActive;
          state.mainMenuActive = payload.mainMenuActive;
          state.userAuthMenuActive = payload.userAuthMenuActive;
          state.userMenuActive = payload.userMenuActive;
          state.adminAuthMenuActive = payload.adminAuthMenuActive;
          state.adminMenuActive = payload.adminMenuActive;
        },

        //Admin Menu
        setAdminAuthMenuActive(state, isActive) {
          state.adminAuthMenuActive = isActive;
          if (isActive) {
            state.adminMenuActive = false;
          }
      },

      setAdminMenuActive(state, isActive) {
        state.adminMenuActive = isActive;
        if (isActive) {
          state.adminAuthMenuActive = false;
        }
      },

        //User Menu
        setUserAuthMenuActive(state, isActive) {
          state.userAuthMenuActive = isActive;
          if (isActive) {
            state.userMenuActive = false;
          }
      },

      setUserMenuActive(state, isActive) {
        state.userMenuActive = isActive;
        if (isActive) {
          state.userAuthMenuActive = false;
        }
      },

      //cart
      addToCart(state, product) {
        const existingProduct = state.cartItems.find(item => item.id === product.id);
    
        // Sprawdź dostępność przed dodaniem do koszyka
        if (existingProduct) {
          // Jeżeli produkt już istnieje w koszyku
          if (existingProduct.quantity + 1 <= product.availability) {
            existingProduct.quantity += 1;
          } else {
            // Tutaj możesz obsłużyć odpowiedni komunikat o braku dostępności
            console.warn("Brak wystarczającej ilości dostępnych produktów");
          }
        } else {
          // Jeżeli produkt nie istnieje w koszyku
          state.cartItems.push({ ...product, quantity: 1 });
        }
    
        console.log('Adding to cart:', product);
        saveCartToLocalStorage(state.cartItems);
      },
      removeFromCart(state, productId) {
        const index = state.cartItems.findIndex(item => item.id === productId);
      
        if (index !== -1) {
          const item = state.cartItems[index];
          if (item.quantity > 1) {
            item.quantity -= 1;
          } else {
            state.cartItems.splice(index, 1);
          }
        }
      
        saveCartToLocalStorage(state.cartItems);
      },

      //cart quantity
      setNinePlusQuantity(state, { index, quantity }) {
        state.cartItems[index].quantity = quantity;
        saveCartToLocalStorage(state.cartItems);
      },
      updateQuantity(state, { index, quantity }) {
        const item = state.cartItems[index];
        
        // Jeżeli wprowadzona ilość przekracza dostępność, ustaw ilość na maksymalną dostępną
        if (quantity > item.availability) {
          item.quantity = item.availability;
          // Tutaj możesz obsłużyć odpowiedni komunikat o braku dostępności
          console.warn("Przekroczono dostępną ilość produktu");
        } else {
          item.quantity = quantity;
        }
    
        saveCartToLocalStorage(state.cartItems);
      },


      //przekazanie z cart do checkout
      setCartItems(state, cartItems) {
        state.cartItems = cartItems;
        localStorage.setItem('cartItems', JSON.stringify(state.cartItems));
      },

      //przekazanie danych do thanks for order
      setOrderData(state, data) {
          state.orderData = data;
        },

      //czyszczenie koszyka
      clearCart(state) {
        state.cartItems = [];
        saveCartToLocalStorage(state.cartItems);
      },
    },
    actions: {
      //Menu
        setAuthMenuActive({ commit }, isActive) {
            commit('setAuthMenuActive', isActive);
        },
        setShoppingBagActive({ commit }, isActive) {
          commit('setShoppingBagActive', isActive);
        },
        setMainMenuActive({ commit }, isActive) {
          commit('setMainMenuActive', isActive);
        },

        //Admin menu
        setAdminAuthMenuActive({ commit }, isActive) {
          commit('setAdminAuthMenuActive', isActive);
        },

        setAdminMenuActive({ commit }, isActive) {
          commit('setAdminMenuActive', isActive);
        },

        //User menu
        setUserAuthMenuActive({ commit }, isActive) {
          commit('setUserAuthMenuActive', isActive);
        },

        setUserMenuActive({ commit }, isActive) {
          commit('setUserMenuActive', isActive);
        },

        //Restowanie menu przy przekierowaniu
        resetMenuStates({ commit }) {
          commit('setAuthMenuActive', false);
          commit('setShoppingBagActive', false);
          commit('setMainMenuActive', false);
          commit('setUserMenuActive', false);
          commit('setAdminAuthMenuActive', false);
          commit('setAdminMenuActive', false);
        },

        //cart
        addToCart({ commit }, product) {
          // Sprawdź, czy istnieje cena promocyjna
          if (product.promo_price) {
              // Stwórz kopię produktu z użyciem promo_price jako ceny
              const productWithPromoPrice = { ...product, price: product.promo_price };
              commit('addToCart', productWithPromoPrice);
          } else {
              // Dodaj produkt z normalną ceną
              commit('addToCart', product);
          }
  
          // Aktywuj koszyk
          commit('setShoppingBagActive', true);
      },
        removeFromCart({ commit }, index) {
          commit('removeFromCart', index);
        },

        //przekazanie danych do cart.vue
        setCartItems({ commit }, cartItems) {
          commit('setCartItems', cartItems);
        },

        //przekazanie danych do thanks for order
        setOrderData({ commit }, data) {
          commit('setOrderData', data);
      },

      //Aktualizowanie stanu magazynowego
      updateProductAvailability({ commit }, purchasedProducts) {
        // Rozdziel zakupione produkty na pojedyncze elementy
        const products = purchasedProducts.split(', ');
  
        products.forEach((product) => {
          // Rozdziel nazwę produktu od ilości
          const [productName, quantity] = product.split(' (x');
          const parsedQuantity = parseInt(quantity.slice(0, -1), 10);
  
          // Wywołaj mutację do zmniejszenia dostępności produktu w koszyku
        });
      },
        

      //Czyszczenie koszyka
      clearCart({ commit }) {
        commit('clearCart');
      },
    },
    getters: {
      cartItems: (state) => state.cartItems,
      totalPrice: (state) => {
        return state.cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
      },

    //przekazanie danych do cart.vue
    getCartItems(state) {
      return state.cartItems;
    },

    //cart quantity
    updateQuantity({ commit, state }, { itemId, quantity }) {
      const index = state.cartItems.findIndex(item => item.id === itemId);
      if (index !== -1) {
        const item = state.cartItems[index];
        commit(item.isNinePlus ? 'setNinePlusQuantity' : 'updateQuantity', { index, quantity });
      }
    },

    //przekazanie z cart do chaeckout
    updateCartItems({ commit }, cartItems) {
      commit('setCartItems', cartItems);
    },
    },
});

export default store;