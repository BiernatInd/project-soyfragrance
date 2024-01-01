<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Status zamówienia</h1>
                <p>Numer zamówienia: {{ orderNumber }}</p>
                <p>Status: {{ orderStatus ? orderStatus.order_status : 'Brak danych' }}</p>
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
                numerZamowienia: null,
                orderStatus: null
            }
        },
        methods: {
        fetchData() {
            this.orderNumber = this.$route.params.orderNumber;
            console.log('Numer zamówienia:', this.orderNumber);

            axios.get(`http://localhost:8000/api/order-status/${this.orderNumber}`)

                .then(response => {
                    console.log('Odpowiedź z serwera:', response.data);
                    this.orderStatus = response.data.order || {};
                })
                .catch(error => {
                    console.error('Błąd pobierania danych zamówienia:', error);
                });
        },
    },
    mounted() {
        console.log('Komponent zamówienia zamontowany.');
        this.fetchData();
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
    }
</style>