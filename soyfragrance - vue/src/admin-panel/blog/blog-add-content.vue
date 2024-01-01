<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Dodawanie treści</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-left">
                <div class="event-form">
                    <h2>Dodawanie nagłówków</h2>
                    <div class="input-full-width">
                        <select v-model="articleType">
                            <option value="header">Nagłówek</option>
                            <option value="paragraph">Paragraf</option>
                        </select>
                        <textarea v-model="articleText" placeholder="Wprowadź treść"></textarea>
                    </div>
                    <div class="event-button">
                        <button class="event-btn" @click="addBlogContent">Dodaj nagłówek</button>
                    </div>
                </div>
            </div>
            <div class="event-right">
                <div class="event-post">
                    <h2>Aktualna treść wpisu:</h2>
                    <div v-for="content in blogContents" :key="content.id">
                        <h3 v-if="content.article_type === 'header'">{{ content.article_text }}</h3>
                        <p v-else-if="content.article_type === 'paragraph'">{{ content.article_text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <AdminFooterBottom />
</template>

<script>
import AdminHeader from '@admin-components/admin-header.vue'
import AdminFooterBottom from '@admin-components/admin-footer-bottom.vue'
import axios from 'axios';

    export default {
        components: {
            AdminHeader,
            AdminFooterBottom
        },
        data() {
            return {
                articleType: 'header',
                articleText: '',
                slug: this.$route.params.slug, // Założenie, że slug jest przekazywany przez trasę
                blogContents: [],
            }
        },
        methods: {
        addBlogContent() {
            axios.post('http://localhost:8000/api/blog-add-content', {
                article_type: this.articleType,
                article_text: this.articleText,
                slug: this.slug,
            })
            .then(response => {
                alert('Treść dodana pomyślnie.');
                this.clearFields();
                this.fetchData();
            })
            .catch(error => {
                console.error('Błąd podczas dodawania treści:', error);
            });
        },
        fetchData() {
            axios.get('http://localhost:8000/api/blog-download-content/' + this.slug)
            .then(response => {
                this.blogContents = response.data;
            })
            .catch(error => {
                console.error('Błąd podczas pobierania danych:', error);
            });
        },
        clearFields() {
            // Wyczyszczenie wszystkich pól
            this.articleText = '';
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
                    margin-bottom: 2rem;
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
                    .input-full-width {
                        display: flex;
                        justify-content: space-between;
                        flex-direction: column;
                        select {
                            width: 100%;
                            height: 40px;
                            border: none;
                            font-size: 16px;
                            color: var(--black);
                            font-weight: 600;
                            border-radius: 15px;
                            padding-left: 1rem;
                            margin-bottom: 1rem;
                            option {
                                font-weight: 600;
                            }
                        }
                        textarea {
                            width: 100%;
                            height: 140px;
                            border: none;
                            font-size: 16px;
                            padding-top: 1rem;
                            color: var(--black);
                            font-weight: 600;
                            border-radius: 15px;
                            padding-left: 1rem;
                            resize: none;
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
                    height: 100%;
                    border-radius: 15px;
                    padding: 2rem;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    div {
                        h3 {
                            font-size: 20px;
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 16px;
                            font-weight: 600;
                            margin-bottom: 1rem;
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
                    .event-form {
                        width: 100%;
                        padding: 1rem;
                        h2 {
                            font-size: 24px;
                            margin-bottom: 1rem;
                        }
                        .input-full-width {
                            flex-direction: column;
                            textarea {
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                        }
                        .event-button {
                            margin-top: 0;
                            .event-btn {
                                height: 40px;
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