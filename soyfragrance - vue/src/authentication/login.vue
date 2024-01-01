<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Logowanie</h1>
            </div>
        </div>
    </div>
    <div class="login">
        <div class="login-content">
            <div class="login-form">
                <div class="login-top">
                    <h2>Zaloguj się</h2>
                    <p>Prosimy o wprowadzenie adresu E-mail i hasła, żeby kontynuować.</p>
                </div>
                <div class="login-input">
                    <input type="email" v-model="email" placeholder="Adres E-mail">
                </div>
                <div class="login-input">
                    <input type="password" v-model="password" placeholder="Hasło">
                </div>
                <div class="login-button">
                    <button class="login-btn" @click="login">Zaloguj się</button>
                </div>
                <div class="login-recover">
                    <router-link to="/odzyskiwanie-hasla">Nie pamiętasz hasła?</router-link>
                </div>
                <div class="login-recover">
                    <router-link to="/rejestracja">Nie masz konta?</router-link>
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
                email: '',
                password: '',
                userRole: '',
                userName: '',
            };
        },
        methods: {
            async login() {

            if (!this.email || !this.password) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Wszystkie pola muszą zostać wypełnione.');
                return;
            }

            try {
                const response = await axios.post('http://localhost:8000/api/login', {
                email: this.email,
                user_name: this.user_name,
                password: this.password,
            });

            // Po udanym zalogowaniu, zapisz informacje o zalogowanym użytkowniku w localStorage
            localStorage.setItem('isLoggedIn', 'true');

            // Zapisz rolę użytkownika w localStorage
            localStorage.setItem('userRole', response.data.user.role);
            localStorage.setItem('userName', response.data.user.user_name)

            // Tutaj możesz obsłużyć odpowiedź serwera (np. przechować token sesji)
            console.log('Zalogowano pomyślnie:', response.data);

            // Przekieruj użytkownika w zależności od roli
            if (response.data.user.role === 'admin') {
                this.$router.push('/lista-zamowien-administrator');
                } else if (response.data.user.role === 'user') {
                    this.$router.push('/lista-zamowien-uzytkownik')
                }
            } catch (error) {
                // Tutaj możesz obsłużyć błędy (np. wyświetlić komunikat o błędzie logowania)
                alert("Nieprawidłowe dane logowania. Spróbuj ponownie.")
                console.error('Błąd logowania:', error.response.data);
            }
        }
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
    
    .login {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .login-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            .login-form {
                padding: 2rem;
                background-color: var(--light-gold);
                border-radius: 25px;
                width: 500px;
                .login-top {
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
                .login-input {
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
                .login-recover:not(:last-child) {
                    margin-bottom: 1rem;
                }
                .login-recover {
                    a {
                        font-size: 16px;
                        color: var(--black);
                        text-decoration: none;
                        font-weight: 600;
                    }
                }
                .login-button {
                    .login-btn {
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
                        margin-bottom: 1rem;
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

        .login {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .login-content {
                width: 90%;
                .login-form {
                    width: 100%;
                    padding: 1rem;
                    .login-top {
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