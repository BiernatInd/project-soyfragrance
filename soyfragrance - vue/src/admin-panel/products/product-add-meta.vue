<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Dodawanie meta tagów dla produktu</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-form">
                <h2>Dodawanie meta title i description dla produktu</h2>
                <div class="input-flex">
                    <input type="text" v-model="productTitle" placeholder="Wprowadź meta title">
                </div>
                <div class="input-flex">
                    <textarea v-model="productDescription" placeholder="Wprowadź meta description"></textarea>
                </div>
                <div class="event-button">
                    <button class="event-btn" @click="addProductMeta">Dodaj meta tagi</button>
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
            productTitle: '',
            productDescription: '',
        }
    },
    methods: {
        addProductMeta() {

            if (!this.productTitle || !this.productDescription )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        // przykład dla metaTitle
        let formData = new FormData();
        formData.append('product_title', this.productTitle);
        formData.append('product_description', this.productDescription);

        axios.post(`http://localhost:8000/api/product-add-meta/${this.$route.params.id}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
             },
        })
        .then(response => {
            console.log(response.data.message);
            alert('Meta tagi dodane pomyślnie.');
            this.$router.push(`/produkt-dodaj-zdjecia/${response.data.id}`);
        })
        .catch(error => {
            console.error('Błąd podczas dodawania meta tagów:', error);
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
            .event-form:not(:last-child) {
                margin-bottom: 2rem;
            }
            .event-form {
                width: 50%;
                background-color: var(--light-gold);
                border-radius: 15px;
                padding: 2rem;
                h2 {
                    margin-bottom: 1rem;
                    font-size: 32px;
                }
                .input-flex {
                    display: flex;
                    justify-content: space-between;
                    input {
                        width: 100%;
                        height: 40px;
                        border: none;
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                        border-radius: 15px;
                        padding-left: 1rem;
                        background-color: var(--white);
                        padding-top: 0.3rem;
                        cursor: pointer;
                        margin-bottom: 1rem;
                    }
                    textarea {
                        width: 100%;
                        height: 150px;
                        border: none;
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                        border-radius: 15px;
                        padding-left: 1rem;
                        background-color: var(--white);
                        padding-top: 1rem;
                        cursor: pointer;
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
                    .input-flex {
                        margin-bottom: 0;
                        flex-direction: column;
                        input {
                            width: 100%;
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