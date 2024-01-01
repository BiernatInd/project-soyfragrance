<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Skontaktuj się z nami</h1>
                <p>W razie pytań służymy pomocą</p>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="contact-content">
            <div class="contact-columns">
                <div class="contact-left">
                    <div class="contact-form">
                        <h2>Napisz do nas</h2>
                        <div class="input-flex">
                            <input type="text" v-model="formData.name" placeholder="Imię">
                            <input type="email" v-model="formData.email" placeholder="Adres E-mail">
                        </div>
                        <div class="input-full-width">
                            <input type="text" v-model="formData.subject" placeholder="Temat">
                        </div>
                        <div class="input-full-width">
                            <textarea v-model="formData.message" placeholder="Wiadomość i inne ważne informacje"></textarea>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox" v-model="formData.acceptTerms">
                            <p>Akceptuję <a href="#">politykę prywatności</a> i <a href="#">regulamin</a> sklepu. <span>(Wymagane)</span></p>
                        </div>
                        <div class="form-buttons">
                            <button class="form-btn" @click="sendForm">Wyślij</button>
                            <button class="form-btn" type="reset">Zresetuj</button>
                        </div>
                    </div>
                </div>
                <div class="contact-right">
                    <h2>Zadzwoń do nas:</h2>
                    <p>Jesteśmy dostępni pod telefonem:</p>
                    <p>Poniedziałek: 9:00 do 17:00</p>
                    <p>Wtorek – Sobota: 9:00 do 20:00</p>
                    <p>Obsługa klienta:</p>
                    <p>+48 514 515 895</p>
                    <h2>Wyślij nam wiadomość E-mail:​</h2>
                    <p>Obsługa klienta:</p>
                    <p>sklep@soyfragrance.com</p>
                    <p>Zapytania biznesowe:</p>
                    <p>kontakt@soyfragrance.com</p>
                    <h2>Dane teleadresowe:</h2>
                    <p>Soy Fragrance Wiktoria Marciniak</p>
                    <p>ul. Kochanowskiego 4/2, Żagań 68-100, woj. lubuskie</p>
                    <p>NIP: 9241920439</p>
                    <p>REGON: 522586585</p>
                </div>
            </div>
        </div>
    </div>
    <div class="map">
        <div class="map-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2477.3403484191103!2d15.30013547688419!3d51.61697430269229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4708a6a85cc761db%3A0x4950abe9869a43d!2sJana%20Kochanowskiego%204%2C%2068-100%20%C5%BBaga%C5%84!5e0!3m2!1spl!2spl!4v1701766991181!5m2!1spl!2spl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                formData: {
                    name: '',
                    email: '',
                    subject: '',
                    message: '',
                    acceptTerms: false, 
                }
            }
        },
        methods: {
            handleMenuToggle(menuActive) {
                this.isMenuActive = menuActive;
            },
            sendForm() {
                if (!this.formData.name || !this.formData.email || !this.formData.subject || !this.formData.message) {
                    alert('Wszystkie pola muszą zostać wypełnione.')
                }

                if (this.formData.acceptTerms) {
                    // Checkbox zaznaczony, możemy wysłać formularz
                    console.log("Dane do wysłania:", this.formData);
                    
                    axios.post('http://localhost:8000/api/send-form', this.formData)
                    .then(response => {
                      alert("Wiadomość została wysłana. Wkrótce się z tobą skontaktujemy!");
                      this.clearFields();
                    })
                    .catch(error => {
                      console.error(error);
                    });
                } else {
                    // Checkbox niezaznaczony, wyświetl komunikat lub podejmij odpowiednie działania
                    alert("Musisz zaakceptować politykę prywatności i regulamin sklepu.");
                }
            },
            clearFields() {
                this.formData.name = '';
                this.formData.email = '';
                this.formData.subject = '';
                this.formData.message = '';
            }
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

    .contact {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .contact-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .contact-columns {
                display: flex;
                justify-content: space-between;
                .contact-left {
                    width: 48%;
                    .contact-form {
                        background-color: var(--light-gold);
                        padding: 2rem;
                        border-radius: 25px;
                        h2 {
                            font-size: 40px;
                            color: var(--black);
                            margin-bottom: 2rem;
                        }
                        .input-flex {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 2rem;
                            input {
                                width: 48%;
                                height: 50px;
                                border: none;
                                background-color: var(--white);
                                border-radius: 25px;
                                font-size: 16px;
                                font-weight: 600;
                                padding-left: 1rem;
                            }
                        }
                        .input-full-width {
                            input {
                                width: 100%;
                                height: 50px;
                                border: none;
                                background-color: var(--white);
                                border-radius: 25px;
                                font-size: 16px;
                                font-weight: 600;
                                padding-left: 1rem;
                                margin-bottom: 2rem;
                            }
                            textarea {
                                width: 100%;
                                height: 180px;
                                border: none;
                                background-color: var(--white);
                                border-radius: 25px;
                                font-size: 16px;
                                font-weight: 600;
                                padding-top: 1rem;
                                padding-left: 1rem;
                                margin-bottom: 1rem;
                                resize: none;
                            }
                        }
                        .form-checkbox {
                            display: flex;
                            margin-bottom: 1rem;
                            input {
                                cursor: pointer;
                                width: 15px;
                                margin-right: 1rem;
                            }
                            p {
                                font-size: 16px;
                                color: var(--black);
                                font-weight: 600;
                                a {
                                    text-underline-offset: 4px;
                                    color: var(--black);
                                    transition: 0.5s;
                                    &:hover {
                                        color: var(--gold);
                                    }
                                }
                            }
                        }
                        .form-buttons {
                            .form-btn:not(:last-child) {
                                margin-right: 1rem;
                            }
                            .form-btn {
                                width: 260px;
                                height: 40px;
                                border-radius: 25px;
                                background-color: var(--gold);
                                border: 2px solid var(--gold);
                                font-size: 16px;
                                color: var(--black);
                                font-weight: 600;
                                transition: 0.5s;
                                cursor: pointer;
                                &:hover {
                                    background-color: var(--black);
                                    color: var(--gold);
                                    border: 2px solid var(--black);
                                }
                            }
                        }
                    }
                }
                .contact-right {
                    width: 48%;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    p:not(:last-child) {
                        margin-bottom: 1rem;

                    }
                    p {
                        color: var(--black);
                        font-weight: 600;
                    }
                }
            }
        }
    }

    .map {
        padding-bottom: 4rem;
        .map-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            iframe {
                border-radius: 25px;
                width: 100%;
                height: 600px;
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .contact {
            .contact-content {
                .contact-columns {
                    .contact-left {
                        .contact-form {
                            .form-buttons {
                                display: flex;
                                flex-direction: column;
                                .form-btn:not(:last-child) {
                                    margin-right: 0;
                                }
                                .form-btn:first-child {
                                    margin-bottom: 1rem;
                                }
                            }
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

        .contact {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .contact-content {
                width: 90%;
                .contact-columns {
                    flex-direction: column;
                    .contact-left {
                        width: 100%;
                        margin-bottom: 2rem;
                        .contact-form {
                            padding: 1rem;
                            h2 {
                                font-size: 32px;
                            }
                            .input-flex {
                                flex-direction: column;
                                margin-bottom: 0;
                                input {
                                    width: 100%;
                                    margin-bottom: 2rem;
                                }
                            }
                            .form-buttons {
                                .form-btn {
                                    width: 100%;
                                }
                            }
                        }
                    }
                    .contact-right {
                        width: 100%;
                        h2 {
                            font-size: 32px;
                        }
                    }
                }
            }
        }

        .map {
            .map-content {
                width: 90%;
                iframe {
                    height: 300px;
                }
            }
        }
    }

</style>