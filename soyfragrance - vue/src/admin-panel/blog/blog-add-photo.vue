<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Dodawanie zdjęcia do postu</h1>
        </div>
    </div>
    <div class="event">
        <div class="event-content">
            <div class="event-form">
                <h2>Dodawanie zdjęcia do postu</h2>
                <div class="input-full-width">
                    <input type="file" ref="articlePhoto" @change="handleFileUpload">
                </div>
                <div class="event-button">
                    <button class="event-btn" @click="addBlogPhoto">Dodaj zdjęcie</button>
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
        file: null,
        slug: null, 
    }
},
methods: {
    handleFileUpload() {
        this.file = this.$refs.articlePhoto.files[0];
    },
    addBlogPhoto() {
        let formData = new FormData();
        formData.append('photo', this.file);
        formData.append('slug', this.slug);

        axios.post('http://localhost:8000/api/blog-add-photo', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => {
            console.log(response);
            // Obsługa odpowiedzi
            alert('Zdjęcie dodane pomyślnie.')
            this.$router.push(`/blog-dodaj-meta/${this.slug}`); 
        })
        .catch(error => {
            console.error(error);
            alert('Wszystkie pola muszą zostać wypełnione.')
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
        this.slug = this.$route.params.slug;
        console.log("Zamontowano komponent, slug:", this.slug);
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
                        border: none;
                        font-size: 16px;
                        color: var(--black);
                        font-weight: 600;
                        border-radius: 15px;
                        padding-left: 1rem;
                        padding-top: 0.3rem;
                        padding-bottom: 0.5rem;
                        background-color: var(--white);
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
                    .event-button {
                        margin-top: 1rem;
                        .event-btn {
                            height: 40px;
                        }
                    }
                }
            }
        }
    }
</style>