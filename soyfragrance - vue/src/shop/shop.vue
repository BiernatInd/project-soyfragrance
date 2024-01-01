<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Sklep - Świeczki sojowe</h1>
            </div>
        </div>
    </div>
    <div class="filter">
        <div class="filter-content">
            <div class="filter-columns">
                <div class="filter-left">
                 <p>Znalezione produkty: {{ products.length }}</p>
                </div>
                <div class="filter-right">
    <p>Wybierz kategorię:</p>
    <select v-model="selectedCategory" @change="changeCategory">
      <option v-for="category in categories" :key="category.id" :value="category.category_name">
        {{ category.category_name }}
      </option>
    </select>
  </div>
            </div>
        </div>
    </div>
    <div class="shop">
        <div class="shop-content">
            <div v-for="(group, index) in groupedProducts" :key="index" class="shop-box-container">
        <div class="shop-box-column" v-for="column in group" :key="column[0].id">
          <div class="shop-box" v-for="product in column" :key="product.id">
                        <div class="shop-box-content">
                            <div class="shop-box-top" @click="redirectToProductPage(product)">
                                <div class="shop-box-top-content">
                                    <img :src="product.product_photo_1" alt="">
                                </div>
                            </div>
                            <div class="shop-box-bottom">
                                <p>{{ product.name }}</p>
                                <p :class="{ 'active': product.promo_price }">{{ product.price }} zł</p>
                                <p v-if="product.promo_price">{{ product.promo_price }} zł</p>
                                <p v-if="product.availability <= 0" class="out-of-stock">Brak na stanie magazynowym</p>
                                <a v-if="product.availability > 0" @click="addToCart(product)">Dodaj do koszyka
                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.32898 14.9999C6.68505 14.9999 6.97371 14.7113 6.97371 14.3552C6.97371 13.9991 6.68505 13.7104 6.32898 13.7104C5.9729 13.7104 5.68424 13.9991 5.68424 14.3552C5.68424 14.7113 5.9729 14.9999 6.32898 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.3553 14.9999C15.7114 14.9999 16 14.7113 16 14.3552C16 13.9991 15.7114 13.7104 15.3553 13.7104C14.9992 13.7104 14.7106 13.9991 14.7106 14.3552C14.7106 14.7113 14.9992 14.9999 15.3553 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.26318 1H3.82611L5.74831 11.8684H16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.67282 9.28941H15.6353C15.7092 9.28946 15.7808 9.26367 15.838 9.21643C15.8951 9.16918 15.9343 9.10341 15.9488 9.03031L17.0991 3.22767C17.1084 3.18088 17.1072 3.1326 17.0958 3.0863C17.0843 3.04001 17.0628 2.99686 17.0328 2.95996C17.0028 2.92307 16.9651 2.89335 16.9223 2.87296C16.8796 2.85257 16.8328 2.84201 16.7855 2.84204H4.39476" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination">
    <div class="pagination-content">
        <div class="pagination-box-container">
            <div
                v-for="page in Math.ceil(products.length / 12)"
                :key="page"
                class="pagination-box"
                :class="{ active: page === currentPage }"
                @click="changePage(page)"
            >
                <p>{{ page }}</p>
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
import { mapActions, mapState } from 'vuex';

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                products: [],
                categories: [],
                selectedCategory: '',
                currentPage: 1,
            };
        },
        methods: {
            ...mapActions(['addToCart']),
  async fetchProducts() {
  try {
    const page = this.$route.params.page || this.currentPage || 1;
    const category = this.$route.params.category_name || this.selectedCategory;
    const response = await axios.get(`http://localhost:8000/api/products/${category}?page=${page}`);
    this.products = response.data.products;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
},
async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:8000/api/categories');
        this.categories = response.data.categories;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
            // Funkcja do dzielenia tablicy na grupy
            chunkArray(array, size) {
                const result = [];
                for (let i = 0; i < array.length; i += size) {
                    result.push(array.slice(i, i + size));
                }
                return result;
            },
            changePage(pageNumber) {
        this.currentPage = pageNumber;
        this.$router.push(`/sklep/${encodeURIComponent(this.$route.params.category_name)}/${pageNumber}`);
        this.fetchProducts();
    },
      async changeCategory() {
    // Ustaw domyślną stronę na 1 po zmianie kategorii
    this.currentPage = 1;

    // Jeśli wybrano kategorię, przenieś użytkownika na odpowiednią podstronę
    if (this.selectedCategory) {
      this.$router.push(`/sklep/${encodeURIComponent(this.selectedCategory)}/1`);
    } else {
      // Jeśli nie wybrano konkretnej kategorii, przenieś użytkownika na stronę główną sklepu
      this.$router.push('/sklep/1');
    }

    // Odśwież produkty dla nowej kategorii
    await this.fetchProducts();
  },
  redirectToProductPage(product) {
        // Use the router to navigate to the product page
        this.$router.push('/strona-produktu/' + product.id );
    },
        },
        computed: {
            ...mapState(['shoppingBagActive']),
            //Dzielenie produktów na grupy po 4 i dodatkowe grupowanie maksymalnie 2 shop-box w shop-box-column
            groupedProducts() {
        const itemsPerPage = 12;
        const startIndex = (this.currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const slicedProducts = this.products.slice(startIndex, endIndex);

        return this.chunkArray(this.chunkArray(slicedProducts, 2), 2);
    },
        },
        watch: {
  '$route.params.category_name': function (newCategory, oldCategory) {
    if (newCategory !== oldCategory) {
      this.selectedCategory = decodeURIComponent(newCategory);
      this.fetchProducts();
    }
  },
},
        mounted() {
  this.fetchProducts();
  this.fetchCategories();

  // Ustaw domyślną kategorię na podstawie parametru w adresie URL
  const defaultCategory = this.$route.params.category_name || '';
  this.selectedCategory = decodeURIComponent(defaultCategory);
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
        }
    }

    .filter {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .filter-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            background-color: var(--light-gold);
            border-radius: 25px;
            padding: 2rem;
            .filter-columns {
                display: flex;
                justify-content: space-between;
                align-items: center;
                .filter-left {
                    p {
                        font-size: 20px;
                        color: var(--black);
                        font-weight: 600;
                    }
                }
                .filter-right {
                    display: flex;
                    align-items: center;
                    p {
                        margin-right: 1rem;
                        font-size: 20px;
                        color: var(--black);
                        font-weight: 600;
                    }
                    select {
                        height: 30px;
                        border: none;
                        border-radius: 25px;
                        cursor: pointer;
                        padding-left: 0.5rem;
                        border-right: 8px solid transparent;
                        font-weight: 600;
                        font-size: 16px;
                        color: var(--black);
                        option {
                            font-weight: 600;
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }

    .shop {
        .shop-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .shop-box-container {
                display: flex;
                margin-bottom: 4rem;
                justify-content: space-between;
                .shop-box-column {
                    display: flex;
                    justify-content: space-between;
                    width: 45%;
                    .shop-box {
                        width: 40%;
                        .shop-box-content {
                            .shop-box-top {
                                cursor: pointer;
                                background-color: var(--light-gold);
                                padding: 2rem;
                                border-radius: 25px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                .shop-box-top-content {
                                    border: 2px solid var(--gold);
                                    border-radius: 25px;
                                    padding: 4rem;
                                    img {
                                        width: 150px;
                                        height: 190px;
                                    }
                                }
                            }
                            .shop-box-bottom {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                p {
                                    font-size: 20px;
                                    color: var(--black);
                                    font-weight: 600;
                                    margin-top: 1rem;
                                    text-align: center;
                                    &.active {
                                      text-decoration: line-through;  
                                    }
                                }
                                a {
                                    font-size: 20px;
                                    color: var(--black);
                                    font-weight: 600;
                                    margin-top: 1rem;
                                    text-decoration: none;
                                    text-align: center;
                                    display: flex;
                                    align-items: center;
                                    transition: 0.5s;
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
                                                stroke: var(--gold);
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
    }

    .pagination {
        padding-bottom: 4rem;
        .pagination-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .pagination-box-container {
                display: flex;
                justify-content: center;
                .pagination-box:not(:last-child) {
                    margin-right: 1rem;
                }
                .pagination-box {
                    width: 30px;
                    height: 30px;
                    border: 2px solid var(--gold);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 5px;
                    transition: 0.5s;
                    cursor: pointer;
                    p {
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                    }
                    &:hover {
                        background-color: var(--gold);
                    }
                }
                .pagination-box.active {
                    background-color: var(--gold);
                }
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .shop {
            .shop-content {
                .shop-box-container {
                    .shop-box-column {
                        .shop-box {
                            .shop-box-content {
                                .shop-box-top {
                                    .shop-box-top-content {
                                        padding: 1rem;
                                    }
                                }
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

        .filter {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .filter-content {
                width: 90%;
                padding: 1rem;
                .filter-columns {
                    flex-direction: column;
                    justify-content: flex-start;
                    .filter-left {
                        width: 100%;
                        margin-bottom: 1rem;
                    }
                    .filter-right {
                        width: 100%;
                        flex-direction: column;
                        align-items: flex-start;
                        p {
                            margin-bottom: 1rem;
                        }
                        select {
                            width: 100%;
                        }
                    }
                }
            }
        }

        .shop {
            padding-bottom: 1rem;
            .shop-content {
                width: 90%;
                .shop-box-container {
                    flex-direction: column;
                    margin-bottom: 0;
                    .shop-box-column {
                        width: 100%;
                        margin-bottom: 1rem;
                        .shop-box {
                            width: 45%;
                            .shop-box-content {
                                .shop-box-top {
                                    padding: 1rem;
                                    .shop-box-top-content {
                                        img {
                                            width: 100%;
                                        }
                                    }
                                }
                                .shop-box-bottom {
                                    align-items: flex-start;
                                    p {
                                        font-size: 16px;
                                        margin-top: 1rem;
                                        text-align: start;
                                    }
                                    a {
                                        font-size: 16px;
                                        flex-direction: column;
                                        margin-top: 1rem;
                                        text-align: start;
                                        align-items: flex-start;
                                        svg {
                                            margin-top: 1rem;
                                            margin-left: 0;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        .pagination {
            padding-bottom: 2rem;
            .pagination-content {
                width: 90%;
                .pagination-box-container {
                    justify-content: flex-start;
                }
            }
        }
    }
</style>