<template>
    <div class="shopping-bag" :class="{ active: shoppingBagActive }">
        <div class="shopping-bag-content">
            <div class="shopping-bag-top">
                <div class="shopping-bag-top-content">
                    <div class="shopping-bag-top-content-icon">
                        <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeActiveClass">
                            <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                            <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(0.700553 0.713601 -0.62041 0.784278 12.9062 12)" fill="black"/>
                            <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(-0.700553 0.713601 0.62041 0.784278 27.0938 12)" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="shopping-bag-center" v-for="(item, index) in cartItems" :key="index">
                    <div class="shopping-bag-center-content">
                        <div class="shopping-bag-left">
                            <img :src="item.product_photo_1" alt="">
                        </div>
                        <div class="shopping-bag-right">
                            <div class="shopping-bag-right-top">
                                <p>{{ item.name }}</p>
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" @click="removeFromCart(item.id)">
                                    <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                                    <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                                    <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                                    <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="shopping-bag-right-bottom">
                                <p>{{ item.price * item.quantity }} zł</p>
                                <p>x{{ item.quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shopping-bag-edit" v-if="cartItems.length > 0">
                    <div class="shopping-bag-edit-content">
                        <router-link to="/koszyk">Edytuj</router-link>
                    </div>
                </div>
                <div class="shopping-bag-no-products" v-else>
                    <div class="shopping-bag-no-products-content">
                        <p>Brak produktów w koszyku</p>
                    </div>
                </div>
            </div>
            <div class="shopping-bag-bottom">
                <div class="shopping-bag-bottom-content">
                    <div class="shopping-bag-bottom-top">
                        <p>Do zapłaty: </p>
                        <p>{{ totalPrice }} zł</p>
                    </div>
                    <div class="shopping-bag-bottom-button">
                        <button class="shopping-bag-bottom-btn" @click="goToCart">Przejdź do koszyka</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(['shoppingBagActive']),
    ...mapGetters(['cartItems', 'totalPrice']),
  },
  methods: {
    ...mapActions(['setShoppingBagActive', 'removeFromCart']),
    resetCartUpdated() {
      this.setCartUpdated(false);
    },
    toggleShoppingBag() {
        this.setShoppingBagActive(!this.shoppingBagActive);
    },
    removeActiveClass() {
        this.setShoppingBagActive(false);
        const shoppingBagElement = document.querySelector('.shopping-bag')
        if (shoppingBagElement) {
            shoppingBagElement.classList.remove('active')
        }
    },

    //przekazanie do cart.vue
    goToCart() {
      this.$store.dispatch('setCartItems', this.cartItems);
      this.$router.push({ name: 'cart' });
    },
  }
}
</script>

<style lang="scss" scoped>
    .shopping-bag {
        position: fixed;
        top: 0px;
        right: -100%;
        width: 25%;
        height: 100%;
        border-left: 1px solid var(--shadow);
        background-color: var(--white);
        transition: 0.5s;
        z-index: 999;
        &.active {
            right: 0;
        }
        .shopping-bag-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            overflow-y: auto;
            .shopping-bag-top {
                .shopping-bag-top-content {
                    display: flex;
                    justify-content: flex-end;
                    border-bottom: 1px solid var(--shadow);
                    .shopping-bag-top-content-icon {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        justify-content: flex-end;
                        padding-top: 0.5rem;
                        padding-bottom: 0.5rem;
                        svg {
                            cursor: pointer;
                            &:hover {
                                circle {
                                    fill: var(--black)
                                }
                                rect {
                                    fill: var(--gold);
                                }
                            }
                        }
                    }
                }
                .shopping-bag-center {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid var(--shadow);
                    .shopping-bag-center-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        justify-content: space-between;
                        .shopping-bag-left {
                        img {
                            width: 65px;
                            height: 80px;
                        }
                    }
                        .shopping-bag-right {
                            width: 80%;
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            .shopping-bag-right-top {
                                display: flex;
                                justify-content: space-between;
                                svg {
                                    stroke: var(--black);
                                    transition: 0.5s;
                                    cursor: pointer;
                                    &:hover {
                                        stroke: var(--gold);
                                    }
                                }
                                p {
                                    font-weight: 600;
                                }
                            }
                            .shopping-bag-right-bottom {
                                display: flex;
                                justify-content: space-between;
                                p {
                                    font-weight: 600;
                                }
                            }
                        }
                    }
                }
            }
            .shopping-bag-edit {
                border-bottom: 1px solid var(--shadow);
                .shopping-bag-edit-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    display: flex;
                    justify-content: flex-end;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    a {
                        color: var(--black);
                        text-decoration: none;
                        transition: 0.5s;
                        font-weight: 600;
                        &:hover {
                            color: var(--gold);
                        }
                    }
                }
            }
            .shopping-bag-no-products {
                border-bottom: 1px solid var(--shadow);
                .shopping-bag-no-products-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    display: flex;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    p {
                        font-size: 16px;
                        font-weight: 600;
                    }
                }
            }
            .shopping-bag-bottom {
                border-top: 1px solid var(--shadow);
                padding-top: 1rem;
                padding-bottom: 1rem;
                .shopping-bag-bottom-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    .shopping-bag-bottom-top {
                        display: flex;
                        justify-content: space-between;
                        padding-bottom: 1rem;
                        p {
                            font-weight: 600;
                        }
                    }
                    .shopping-bag-bottom-button {
                        .shopping-bag-bottom-btn {
                            width: 100%;
                            height: 40px;
                            border-radius: 25px;
                            background-color: var(--gold);
                            border: 1px solid var(--gold);
                            font-size: 16px;
                            transition: 0.5s;
                            cursor: pointer;
                            font-weight: 600;
                            color: var(--black);
                            &:hover {
                                background-color: var(--black);
                                border: 1px solid var(--black);
                                color: var(--gold);
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1200px) {
        .shopping-bag {
            top: 0px;
            width: 40%;
            .shopping-bag-content {
                .shopping-bag-top {
                    .shopping-bag-center {
                        .shopping-bag-center-content {
                            .shopping-bag-right {
                                width: 70%;
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 768px) {
        .shopping-bag {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 468px) {
        .shopping-bag {
            width: 100%;
        }
    }
</style>
  