<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Rejestracja</h1>
            </div>
        </div>
    </div>
    <div class="register">
        <div class="register-content">
            <div class="register-form">
                <div class="register-top">
                    <h2>Rejestracja</h2>
                    <p>Prosimy o zarejestrowanie się, żeby kontynuować.</p>
                </div>
                <div class="register-input">
                    <input v-model="user_name" type="text" placeholder="Nazwa użytkownika" required>
                </div>
                <div class="register-input">
                    <input v-model="email" type="email" placeholder="Adres E-mail" required>
                </div>
                <div class="register-input">
                    <input v-model="password" type="password" placeholder="Hasło" required>
                </div>
                <div class="register-input">
                    <input v-model="password_confirmation" type="password" placeholder="Powtórz hasło" required>
                </div>
                <div class="register-button">
                    <button class="register-btn" @click="register">Zarejestruj się</button>
                </div>
                <div class="register-recover">
                    <router-link to="/logowanie">Masz już konto?</router-link>
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
            user_name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        async register() {

            if (!this.user_name || !this.email || !this.password || !this.password_confirmation) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Wszystkie pola muszą zostać wypełnione.');
                return;
            }

            const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!passwordRegex.test(this.password)) {
                // Hasło nie spełnia wymagań, możesz obsłużyć to odpowiednim komunikatem
                alert('Hasło musi mieć co najmniej 8 znaków, zawierać dużą literę, liczbę i jeden znak specjalny.');
                return;
            }

            if (this.password !== this.password_confirmation) {
                // Hasło i jego potwierdzenie nie pasują do siebie, wyświetl alert
                alert('Hasło do siebie nie pasują');
                return;
            }

            try {
                const response = await axios.post('http://localhost:8000/api/register', {
                    user_name: this.user_name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });
                this.$router.push('/logowanie');
                // Tutaj możesz obsłużyć odpowiedź serwera (np. wyświetlić komunikat o sukcesie)
                console.log(response.data);
            } catch (error) {
                // Tutaj możesz obsłużyć błędy (np. wyświetlić komunikat o błędzie)
                console.error(error.response.data);
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
    
    .register {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .register-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            .register-form {
                padding: 2rem;
                background-color: var(--light-gold);
                border-radius: 25px;
                width: 500px;
                .register-top {
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
                .register-input {
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
                .register-recover {
                    a {
                        font-size: 16px;
                        color: var(--black);
                        text-decoration: none;
                        font-weight: 600;
                    }
                }
                .register-button {
                    margin-bottom: 1rem;
                    .register-btn {
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

        .register {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .register-content {
                width: 90%;
                .register-form {
                    width: 100%;
                    padding: 1rem;
                    .register-top {
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