<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>O naszej firmie</h1>
                <p>Soy Fragrance to, tak właściwie, młoda i chętna poznawania świata para.</p>
            </div>
        </div>
    </div>
    <div class="aboutus">
        <div class="aboutus-content">
            <div class="aboutus-left">
                <img src="../assets/18.webp" alt="">
            </div>
            <div class="aboutus-right">
                <h2>Kilka słów o nas.</h2>
                <p>Soy Fragrance to Polska marka, zajmująca się produkcja eleganckich i subtelnych świec sojowych, w której skład wchodzi młoda i energiczna para. Firma została oficjalnie założona w tym roku, jednak samo dojście do ostatecznego produktu zajęło nam niespełna rok. Naszą misją jest dostarczenie produktów najwyższej jakość połączonych z nowoczesnym designem na miarę klienta XXI wieku. Każdą świecę tworzymy ręcznie wkładając w to całe serce.</p>
                <p>Żależy nam by jak najwięcej klientów poznało markę nie tylko w Polsce ale również poza nią, dlatego dziękujemy Ci, że chcesz być częścią naszego projektu. Satysfakcja i zaufanie klientów jest główną siłą młodej marki Soy Fragrance.</p>
                <p>Naszą największą misją jest dostarczenie świec najwyższej jakości połączonych z nowoczesnym designem na miarę klienta XXI wieku. Każdą świecę  wylewamy z największą starannością, aby sprostać najbardziej wymagającym.</p>
            </div>
        </div>
    </div>
    <div class="aboutus-bottom">
        <div class="aboutus-bottom-content">
            <div class="aboutus-bottom-left">
                <p>Najważniejsze nie jest szybkie dojście do obranego celu, lecz satysfakcja klientów, bo to ona jest główną siłą młodej marki Soy Fragrance.</p>
                <p>Zależy nam by jak najwięcej osób mogło zobaczyć w świecy nie tylko przyjemny zapach, ale również unikatowy i elegancki dodatek do wszystkich pomieszczeń.</p>
                <p>Satysfakcja klientów jest naszym priorytetem dlatego każdy produkt sumiennie pakujemy, a dzięki temu jest pięknym pomysłem na prezent. Spośród kilkunastu zapachów każdy znajdzie SWÓJ. Gwarantujemy wiele pachnących chwil i komfort na wyciągnięcie ręki.</p>
            </div>
            <div class="aboutus-bottom-right">
                <img src="../assets/22.webp" alt="">
            </div>
        </div>
    </div>
    <div class="instagram">
        <div class="instagram-content">
            <div class="instagram-heading">
                <h3>Sprawdź naszego Instagrama</h3>
            </div>
            <div class="instagram-center">
                <img src="../assets/23.webp" alt="">
                <img src="../assets/24.webp" alt="">
            </div>
            <div class="instagram-bottom">
                <div class="instagram-button">
                    <a href="https://www.instagram.com/soy.fragrance/" target="blank">
                    <button class="instagram-btn">Obserwuj nas</button>
                    </a>
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
            p {
                font-size: 24px;
                color: var(--white);
                text-align: center;
            }
        }
    }

    .aboutus {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .aboutus-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .aboutus-right {
                width: 60%;
                h2 {
                    font-size: 48px;
                    margin-bottom: 2rem;
                }
                p:not(:last-child) {
                    margin-bottom: 2rem;
                }
                p {
                    font-size: 16px;
                    font-weight: 600;
                }
            }
        }
    }

    .aboutus-bottom {
        padding-bottom: 4rem;
        .aboutus-bottom-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .aboutus-bottom-left {
                background-color: var(--light-gold);
                width: 80%;
                padding: 2rem;
                border-radius: 25px;
                p:not(:last-child) {
                    margin-bottom: 2rem;
                }
                p {
                    font-size: 16px;
                    font-weight: 600;
                }
            }
        }
    }

    .instagram {
        padding-bottom: 4rem;
        background-color: or;
        .instagram-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .instagram-heading {
                margin-bottom: 4rem;
                h3 {
                    font-size: 48px;
                    text-align: center;
                }
            }
            .instagram-center {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 4rem;
                img:nth-child(2) {
                    display: none;
                }
            }
            .instagram-bottom {
                .instagram-button {
                    display: flex;
                    justify-content: center;
                    .instagram-btn {
                        width: 260px;
                        height: 40px;
                        border-radius: 25px;
                        color: var(--black);
                        font-weight: 600;
                        font-size: 16px;
                        background-color: var(--gold);
                        border: 2px solid var(--gold);
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            background-color: var(--black);
                            color: var(--gold);
                            border: 2px solid var(--black);
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1650px) {
        .aboutus {
            .aboutus-content {
                .aboutus-left {
                    img {
                        width: 80%;
                    }
                }
            }
        }
        .aboutus-bottom {
            .aboutus-bottom-content {
                .aboutus-bottom-right {
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
                    p {
                        text-align: start;
                        font-size: 15px;
                    }
                }
            }
        }
        .aboutus {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .aboutus-content {
                width: 90%;
                flex-direction: column;
                .aboutus-left {
                    width: 100%;
                    margin-bottom: 2rem;
                    display: flex;
                    justify-content: center;
                }
                .aboutus-right {
                    width: 100%;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                }
            }
        }
        .aboutus-bottom {
            padding-bottom: 2rem;
            .aboutus-bottom-content {
                width: 90%;
                flex-direction: column;
                .aboutus-bottom-right {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
                .aboutus-bottom-left {
                    margin-bottom: 2rem;
                    width: 100%;
                    padding: 1rem;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                    }
                }
            }
        }
        .instagram {
            padding-bottom: 2rem;
            .instagram-content {
                width: 90%;
                .instagram-heading {
                    margin-bottom: 2rem;
                    h3 {
                        font-size: 32px;
                        text-align: start;
                    }
                }
                .instagram-center {
                    margin-bottom: 2rem;
                    img:nth-child(1) {
                        display: none;
                    }
                    img:nth-child(2) {
                        display: block;
                        width: 100%;
                    }
                }
                .instagram-bottom {
                    .instagram-button {
                        justify-content: flex-start;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 320px) {
        .instagram {
            .instagram-content {
                .instagram-bottom {
                    .instagram-button {
                        width: 100%;
                        .instagram-btn {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
</style>