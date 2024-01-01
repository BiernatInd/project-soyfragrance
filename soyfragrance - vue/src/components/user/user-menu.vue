<template>
    <div class="user-menu" :class="{ active: userMenuActive }">
        <div class="user-menu-content">
            <div class="user-menu-top">
                <div class="user-menu-top-content">
                    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeActiveClass">
                        <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(0.700553 0.713601 -0.62041 0.784278 12.9062 12)" fill="black"/>
                        <rect width="22.9729" height="2.04836" rx="1.02418" transform="matrix(-0.700553 0.713601 0.62041 0.784278 27.0938 12)" fill="black"/>
                    </svg>
                </div>
            </div>
            <div class="user-menu-bottom">
                <div class="user-menu-link">
                    <router-link to="/lista-zamowien-uzytkownik" :class="{ 'active': $route.path === '/lista-zamowien-uzytkownik' }">Lista zamówień</router-link>
                </div>
                <div class="user-menu-link">
                    <router-link to="/ustawienia-konta-uzytkownik" :class="{ 'active': $route.path === '/ustawienia-konta-uzytkownik' }">Ustawienia konta</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(['userMenuActive']),
  },
  methods: {
    ...mapActions(['setUserMenuActive']),
    // Zmień funkcję na toggleMenu
    toggleUserMenu() {
      this.setUserMenuActive(!this.userMenuActive);
    },
    removeActiveClass() {
      this.setUserMenuActive(false);
      const userMenuElement = document.querySelector('.user-menu');
      if (userMenuElement) {
        userMenuElement.classList.remove('active');
      }
    },
  },
};
</script>

<style lang="scss" scoped>
    .user-menu {
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
        .user-menu-content {
            .user-menu-top {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid var(--shadow);
                .user-menu-top-content {
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
            .user-menu-bottom {
                .user-menu-link {
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
                .user-menu-link-child {
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
        .user-menu {
            top: 0px;
            width: 40%;
        }
    }

    @media screen and (max-width: 768px) {
        .user-menu {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 468px) {
        .user-menu {
            width: 100%;
        }
    }
</style>
  