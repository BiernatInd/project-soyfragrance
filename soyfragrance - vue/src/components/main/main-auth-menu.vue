<template>
    <div class="auth-menu" :class="{ active: authMenuActive }">
        <div class="auth-menu-content">
            <div class="auth-menu-top">
                <div class="auth-menu-top-content">
                    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeActiveClass">
                        <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(0.700553 0.713601 -0.62041 0.784278 12.9062 12)" fill="black"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(-0.700553 0.713601 0.62041 0.784278 27.0938 12)" fill="black"/>
                    </svg>
                </div>
            </div>
            <div class="auth-menu-bottom">
                <div class="auth-menu-link">
                    <router-link to="/logowanie" :class="{ 'active': $route.path === '/logowanie' }">Zaloguj się</router-link>
                </div>
                <div class="auth-menu-link">
                    <router-link to="/rejestracja" :class="{ 'active': $route.path === '/rejestracja' }">Zarejestruj się</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(['authMenuActive'])
  },
  methods: {
    ...mapActions(['setAuthMenuActive']),
    toggleAuthMenu() {
      this.setAuthMenuActive(!this.authMenuActive);
    },
    removeActiveClass() {
      this.setAuthMenuActive(false);
      const authMenuElement = document.querySelector('.auth-menu');
      if (authMenuElement) {
        authMenuElement.classList.remove('active');
      }
    },
}
}
</script>

<style lang="scss" scoped>
    .auth-menu {
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
        .auth-menu-content {
            .auth-menu-top {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid var(--shadow);
                .auth-menu-top-content {
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
            .auth-menu-bottom {
                .auth-menu-link {
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
        .auth-menu {
            top: 0px;
            width: 40%;
        }
    }

    @media screen and (max-width: 768px) {
        .auth-menu {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 468px) {
        .auth-menu {
            width: 100%;
        }
    }
</style>
  