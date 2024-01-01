<template>
    <UserHeader />
    <div class="home">
        <div class="home-content">
            <h1>Ustawienia konta</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-left">
                <div class="event-form">
                    <h2>Aktualne dane konta</h2>
                    <p>Nazwa użytkownika: {{ user.length > 0 ? user[0].user_name : 'Brak danych' }}</p>
                    <p>Adres E-mail: {{ user.length > 0 ? user[0].email : 'Brak danych' }}</p>
                </div>
            </div>
            <div class="event-right">
                <div class="event-post">
                    <h2>Zmiana danych</h2>
                    <router-link v-if="user.length > 0" :to="{ name: 'change-email-user', params: { id: user[0].id }}">Zmień adres E-mail</router-link>
                </div>
            </div>
        </div>
    </div>
    <UserFooterBottom />
</template>

<script>
import UserHeader from '@user-components/user-header.vue'
import UserFooterBottom from '@user-components/user-footer-bottom.vue'  
import axios from 'axios';  

    export default {
        components: {
            UserHeader,
            UserFooterBottom
        },
        data() {
            return {
              user: []
            }
        },
        methods: {
            fetchData() {
        axios.get('http://localhost:8000/api/user-account')
          .then(response => {
            console.log('Odpowiedź z API:', response.data)
            this.user = response.data.user
          })
          .catch(error => {
            console.error('Błąd pobierania danych:', error)
          })
      },
      checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'user') {
                // Jeżeli użytkownik nie ma roli user, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
        },
        mounted() {
            this.fetchData();
            this.checkUserRole();
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
            color: var(--white);
            font-size: 48px;
            font-weight: 400;
        }
    }
    }

    .event {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .event-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .event-left {
                width: 48%;
                .event-form:not(:last-child) {
                    margin-bottom: 1rem;
                }
                .event-form {
                    width: 100%;
                    background-color: var(--light-gold);
                    border-radius: 15px;
                    padding: 2rem;
                    h2 {
                        margin-bottom: 1rem;
                        font-size: 32px;
                    }
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                    p {
                        font-size: 16px;
                        font-weight: 600;
                    }
                }
            }
            .event-right {
                width: 50%;
                .event-post {
                    background-color: var(--light-gold);
                    height: 100%;
                    border-radius: 15px;
                    padding: 2rem;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    a {
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                        text-underline-offset: 4px;
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            color: var(--gold);
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1400px) {
        .home {
            padding-top: 6.5rem;
            padding-bottom: 2rem;
            .home-content {
                width: 90%;
                h1 {
                    text-align: start;
                    font-size: 32px;
                }
            }
        }
        .event {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .event-content {
                width: 90%;
                flex-direction: column;
                .event-left {
                    width: 100%;
                    .event-form {
                        width: 100%;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                            margin-bottom: 1rem;
                        }
                        .input-full-width {
                            flex-direction: column;
                            input {
                                width: 100%;
                                height: 40px;
                                margin-bottom: 1rem;
                            }
                        }
                        .input-flex {
                            flex-direction: column;
                            input {
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                        }
                        .event-button {
                            margin-top: 0;
                            .event-btn {
                                height: 40px;
                            }
                        }
                    }
                }
                .event-right {
                    margin-top: 2rem;
                    width: 100%;
                    .event-post {
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                }
            }
        }
    }
</style>