<template>
    <UserHeader />
    <div class="home">
        <div class="home-content">
            <h1>Szczegóły zamówienia</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content" v-if="orderType === 'private_person'" id="private_person">
            <div class="event-left">
                <div class="event-details">
                    <div class="event-details-top">
                        <h2>Dane klienta</h2>
                        <p>Osoba prywatna</p>
                    </div>
                    <div class="event-details-bottom">
                        <p>Imię: {{  order.name || 'Brak danych' }}</p>
                        <p>Nazwisko: {{ order.surname || 'Brak danych'}}</p>
                        <p>Adres E-mail: {{  order.email || 'Brak danych'}}</p>
                        <p>Numer telefonu: {{  order.phone || 'Brak danych' }}</p>
                        <p>Kraj: {{ order.country || 'Brak danych'}}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.street_and_house_number || 'Brak danych' }}</p>
                        <p>Miejscowość: {{  order.place || 'Brak danych' }}</p>
                        <p>Kod pocztowy: {{  order.postal_code || 'Brak danych' }}</p>
                        <h2>Dodatkowe dane do faktury</h2>
                        <p>Imię: {{ order.invoice_name || 'Brak danych' }}</p>
                        <p>Nazwisko: {{ order.invoice_surname || 'Brak danych' }}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.invoice_street_and_house_number || 'Brak danych' }}</p>
                        <p>Miejscowość: {{  order.invoice_place || 'Brak danych' }}</p>
                        <p>Kod pocztowy: {{ order.invoice_postal_code || 'Brak danych' }}</p>
                    </div>
                </div>
            </div>
            <div class="event-right">
                <div class="event-right-top">
                    <h2>Dane zamówienia</h2>
                    <p>Łączna kwota: {{ order.total_price ? order.total_price + ' zł' : 'Brak danych' }}</p>
                    <p>Metoda płatności: {{  order.payment || 'Brak danych' }}</p>
                    <p>Metoda dostawy: {{ order.delivery || 'Brak danych' }}</p>
                    <p>Status zamówienia: {{  order.order_status || 'Brak danych' }}</p>
                    <p>Numer zamówienia: {{ order.order_number || 'Brak danych' }}</p>
                    <p>Kod promocyjny: {{  order.entered_promo_code || 'Brak danych'}}</p>
                    <p>Zniżka: {{  order.discount + '%'|| 'Brak danych' }}</p>
                    <p>Zakupiono: {{  order.purchased_products || 'Brak danych' }}</p>
                </div>
            </div>
        </div>
        <div class="event-content" v-if="orderType === 'company'" id="company">
            <div class="event-left">
                <div class="event-details">
                    <div class="event-details-top">
                        <h2>Dane klienta</h2>
                        <p>Firma</p>
                    </div>
                    <div class="event-details-bottom">
                        <p>NIP: {{ order.nip || 'Brak danych' }}</p>
                        <p>Nazwa firmy: {{ order.company_name || 'Brak danych'}}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.street_and_house_number || 'Brak danych'}}</p>
                        <p>Miejscowość: {{ order.place || 'Brak danych'}}</p>
                        <p>Kod pocztowy: {{ order.postal_code || 'Brak danych'}}</p>
                        <h2>Adres dostawy:</h2>
                        <p>Imię: {{ order.invoice_name || 'Brak danych'}}</p>
                        <p>Nazwisko: {{ order.invoice_surname || 'Brak danych'}}</p>
                        <p>Adres E-mail: {{ order.invoice_email || 'Brak danych'}}</p>
                        <p>Numer telefonu: {{ order.invoice_phone || 'Brak danych'}}</p>
                        <p>Kraj: {{ order.invoice_country || 'Brak danych'}}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.invoice_street_and_house_number || 'Brak danych'}}</p>
                        <p>Miejscowość: {{ order.invoice_place || 'Brak danych'}}</p>
                        <p>Kod pocztowy: {{ order.invoice_postal_code || 'Brak danych'}}</p>
                    </div>
                </div>
            </div>
            <div class="event-right">
                <div class="event-right-top">
                    <h2>Dane zamówienia</h2>
                    <p>Łączna kwota: {{ order.total_price ? order.total_price + ' zł' : 'Brak danych' }}</p>
                    <p>Metoda płatności: {{  order.payment || 'Brak danych' }}</p>
                    <p>Metoda dostawy: {{ order.delivery || 'Brak danych' }}</p>
                    <p>Status zamówienia: {{  order.order_status || 'Brak danych' }}</p>
                    <p>Numer zamówienia: {{ order.order_number || 'Brak danych' }}</p>
                    <p>Kod promocyjny: {{  order.entered_promo_code || 'Brak danych'}}</p>
                    <p>Zniżka: {{  order.discount + '%' || 'Brak danych' }}</p>
                    <p>Zakupiono: {{  order.purchased_products || 'Brak danych' }}</p>
                </div>
            </div>
        </div>
    </div>
    <UserFooterBottom />
</template>

<script>
import UserHeader from '@user-components/user-header.vue'
import UserFooterBottom from '@user-components/user-footer-bottom.vue'
import axios from 'axios'

    export default {
        components: {
            UserHeader,
            UserFooterBottom
        },
        data() {
            return {
                confirmationActive: false,
                order: {},
                newOrderStatus: '',
            }
        },
        methods: {
            fetchOrderContent(orderNumber) {
        axios.get(`http://localhost:8000/api/order-content/${orderNumber}`)
            .then(response => {
                this.order = response.data.order;
                console.log('Order details:', this.order);

                // Pobierz dostępne statusy i przypisz do statusOptions
                this.statusOptions = response.data.statusOptions;

                // Ustaw domyślny status na aktualny status zamówienia
                this.newOrderStatus = this.order.order_status || '';
            })
            .catch(error => {
                console.error('Error fetching order details:', error);
            });
        },
        checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'user') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
    },
    computed: {
            // Sprawdź, czy order jest firmą czy osobą prywatną
    orderType() {
      return this.order && this.order.order_type === 'company' ? 'company' : 'private_person';
    },
    },
    mounted() {
    const orderNumber = this.$route.params.order_number;
    this.fetchOrderContent(orderNumber);
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
                .event-details {
                    width: 100%;
                    background-color: var(--light-gold);
                    border-radius: 15px;
                    padding: 2rem;
                    .event-details-top {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 1rem;
                        h2 {
                            font-size: 24px;
                        }
                        p {
                            font-size: 20px;
                            font-weight: 600;
                        }
                    }
                    .event-details-bottom {
                        p:not(:last-child) {
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 16px;
                            font-weight: 600;
                        }
                        h2 {
                            font-size: 24px;
                            margin-bottom: 1rem;
                        }
                    }
                }
            }
            .event-right {
                width: 48%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                .event-right-top {
                    background-color: var(--light-gold);
                    padding: 2rem;
                    border-radius: 15px;
                    h2 {
                        font-size: 24px;
                        margin-bottom: 1rem;
                    }
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                    p {
                        font-weight: 600;
                    }
                }
                .event-right-bottom {
                    background-color: var(--light-gold);
                    padding: 2rem;
                    border-radius: 15px;
                    h2 {
                        font-size: 24px;
                        margin-bottom: 1rem;
                    }
                    select {
                        width: 100%;
                        height: 40px;
                        border-radius: 15px;
                        font-size: 16px;
                        font-weight: 600;
                        border: none;
                        padding-left: 1rem;
                        border-right: 16px solid var(--white);
                        cursor: pointer;
                        margin-bottom: 1rem;
                        option {
                            font-weight: 600;
                        }
                    }
                    .event-right-bottom-button {
                        .event-right-bottom-btn {
                            width: 100%;
                            height: 40px;
                            border-radius: 15px;
                            border: 2px solid var(--gold);
                            background-color: var(--gold);
                            color: var(--black);
                            font-weight: 600;
                            font-size: 16px;
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

    .confirmation {
        position: fixed;
        max-width: 1920px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.5s;
        z-index: 999;
        top: -100%;
        &.active {
            top: 0;
        }
        .confirmation-content {
            width: 40%;
            height: 25%;
            border-radius: 25px;
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            .confirmation-main {
                width: 90%;
                .confirmation-top {
                    margin-bottom: 1rem;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    hr {
                    width: 50%;
                    height: 3px;
                    border: none;
                    border-radius: 10px;
                    background-color: var(--gold);
                    }
                }
                .confirmation-bottom {
                    p {
                        font-size: 20px;
                        margin-bottom: 1rem;
                        font-weight: 600;
                    }
                    .confirmation-buttons {
                        .confirmation-btn {
                            width: 220px;
                            height: 30px;
                            font-size: 16px;
                        }
                        .confirmation-btn:nth-child(1) {
                            margin-right: 1rem;
                            background-color: var(--white);
                            border: 2px solid var(--gold);
                            color: var(--dark-beige);
                            border-radius: 25px;
                            cursor: pointer;
                            transition: 0.5s;
                            font-weight: 600;
                            &:hover {
                                background-color: var(--gold);
                                color: var(--black);
                            }
                        }
                        .confirmation-btn:nth-child(2) {
                            margin-right: 1rem;
                            background-color: var(--gold);
                            border: 2px solid var(--gold);
                            color: var(--black);
                            border-radius: 25px;
                            cursor: pointer;
                            transition: 0.5s;
                            font-weight: 600;
                            &:hover {
                                background-color: var(--white);
                                color: var(--dark-beige);
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
                    margin-bottom: 2rem;
                    .event-details {
                        width: 100%;
                        padding: 1rem;
                        .event-details-top {
                            flex-direction: column;
                            align-items: flex-start;
                            h2 {
                                margin-bottom: 1rem;
                            }
                        }
                    }

                }
                .event-right {
                    width: 100%;
                    .event-right-top {
                        padding: 1rem;
                    }
                    .event-right-bottom {
                        padding: 1rem;
                        margin-top: 2rem;
                    }
                }
            }
        }
        .confirmation {
                .confirmation-content {
                    width: 90%;
                    height: 260px;
                    .confirmation-main {
                        .confirmation-top {
                            h2 {
                                font-size: 24px;
                            }
                        }
                        .confirmation-bottom {
                            p {
                                font-size: 16px;
                            }
                            .confirmation-buttons {
                                .confirmation-btn:nth-child(1) {
                                    margin-bottom: 1rem;
                                }
                                .confirmation-btn {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
            }
    }
</style>