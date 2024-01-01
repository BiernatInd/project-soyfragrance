<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Resetowanie hasła</h1>
            </div>
        </div>
    </div>
    <div class="reset-password">
        <div class="reset-password-content">
            <div class="reset-password-form">
                <div class="reset-password-top">
                    <h2>Resetowanie hasła</h2>
                    <p>Prosimy o ustawienie nowego hasła dla swojego konta.</p>
                </div>
                <div class="reset-password-input">
                    <input type="password" v-model="password" placeholder="Nowe hasło">
                </div>
                <div class="reset-password-input">
                    <input type="password" v-model="confirmPassword" placeholder="Powtórz nowe hasło">
                </div>
                <div class="reset-password-button">
                    <button class="reset-password-btn" @click="resetPassword">Zresetuj hasło</button>
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

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                password: '',
                confirmPassword: '',
                token: null
            };
        },
        methods: {
        resetPassword() {

            if (!this.password || !this.confirmPassword) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Wszysktie pola muszą zostać wypełnione.');
                return;
            }

            // Weryfikacja, czy hasła są takie same
            if (this.password !== this.confirmPassword) {
                alert('Hasła nie są takie same');
                return;
            }

            // Upewnij się, że token istnieje przed wysłaniem zapytania
            if (!this.token) {
                alert('Nieprawidłowy token');
                return;
            }

            // Wysłanie zapytania do Laravela
            axios.post(`http://localhost:8000/api/reset-password/${this.token}`, {
                password: this.password
            })
            .then(response => {
                // Reakcja na poprawną odpowiedź z serwera
                alert(response.data.message);
                this.$router.push('/logowanie');
            })
            .catch(error => {
                // Reakcja na błąd
                alert('Wystąpił błąd: ' + error.response.data.message);
            });
        }
    },
    mounted() {
        // Pobranie tokenu z routera
        this.token = this.$route.params.token;
        console.log(this.token); // Dodaj to, aby sprawdzić wartość tokenu w konsoli
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
            p {
                font-size: 24px;
                color: var(--white);
                text-align: center;
            }
        }
    }
    
    .reset-password {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .reset-password-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            .reset-password-form {
                padding: 2rem;
                background-color: var(--light-gold);
                border-radius: 25px;
                width: 500px;
                .reset-password-top {
                    h2 {
                        text-align: center;
                        font-size: 40px;
                        font-weight: 600;
                        margin-bottom: 1rem;
                    }
                    p {
                        font-size: 16px;
                        margin-bottom: 1rem;
                        font-weight: 600;
                        text-align: center;
                    }
                }
                .reset-password-input {
                    display: flex;
                    flex-direction: column;
                    input {
                        margin-bottom: 1rem;
                        height: 40px;
                        border-radius: 25px;
                        border: none;
                        padding-left: 1rem;
                        font-weight: 600;
                        font-size: 16px;
                        color: var(--black);
                    }
                }
                .reset-password-recover {
                    margin-bottom: 1rem;
                    a {
                        font-size: 16px;
                        color: var(--black);
                        text-decoration: none;
                        font-weight: 600;
                    }
                }
                .reset-password-button {
                    .reset-password-btn {
                        width: 100%;
                        height: 40px;
                        background-color: var(--gold);
                        font-size: 16px;
                        font-weight: 600;
                        color: var(--black);
                        border: 2px solid var(--gold);
                        border-radius: 25px;
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            background-color: var(--black);
                            border: 2px solid var(--black);
                            color: var(--light-gold);
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
                    p {
                        text-align: start;
                        font-size: 15px;
                    }
                }
            }
        }

        .reset-password {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .reset-password-content {
                width: 90%;
                .reset-password-form {
                    width: 100%;
                    padding: 1rem;
                    .reset-password-top {
                        p {
                            text-align: center;
                        }
                        h2 {
                            font-size: 32px;
                        }
                    }
                }
            }
        }
    }
</style>