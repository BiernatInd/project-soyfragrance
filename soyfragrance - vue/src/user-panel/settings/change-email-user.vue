<template>
    <UserHeader />
    <div class="home">
        <div class="home-content">
            <h1>Zmiana adresu E-mail</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-left">
                <div class="event-form">
                    <h2>Zmiana adresu E-mail</h2>
                    <div class="input-full-width">
                        <input type="e-mail" v-model="newEmail" placeholder="Wprowadź adres E-mail">
                    </div>
                    <div class="input-full-width">
                        <input type="password" v-model="password" placeholder="Wprowadź hasło">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="changeEmail">Zmień adres E-mail</button>
                    </div>
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
                newEmail: '',
                password: '',
            }
        },
        methods: {
            changeEmail() {
    // Walidacja: Sprawdź, czy oba pola są wypełnione
    if (!this.newEmail || !this.password) {
        alert('Wszystkie pola muszą zostać wypełnione.');
        return;
    }

    const userId = this.$route.params.id;
    axios.put(`http://localhost:8000/api/change-email-user/${userId}`, {
        new_email: this.newEmail, // zmienione z nowy_email
        password: this.password // zmienione z haslo
    })
    .then(response => {
        console.log(response.data.message);
        alert("Adres E-mail został pomyślnie zmieniony.")
        this.clearFields()
    })
    .catch(error => {
        console.error(error.response.data.error);

        if (error.response.status === 401) {
            alert('Wprowadź poprawne hasło.'); // Możesz dostosować komunikat według potrzeb
        }
    });
},
clearFields() {
    this.newEmail = '';
    this.password = '';
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
        this.checkUserRole();
    },
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
                    .input-full-width:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                    .input-full-width {
                        input {
                            width: 100%;
                        height: 40px;
                        border: none;
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                        border-radius: 15px;
                        padding-left: 1rem;
                        }
                    }
                    .event-button {
                    margin-top: 1rem;
                    .event-btn {
                        width: 100%;
                        height: 40px;
                        border-radius: 15px;
                        background-color: var(--gold);
                        color: var(--black);
                        font-size: 16px;
                        font-weight: 600;
                        border: 2px solid var(--gold);
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            background-color: var(--black);
                            color: var(--light-gold);
                            border: 2px solid var(--black);
                        }
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