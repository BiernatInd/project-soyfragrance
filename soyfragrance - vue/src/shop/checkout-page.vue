<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Strona zamówienia</h1>
                <p>Kontynuuj zamówienie</p>
            </div>
        </div>
    </div>
    <div class="checkout">
        <div class="checkout-content">
            <div class="checkout-left">
                <div class="checkout-delivery">
                    <div class="checkout-delivery-top">
                        <h2>Wybierz sposób dostawy</h2>
                    </div>
                    <div class="checkout-delivery-option" v-for="(delivery, index) in deliveryOptions" :key="index" :class="{ active: delivery.selected }" @click="selectDelivery(index)">
                        <input type="checkbox" v-model="delivery.selected">
                        <p>{{ delivery.name }}</p>
                    </div>
                </div>
                <div class="checkout-person">
                    <div class="checkout-person-top">
                        <h2>Kupujesz jako</h2>
                    </div>
                    <div class="checkout-person-option" v-for="(option, index) in orderOptions" :key="index" :class="{ active: option.selected }" @click="selectOrderOption(index)">
                        <input type="checkbox" v-model="option.selected">
                        <p>{{ option.name }}</p>
                    </div>
                </div>
                <div class="checkout-private" :class="{ active: orderOptions[1].selected }">
                    <div class="checkout-private-top">
                        <h2>Adres dostawy</h2>
                    </div>
                    <div class="checkout-private-form">
                        <div class="input-flex">
                            <input type="text" placeholder="Imię" v-model="privatePersonFormData.name">
                            <input type="text" placeholder="Nazwisko" v-model="privatePersonFormData.surname">
                        </div>
                        <div class="input-flex">
                            <input type="email" placeholder="Adres E-mail" v-model="privatePersonFormData.email">
                            <input type="text" placeholder="Numer telefonu" v-model="privatePersonFormData.phone" @input="() => handlePhoneInput(privatePersonFormData)">
                        </div>
                        <div class="input-flex">
                            <select v-model="privatePersonFormData.country">
                                <option value="Polska">Polska</option>
                                <option value="Austria">Austria</option>
                                <option value="Belgia">Belgia</option>
                                <option value="Bułgaria">Bułgaria</option>
                                <option value="Chorwacja">Chorwacja</option>
                                <option value="Cypr">Cypr</option>
                                <option value="Czechy">Czechy</option>
                                <option value="Dania">Dania</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Finlandia">Finlandia</option>
                                <option value="Francja">Francja</option>
                                <option value="Grecja">Grecja</option>
                                <option value="Hiszpania">Hiszpania</option>
                                <option value="Holandia">Holandia</option>
                                <option value="Irlandia">Irlandia</option>
                                <option value="Litwa">Litwa</option>
                                <option value="Luksemburg">Luksemburg</option>
                                <option value="Łotwa">Łotwa</option>
                                <option value="Malta">Malta</option>
                                <option value="Niemcy">Niemcy</option>
                                <option value="Portugalia">Portugalia</option>
                                <option value="Rumunia">Rumunia</option>
                                <option value="Słowacja">Słowacja</option>
                                <option value="Słowenia">Słowenia</option>
                                <option value="Szwecja">Szwecja</option>
                                <option value="Węgry">Węgry</option>
                                <option value="Włochy">Włochy</option>
                            </select>
                            <input type="text" placeholder="Ulica i numer domu / mieszkania" v-model="privatePersonFormData.street_and_house_number">
                        </div>
                        <div class="input-flex">
                            <input type="text" placeholder="Miejscowość" v-model="privatePersonFormData.place">
                            <input type="text" placeholder="Kod pocztowy" v-model="privatePersonFormData.postal_code" @input="() => handlePostalCodeInput(false)">
                        </div>
                    </div>
                </div>
                <div class="checkout-invoice" :class="{ active: orderOptions[1].selected }">
                    <div class="checkout-invoice-top">
                        <h2>Dane do faktury?</h2>
                        <p>W naszym sklepie internetowym dowodem zakupu jest faktura. Standardowo wystawiamy ją na dane z adresu dostawy.</p>
                    </div>
                    <div class="checkout-invoice-option" :class="{ active: showInvoiceForm }">
                        <input type="checkbox" v-model="showInvoiceForm">
                        <p>Chcę podać inne dane do faktury</p>
                    </div>
                    <div class="checkout-invoice-form" :class="{ active: showInvoiceForm }">
                        <div class="input-flex">
                            <input type="text" placeholder="Imię" v-model="privatePersonFormData.invoice_name">
                            <input type="text" placeholder="Nazwisko" v-model="privatePersonFormData.invoice_surname">
                        </div>
                        <div class="input-flex">
                            <input type="text" placeholder="Ulica i numer domu / mieszkania" v-model="privatePersonFormData.invoice_street_and_house_number">
                            <input type="text" placeholder="Miejscowość" v-model="privatePersonFormData.invoice_place">
                        </div>
                        <div class="input-full-width">
                            <input type="text" placeholder="Kod pocztowy" v-model="privatePersonFormData.invoice_postal_code" @input="() => handlePostalCodeInput(true)">
                        </div>
                    </div>
                </div>
                <div class="checkout-company" :class="{ active: orderOptions[1].selected }">
                    <div class="checkout-company-form">
                        <div class="checkout-company-top">
                            <h2>Dane do faktury</h2>
                        </div>
                        <div class="checkout-company-form-content">
                            <div class="input-flex">
                                <input type="text" placeholder="NIP" v-model="companyFormData.nip">
                                <input type="text" placeholder="Nazwa Firmy" v-model="companyFormData.company_name">
                            </div>
                            <div class="input-flex">
                                <input type="text" placeholder="Ulica i numer domu / mieszkania" v-model="companyFormData.street_and_house_number">
                                <input type="text" placeholder="Miejscowość" v-model="companyFormData.place">
                            </div>
                            <div class="input-full-width">
                                <input type="text" placeholder="Kod pocztowy" v-model="companyFormData.postal_code" @input="() => handlePostalCodeInput(false, true)">
                            </div>
                        </div>
                    </div>
                    <div class="checkout-company-form">
                        <div class="checkout-company-top">
                            <h2>Adres dostawy</h2>
                        </div>
                        <div class="checkout-company-form-content">
                            <div class="input-flex">
                                <input type="text" placeholder="Imię" v-model="companyFormData.invoice_name">
                                <input type="text" placeholder="Nazwisko" v-model="companyFormData.invoice_surname">
                            </div>
                            <div class="input-flex">
                                <input type="email" placeholder="Adres E-mail" v-model="companyFormData.invoice_email">
                                <input type="text" placeholder="Numer telefonu" v-model="companyFormData.invoice_phone" @input="() => handlePhoneInput(companyFormData, true)">
                            </div>
                            <div class="input-flex">
                                <select v-model="companyFormData.invoice_country">
                                    <option value="Polska">Polska</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Belgia">Belgia</option>
                                    <option value="Bułgaria">Bułgaria</option>
                                    <option value="Chorwacja">Chorwacja</option>
                                    <option value="Cypr">Cypr</option>
                                    <option value="Czechy">Czechy</option>
                                    <option value="Dania">Dania</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Finlandia">Finlandia</option>
                                    <option value="Francja">Francja</option>
                                    <option value="Grecja">Grecja</option>
                                    <option value="Hiszpania">Hiszpania</option>
                                    <option value="Holandia">Holandia</option>
                                    <option value="Irlandia">Irlandia</option>
                                    <option value="Litwa">Litwa</option>
                                    <option value="Luksemburg">Luksemburg</option>
                                    <option value="Łotwa">Łotwa</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Niemcy">Niemcy</option>
                                    <option value="Portugalia">Portugalia</option>
                                    <option value="Rumunia">Rumunia</option>
                                    <option value="Słowacja">Słowacja</option>
                                    <option value="Słowenia">Słowenia</option>
                                    <option value="Szwecja">Szwecja</option>
                                    <option value="Węgry">Węgry</option>
                                    <option value="Włochy">Włochy</option>
                                </select>
                            <input type="text" placeholder="Ulica i numer domu / mieszkania" v-model="companyFormData.invoice_street_and_house_number">
                        </div>
                        <div class="input-flex">
                            <input type="text" placeholder="Miejscowość" v-model="companyFormData.invoice_place">
                            <input type="text" placeholder="Kod pocztowy" v-model="companyFormData.invoice_postal_code" @input="() => handlePostalCodeInput(true, true)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-payments">
                    <div class="checkout-payments-top">
                        <h2>Płatność</h2>
                    </div>
                    <div class="checkout-payments-option"  v-for="(payment, index) in paymentOptions" :key="index" :class="{ active: payment.selected }" @click="selectPayment(index)">
                        <input type="checkbox" v-model="payment.selected">
                        <p>{{ payment.name }}</p>
                    </div>
                </div>
                <div class="checkout-terms">
                    <div class="checkout-terms-top">
                        <h2>Zgody i oświadczenia</h2>
                    </div>
                    <div class="checkout-terms-option">
                        <input type="checkbox" checked>
                        <p>Akceptuję <a href="#">politykę prywatności</a> i <a href="#">regulamin</a> sklepu. (Wymagane)</p>
                    </div>
                </div>
            </div>
            <div class="checkout-right">
                <div class="shopping-bag-summary">
                    <div class="shopping-bag-summary-top">
                        <h2>Podsumowanie</h2>
                    </div>
                    <div class="shopping-bag-promo">
    <input type="text" placeholder="Wprowadź kod rabatowy" v-model="discountCode">
    <button class="shopping-bag-promo-btn" @click="checkDiscountCode">Aktywuj</button>
  </div>
                    <div class="shopping-bag-price">
                        <p>Koszyk:</p>
                        <p>{{ totalPriceBasket() }} zł</p>
                    </div>
                    <div class="shopping-bag-price">
                        <p>Dostawa:</p>
                        <p>{{ totalPriceDelivery() }} zł</p>
                    </div>
                    <div v-if="discountRate > 0" class="shopping-bag-price-promo">
    <p>Zniżka:</p>
    <p>{{ calculateDiscountAmount() }} zł</p>
</div>
                    <div class="shopping-bag-price">
                        <p>Łączna kwota:</p>
                        <p>{{ calculateTotalPrice() }} zł</p>
                    </div>
                    <div class="shopping-bag-button">
                        <button class="shopping-bag-btn" @click="sendForm">Przejdź do płatności</button>
                        <button class="shopping-bag-btn" @click="continueShopping">Kontynuuj zakupy</button>
                    </div>
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
import { mapState, mapGetters } from 'vuex';

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                //dostawa
                deliveryOptions: [
                    { name: "Kurier Inpost: 14.40 zł", price: 14.40, selected: true },
                    { name: "Kurier UPS: 22.50 zł", price: 22.50, selected: false },
                    { name: "Kurier FedEx: 19.90 zł", price: 19.90, selected: false },
                    { name: "Kurier Pocztex: 12.20 zł", price: 12.20, selected: false },
                    { name: "Kurier Inpost za pobraniem: 21.00 zł", price: 21.00, selected: false },
                    { name: "Kurier Pocztex za pobraniem: 16.70 zł", price: 16.70, selected: false },
                    { name: "Paczkomaty Inpost: 13.80 zł", price: 13.80, selected: false },
                    { name: "Odbiór osobisty: 0.00 zł", price: 0.00, selected: false },
                ],
                //Wybór formularza
                orderOptions: [
                    { name: "Osoba prywatna", selected: true },
                    { name: "Firma", selected: false },
                ],
                paymentOptions: [
                    { name: "Płatność za pomocą PayU", selected: true },
                    { name: "Przelew bankowy", selected: false },
                ],
                showInvoiceForm: false,
                privatePersonFormData: {
                    name: '',
                    surname: '',
                    email: '',
                    phone: '',
                    country: 'Polska',
                    street_and_house_number: '',
                    place: '',
                    postal_code: '',
                    invoice_name: '',
                    invoice_surname: '',
                    invoice_street_and_house_number: '',
                    invoice_place: '',
                    invoice_postal_code: '',
                },
                companyFormData: {
                    nip: '',
                    company_name: '',
                    street_and_house_number: '',
                    place: '',
                    postal_code: '',
                    invoice_name: '',
                    invoice_surname: '',
                    invoice_email: '',
                    invoice_phone: '',
                    invoice_country: 'Polska',
                    invoice_street_and_house_number: '',
                    invoice_place: '',
                    invoice_postal_code: '',
                },
                discountCode: '',
                discountRate: 0,
                addressSelected: false,
            }
        },
        methods: {
            privatePersonForm() {
            if (this.orderOptions[0].selected) {

                //Walidacja
                if ( !this.privatePersonFormData.name || !this.privatePersonFormData.surname || !this.privatePersonFormData.email || !this.privatePersonFormData.phone || !this.privatePersonFormData.country || !this.privatePersonFormData.street_and_house_number || !this.privatePersonFormData.place || !this.privatePersonFormData.postal_code ) 
                {
                    // Wyświetl alert, gdy któreś pole jest puste
                    alert("Wszystkie pola muszą zostać wypełnione.");
                    return; // Przerwij funkcję, jeśli pola są niekompletne
                }

                //Walidacja dla dodatkowe formularza
                if (this.showInvoiceForm) {
                    if ( !this.privatePersonFormData.invoice_name || !this.privatePersonFormData.invoice_surname || !this.privatePersonFormData.invoice_street_and_house_number || !this.privatePersonFormData.invoice_place || !this.privatePersonFormData.invoice_postal_code ) 
                    {
                        // Wyświetl alert, gdy któreś pole faktury jest puste
                        alert("Wszystkie pola muszą zostać wypełnione.");
                        return; // Przerwij funkcję, jeśli pola faktury są niekompletne
                    }
                }

                const selectedDelivery = this.deliveryOptions.find(delivery => delivery.selected);

                const purchasedProducts = this.cartItems.map(item => `${item.name} (x${item.quantity})`).join(', ');

                const selectedPayment = this.paymentOptions.find(payment => payment.selected);

                const formData = {
                    name: this.privatePersonFormData.name,
                    surname: this.privatePersonFormData.surname,
                    email: this.privatePersonFormData.email,
                    phone: this.privatePersonFormData.phone,
                    country: this.privatePersonFormData.country,
                    street_and_house_number: this.privatePersonFormData.street_and_house_number,
                    place: this.privatePersonFormData.place,
                    postal_code: this.privatePersonFormData.postal_code,
                    invoice_name: this.privatePersonFormData.invoice_name,
                    invoice_surname: this.privatePersonFormData.invoice_surname,
                    invoice_street_and_house_number: this.privatePersonFormData.invoice_street_and_house_number,
                    invoice_place: this.privatePersonFormData.invoice_place,
                    invoice_postal_code: this.privatePersonFormData.invoice_postal_code,
                    total_price: this.calculateTotalPrice(),
                    delivery: selectedDelivery ? selectedDelivery.name : null,
                    purchased_products: purchasedProducts,
                    order_number: this.generateOrderNumber(),
                    payment: selectedPayment ? selectedPayment.name : null,
                    discount: this.discountRate, // Dodaj tę linię
                    entered_promo_code: this.discountCode,
                    user_name: localStorage.getItem('userName')
                    // Add other form fields as needed
                };

                console.log('Form Data:', formData);

                this.$store.dispatch('setOrderData', formData);

                this.$store.dispatch('updateProductAvailability', purchasedProducts);

                // Send data to the backend using Axios
                axios.post('https://soyfragrance.pl/server/api/order-private-person', formData)
                .then(response => {
                    // Handle success
                    console.log(response.data.message);

                    const isPayUSelected = this.paymentOptions.some(payment => payment.selected && payment.name === "Płatność za pomocą PayU");
        if (isPayUSelected) {
            this.initiatePaymentPrivate({ /* tutaj przekazujesz odpowiednie dane płatności */ });
            this.clearCart();
            // Możesz tutaj także dodać jakąś logikę potwierdzającą złożenie zamówienia przed inicjowaniem płatności.
        } else {
            this.clearCart();
            this.$router.push('/podziekowanie-za-zamowienie');
        } })
                .catch(error => {
                    // Handle error, e.g., show validation errors
                    if (error.response.status === 422) {
                      console.error('Validation Errors:', error.response.data.errors);
                    } else {
                      console.error('Error submitting form:', error);
                    }
                });
            }
        },
        //czysczenie koszyka
        clearCart() {
      this.$store.dispatch('clearCart'); // Assuming you have a clearCart action in your store
    },

    companyForm() {
    if (this.orderOptions[1].selected) {

        //Walidacja
        if ( !this.companyFormData.nip || !this.companyFormData.company_name || !this.companyFormData.street_and_house_number || !this.companyFormData.place || !this.companyFormData.postal_code || !this.companyFormData.invoice_name || !this.companyFormData.invoice_surname || !this.companyFormData.invoice_email || !this.companyFormData.invoice_phone || !this.companyFormData.invoice_country || !this.companyFormData.invoice_street_and_house_number || !this.companyFormData.invoice_place || !this.companyFormData.invoice_postal_code) 
                {
                    // Wyświetl alert, gdy któreś pole jest puste
                    alert("Wszystkie pola muszą zostać wypełnione.");
                    return; // Przerwij funkcję, jeśli pola są niekompletne
                }

        const selectedDelivery = this.deliveryOptions.find(delivery => delivery.selected);
        const purchasedProducts = this.cartItems.map(item => `${item.name} (x${item.quantity})`).join(', ');
        const selectedPayment = this.paymentOptions.find(payment => payment.selected);

        const formData = {
            nip: this.companyFormData.nip,
            company_name: this.companyFormData.company_name,
            street_and_house_number: this.companyFormData.street_and_house_number,
            place: this.companyFormData.place,
            postal_code: this.companyFormData.postal_code,
            invoice_name: this.companyFormData.invoice_name,
            invoice_surname: this.companyFormData.invoice_surname,
            invoice_email: this.companyFormData.invoice_email,  // <-- Corrected property name
            invoice_phone: this.companyFormData.invoice_phone,  // <-- Corrected property name
            invoice_country: this.companyFormData.invoice_country,
            invoice_street_and_house_number: this.companyFormData.invoice_street_and_house_number,
            invoice_place: this.companyFormData.invoice_place,
            invoice_postal_code: this.companyFormData.invoice_postal_code,
            total_price: this.calculateTotalPrice(),
            delivery: selectedDelivery ? selectedDelivery.name : null,
            purchased_products: purchasedProducts,
            order_number: this.generateOrderNumber(),
            payment: selectedPayment ? selectedPayment.name : null,
            discount: this.discountRate, // Dodaj tę linię
            entered_promo_code: this.discountCode,
            user_name: localStorage.getItem('userName')
            // Add other form fields as needed
        };

        console.log('Form Data:', formData);

        this.$store.dispatch('setOrderData', formData);

        this.$store.dispatch('updateProductAvailability', purchasedProducts);

        // Send data to the backend using Axios
        axios.post('https://soyfragrance.pl/server/api/order-company', formData)  // <-- Corrected API endpoint
            .then(response => {
                // Handle success
                console.log(response.data.message);
              
                const isPayUSelected = this.paymentOptions.some(payment => payment.selected && payment.name === "Płatność za pomocą PayU");
        if (isPayUSelected) {
            this.initiatePaymentCompany({ /* tutaj przekazujesz odpowiednie dane płatności */ });
            this.clearCart();
            // Możesz tutaj także dodać jakąś logikę potwierdzającą złożenie zamówienia przed inicjowaniem płatności.
        } else {
            this.clearCart();
            this.$router.push('/podziekowanie-za-zamowienie');
        } })
            .catch(error => {
                // Handle error, e.g., show validation errors
                if (error.response.status === 422) {
                    console.error('Validation Errors:', error.response.data.errors);
                } else {
                    console.error('Error submitting form:', error);
                }
            });
    }
},
        sendForm() {

            if (this.cartItems.length === 0) {
                alert("Koszyk jest pusty. Produkty muszą zostać dodane przed złożeniem zamówienia.");
                return;
            }

            this.privatePersonForm();
            this.companyForm();
        },
        //dostawa
        selectDelivery(index) {
            this.deliveryOptions.forEach((delivery, i) => {
                delivery.selected = i === index;
            });
        },
        //Wybór formularza
        selectOrderOption(index) {
            this.orderOptions.forEach((option, i) => {
              option.selected = i === index;
            });
        },
        //Wybór płatności
        selectPayment(index) {
            this.paymentOptions.forEach((payment, i) => {
                payment.selected = i === index;
            });
        },
        //kalkulacja ceny calkowitej
        calculateTotalPrice() {
        const selectedDelivery = this.deliveryOptions.find(delivery => delivery.selected);
        const deliveryPrice = selectedDelivery ? selectedDelivery.price : 0;
        const cartTotal = this.cartItems.reduce((total, item) => total + item.price * item.quantity, 0);

        // Suma ceny produktów i dostawy
        const totalBeforeDiscount = cartTotal + deliveryPrice;

        // Oblicz rabat i zastosuj go do całkowitej kwoty (cena produktów + dostawa)
        const discountAmount = (totalBeforeDiscount * this.discountRate) / 100;
        const totalWithDiscount = totalBeforeDiscount - discountAmount;

        return totalWithDiscount.toFixed(2); // Formatuj do dwóch miejsc po przecinku
    },
        //cena produktow w koszyku
        totalPriceBasket() {
            // Oblicz sumę częściową na podstawie przedmiotów w koszyku
            return this.cartItems.reduce((subtotal, item) => subtotal + item.price * item.quantity, 0);
        },

        //Cena dostawy w koszyku
        totalPriceDelivery() {
    const selectedDelivery = this.deliveryOptions.find(delivery => delivery.selected);
    return selectedDelivery ? selectedDelivery.price : 0;
},

            //generowanie numeru zamowienia
        generateOrderNumber() {
            // Generowanie losowych liter (w tym cyfr) o długości 8
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let randomString = '';
            for (let i = 0; i < 8; i++) {
                randomString += characters.charAt(Math.floor(Math.random() * characters.length));
            }

            // Pobieranie bieżącej daty
            const now = new Date();
            const year = now.getFullYear().toString();
            const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Miesiące są indeksowane od 0
            const day = now.getDate().toString().padStart(2, '0');

            // Łączenie losowego ciągu i sformatowanej daty
            const orderNumber = `${randomString}/${day}-${month}-${year}`;

            return orderNumber;
        },

        //walidacja pól phone
        phoneInputValidation(formData, isCompany) {
            // Pobierz aktualną wartość pola numeru telefonu
            let phoneNumber = isCompany ? formData.invoice_phone : formData.phone;

            // Usuń wszystkie znaki niebędące cyframi
            phoneNumber = phoneNumber.replace(/\D/g, '');

            // Zaktualizuj wartość pola numeru telefonu odpowiedniego formularza
            if (isCompany) {
              formData.invoice_phone = phoneNumber;
            } else {
              formData.phone = phoneNumber;
            }
        },

        handlePhoneInput(formData, isCompany = false) {
            this.phoneInputValidation(formData, isCompany);
        },

        //walidacja pól postal code
        validatePostalCode(postalCode, isInvoice = false, isCompany = false) {
        // Maksymalna długość kodu pocztowego
        const maxLength = 6;

        // Usuń wszystkie znaki niebędące cyframi ani myslnikiem
        const sanitizedPostalCode = postalCode.replace(/[^0-9-]/g, '');

        // Ogranicz długość do maksymalnej wartości
        const truncatedPostalCode = sanitizedPostalCode.slice(0, maxLength);

        // Aktualizuj wartość pola odpowiedniego formularza
        if (isCompany) {
            if (isInvoice) {
                this.companyFormData.invoice_postal_code = truncatedPostalCode;
            } else {
                this.companyFormData.postal_code = truncatedPostalCode;
            }
        } else {
            if (isInvoice) {
                this.privatePersonFormData.invoice_postal_code = truncatedPostalCode;
            } else {
                this.privatePersonFormData.postal_code = truncatedPostalCode;
            }
        }
    },

    handlePostalCodeInput(isInvoice = false, isCompany = false) {
        const formData = isCompany ? this.companyFormData : this.privatePersonFormData;
        const postalCodeField = isInvoice ? 'invoice_postal_code' : 'postal_code';
        this.validatePostalCode(formData[postalCodeField], isInvoice, isCompany);
    },
        
    //kontynuuj zakupy
    continueShopping() {
            this.$router.push({ 
                name: 'shop', 
                params: { 
                    category_name: 'Świece sojowe', 
                    page: 1 
                }
            });
        },
        //kod rabatowy
        checkDiscountCode() {
    axios.post('http://localhost:8000/api/check-promo-code', { promo_code: this.discountCode })
        .then(response => {
            if (response.data.success) {
                alert(`${response.data.message} Rabat: ${response.data.discount}%`);
                this.discountRate = response.data.discount;

                // Zapisz kod rabatowy w localStorage
                localStorage.setItem('discountCode', this.discountCode);
                localStorage.setItem('discountRate', this.discountRate.toString());
            } else {
                alert(response.data.message);
                this.discountRate = 0;
                localStorage.removeItem('discountCode');
                localStorage.removeItem('discountRate');
            }
        })
        .catch(error => {
            console.error('There was an error!', error);
        });
},
    //obliczanie znizki do wyswietlenia
    calculateDiscountAmount() {
    const cartTotal = this.totalPriceBasket();
    const deliveryPrice = this.selectedDeliveryPrice();
    const totalBeforeDiscount = cartTotal + deliveryPrice;

    // Oblicz rabat i zastosuj go do całkowitej kwoty (cena produktów + dostawa)
    const discountAmount = (totalBeforeDiscount * this.discountRate) / 100;
    return discountAmount.toFixed(2);
},
//obliczanie kosztu dostawy
selectedDeliveryPrice() {
    const selectedDelivery = this.deliveryOptions.find(delivery => delivery.selected);
    return selectedDelivery ? selectedDelivery.price : 0;
}, 
        },
        computed: {
            ...mapGetters(['getCartItems']),
            // ... other computed properties
            cartItems() {
              return this.$store.getters.getCartItems;
            },
        },
        mounted() {
    let storedDiscountCode = localStorage.getItem('discountCode');
    let storedDiscountRate = localStorage.getItem('discountRate');

    if (storedDiscountCode && storedDiscountRate) {
        this.discountCode = storedDiscountCode;
        this.discountRate = parseFloat(storedDiscountRate);

        // Możesz też ponownie zweryfikować kod tutaj, jeśli to konieczne
    }

    console.log('Cart Items in Checkout Page:', this.getCartItems);
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

    .checkout {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .checkout-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .checkout-left {
                width: 70%;
                .checkout-delivery {
                    border-radius: 25px;
                    border: 1px solid var(--shadow);
                    margin-bottom: 2rem;
                    .checkout-delivery-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .checkout-delivery-option.active {
                        background-color: var(--white);
                    }
                    .checkout-delivery-option:last-child {
                        border-bottom-left-radius: 25px;
                        border-bottom-right-radius: 25px;
                    }
                     .checkout-delivery-option {
                        display: flex;
                        padding: 1rem;
                        cursor: pointer;
                        background-color: var(--light-gold);
                        input {
                            margin-right: 1rem;
                        }
                        input[type="checkbox"] {
                            cursor: pointer;
                            accent-color: var(--gold);
                        }
                        p {
                            font-size: 16px;
                            font-weight: 600;
                        }
                    }
                }

                .checkout-person {
                    border: 1px solid var(--shadow);
                    border-radius: 25px;
                    margin-bottom: 2rem;
                    .checkout-person-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .checkout-person-option:last-child {
                        border-bottom-left-radius: 25px;
                        border-bottom-right-radius: 25px;
                    }
                    .checkout-person-option {
                        padding: 1rem;
                        display: flex;
                        background-color: var(--light-gold);
                        cursor: pointer;
                        input {
                            margin-right: 1rem;
                        }
                        input[type="checkbox"] {
                            cursor: pointer;
                            accent-color: var(--gold);
                        }
                        p {
                            font-size: 16px;
                            font-weight: 600;
                        }
                    }
                    .checkout-person-option.active {
                        background-color: var(--white);
                    }
                }
                .checkout-private {
                    border: 1px solid var(--shadow);
                    border-radius: 25px;
                    margin-bottom: 2rem;
                    &.active {
                        display: none;
                    }
                    .checkout-private-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .checkout-private-form {
                        border-bottom-left-radius: 25px;
                        border-bottom-right-radius: 25px;
                        background-color: var(--light-gold);
                        .input-flex:first-child {
                            padding: 1rem;
                        }
                        .input-flex {
                            display: flex;
                            justify-content: space-between;
                            padding-bottom: 1rem;
                            padding-left: 1rem;
                            padding-right: 1rem;
                            input {
                                width: 45%;
                                height: 50px;
                                font-size: 16px;
                                border: none;
                                background-color: var(--white);
                                font-weight: 600;
                                color: var(--black);
                                padding-left: 1rem;
                                border-radius: 25px;
                            }
                            select {
                                width: 45%;
                                height: 50px;
                                font-size: 16px;
                                border: none;
                                background-color: var(--white);
                                font-weight: 600;
                                color: var(--black);
                                padding-left: 1rem;
                                border-radius: 25px;
                                border-right: 16px solid var(--white);
                                cursor: pointer;
                                option {
                                    background-color: var(--white);
                                    font-weight: 600;
                                }
                            } 
                        }
                    }
                }
                .checkout-invoice {
                    border-radius: 25px;
                    border: 1px solid var(--shadow);
                    margin-bottom: 2rem;
                    display: block;
                    &.active {
                        display: none;
                    }
                    .checkout-invoice-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                        p {
                            color: var(--black);
                            font-weight: 600;
                        }
                    }
                    .checkout-invoice-option {
                        display: flex;
                        padding: 1rem;
                        cursor: pointer;
                        background-color: var(--light-gold);
                        border-bottom-left-radius: 25px;
                        border-bottom-right-radius: 25px;
                        input {
                            margin-right: 1rem;
                        }
                        input[type="checkbox"] {
                            cursor: pointer;
                            accent-color: var(--gold);
                        }
                        p {
                            font-size: 20px;
                            font-weight: 600;
                        }
                        &.active {
                            border-bottom-left-radius: 0;
                            border-bottom-right-radius: 0;
                        }
                    }
                    .checkout-invoice-form {
                        background-color: var(--light-gold);
                        display: none;
                        &.active {
                            display: block;
                        }
                        .input-flex {
                            display: flex;
                            justify-content: space-between;
                            padding-bottom: 1rem;
                            padding-left: 1rem;
                            padding-right: 1rem;
                            input {
                                width: 45%;
                                height: 50px;
                                font-size: 16px;
                                border: none;
                                background-color: var(--white);
                                font-weight: 600;
                                color: var(--black);
                                padding-left: 1rem;
                                border-radius: 25px;
                            }
                        }
                        .input-full-width {
                            padding-left: 1rem;
                            padding-right: 1rem;
                            padding-bottom: 1rem;
                            input {
                                width: 100%;
                                height: 50px;
                                font-size: 16px;
                                border: none;
                                background-color: var(--white);
                                font-weight: 600;
                                color: var(--black);
                                padding-left: 1rem;
                                border-radius: 25px;
                            }
                        }
                    }
                }
                .checkout-company {
                    border-radius: 25px;
                    margin-bottom: 2rem;
                    display: none;
                    &.active {
                        display: block;
                    }
                    .checkout-company-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .checkout-company-form {
                        background-color: var(--light-gold);
                        border: 1px solid var(--shadow);
                        margin-top: 2rem;
                        border-radius: 25px;
                        .checkout-company-form-content {
                            .input-flex:first-child {
                                padding: 1rem;
                            }
                            .input-flex {
                                display: flex;
                                justify-content: space-between;
                                padding-bottom: 1rem;
                                padding-left: 1rem;
                                padding-right: 1rem;
                                input {
                                    width: 45%;
                                    height: 50px;
                                    font-size: 16px;
                                    border: none;
                                    background-color: var(--white);
                                    font-weight: 600;
                                    color: var(--black);
                                    padding-left: 1rem;
                                    border-radius: 25px;
                                }
                                select {
                                    width: 45%;
                                    height: 50px;
                                    font-size: 16px;
                                    border: none;
                                    background-color: var(--white);
                                    font-weight: 600;
                                    color: var(--black);
                                    padding-left: 1rem;
                                    border-radius: 25px;
                                    border-right: 16px solid var(--white);
                                    cursor: pointer;
                                    option {
                                        background-color: var(--white);
                                        font-weight: 600;
                                    }
                                } 
                            }
                            .input-full-width {
                                padding-left: 1rem;
                                padding-right: 1rem;
                                padding-bottom: 1rem;
                                input {
                                    width: 100%;
                                    height: 50px;
                                    font-size: 16px;
                                    border: none;
                                    background-color: var(--white);
                                    font-weight: 600;
                                    color: var(--black);
                                    padding-left: 1rem;
                                    border-radius: 25px;
                                }
                            }
                        }

                    }
                }
                .checkout-payments {
                    border-radius: 25px;
                    border: 1px solid var(--shadow);
                    margin-bottom: 2rem;
                    .checkout-payments-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .checkout-payments-option.active {
                        background-color: var(--white);
                    }
                    .checkout-payments-option:last-child {
                        border-bottom-left-radius: 25px;
                        border-bottom-right-radius: 25px;
                    }
                     .checkout-payments-option {
                        display: flex;
                        padding: 1rem;
                        cursor: pointer;
                        background-color: var(--light-gold);
                        input {
                            margin-right: 1rem;
                        }
                        input[type="checkbox"] {
                            cursor: pointer;
                            accent-color: var(--gold);
                        }
                        p {
                            font-size: 16px;
                            font-weight: 600;
                        }
                    }
                }
                .checkout-terms {
                    border-radius: 25px;
                    border: 1px solid var(--shadow);
                    .checkout-terms-top {
                        background-color: var(--gold);
                        border-top-left-radius: 25px;
                        border-top-right-radius: 25px;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .checkout-terms-option.active {
                        background-color: var(--white);
                    }
                     .checkout-terms-option {
                        display: flex;
                        padding: 1rem;
                        cursor: pointer;
                        background-color: var(--light-gold);
                        border-bottom-left-radius: 25px;
                        border-bottom-right-radius: 25px;
                        input {
                            margin-right: 1rem;
                        }
                        input[type="checkbox"] {
                            cursor: pointer;
                            accent-color: var(--gold);
                        }
                        p {
                            font-size: 16px;
                            font-weight: 600;
                            a {
                                color: var(--black);
                                text-underline-offset: 4px;
                                transition: 0.5s;
                                &:hover {
                                    color: var(--gold);
                                }
                            }
                        }
                    }
                }
            }
            .checkout-right {
                width: 25%;
                right: 0;
                .shopping-bag-summary {
                    background-color: var(--light-gold);
                    border-radius: 25px;
                    .shopping-bag-summary-top {
                        border-bottom: 1px solid var(--shadow);
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        h2 {
                            padding: 1rem;
                        }
                    }
                    .shopping-bag-promo {
                        padding: 1rem;
                        border-bottom: 1px solid var(--shadow);
                        input {
                            width: 70%;
                            font-size: 16px;
                            font-weight: 600;
                            height: 40px;
                            padding-left: 1rem;
                            border-top-left-radius: 25px;
                            border-bottom-left-radius: 25px;
                            font-weight: 600;
                            border: none;
                        }
                        button {
                            width: 30%;
                            height: 40px;
                            border-top-right-radius: 25px;
                            border-bottom-right-radius: 25px;
                            background-color: var(--gold);
                            border: 2px solid var(--gold);
                            cursor: pointer;
                            font-weight: 600;
                            color: var(--black);
                            transition: 0.5s;
                            font-size: 16px;
                        }
                    }
                    .shopping-bag-price {
                        display: flex;
                        padding: 1rem;
                        justify-content: space-between;
                        border-bottom: 1px solid var(--shadow);
                        p {
                            font-size: 16px;
                            font-weight: 600;
                            color: var(--black);
                        }
                        p:nth-child(2) {
                            text-align: right;
                            margin-left: 1rem;
                        }
                    }
                    .shopping-bag-price-promo {
                        display: flex;
                        padding: 1rem;
                        justify-content: space-between;
                        border-bottom: 1px solid var(--shadow);
                        p {
                            font-size: 16px;
                            font-weight: 600;
                            color: var(--black);
                        }
                    }
                    .shopping-bag-button {
                        padding: 1rem;

                            .shopping-bag-btn {
                                margin-bottom: 1rem;
                            }
                            .shopping-bag-btn {
                                width: 100%;
                                height: 40px;
                                color: var(--black);
                                font-weight: 600;
                                font-size: 16px;
                                background-color: var(--gold);
                                border: 2px solid var(--gold);
                                transition: 0.5s;
                                cursor: pointer;
                                border-radius: 25px;
                                &:hover {
                                    background-color: var(--black);
                                    border: 2px solid var(--black);
                                    color: var(--light-gold);
                                }
                            }

                            .shopping-bag-btn:last-child{
                                background-color: var(--black);
                                border: 2px solid var(--black);
                                color: var(--light-gold);
                                &:hover {
                                    background-color: var(--gold);
                                    border: 2px solid var(--gold);
                                    color: var(--black);
                                }
                            }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .checkout {
            .checkout-content {
                .checkout-left {
                    width: 60%;
                }
                .checkout-right {
                    width: 30%
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
        
        .checkout {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .checkout-content {
                width: 90%;
                flex-direction: column;
                .checkout-left {
                    width: 100%;
                    .checkout-private {
                        .checkout-private-form {
                            .input-flex:first-child {
                                padding-left: 1rem;
                                padding-right: 0.5rem;
                                padding-bottom: 0;
                            }
                            .input-flex {
                                padding-left: 1rem;
                                padding-right: 1rem;
                                flex-direction: column;
                                padding-bottom: 0;
                                padding-top: 0;
                                input {
                                    margin-bottom: 1rem;
                                    width: 100%;
                                }
                                select {
                                    margin-bottom: 1rem;
                                    width: 100%;
                                }
                            }
                        }
                    }
                    .checkout-invoice {
                        .checkout-invoice-option {
                            p {
                                font-size: 16px;
                            }
                        }
                        .checkout-invoice-form {
                            .input-flex:first-child {
                                padding-left: 1rem;
                                padding-right: 0.5rem;
                                padding-bottom: 0;
                            }
                            .input-flex {
                                padding-left: 1rem;
                                padding-right: 1rem;
                                flex-direction: column;
                                padding-bottom: 0;
                                padding-top: 0;
                                input {
                                    margin-bottom: 1rem;
                                    width: 100%;
                                }
                            }
                        }
                    }
                    .checkout-company {
                        .checkout-company-form {
                            .checkout-company-form-content {
                                .input-flex:first-child {
                                padding-left: 1rem;
                                padding-right: 0.5rem;
                                padding-bottom: 0;
                            }
                            .input-flex {
                                padding-left: 1rem;
                                padding-right: 1rem;
                                flex-direction: column;
                                padding-bottom: 0;
                                padding-top: 0;
                                input {
                                    margin-bottom: 1rem;
                                    width: 100%;
                                }
                                select {
                                    margin-bottom: 1rem;
                                    width: 100%;
                                }
                            }
                            }
                        }
                    }
                    .checkout-terms {
                        margin-bottom: 2rem;
                    }
                }
                .checkout-right {
                    width: 100%;
                    .shopping-bag-summary {
                        .shopping-bag-promo {
                            display: flex;
                            flex-direction: column;
                            input {
                                border-radius: 25px;
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                            button {
                                width: 100%;
                                border-radius: 25px;
                            }
                        }
                    }
                }
            }
        }
    }
</style>