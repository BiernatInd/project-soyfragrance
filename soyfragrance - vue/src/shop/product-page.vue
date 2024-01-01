<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-left">
                <img :src="selectedImage" alt="">
            </div>
            <div class="home-right">
                <h1 v-if="product">{{ product.name }}</h1>
                <div class="home-price">
                    <p v-if="product" :class="{ active: product.promo_price }">{{ product.price }} zł</p>
                </div>
                <div class="home-price">
                    <p v-if="product && product.promo_price !== null">{{ product.promo_price }} zł</p>
                </div>
                <div class="home-short-desc">
                    <p v-if="product" v-html="formatDescription(product.short_description)"></p>
                </div>
                <div class="home-sku" v-if="product">
                    <p v-if="product.availability > 0">{{ product.availability }} szt. na stanie magazynowym</p>
                    <p v-else>Brak na stanie magazynowym</p>
                </div>
                <div class="home-button" v-if="product && product.availability > 0">
                    <button class="home-btn" @click="addToCart(product)">Dodaj do koszyka</button>
                </div>
            </div>
        </div>
    </div>
    <div class="slider">
        <div class="slider-content">
            <div class="slider-box-container">
                <div class="slider-box" v-for="(image, index) in productImages" :key="index" @click="changeImage(index)">
                    <img :src="image" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="info">
        <div class="info-content">
            <div class="info-top">
                <h2>Dodatkowe informacje</h2>
            </div>
            <div class="info-bottom">
                <p v-if="product" v-html="formatDescription(product.long_description)"></p>
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

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                product: null,
                productImages: [],
                selectedImage: null,
            }
        },
        methods: {
            fetchProduct() {
    const productId = this.$route.params.id;

    axios.get(`https://localhost:8000/api/product/${productId}`)
        .then(response => {
            this.product = response.data.product;

            this.$nextTick(() => {
                // Filtruj obrazy tak, aby zignorować puste lub niezdefiniowane
                this.productImages = [
                    this.product.product_photo_1,
                    this.product.product_photo_2,
                    this.product.product_photo_3,
                ].filter(image => image != null && image.trim() !== '');

                // Ustaw domyślny obraz na pierwsze zdjęcie z dostępnych
                this.selectedImage = this.productImages[0] || null; 
            });

            console.log('Dane produktu:', this.product);
        })
        .catch(error => {
            console.error('Błąd pobierania produktu', error);
        });
},

        //slider
        changeImage(index) {
            // Sprawdź, czy productImages jest zdefiniowane
            if (this.productImages && this.productImages.length > index) {
                // Zmiana obrazu po kliknięciu
                this.selectedImage = this.productImages[index];
            }
        },

        formatDescription(description) {
    return description.replace(/\n/g, '<br>');
  },

        //dodanie do koszyka
        addToCart(product) {
    this.$store.dispatch('addToCart', product);
  }
        },
        mounted() {
        // Pobieranie produktu po załadowaniu komponentu
        this.fetchProduct();
      },
    }
</script>

<style lang="scss" scoped>
    .home {
        padding-top: 9.2rem;
        padding-bottom: 2rem;
        .home-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .home-left {
                width: 48%;
                background-color: var(--light-gold);
                border-radius: 25px;
                display: flex;
                align-items: center;
                justify-content: center;
                img {
                    width: 150px;
                    height: 190px;
                    border-radius: 15px;
                }
            }
            .home-right {
                width: 48%;
                h1 {
                    font-size: 40px;
                    font-weight: 600;
                    color: var(--black);
                    margin-bottom: 1rem;
                }
                .home-price {
                    margin-bottom: 1rem;
                    p {
                        font-size: 20px;
                        font-weight: 600;
                        &.active {
                            text-decoration: line-through;
                        }
                    }
                }
                .home-short-desc {
                    margin-bottom: 1rem;
                    p {
                        font-size: 20px;
                        font-weight: 600;
                    }
                }

                .home-sku {
                    margin-bottom: 1rem;
                    p {
                        font-size: 20px;
                        font-weight: 600;
                    }
                }

                .home-button {
                    .home-btn {
                        width: 260px;
                        height: 40px;
                        color: var(--black);
                        font-size: 16px;
                        font-weight: 600;
                        background-color: var(--gold);
                        border: 2px solid var(--gold);
                        border-radius: 25px;
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            background-color: var(--black);
                            border: 2px solid var(--black);
                            color: var(--gold);
                        }
                    }
                }
            }
        }
    }
    .slider {
        padding-bottom: 2rem;
        .slider-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .slider-box-container {
                display: flex;
                .slider-box:not(:last-child) {
                    margin-right: 1rem;
                }
                .slider-box {
                    cursor: pointer;
                    background-color: var(--light-gold);
                    width: 100px;
                    height: 100px;
                    padding: 1rem;
                    border-radius: 15px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    img {
                        max-width: 100%;
                        max-height: 100%;
                    }   
                }
            }
        }
    }

    .info {
        padding-bottom: 4rem;
        .info-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            border: 2px solid var(--gold);
            border-radius: 25px;
            .info-top {
                background-color: red;
                padding: 1rem;
                border-bottom: 2px solid var(--gold);
                background-color: var(--light-gold);
                border-radius: 25px;
                h2 {
                    font-size: 20px;
                    color: var(--black);
                    font-weight: 600;
                }
            }
            .info-bottom {
                padding: 1rem;
                p:not(:last-child) {
                    margin-bottom: 1rem;
                }
                p {
                    font-size: 16px;
                    font-weight: 600;
                }
            }
        }
    }

    @media screen and (max-width: 1200px) {
        .home {
            padding-top: 7.2rem;
            .home-content {
                width: 90%;
                flex-direction: column;
                .home-left {
                    width: 100%;
                    padding: 4rem;
                    margin-bottom: 1rem;
                }
                .home-right {
                    width: 100%;
                    h1 {
                        font-size: 32px;
                    }
                }
            }
        }
        .slider {
            padding-bottom: 2rem;
            .slider-content {
                width: 90%;
                .slider-box-container {
                    .slider-box {
                        width: 80px;
                        height: 80px;
                    }
                }
            }
        }
        .info {
            padding-bottom: 2rem;
            .info-content {
                width: 90%;
                .info-top {
                    h2 {
                        font-size: 20px;
                    }
                }
            }
        }
    }
</style>