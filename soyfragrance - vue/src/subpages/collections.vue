<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Ekologiczne świece sojowe – kolekcje</h1>
            </div>
        </div>
    </div>
    <div class="collection">
        <div class="collection-content">
            <div class="collection-columns" v-for="(group, index) in productGroups" :key="index">
                <div class="collection-box-container">
                    <!-- Iterowanie przez produkty w grupie -->
                    <div class="collection-box" v-for="product in group" :key="product.id">
                        <div class="collection-top">
                            <!-- Warunek dla statycznych i dynamicznych obrazów -->
                            <router-link :to="`/strona-produktu/${product.id}`">
                            <img v-if="product.staticImage" :src="product.staticImage" alt="">
                            <img v-else :src="product.product_photo_1" :alt="product.name">
                            </router-link>
                        </div>
                        <div class="collection-bottom">
                            <!-- Treść dla statycznych i dynamicznych elementów -->
                            <p v-if="product.staticImage">{{ product.name }}</p>
                            <template v-else>
                                <p>{{ product.name }}</p>
                                <p :class="{ 'active': product.promo_price }">{{ product.price }} zł</p>
                                <p v-if="product.promo_price">{{ product.promo_price }} zł</p>
                                <a @click="addProductToCart(product)" v-if="product.product_photo_1">Dodaj do koszyka
                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.32898 14.9999C6.68505 14.9999 6.97371 14.7113 6.97371 14.3552C6.97371 13.9991 6.68505 13.7104 6.32898 13.7104C5.9729 13.7104 5.68424 13.9991 5.68424 14.3552C5.68424 14.7113 5.9729 14.9999 6.32898 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.3553 14.9999C15.7114 14.9999 16 14.7113 16 14.3552C16 13.9991 15.7114 13.7104 15.3553 13.7104C14.9992 13.7104 14.7106 13.9991 14.7106 14.3552C14.7106 14.7113 14.9992 14.9999 15.3553 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.26318 1H3.82611L5.74831 11.8684H16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.67282 9.28941H15.6353C15.7092 9.28946 15.7808 9.26367 15.838 9.21643C15.8951 9.16918 15.9343 9.10341 15.9488 9.03031L17.0991 3.22767C17.1084 3.18088 17.1072 3.1326 17.0958 3.0863C17.0843 3.04001 17.0628 2.99686 17.0328 2.95996C17.0028 2.92307 16.9651 2.89335 16.9223 2.87296C16.8796 2.85257 16.8328 2.84201 16.7855 2.84204H4.39476" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </template>
                        </div>
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
import axios from 'axios'
import { mapActions } from 'vuex';

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                productGroups: [], // Grupy produktów
                staticImages: [ // Stałe ścieżki do zdjęć dla pierwszych elementów grup
                    "http://localhost:3000/src/assets/26.webp",
                    "http://localhost:3000/src/assets/30.webp",
                    "http://localhost:3000/src/assets/34.webp",
                    "http://localhost:3000/src/assets/38.webp",
                    "http://localhost:3000/src/assets/42.webp",
                    "http://localhost:3000/src/assets/46.webp",
                ],
                groupNames: [ // Nazwy dla każdej grupy
                    "Kolekcja świąteczna",
                    "Kolekcja klasyczna",
                    "Kolekcja wśród drzew",
                    "Kolekcja subtelna elegancja",
                    "Kolekcja perfumeryjna",
                    "Kolekcja kwiatowa"
                    // ...inne nazwy...
                ],
            }
        },
        methods: {
            ...mapActions(['addToCart']),
            async fetchProducts() {
            try {
                const response = await axios.get('http://localhost:8000/api/products/Promocje');
                const allProducts = response.data.products;
                if (Array.isArray(allProducts)) {
                    const groupIds = [[16, 4, 9], [6, 17, 10], [2, 12, 13], [11, 7, 1], [3, 15, 14], [8, 5, 10]]; // Identyfikatory dla każdej grupy
                    this.productGroups = groupIds.map((group, index) => [
                { id: `static-${index}`, staticImage: this.staticImages[index], name: this.groupNames[index] }, // Dodaj statyczne elementy
                ...group.map(id => allProducts.find(product => product.id === id)).filter(product => product)
            ]);
                } else {
                    console.error('Otrzymano dane w nieprawidłowym formacie:', allProducts);
                }
            } catch (error) {
                console.error('Błąd podczas pobierania produktów:', error);
            }
        },
        addProductToCart(product) {
      this.addToCart(product);
    },
    },
    mounted() {
        this.fetchProducts();
    }
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
        }
    }
    
    .collection {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .collection-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .collection-columns:not(:last-child) {
                margin-bottom: 4rem;
            }
            .collection-columns {
                padding: 2rem;
                background-color: var(--light-gold);
                border-radius: 25px;
                .collection-box-container {
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                    .collection-box:not(:first-child) {
                        .collection-top {
                            background-color: var(--white);
                        }
                    }
                    .collection-box {
                        .collection-top {
                            width: 300px;
                            height: 300px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 25px;
                            cursor: pointer;
                            img {
                                max-width: 100%;
                                max-height: 100%;
                            }
                        }
                        .collection-bottom {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            p {
                                margin-top: 1rem;
                                font-size: 20px;
                                font-weight: 600;
                                text-align: center;
                                &.active {
                                    text-decoration: line-through;
                                }
                            }
                            a {
                                margin-top: 1rem;
                                font-size: 20px;
                                color: var(--black);
                                text-decoration: none;
                                font-weight: 600;
                                transition: 0.5s;
                                text-align: center;
                                display: flex;
                                align-items: center;
                                cursor: pointer;
                                svg {
                                    margin-left: 1rem;
                                    path {
                                        transition: 0.5s;
                                    }
                                }
                                &:hover {
                                    color: var(--gold);
                                    svg {
                                        path {
                                            stroke: var(--gold)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .collection {
            .collection-content {
                .collection-columns {
                    .collection-box-container {
                        .collection-box {
                            width: 20%;
                            .collection-top {
                                width: 100%;
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
                }
            }
        }
        .collection {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .collection-content {
                width: 90%;
                .collection-columns:not(:last-child) {
                    margin-bottom: 2rem;
                }
                .collection-columns {
                    .collection-box-container {
                        flex-direction: column;
                        .collection-box:not(:first-child) {
                            .collection-top {
                                margin-top: 1rem;
                            }
                        }
                        .collection-box {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
</style>