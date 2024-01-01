<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Edytowanie treści</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-left">
                <div class="event-form">
                    <h2>Edytowanie nazwy produktu</h2>
                    <div class="input-flex">
                        <input type="text" v-model="newName" placeholder="Wprowadź nową nazwę produktu">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductName">Edytuj nazwę produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie kategorii produktu</h2>
                    <div class="input-flex">
                        <input type="text" v-model="newCategory" placeholder="Wprowadź nową kategorię produktu">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductCategory">Edytuj kategorię produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie ceny produktu</h2>
                    <div class="input-flex">
                        <input type="text" v-model="newPrice" placeholder="Wprowadź nową cenę produktu">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductPrice">Edytuj cenę produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie ceny promocyjnej produktu</h2>
                    <div class="input-flex">
                        <input type="text" v-model="newPromoPrice" placeholder="Wprowadź nową cenę promocyjną produktu">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductPromoPrice">Edytuj cenę promycjną produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie stanu magazynowego produktu</h2>
                    <div class="input-flex">
                        <input type="text" v-model="newAvailability" placeholder="Wprowadź nowy stan magazynowy produktu">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductAvailability">Edytuj stan magazynowy produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie meta title produktu</h2>
                    <div class="input-flex">
                        <input type="text" v-model="newTitle" placeholder="Wprowadź nowy meta title">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductTitle">Edytuj meta title produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie meta title description</h2>
                    <div class="input-flex">
                        <textarea v-model="newDescription" placeholder="Wprowadź nowy meta title"></textarea>
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductDescription">Edytuj meta description produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie krótkiego opisu produktu</h2>
                    <div class="input-flex">
                        <textarea v-model="newShortDescription" placeholder="Wprowadź nowy krótki opis produktu"></textarea>
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductShortDescription">Edytuj krótki opis produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie długiego opisu produktu</h2>
                    <div class="input-flex">
                        <textarea v-model="newLongDescription" placeholder="Wprowadź nowy długi opis produktu"></textarea>
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductLongDescription">Edytuj długi opis produktu</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie zdjęcia głównego produktu</h2>
                    <div class="input-photo-flex">
                        <input type="file" ref="newMainPhoto">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductMainPhoto">Edytuj zdjęcie główne</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie drugiego zdjęcia produktu</h2>
                    <div class="input-photo-flex">
                        <input type="file" ref="newSecondPhoto">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductSecondPhoto">Edytuj drugie zdjęcie</button>
                    </div>
                </div>
                <div class="event-form">
                    <h2>Edytowanie trzeciego zdjęcia produktu</h2>
                    <div class="input-photo-flex">
                        <input type="file" ref="newThirdPhoto">
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="editProductThirdPhoto">Edytuj trzecie zdjęcie</button>
                    </div>
                </div>
            </div>
            <div class="event-right">
                <div class="event-post">
                    <h2>Treść aktualnego produktu</h2>
                    <p>Numer: {{ product.id }}</p>
                    <p>Nazwa: {{ product.name }}</p>
                    <p>Kategoria: {{ product.category }}</p>
                    <p>Cena: {{  product.price }}</p>
                    <p>Cena promocyjna: {{  product.promo_price || 'Brak danych'}}</p>
                    <p>Stan magazynowy: {{ product.availability }}</p>
                    <p>Meta title: {{ product.product_title }}</p>
                    <p>Meta title: {{ product.product_description }}</p>
                    <p>Opis krótki: {{ product.short_description }}</p>
                    <p>Opis długi: {{ product.long_description }}</p>
                    <p>Zdjęcie produktu numer 1: {{ product.product_photo_1 }}</p>
                    <p>Zdjęcie produktu numer 2: {{ product.product_photo_2 }}</p>
                    <p>Zdjęcie produktu numer 3: {{ product.product_photo_3 }}</p>
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
                product: {}, 
                newName: '',
                newCategory: '',
                newPrice: '',
                newPromoPrice: '',
                newAvailability: '',
                newTitle: '',
                newDescription: '',
                newShortDescription: '',
                newLongDescription: '',
                newMainPhoto: '',
            }
        },
        methods: {
            async downloadProductData() {
            const productId = this.$route.params.id;
      try {
        const response = await axios.get(`http://localhost:8000/api/product-admin/${productId}`);
        this.product = response.data.product;
      } catch (error) {
        console.error('Błąd podczas pobierania danych produktu:', error);
      }
    },
    //edytowanie nazwy
    async editProductName() {

        if (!this.newName )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-name/${productId}`, {
          newName: this.newName,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Nazwa produktu została zaktualizowana pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },
    //edytowanie kategorii
    async editProductCategory() {

        if (!this.newCategory )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-category/${productId}`, {
          newCategory: this.newCategory,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Kategoria została zaktualizowana pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },
    //edytowanie ceny
    async editProductPrice() {

        if (!this.newPrice )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-price/${productId}`, {
          newPrice: this.newPrice,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Cena została zaktualizowana pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },
    //edytowanie ceny promocyjnej
    async editProductPromoPrice() {

        if (!this.newPromoPrice )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-promo-price/${productId}`, {
          newPromoPrice: this.newPromoPrice,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Cena promocyjna została zaktualizowana pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async editProductAvailability() {

        if (!this.newAvailability )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-availability/${productId}`, {
          newAvailability: this.newAvailability,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Stan magazynowy został zaktualizowany pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async editProductTitle() {

        if (!this.newTitle )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-title/${productId}`, {
            newTitle: this.newTitle,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Meta title zostało zaktualizowane pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },
    
    async editProductDescription() {

        if (!this.newDescription )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-description/${productId}`, {
            newDescription: this.newDescription,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Meta description zostało zaktualizowane pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async editProductShortDescription() {

        if (!this.newShortDescription )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-short-description/${productId}`, {
            newShortDescription: this.newShortDescription,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Opis krótki został zaktualizowany pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async editProductLongDescription() {

        if (!this.newLongDescription )  {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }

        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edit-product-long-description/${productId}`, {
            newLongDescription: this.newLongDescription,
        });

        // Aktualizacja danych produktu po edycji
        await this.downloadProductData();
        alert('Opis długi został zaktualizowany pomyślnie.');
        this.clearFields();
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },
    async editProductMainPhoto() {

    const productId = this.$route.params.id;
    const formData = new FormData();
    const fileInput = this.$refs.newMainPhoto;

    if (fileInput.files.length > 0) {
        formData.append('newMainPhoto', fileInput.files[0]);

        try {
            await axios.post(`http://localhost:8000/api/edit-product-main-photo/${productId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            this.downloadProductData(); // Odśwież dane produktu
            alert('Główne zdjęcie produktu zostało zaktualizowane pomyślnie.');
            this.clearPhotoInput(fileInput);
        } catch (error) {
            console.error('Błąd podczas aktualizacji zdjęcia:', error);
        }
    } else {
        alert('Wszystkie pola muszą zostać wypełnione.');
    }
},
async editProductSecondPhoto() {
    const productId = this.$route.params.id;
    const formData = new FormData();
    const fileInput = this.$refs.newSecondPhoto;

    if (fileInput.files.length > 0) {
        formData.append('newSecondPhoto', fileInput.files[0]);

        try {
            await axios.post(`http://localhost:8000/api/edit-product-second-photo/${productId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            this.downloadProductData(); // Odśwież dane produktu
            alert('Drugie zdjęcie produktu zostało zaktualizowane pomyślnie.');
            this.clearPhotoInput(fileInput);
        } catch (error) {
            console.error('Błąd podczas aktualizacji zdjęcia:', error);
        }
    } else {
        alert('Wszystkie pola muszą zostać wypełnione.');
    }
},
async editProductThirdPhoto() {
    const productId = this.$route.params.id;
    const formData = new FormData();
    const fileInput = this.$refs.newThirdPhoto;

    if (fileInput.files.length > 0) {
        formData.append('newThirdPhoto', fileInput.files[0]);

        try {
            await axios.post(`http://localhost:8000/api/edit-product-third-photo/${productId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            this.downloadProductData(); // Odśwież dane produktu
            alert('Trzecie zdjęcie produktu zostało zaktualizowane pomyślnie.');
            this.clearPhotoInput(fileInput);
        } catch (error) {
            console.error('Błąd podczas aktualizacji zdjęcia:', error);
        }
    } else {
        alert('Wszystkie pola muszą zostać wypełnione.');
    }
},
//Czyszczenie pól
clearFields() {
            // Wyczyszczenie wszystkich pól
            this.newName = '';
            this.newCategory ='';
            this.newPrice ='';
            this.newPromoPrice ='';
            this.newAvailability ='';
            this.newTitle ='';
            this.newDescription ='';
            this.newShortDescription ='';
            this.newLongDescription ='';
        },

        //Czyszcznie pol typu file
        clearPhotoInput(input) {
    input.value = ''; // Resetuje wartość inputu
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
            this.downloadProductData();
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
                        }
                        textarea {
                            width: 100%;
                            height: 150px;
                            padding-top: 1rem;
                            border: none;
                            font-size: 16px;
                            color: var(--black);
                            font-weight: 600;
                            border-radius: 15px;
                            padding-left: 1rem;
                        }
                    }
                    .input-photo-flex {
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
                        }
                    }
                    .input-full-width {
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;                      
                        textarea {
                            width: 100%;
                            height: 150px;
                            border: none;
                            font-size: 16px;
                            padding-top: 1rem;
                            color: var(--black);
                            font-weight: 600;
                            border-radius: 15px;
                            padding-left: 1rem;
                            resize: none;
                        }
                        input {
                            width: 100%;
                            height: 40px;
                            border: none;
                            font-size: 16px;
                            color: var(--black);
                            font-weight: 600;
                            border-radius: 15px;
                            padding-left: 1rem;
                            margin-bottom: 1rem;
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
            .event-right {
                width: 50%;
                .event-post {
                    background-color: var(--light-gold);
                    border-radius: 15px;
                    padding: 2rem;
                    h2 {
                        font-size: 32px;
                    }
                    p {
                        font-size: 20px;
                        font-weight: 600;
                        margin-top: 1rem;
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

                        .input-flex {
                            flex-direction: column;
                            input {
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                            textarea {
                                margin-bottom: 1rem;
                            }
                        }
                        .input-photo-flex {
                            flex-direction: column;
                            input {
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                        }
                        .event-button {
                            margin-top: 0;
                            .event-btn {
                                height: 100%;
                                padding-top: 0.2rem;
                                padding-bottom: 0.2rem;
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