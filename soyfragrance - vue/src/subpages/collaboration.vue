<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Oferta współpracy dla firm</h1>
            </div>
        </div>
    </div>
    <div class="business">
        <div class="business-content">
            <div class="business-left">
                <img src="../assets/25.webp" alt="">
            </div>
            <div class="business-right">
                <div class="business-right-content">
                    <h2>B2B – Oferta specjalna dla przesiębiorców</h2>
                    <p>Oferujemy produkcję naturalnych świec sojowych oraz dyfuzorów patyczkowych pod Twoją markę.</p>
                    <p>Wyróżnij swoją firmę na tle konkurencji poprzez wprowadzenie modnego akcentu, jakim jest ręcznie robiona świeca sojowa, która cieszy się coraz większą popularnością.</p>
                    <p>Wosk sojowy jest ekologiczny, podąża za trendami i cechuje go najwyższa jakość. Jest zdrową alternatywą dla świec parafinowych, dodatkowo lepiej uwalnia zapach i wytwarza do 90% mniej dwutlenku węgla podczas spalania.</p>
                    <p>Etykieta – zaprojektowana przez Ciebie lub z naszą pomocą. Tu nie ma ograniczeń, od kolorów po królewskie złoto.</p>
                    <p>Naturalne zapachy stosowane przy produkcji posiadają najlepszy skład oraz wszelkie certyfikaty, przede wszystkim spowodują, że Twoja marka stanie się lepiej zapamiętywana. Kluczem sukcesu jest dopasowanie odpowiedniego zapachu do Twojej profesji. Jeśli prowadzisz kwiaciarnię, lub cukiernię na pewno sprawdzą się kwiatowe, słodkie aromaty. Natomiast jeśli firma jest producentem męskich dodatków to z pewnością cięższe, orientalne olejki odnajdą się w niej idealnie.</p>
                    <p>Podejmujemy się także okolicznościowych projektów, jak upominki dla gości weselnych, komunijnych itp. Ty decydujesz, począwszy od wyglądu, aż po dobór zapachów jak i etykietę. Ogranicza nas jedynie wyobraźnia!</p>
                    <p>Każdy projekt przygotowujemy indywidualnie, dlatego w kwestii wyceny prosimy o kontakt. Świece wylewamy z największą starannością, aby sprostać najbardziej wymagającym. Chętnie odpowiemy na wszelkie pytania.</p>
                    <p>Wybierając Soy Fragrance nie tylko wspierasz Polską manufakturę, ale dokonujesz najlepszego wyboru dla siebie oraz bliskich.</p>
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

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
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
        }
    }
    
    .business {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .business-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .business-left {
                img {
                    width: 100%;
                }
            }
            .business-right {
                width: 70%;
                .business-right-content {
                    background-color: var(--light-gold);
                    padding: 2rem;
                    border-radius: 25px;
                    h2 {
                        font-size: 48px;
                        margin-bottom: 2rem;
                    }
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                    p {
                        font-size: 16px;
                        font-weight: 600;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .business {
            .business-content {
                .business-left {
                    img {
                        width: 80%;
                    }
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
                }
            }
        }
        .business {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .business-content {
                width: 90%;
                flex-direction: column;
                .business-left {
                    margin-bottom: 2rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .business-right {
                    width: 100%;
                    .business-right-content {
                        h2 {
                            font-size: 32px;
                        }
                    }
                }
            }
        }
    }
</style>