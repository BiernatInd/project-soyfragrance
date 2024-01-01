<template>
    <div class="footer-top">
        <div class="footer-top-content">
            <div class="footer-top-box-container">
                <div class="footer-top-box">
                    <div class="footer-top-box-heading">
                        <h2>O Naszej Firmie</h2>
                    </div>
                    <div class="footer-top-box-info">
                        <p>Polska marka Soy Fragrance to tak naprawdę dwójka młodych, pracowitych ludzi. Parę miesięcy zajęło nam dojście do ostatecznego produktu który dziś jest dla każdego na wyciągnięcie ręki.</p>
                    </div>
                </div>
                <div class="footer-top-box">
                    <div class="footer-top-box-heading">
                        <h2>Dane Teleadresowe</h2>
                    </div>
                    <div class="footer-top-box-info">
                        <p>Soy Fragrance Wiktoria Marciniak</p>
                        <p>ul. Kochanowskiego 4/2, Żagań 68-100, woj. lubuskie</p>
                        <p>NIP: 9241920439</p>
                        <p>REGON: 522586585</p>
                        <p>E-mail: soy.fragrance@gmail.com</p>
                        <p>Numer telefonu: 723 440 469</p>
                    </div>
                </div>
                <div class="footer-top-box">
                    <div class="footer-top-box-heading">
                        <h2>Kolekcje</h2>
                    </div>
                    <div class="footer-top-box-info">
                        <router-link :to="{ name: 'shop', params: { category_name: 'Świece sojowe', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Świece sojowe</router-link>
                        <router-link :to="{ name: 'shop', params: { category_name: 'Kominki do wosku', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Kominki do wosku</router-link>
                        <router-link :to="{ name: 'shop', params: { category_name: 'Nawilżacze powietrza', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Nawilżacze powietrza</router-link>
                        <router-link :to="{ name: 'shop', params: { category_name: 'Dyfuzory zapachowe z patyczkami', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Dyfuzory zapachowe z patyczkami</router-link>
                        <router-link :to="{ name: 'shop', params: { category_name: 'Woski zapachowe do kominka', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Woski zapachowe do kominka</router-link>
                    </div>
                </div>
                <div class="footer-top-box">
                    <div class="footer-top-box-heading">
                        <h2>Zapisz Się Na Newsletter</h2>
                    </div>
                    <div class="footer-top-box-info">
                        <p>Zapisz się do naszego newslettera, aby otrzymywać powiadomienia o wyprzedażach i nowych produktach.</p>
                    </div>
                    <div class="footer-top-box-newsletter">
                        <input type="text" v-model="newsletter" placeholder="Wprowadź E-mail">
                        <button class="newsletter-btn" @click="addNewsletter">Zapisz się</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            newsletter: '',
        }
    },
    methods: {
        addNewsletter() {

            if (!this.newsletter )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return;
            }

            let formData = new FormData();
            formData.append('email', this.newsletter);

            axios.post('http://localhost:8000/api/add-newsletter', formData, {
                headers: {
                    "Content-Type": 'multipart/form-data',
                }
            })
            .then(response => {
            // Otrzymaliśmy odpowiedź z serwera
            console.log(response.data.message);
            alert('Newsletter został wysłany, wkrótce otrzymasz kod rabatowy na podany adres E-mail.');
            this.clearFields();
            // Możesz dodać kod obsługi odpowiedzi, np. wyświetlenie komunikatu o sukcesie
        })
        .catch(error => {
            // Obsługa błędów
            console.error('Błąd podczas dodawania kategorii:', error);
            // Możesz dodać kod obsługi błędów, np. wyświetlenie komunikatu o błędzie
        });
        },

        
        clearFields() {
            // Wyczyszczenie wszystkich pól
            this.newsletter = '';
        },
    }
}
</script>

<style lang="scss" scoped>
.footer-top {
    background-color: var(--light-gold);
    padding-top: 4rem;
    padding-bottom: 4rem;
    .footer-top-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        .footer-top-box-container {
            display: flex;
            justify-content: space-between;
            .footer-top-box {
                width: 20%;
                .footer-top-box-heading {
                    margin-bottom: 1rem;
                    h2 {
                        font-size: 24px;
                        color: var(--black);
                    }
                }
                .footer-top-box-info {
                    display: flex;
                    flex-direction: column;
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                    p {
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                    }
                    a:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                    a {              
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                        text-underline-offset: 4px;
                        transition: 0.5s;
                    &:hover {
                        color: var(--gold);
                    }
                    }
                }
            }
            .footer-top-box {
                .footer-top-box-newsletter {
                    margin-top: 1rem;
                    input {
                        width: 70%;
                        height: 40px;
                        border-top-left-radius: 25px;
                        border-bottom-left-radius: 25px;
                        border: none;
                        font-size: 16px;
                        padding-left: 1rem;
                        font-weight: 600;
                        color: var(--black);
                    }
                    button {
                        width: 30%;
                        height: 40px;
                        border: none;
                        background-color: var(--gold);
                        color: var(--black);
                        font-size: 16px;
                        border-top-right-radius: 25px;
                        border-bottom-right-radius: 25px;
                        cursor: pointer;
                        font-weight: 600;
                        transition: 0.5s;
                        &:hover {
                            background-color: var(--black);
                            color: var(--gold);
                        }
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 1200px) {
    .footer-top {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .footer-top-content {
            width: 90%;
            .footer-top-box-container {
                flex-direction: column;
                .footer-top-box {
                    width: 100%;
                    .footer-top-box-heading {
                        margin-bottom: 0rem;
                        h2 {
                            margin-bottom: 1rem;
                        }
                    }
                    .footer-top-box-info {
                        p {
                            margin-bottom: 1rem;
                        }
                        a {
                        }
                        p:not(:last-child) {
                            margin-bottom: 0rem;
                        }
                        a {
                            margin-bottom: 1rem;
                        }
                    }
                }
            }
        }
    }
}
</style>
  