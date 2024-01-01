<template>
    <div class="main-menu" :class="{ active: mainMenuActive }">
        <div class="main-menu-content">
            <div class="main-menu-top">
                <div class="main-menu-top-content">
                    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeActiveClass">
                        <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(0.700553 0.713601 -0.62041 0.784278 12.9062 12)" fill="black"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(-0.700553 0.713601 0.62041 0.784278 27.0938 12)" fill="black"/>
                    </svg>
                </div>
            </div>
            <div class="main-menu-bottom">
                <div class="main-menu-link">
                    <router-link to="/" :class="{ 'active': $route.path === '/' }">Strona główna</router-link>
                </div>
                <div class="main-menu-link">
                    <router-link :to="{ name: 'shop', params: { category_name: 'Promocje', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Sklep</router-link>
                </div>
                <div class="main-menu-link">
                    <router-link to="/kolekcje" :class="{ 'active': $route.path === '/kolekcje' }">Kolekcje</router-link>
                </div>
                <div class="main-menu-link">
                    <router-link to="/wspolpraca" :class="{ 'active': $route.path === '/wspolpraca' }">Współpraca B2B</router-link>
                </div>
                <div class="main-menu-link">
                    <router-link to="/o-naszej-firmie" :class="{ 'active': $route.path === '/o-naszej-firmie' }">O nas</router-link>
                </div>
                <div class="main-menu-link">
                    <router-link to="/blog" :class="{ 'active': $route.path === '/blog' }">Blog</router-link>
                </div>
                <div class="main-menu-link">
                    <router-link to="/kontakt" :class="{ 'active': $route.path === '/kontakt' }">Kontakt</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
    ...mapState(['mainMenuActive'])
  },
  methods: {
    ...mapActions(['setMainMenuActive']),
    toggleMainMenu() {
      this.setMainMenuActive(!this.mainMenuActive);
    },
    closeMainMenu() {
      this.setMainMenuActive(false);
    },
    removeActiveClass() {
      this.setMainMenuActive(false);
      const mainMenuElement = document.querySelector('.main-menu');
      if (mainMenuElement) {
        mainMenuElement.classList.remove('active');
      }
    },
}
}
</script>

<style lang="scss" scoped>
    .main-menu {
        position: fixed;
        top: 0px;
        right: -100%;
        width: 20%;
        height: 100%;
        border-left: 1px solid var(--shadow);
        background-color: var(--white);
        transition: 0.5s;
        z-index: 999;
        &.active {
            right: 0;
        }
        .main-menu-content {
            .main-menu-top {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid var(--shadow);
                .main-menu-top-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    display: flex;
                    justify-content: flex-end;
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
            .main-menu-bottom {
                .main-menu-link {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid  var(--shadow);
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
        .main-menu {
            top: 0px;
            width: 40%;
        }
    }

    @media screen and (max-width: 768px) {
        .main-menu {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 468px) {
        .main-menu {
            width: 100%;
        }
    }
</style>
  