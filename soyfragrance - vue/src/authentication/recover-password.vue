<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Odzyskiwanie hasła</h1>
            </div>
        </div>
    </div>
    <div class="recover-password">
        <div class="recover-password-content">
            <div class="recover-password-form">
                <div class="recover-password-top">
                    <h2>Odzyskiwanie hasła</h2>
                    <p>Prosimy o wprowadzenie adresu E-mail, żeby otrzymać link do zresetowania hasła.</p>
                </div>
                <div class="recover-password-input">
                    <input type="email" v-model="email" placeholder="Adres E-mail">
                </div>
                <div class="recover-password-button">
                    <button class="recover-password-btn" @click="recoverPassword">Odzyskaj hasło</button>
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
            };
        },
    methods: {
        async recoverPassword() {
            if (!this.email.trim()) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Pole musi zostać wypełnione.');
                return;
            }

            try {
                const response = await axios.post('http://localhost:8000/api/recover-password', {
                    email: this.email,
                });

                // Console.log dla celów debugowania - możesz to później usunąć
                console.log(response.data);

                // Opcjonalnie: przekieruj użytkownika na inną stronę po pomyślnym odzyskaniu hasła
                this.$router.push('/logowanie');

            } catch (error) {
                // Console.error dla celów debugowania - możesz to później usunąć
                console.error(error.response.data);
            }
        },
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
    
    .recover-password {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .recover-password-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            .recover-password-form {
                padding: 2rem;
                background-color: var(--light-gold);
                border-radius: 25px;
                width: 500px;
                .recover-password-top {
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
                .recover-password-input {
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
                .recover-password-recover {
                    margin-bottom: 1rem;
                    a {
                        font-size: 16px;
                        color: var(--black);
                        text-decoration: none;
                        font-weight: 600;
                    }
                }
                .recover-password-button {
                    .recover-password-btn {
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

        .recover-password {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .recover-password-content {
                width: 90%;
                .recover-password-form {
                    width: 100%;
                    padding: 1rem;
                    .recover-password-top {
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