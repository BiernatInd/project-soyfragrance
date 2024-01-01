<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Blog</h1>
            </div>
        </div>
    </div>
    <div class="blog">
        <div class="blog-content">
            <div class="blog-left">
                <div class="blog-box-container" v-for="(group, index) in groupedBlogList" :key="index">
                    <div class="blog-box" v-for="blog in group" :key="blog.id">
                        <div class="blog-box-top">
                            <img :src="getImagePath(blog.slug)" alt="">
                        </div>
                        <div class="blog-box-bottom">
                            <h2>{{ blog.article_title }}</h2>
                            <p>{{ blog.article_meta_description }}</p>
                            <router-link to="/artykul" @click="goToArticle(blog.slug)">Czytaj więcej
                                <svg width="10" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.999998 19L10 10L0.999999 0.999999" stroke="#222222"/>
                                </svg>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-right">
                <div class="blog-popular-top">
                    <h2>Popularne artykuły</h2>
                </div>
                <div class="blog-popular-posts">
                    <div class="blog-post-box" v-for="blog in recentPosts" :key="blog.id" @click="goToArticle(blog.slug)">
                        <div class="blog-post-box-img">
                            <img :src="getImagePath(blog.slug)" alt="">
                        </div>
                        <div class="blog-post-box-content">
                            <h2>{{ blog.article_title }}</h2>
                            <p>{{ formatData(blog.created_at) }}</p>
                        </div>
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

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                blogList: [],
                blogImages: []
            }
        },
        methods: {
         goToArticle(slug) {
            this.$router.push({ path: `/artykul/${slug}` });
        },
        async fetchBlogData() {
            try {
                const response = await axios.get('http://localhost:8000/api/blog-download-all-data');
                this.blogList = response.data.blogList;
                this.blogImages = response.data.blogImages;
                // obsługa pozostałych danych
            } catch (error) {
                console.error('Błąd podczas pobierania danych bloga:', error);
            }
        },
        getImagePath(slug) {
            const image = this.blogImages.find(img => img.slug === slug);
            return image ? image.image_path : '';
        },
        formatData(isoDateTime) {
            const dateObject = new Date(isoDateTime);
            return dateObject.toLocaleString();
        },
    },
    computed: {
        groupedBlogList() {
            let groupSize = 2;
            return this.blogList.reduce((accumulator, current, index) => {
                const chunkIndex = Math.floor(index / groupSize);

                if (!accumulator[chunkIndex]) {
                    accumulator[chunkIndex] = []; // start a new chunk
                }

                accumulator[chunkIndex].push(current);

                return accumulator;
            }, []);
        },
        recentPosts() {
            // Zwróć ostatnie trzy wpisy
            return this.blogList.slice(-3);
        },
    },
    created() {
        this.fetchBlogData();
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

    .blog {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .blog-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .blog-left {
                width: 70%;
                .blog-box-container:not(:last-child) {
                    margin-bottom: 2rem;
                }
                .blog-box-container {
                    display: flex;
                    justify-content: space-between;
                    .blog-box {
                        width: 48%;
                        justify-content: space-between;
                        .blog-box-top {
                            margin-bottom: 1rem;
                            img {
                                display: block;
                                width: 440px;
                                height: 360px;
                                border-radius: 25px;
                            }
                        }
                        .blog-box-bottom {
                            h2 {
                                font-size: 24px;
                                color: var(--black);
                                font-weight: 600;
                                margin-bottom: 1rem;
                            }
                            p {
                                font-size: 16px;
                                color: var(--black);
                                font-weight: 600;
                                margin-bottom: 1rem;
                            }
                            a {
                                font-size: 20px;
                                font-weight: 600;
                                text-decoration: none;
                                display: flex;
                                align-items: center;
                                color: var(--black);
                                transition: 0.5s;
                                svg {
                                    margin-left: 1rem;
                                    path {
                                        transition: 0.5s;
                                    }
                                }
                                &:hover {
                                    color: var(--gold);
                                    svg {
                                        path {
                                            stroke: var(--gold);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            .blog-right {
                width: 25%;
                .blog-popular-top {
                    h2 {
                        font-size: 24px;
                        color: var(--black);
                        margin-bottom: 2rem;
                    }
                }
                .blog-popular-posts {
                    .blog-post-box {
                        display: flex;
                        margin-bottom: 1rem;
                        justify-content: space-between;
                        padding: 1rem;
                        border-radius: 25px;
                        background-color: var(--light-gold);
                        cursor: pointer;
                        .blog-post-box-img {
                            img {
                                display: block;
                                width: 100px;
                                height: 100px;
                                border-radius: 10px;
                            }
                        }
                        .blog-post-box-content {
                            width: 65%;
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            h2 {
                                font-size: 20px;
                                color: var(--black);
                            }
                            p {
                                font-size: 16px;
                                color: var(--black);
                                font-weight: 600;
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .blog {
            .blog-content {
                .blog-left {
                    width:65%;
                    .blog-box-container {
                        .blog-box {
                            .blog-box-top {
                                img {
                                    width: 100%;
                                    height: 100%;
                                }
                            }
                        }
                    }
                }
                .blog-right {
                    width: 30%;
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

        .blog {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .blog-content {
                width: 90%;
                flex-direction: column;
                .blog-left {
                    width: 100%;
                    .blog-box-container:not(:last-child) {
                        margin-bottom: 0;
                    }
                    .blog-box-container {
                        flex-direction: column;
                        .blog-box {
                            width: 100%;
                            margin-bottom: 2rem;
                        }
                    }
                }
                .blog-right {
                    width: 100%;
                    .blog-popular-posts {
                        .blog-post-box {
                            flex-direction: column;
                            .blog-post-box-img {
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                            .blog-post-box-content {
                                width: 100%;
                                h2 {
                                    margin-bottom: 1rem;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</style>