<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Dodawanie produktu</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-form">
                <h2>Dodawanie produktu</h2>
                <div class="input-flex">
                    <input type="text" v-model="productName" placeholder="Wprowadź nazwę produktu">
                    <input type="text" v-model="productCategory" placeholder="Wprowadź kategorię produktu">
                </div>
                <div class="input-flex">
                    <input type="number" v-model="productPrice" placeholder="Wprowadź cenę produktu">
                    <input type="number" v-model="productPromoPrice" placeholder="Wprowadź cenę promocyjną">
                </div>
                <div class="input-full-width">
                    <input type="number" v-model="productAvailability" placeholder="Wprowadź stan magazynowy">
                </div>
                <div class="event-button">
                    <button class="event-btn" @click="addProduct">Dodaj produkt</button>
                </div>
            </div>
        </div>
    </div>
    <AdminFooterBottom />
</template>

<script>
import AdminHeader from '@admin-components/admin-header.vue'
import AdminFooterBottom from '@admin-components/admin-footer-bottom.vue'    
import axios from 'axios'

    export default {
        components: {
            AdminHeader,
            AdminFooterBottom
        },
        data() {
            return {
                productName: '',
                productCategory: '',
                productPrice: '',
                productPromoPrice: '',
                productAvailability: '',
            }
        },
        methods: {
            addProduct() {

                if (!this.productName || !this.productCategory || !this.productPrice || !this.productAvailability )  {
                alert('Wszystkie pola oprócz ceny promocyjnej muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }


                let formData = new FormData();
                formData.append('name', this.productName);
                formData.append('category', this.productCategory);
                formData.append('price', this.productPrice);
                formData.append('promo_price', this.productPromoPrice);
                formData.append('availability', this.productAvailability);

                axios.post('http://localhost:8000/api/product-add', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                     },
                })
                .then(response => {
            // Otrzymaliśmy odpowiedź z serwera
            console.log(response.data.message);
            alert('Produkt dodany pomyślnie.');
            this.$router.push(`/produkt-dodaj-meta/${response.data.id}`);
            // Możesz dodać kod obsługi odpowiedzi, np. wyświetlenie komunikatu o sukcesie
        })
        .catch(error => {
            // Obsługa błędów
            console.error('Błąd podczas dodawania produktu:', error);
            // Możesz dodać kod obsługi błędów, np. wyświetlenie komunikatu o błędzie
        });
            },
            checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
        },
        mounted() {
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
            .event-form {
                width: 50%;
                background-color: var(--light-gold);
                border-radius: 15px;
                padding: 2rem;
                h2 {
                    margin-bottom: 1rem;
                    font-size: 32px;
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
                .input-flex {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 1rem;
                    input {
                        width: 48%;
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
                .event-form {
                    width: 100%;
                    padding: 1rem;
                    h2 {
                        font-size: 24px;
                        margin-bottom: 1rem;
                    }
                    .input-full-width {
                        input {
                            height: 40px;
                        }
                    }
                    .input-flex {
                        margin-bottom: 0;
                        flex-direction: column;
                        input {
                            width: 100%;
                            margin-bottom: 1rem;
                        }
                    }
                    .event-button {
                        margin-top: 1rem;
                        .event-btn {
                            height: 100%;
                                padding-top: 0.2rem;
                                padding-bottom: 0.2rem;
                        }
                    }
                }
            }
        }
    }
</style>