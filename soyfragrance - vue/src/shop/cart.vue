<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Koszyk</h1>
                <p>Kontynuuj zamówienie</p>
            </div>
        </div>
    </div>
    <div class="shopping-bag-clear">
        <div class="shopping-bag-clear-content">
            <a href="#"  @click="clearShoppingCart">Wyczyść koszyk
                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                    <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                    <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                    <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="shopping-bag-cart">
        <div class="shopping-bag-cart-content">
    <div class="shopping-bag-left">
      <div class="shopping-bag-cart-box" v-for="(item, index) in cartItems" :key="index">
        <div class="shopping-bag-cart-left">
          <img :src="item.product_photo_1" alt="">
          <p>{{ item.name }} | {{ item.category }}</p>
        </div>
        <div class="shopping-bag-cart-right">
          <p>{{ item.price }} zł</p>
          <select
    v-model="item.quantity"
>
    <option v-for="i in item.availability" :key="i">{{ i }}</option>
</select>
          <svg width="21" height="22" viewBox="0 0 21 22" fill="none" @click="removeFromCart(item.id)">
                            <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                            <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                            <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                            <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="shopping-bag-right">
                <div class="shopping-bag-summary">
                    <div class="shopping-bag-summary-top">
                        <h2>Podsumowanie</h2>
                    </div>
                    <div class="shopping-bag-price">
                        <p>Łączna kwota:</p>
                        <p>{{ totalPrice.toFixed(2) }} zł</p>
                    </div>
                    <div class="shopping-bag-button">
                        <button class="shopping-bag-btn" @click="goToCheckout">Przejdź do dostawy</button>
                        <button class="shopping-bag-btn" @click="continueShopping">Kontynuuj zakupy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <MainFooterTop />
    <MainFooterBottom />
</template>

<script>
import MainHeader from '@main-components/main-header.vue'
import MainFooterTop from '@main-components/main-footer-top.vue'
import MainFooterBottom from '@main-components/main-footer-bottom.vue'    

import { mapGetters, mapActions } from 'vuex';

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        methods: {
            ...mapActions(['setShoppingBagActive', 'removeFromCart', 'updateQuantity', 'clearCart']),
            goToCheckout() {
      // Assuming you have access to cartItems in this component
      // Navigate to the checkout page using your router or other method
      this.$router.push('/strona-zamowienia'); // Adjust the route as needed
    },
    continueShopping() {
            this.$router.push({ 
                name: 'shop', 
                params: { 
                    category_name: 'Świece sojowe', 
                    page: 1 
                }
            });
        },
        clearShoppingCart() {
        this.clearCart(); // Wywołanie akcji Vuex do wyczyszczenia koszyka
        // Dodatkowe działania, np. wyświetlenie komunikatu
    },
        },
        computed: {
            ...mapGetters(['cartItems', 'totalPrice']),
    cartItems() {
      return this.$store.getters.getCartItems;
    },
  },
  mounted() {
    console.log('Zawartość koszyka:', this.cartItems);
  },
    }
</script>

<style lang="scss" scoped>
  .home {
        padding-top: 9.2rem;
        padding-bottom: 4rem;
        background-color: var(--black);
        .home-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            h1 {
                font-size: 48px;
                color: var(--white);
                font-weight: 400;
                text-align: center;
                margin-bottom: 1rem;
            }
            p {
                font-size: 24px;
                color: var(--white);
                text-align: center;
            }
        }
    }

    .shopping-bag-clear {
        padding-top: 4rem;
        padding-bottom: 2rem;
        .shopping-bag-clear-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            a {
                font-size: 20px;
                font-weight: 600;
                transition: 0.5s;
                color: var(--black);
                text-decoration: none;
                svg {
                    margin-left: 1rem;
                    path {
                        stroke: var(--black);
                        transition: 0.5s;
                    }
                }
                &:hover {
                    color: var(--gold);
                    svg {
                        path {
                            stroke: var(--gold);
                        }
                    }
                }
            }
        }
    }

    .shopping-bag-cart {
        padding-bottom: 4rem;
        .shopping-bag-cart-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .shopping-bag-left {
                width: 70%;
                .shopping-bag-cart-box:first-child {
                    border-top-right-radius: 25px;
                    border-top-left-radius: 25px;
                }
                .shopping-bag-cart-box:last-child {
                    border-bottom-right-radius: 25px;
                    border-bottom-left-radius: 25px;
                }
                .shopping-bag-cart-box:not(:first-child) {
                    border-top: 1px solid var(--shadow);
                }
                .shopping-bag-cart-box {
                    background-color: var(--light-gold);
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 1rem;
                    .shopping-bag-cart-left {
                        display: flex;
                        align-items: center;
                        img {
                            max-width: 60px;
                            max-height: 60px;
                            margin-left: 1rem;
                            margin-right: 1rem;
                        }
                        p {
                            font-size: 20px;
                            font-weight: 600;
                        }
                    }
                    .shopping-bag-cart-right {
                        display: flex;
                        p {
                            font-weight: 600;
                            font-size: 16px;
                            color: var(--black);
                            margin-right: 1rem;
                        }
                        select {
                            padding-left: 0.5rem;
                            border: 1px solid var(--white);
                            border-right: 8px solid var(--white);
                            border-radius: 25px;
                            margin-right: 1rem;
                            user-select: none;
                            cursor: pointer;
                            color: var(--black);
                            font-weight: 600;
                            option {
                                font-weight: 600;
                            }
                        }
                        svg {
                            cursor: pointer;
                            path {
                                stroke: var(--black);
                                transition: 0.5s;
                            }
                            &:hover {
                                path {
                                    stroke: var(--gold);
                                }
                            }
                        }
                    }
                }
            }
            .shopping-bag-right {
                width: 25%;
                .shopping-bag-summary {
                    background-color: var(--light-gold);
                    border-radius: 25px;
                    .shopping-bag-summary-top {
                        border-bottom: 1px solid var(--shadow);
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        h2 {
                            padding: 1rem;
                        }
                    }
                    .shopping-bag-price {
                        padding: 1rem;
                        display: flex;
                        justify-content: space-between;
                        border-bottom: 1px solid var(--shadow);
                        p {
                            font-size: 16px;
                            font-weight: 600;
                            color: var(--black);
                        }
                    }
                    .shopping-bag-button {
                        padding: 1rem;
                        a:not(:last-child) {
                            .shopping-bag-btn {
                                margin-bottom: 1rem;

                            }
                        }
                        .shopping-bag-btn {
                            width: 100%;
                            height: 40px;
                            color: var(--black);
                            font-weight: 600;
                            font-size: 16px;
                            background-color: var(--gold);
                            border: 2px solid var(--gold);
                            transition: 0.5s;
                            cursor: pointer;
                            border-radius: 25px;
                            &:hover {
                                background-color: var(--black);
                                border: 2px solid var(--black);
                                color: var(--light-gold);
                            }
                        }
                        .shopping-bag-btn:last-child {
                            margin-top: 1rem;
                            background-color: var(--black);
                            border: 2px solid var(--black);
                            color: var(--light-gold);
                            &:hover {
                                background-color: var(--gold);
                                border: 2px solid var(--gold);
                                color: var(--black);
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1200px) {
        .home {
            padding-top: 6.5rem;
            padding-bottom: 2rem;
            .home-content {
                width: 90%;
                .home-heading {
                    h1 {
                        text-align: start;
                        font-size: 32px;
                    }
                    p {
                        text-align: start;
                        font-size: 15px;
                    }
                }
            }
        }
        
        .shopping-bag-clear {
            padding-top: 2rem;
            padding-bottom: 0;
            .shopping-bag-clear-content {
                width: 90%;
            }
        }
        .shopping-bag-cart {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .shopping-bag-cart-content {

                width: 90%;
                flex-direction: column;
                .shopping-bag-left {
                    margin-bottom: 2rem;
                    width: 100%;
                    .shopping-bag-cart-box {
                        flex-direction: column;
                        .shopping-bag-cart-left {
                            width: 100%;
                            margin-bottom: 1rem;
                            flex-direction: column;
                            align-items: start;
                            img {
                                margin-left: 0;
                                margin-bottom: 1rem;
                            }
                        }
                        .shopping-bag-cart-right {
                            width: 100%;
                        }
                    }
                }
                .shopping-bag-right {
                    width: 100%;
                }
            }
        }
    }
</style>