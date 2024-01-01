<template>
    <UserHeader />
    <div class="home">
        <div class="home-content">
            <h1>Lista zamówień</h1>
        </div>
    </div>
    <div class="list">
        <div class="list-content">
            <table>
                <thead>
                    <tr>
                        <th>Numer</th>
                        <th>Zamówienie</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Płatność</th>
                        <th>Cena</th>
                        <th>Szczegóły</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in orders" :key="index">
                        <td data-label="Numer">{{ index + 1 }}</td>
                        <td data-label="Zamówienie">{{ order.order_number || order.id }}</td>
                        <td data-label="Status">{{ order.order_status || 'Nieznany' }}</td>
                        <td data-label="Płatność">{{ order.payment|| 'Nieznana' }}</td>
                        <td data-label="Cena">{{ order.total_price + ' zł'|| 'Brak informacji' }}</td>
                        <td data-label="Data">{{ formatData(order.created_at) }}</td>
                        <td data-label="Szczegóły">
                            <router-link :to="{ name: 'order-content-user', params: { order_number: extractOrderNumber(order.order_number) } }">
                                <svg width="16" height="4" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="8" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="2" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="14" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
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
        confirmationActive: false,
      userName: null,
      orders: [],
    }
},
methods: {
    extractOrderNumber(fullOrderNumber) {
    // Zastosuj odpowiednią logikę wyciągania numeru zamówienia przed datą
    const orderNumberWithoutDate = fullOrderNumber.split('/')[0];
    return orderNumberWithoutDate;
  },
  formatData(isoDateTime) {
                const dateObject = new Date(isoDateTime);
                return dateObject.toLocaleString();
            },
    checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'user') {
                // Jeżeli użytkownik nie ma roli user, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
        fetchOrders() {
  axios
    .get("http://localhost:8000/api/orders-list-user", { params: { userName: this.userName } })
    .then((response) => {
      // Aktualizacja zmiennej orders
      this.orders = response.data.map(order => {
        return {
          ...order,
          user_name: order.user_name || this.userName,
        };
      });

      console.log('Fetched Orders:', this.orders);
    })
    .catch((error) => {
      console.error("Error fetching orders", error);
    });
},
    },
    mounted() {
        this.checkUserRole();
        this.fetchOrders();
    },
    created() {
        this.userName = localStorage.getItem('userName');
                // Wyświetl userName w konsoli
                console.log('UserName:', this.userName);
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
    .list {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .list-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
                table {
                width: 100%;
                border-radius: 15px;
                border-collapse: separate;
                border-spacing: 0;
                background-color: var(--light-gold);
                th {
                    padding: 12px;
                    text-align: center;
                    font-size: 20px;
                    font-weight: 600;
                }
                td {
                    padding: 12px;
                    text-align: center;
                    font-weight: 400;
                    white-space: normal;
                    font-size: 20px;
                    border-top: 1px solid var(--gold);
                    font-weight: 600;
                    svg {
                        width: 20px;
                        margin-left: 0.5rem;
                        margin-right: 0.5rem;
                        cursor: pointer;
                        stroke: var(--black);
                        transition: 0.5s;
                        &:hover {
                            stroke: var(--gold);
                        }
                    }
                    svg:nth-child(1) {
                        position: relative;
                        bottom: 5px;
                    }
                    a {
                      color: var(--black);
                      text-underline-offset: 4px;
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
        .list {
                padding-top: 2rem;
                padding-bottom: 2rem;
                .list-content {
                    width: 90%;
                    table, thead, tbody, th, td, tr {
                      display: block;
                      border: none;
                  }
                  table {
                      thead {
                        tr {
                            position: absolute;
                            top: -9999px;
                            left: -9999px;
                        }
                      }
                      tbody {
                          tr {
                            border-radius: 10px;
                            td {
                                border-top: none;
                                position: relative;
                                padding-left: 50%;
                                font-size: 12px;
                                text-align: right;
                                img {
                                  width: 16px;
                                }
                                svg:nth-child(1) {
                        position: relative;
                        bottom: 0px;
                    }
                            }
                            td {
                                position: relative;
                                padding-left: 50%;
                                font-size: 12px;
                                text-align: right;
                                img {
                                  width: 16px;
                                }
                            }
                            td:not(:last-child) {
                              border-bottom: 1px solid var(--gold);
                            }
                            td:last-child {
                              display: flex;
                              align-items: center;
                              justify-content: flex-end;
                            }
                            tr {
                              border: 2px solid var(--gold);
                              border-radius: 10px;
                            }
                            td::before {
                                content: attr(data-label);
                                position: absolute;
                                left: 0;
                                width: 50%;
                                padding-left: 15px;
                                font-weight: bold;
                                text-align: left;
                            }
                        }
                      }
                  }
                }
            }
    }
</style>