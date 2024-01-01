<template>
    <div class="auth-menu" :class="{ active: userAuthMenuActive }">
        <div class="auth-menu-content">
            <div class="auth-menu-top">
                <div class="auth-menu-top-content">
                    <p>{{ userName }}</p>
                    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeActiveClass">
                        <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(0.700553 0.713601 -0.62041 0.784278 12.9062 12)" fill="black"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(-0.700553 0.713601 0.62041 0.784278 27.0938 12)" fill="black"/>
                    </svg>
                </div>
            </div>
            <div class="auth-menu-bottom">
                <div class="auth-menu-link">
                    <a href="#" @click="logout">Wyloguj się</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
    ...mapState(['userAuthMenuActive']),
  },
  data() {
    return {
        userName: localStorage.getItem('userName')
    }
  },
  methods: {
    ...mapActions(['setUserAuthMenuActive']),
    toggleUserAuthMenu() {
      this.setUserAuthMenuActive(!this.userAuthMenuActive);
    },
    removeActiveClass() {
      this.setUserAuthMenuActive(false);
      const userAuthMenuElement = document.querySelector('.auth-menu');
      if (userAuthMenuElement) {
        userAuthMenuElement.classList.remove('active');
      }
    },
    logout() {
      // Usuń informacje o zalogowaniu z localStorage
      localStorage.removeItem('isLoggedIn');
      localStorage.removeItem('userRole');

      // Ustaw stan zalogowania na false
      this.isLoggedIn = false;

      // Tutaj możesz dodać przekierowanie na stronę logowania
      // Przykład przekierowania do strony głównej:
      this.$router.push({ path: '/' }); // Zakładając, że używasz Vue Router
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
                    justify-content: space-between;
                    align-items: center;
                    p {
                        font-size: 16px;
                        font-weight: 600;
                    }
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
  