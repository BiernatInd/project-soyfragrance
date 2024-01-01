<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Lista newsletter</h1>
        </div>
    </div>
    <div class="list">
        <div class="list-content">
            <table>
                <thead>
                    <tr>
                        <th>Numer</th>
                        <th>Adres E-mail</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="newsletter in newsletter" :key="newsletter.id">
                        <td data-label="Numer">{{  newsletter.id }}</td>
                        <td data-label="Adres E-mail">{{  newsletter.email }}</td>
                        <td data-label="Data">{{ formatData(newsletter.created_at) }}</td>
                    </tr>
                </tbody>
            </table>
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
                newsletter: []
            }
        },
        methods: {
            fetchData() {
                // Pobierz dane z API
                axios.get('http://localhost:8000/api/newsletter-list')
    .then(response => {
      console.log('Odpowiedź z API:', response.data);
      this.newsletter = response.data.newsletter;
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
    });
},
formatData(isoDateTime) {
                const dateObject = new Date(isoDateTime);
                return dateObject.toLocaleString();
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
            this.fetchData();
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
                    svg:nth-child(2) {
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
                                svg:nth-child(2) {
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