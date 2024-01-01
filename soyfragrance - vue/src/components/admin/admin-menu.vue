<template>
    <div class="admin-menu" :class="{ active: adminMenuActive }">
        <div class="admin-menu-content">
            <div class="admin-menu-top">
                <div class="admin-menu-top-content">
                    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeActiveClass">
                        <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(0.700553 0.713601 -0.62041 0.784278 12.9062 12)" fill="black"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(-0.700553 0.713601 0.62041 0.784278 27.0938 12)" fill="black"/>
                    </svg>
                </div>
            </div>
            <div class="admin-menu-bottom">
                <div class="admin-menu-link">
                    <router-link to="/lista-zamowien-administrator" :class="{ 'active': $route.path === '/lista-zamowien-administrator' }" >Lista zamówień</router-link>
                </div>
                <div class="admin-menu-link" @click="toggleProducts">
                    <p>Produkty</p>
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg" ref="productsIcon" @click="toggleProducts">
                      <path d="M1 0.999999L9 9L17 0.999998" stroke="#222222"/>
                    </svg>
                </div>
                <div v-if="productsChild" class="admin-menu-link-child">
                    <router-link to="/lista-produktow" :class="{ 'active': $route.path === '/lista-produktow' }">Lista produktów</router-link>
                </div>
                <div v-if="productsChild" class="admin-menu-link-child">
                    <router-link to="/produkt-dodaj" :class="{ 'active': $route.path === '/produkt-dodaj' }">Dodawanie produktów</router-link>
                </div>
                <div class="admin-menu-link" @click="toggleCategory">
                    <p>Kategorie</p>
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 0.999999L9 9L17 0.999998" stroke="#222222"/>
                    </svg>
                </div>
                <div v-if="categoryChild" class="admin-menu-link-child">
                    <router-link to="/kategorie-lista" :class="{ 'active': $route.path === '/kategorie-lista' }">Lista kategorii</router-link>
                </div>
                <div v-if="categoryChild" class="admin-menu-link-child">
                    <router-link to="/kategorie-dodaj" :class="{ 'active': $route.path === '/kategorie-dodaj' }">Dodawanie kategorii</router-link>
                </div>
                <div class="admin-menu-link" @click="togglePromoCode">
                    <p>Kody rabatowe</p>
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 0.999999L9 9L17 0.999998" stroke="#222222"/>
                    </svg>
                </div>
                <div v-if="promoCodeChild" class="admin-menu-link-child">
                    <router-link to="/lista-kodow-rabatowych" :class="{ 'active': $route.path === '/lista-kodow-rabatowych' }">Lista kodów rabatowych</router-link>
                </div>
                <div v-if="promoCodeChild" class="admin-menu-link-child">
                    <router-link to="/kod-rabatowy-dodaj" :class="{ 'active': $route.path === '/kod-rabatowy-dodaj' }">Dodawanie kodów rabatowych</router-link>
                </div>
                <div class="admin-menu-link" @click="toggleBlog">
                    <p>Blog</p>
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 0.999999L9 9L17 0.999998" stroke="#222222"/>
                    </svg>
                </div>
                <div  v-if="blogChild" class="admin-menu-link-child">
                    <router-link to="/blog-lista" :class="{ 'active': $route.path === '/blog-lista' }">Lista wpisów</router-link>
                </div>
                <div  v-if="blogChild" class="admin-menu-link-child">
                    <router-link to="/blog-dodaj-post" :class="{ 'active': $route.path === '/blog-dodaj-post' }">Dodawanie wpisów</router-link>
                </div>
                <div class="admin-menu-link">
                    <router-link to="/lista-uzytkownikow" :class="{ 'active': $route.path === '/lista-uzytkownikow' }">Lista użytkowników</router-link>
                </div>
                <div class="admin-menu-link">
                    <router-link to="/analityka" :class="{ 'active': $route.path === '/analityka' }">Analityka</router-link>
                </div>
                <div class="admin-menu-link">
                    <router-link to="/ustawienia-konta-administrator" :class="{ 'active': $route.path === '/ustawienia-konta-administrator' }">Ustawienia konta</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  data() {
    return {
      // Menu które sie pojawia
      productsChild: false,
      categoryChild: false,
      promoCodeChild: false,
      blogChild: false,
    };
  },
  computed: {
    ...mapState(['adminMenuActive']),
  },
  methods: {
    ...mapActions(['setAdminMenuActive']),
    // Zmień funkcję na toggleMenu
    toggleAdminMenu() {
      this.setAdminMenuActive(!this.adminMenuActive);
    },
    removeActiveClass() {
      this.setAdminMenuActive(false);
      const adminMenuElement = document.querySelector('.admin-menu');
      if (adminMenuElement) {
        adminMenuElement.classList.remove('active');
      }
    },
    toggleProducts() {
  this.productsChild = !this.productsChild;
  const svgElement = this.$refs.productsIcon;
  if (svgElement) {
    svgElement.classList.toggle('active');
  }
},
    toggleCategory() {
        this.categoryChild = !this.categoryChild
    },
    togglePromoCode() {
        this.promoCodeChild = !this.promoCodeChild
    },
    toggleBlog() {
        this.blogChild = !this.blogChild
    },
  },
};
</script>

<style lang="scss" scoped>
    .admin-menu {
        position: fixed;
        top: 0px;
        right: -100%;
        width: 20%;
        height: 100%;
        border-left: 1px solid var(--shadow);
        background-color: var(--white);
        transition: 0.5s;
        z-index: 999;
        overflow-y: auto;
        &.active {
            right: 0;
        }
        .admin-menu-content {
            .admin-menu-top {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid var(--shadow);
                .admin-menu-top-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    display: flex;
                    justify-content: flex-end;
                    svg {
                        transition: 0.5s;
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
            .admin-menu-bottom {
                .admin-menu-link {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid  var(--shadow);
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    cursor: pointer;
                    &.active {
                        p {
                            color: var(--gold);
                        }
                    }
                    p, a {
                        font-size: 16px;
                        color: var(--black);
                        text-decoration: none;
                        transition: 0.5s;
                        font-weight: 600;
                        &:hover {
                            color: var(--gold);
                        }
                        &.active {
                            color: var(--gold);
                        }
                    }
                    svg {
                        transition: 0.5s;
                        &.active {
                            transform: rotate(180deg);
                        }
                    }
                }
                .admin-menu-link-child {
                    width: 80%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid  var(--shadow);
                    &.active {
                        display: block;
                    }

                    a {
                        font-size: 16px;
                        color: var(--black);
                        text-decoration: none;
                        transition: 0.5s;
                        font-weight: 600;
                        &:hover {
                            color: var(--gold);
                        }
                        &.active {
                            color: var(--gold);
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1200px) {
        .admin-menu {
            top: 0px;
            width: 40%;
        }
    }

    @media screen and (max-width: 768px) {
        .admin-menu {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 468px) {
        .admin-menu {
            width: 100%;
        }
    }
</style>
  