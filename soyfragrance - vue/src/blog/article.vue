<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>{{ articleTitle }}</h1>
            </div>
        </div>
    </div>
    <div class="article">
        <div class="article-content">
            <div class="article-img"  v-if="blogImages.length > 0">
                <img :src="blogImages[0].image_path" alt="">
            </div>
            <div v-for="content in blogContents" :key="content.id">
                <h2 v-if="content.article_type === 'header'">{{ content.article_text }}</h2>
                <p v-else-if="content.article_type === 'paragraph'">{{ content.article_text }}</p>
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
            slug: this.$route.params.slug,
            blogContents: [],
            blogImages: [],
            articleTitle: '',
        }
    },
    methods: {
        fetchData() {
            axios.get('http://localhost:8000/api/blog-download-article/' + this.slug)
            .then(response => {
                this.blogContents = response.data.blogContents;
                this.blogImages = response.data.blogImages; // Pobieramy obrazy
                this.articleTitle = response.data.blogContents[0].article_text;
            })
            .catch(error => {
                console.error('Błąd podczas pobierania danych:', error);
            });
        },
        clearFields() {
            // Wyczyszczenie wszystkich pól
            this.articleText = '';
        },
    },
    mounted() {
        this.fetchData();
    }
    }
</script>

<style lang="scss" scoped>
  .home {
        padding-top: 9.2rem;
        padding-bottom: 3rem;
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
            }
        }
    }

    .article {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .article-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .article-img {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 2rem;
                img {
                    display: block;
                    max-width: 600px;
                    max-height: 600px;
                    border-radius: 25px;
                }
            }
            h2, h3, h4, h5, h6 {
                font-size: 24px;
                margin-bottom: 1rem;
            }
            p {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 1rem;
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
                }
            }
        }

        .article {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .article-content {
                width: 90%;
                .article-img {
                    img {
                        width: 100%;
                        height: 100%;
                    }
                }
            }
        }
    }
</style>