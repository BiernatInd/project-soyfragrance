<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-left">
                <h2>Daj się oczarować</h2>
                <h1>Naszym <span>pachnącym</span> kolekcjom</h1>
                <div class="home-button">
                    <router-link :to="{ name: 'shop', params: { category_name: 'Promocje', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">
                        <button class="home-btn">Sprawdź nasze produkty</button>
                    </router-link>
                </div>
            </div>
            <div class="home-right">
                <img src="../assets/2.webp" alt="">
            </div>
        </div>
    </div>
    <div class="candles-info">
        <div class="candles-info-content">
            <h3>Producent świec sojowych, zapachowych</h3>
            <p>Kochasz naturalne aromaty, które przypominają Ci o pięknie lasów, kwiatów i innych dobrodziejstw przyrody? Koniecznie poznaj ofertę Soy Fragrance – dzięki nam możesz zaprosić je na stałe do Twojego domu! Jesteśmy małą, polską firmą, która na rynku działa jako producent świec sojowych. Dzięki połączeniu wegańskiego wosku, naturalnych olejków eterycznych i pracy rąk stworzyliśmy wyjątkową linię produktów zapachowych. Nasze produkty pozwolą Ci wypełnić mieszkanie rozpieszczającymi zmysły aromatami, dodając wnętrzom przytulnej atmosfery.</p>
            <p>Każda z propozycji, którą u nas znajdziesz została stworzona z najwyższą starannością – od woskowego składu aż po eleganckie, szklane opakowanie. Soy Fragrance to producent świec zapachowych, któremu możesz zaufać – podczas pracy nad naszym asortymentem dbamy o każdy szczegół. Nasza oferta to nie tylko wegańskie, ekologiczne produkty z wosku sojowego, lecz także estetyczne dodatki do wystroju wnętrz. W sprzedaży mamy również oryginalne, eleganckie kominki do aromatycznych wosków oraz elektryczne nawilżacze powietrza.</p>
        </div>
    </div>
    <div class="categories">
        <div class="categories-content">
            <div class="categories-heading">
                <h4>Najlepsze kategorie</h4>
            </div>
            <div class="categories-box-container">
                <router-link :to="{ name: 'shop', params: { category_name: 'Świece sojowe', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">
                <div class="categories-box">
                    <div class="categories-box-top">
                        <img src="../assets/4.webp" alt="">
                    </div>
                    <div class="categories-box-bottom">
                        <p>Świece sojowe</p>
                    </div>
                </div>
                </router-link>
                <router-link :to="{ name: 'shop', params: { category_name: 'Kominki zapachowe', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">
                <div class="categories-box">
                    <div class="categories-box-top">
                        <img src="../assets/5.webp" alt="">
                    </div>
                    <div class="categories-box-bottom">
                        <p>Kominki</p>
                    </div>
                </div>
                </router-link>
                <router-link :to="{ name: 'shop', params: { category_name: 'Nawilżacze powietrza', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">
                <div class="categories-box">
                    <div class="categories-box-top">
                        <img src="../assets/6.webp" alt="">
                    </div>
                    <div class="categories-box-bottom">
                        <p>Nawilżacze</p>
                    </div>
                </div>
                </router-link>
                <router-link :to="{ name: 'shop', params: { category_name: 'Dyfuzory zapachowe z patyczkami', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">
                <div class="categories-box">
                    <div class="categories-box-top">
                        <img src="../assets/7.webp" alt="">
                    </div>
                    <div class="categories-box-bottom">
                        <p>Dyfuzory zapachowe</p>
                    </div>
                </div>
                </router-link>
            </div>
        </div>
    </div>
    <div class="best-selling">
        <div class="best-selling-content">
            <div class="best-selling-heading">
                <h4>Najlepiej sprzedające się produkty</h4>
            </div>
            <div class="best-selling-box-container">
                <div class="best-selling-box" v-for="product in products" :key="product.id">
                <router-link :to="`/strona-produktu/${product.id}`">
                    <div class="best-selling-box-top">
                        <div class="best-selling-box-top-content">
                            <div class="best-selling-box-img">
                                <img :src="product.product_photo_1" :alt="product.name">
                            </div>
                        </div>
                    </div>
                </router-link>
                <div class="best-selling-box-bottom">
                    <p>{{ product.name }}</p>
                    <p :class="{ 'active': product.promo_price }">{{ product.price }} zł</p>
                    <p v-if="product.promo_price">{{ product.promo_price }} zł</p>
                        <div class="best-selling-box-cart">
                            <a @click="addProductToCart(product)">Dodaj do koszyka
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.32898 14.9999C6.68505 14.9999 6.97371 14.7113 6.97371 14.3552C6.97371 13.9991 6.68505 13.7104 6.32898 13.7104C5.9729 13.7104 5.68424 13.9991 5.68424 14.3552C5.68424 14.7113 5.9729 14.9999 6.32898 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.3553 14.9999C15.7114 14.9999 16 14.7113 16 14.3552C16 13.9991 15.7114 13.7104 15.3553 13.7104C14.9992 13.7104 14.7106 13.9991 14.7106 14.3552C14.7106 14.7113 14.9992 14.9999 15.3553 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.26318 1H3.82611L5.74831 11.8684H16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.67282 9.28941H15.6353C15.7092 9.28946 15.7808 9.26367 15.838 9.21643C15.8951 9.16918 15.9343 9.10341 15.9488 9.03031L17.0991 3.22767C17.1084 3.18088 17.1072 3.1326 17.0958 3.0863C17.0843 3.04001 17.0628 2.99686 17.0328 2.95996C17.0028 2.92307 16.9651 2.89335 16.9223 2.87296C16.8796 2.85257 16.8328 2.84201 16.7855 2.84204H4.39476" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="collection">
        <div class="collection-content">
            <div class="collection-left">
                <h5>Nasze kolekcje!</h5>
                <div class="collection-button">
                    <router-link to="/kolekcje">
                        <button class="collection-btn">Sprawdź nasze kolekcje</button>
                    </router-link>
                </div>
            </div>
            <div class="collection-right">
                <img src="../assets/13.webp" alt="">
            </div>
        </div>
    </div>
    <div class="features">
        <div class="features-content">
            <div class="features-heading">
                <h6>Nasze cechy</h6>
            </div>
            <div class="features-box-container">
                <div class="features-box">
                    <div class="features-box-top">
                        <img src="../assets/14.webp" alt="">
                    </div>
                    <div class="features-box-bottom">
                        <h2>Troska o Środowisko</h2>
                        <p>Zredukowaliśmy do minimum zużycie plastiku tworząc dla Was EKO paczki do wysyłki oraz przemyślaną strategię produkcji.</p>
                    </div>
                </div>
                <div class="features-box">
                    <div class="features-box-top">
                        <img src="../assets/15.webp" alt="">
                    </div>
                    <div class="features-box-bottom">
                        <h2>Ręcznie Robione</h2>
                        <p>Nasze świece wytwarzamy ręcznie, zaczynając od topienia wosku, a kończąc na naklejaniu etykiety. Jesteśmy dumni z tego co tworzymy!</p>
                    </div>
                </div>
                <div class="features-box">
                    <div class="features-box-top">
                        <img src="../assets/16.webp" alt="">
                    </div>
                    <div class="features-box-bottom">
                        <h2>Lokalna firma</h2>
                        <p>Jesteśmy małą manufakturą z Żagania, a świece są naszą pasją. Wybierając nasz produkt wspierasz lokalny rynek</p>
                    </div>
                </div>
                <div class="features-box">
                    <div class="features-box-top">
                        <img src="../assets/17.webp" alt="">
                    </div>
                    <div class="features-box-bottom">
                        <h2>100% Wosk Sojowy​</h2>
                        <p>W naszych świecach wykorzystujemy tylko naturalny, wolny od GMO i bezpieczny dla zdrowia wosk sojowy!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="aboutus">
        <div class="aboutus-content">
            <div class="aboutus-left">
                <img src="../assets/18.webp" alt="">
            </div>
            <div class="aboutus-right">
                <div class="aboutus-right-content">
                    <h2>O naszej wizji</h2>
                    <p>Polska marka Soy Fragrance to tak naprawdę dwójka młodych, pracowitych ludzi. Parę miesięcy zajęło nam dojście do ostatecznego produktu który dziś jest dla każdego na wyciągnięcie ręki.</p>
                    <p>Wierzymy, że ręcznie robiona świeca sojowa nie tylko przeniesie Cię w ulubione miejsce i przypomni wyjątkowe chwile, ale będzie unikatowym dodatkiem w pomieszczeniu.</p>
                    <router-link to="/">
                        <div class="aboutus-button">
                            <router-link to="/o-naszej-firmie">
                                <button class="aboutus-btn">Dowiedz się więcej</button>
                            </router-link>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
    <div class="info">
        <div class="info-content">
            <div class="info-top">
                <p>Stworzenie wyjątkowej przestrzeni to nie tylko odpowiedni dobór kolorystyki, rodzaj mebli czy ich rozmieszczenie. To również to, czego nie widać, a co niewątpliwie wpływa na nasze postrzeganie konkretnego miejsca. Dlatego warto zadbać o piękny zapach, który może podkreślać charakter właściciela domu lub wpasować się do prowadzonej przez nas działalności. Jak to zrobić w prosty i jednocześnie bardzo efektowy sposób? Postaw na polskie świecie sojowe od dobrego producenta i wybierz jedną lub kilka opcji zapachowych.</p>
            </div>
            <div class="info-columns">
                <div class="info-left">
                    <h3>Oryginalne kompozycje zapachowe świec sojowych</h3>
                    <p>U nas nie znajdziesz prostych zapachów. Do życia i naszego biznesu podchodzimy kreatywnie. Dlatego w asortymencie umieściliśmy przede wszystkim niestandardowe kompozycje. Smells like H.I.M, Smells like H.E.R, 5 o’Clock, Among The Trees, Be a Woman, Flowerbomb, Harmony czy Orient Express to tylko kilka z naszych oryginalnych propozycji produktów wykonanych z wosku sojowego.</p>
                    <p>Jednak jako polski producent świec zapachowych jesteśmy świadomi, że niektórzy z naszych Klientów preferują ponadczasowe klasyki, takie jak wanilia, drzewo sandałowe, piżmo, jaśmin czy owoce leśne. Te również znajdziesz w naszej ofercie.</p>
                </div>
                <div class="info-right">
                    <img src="../assets/20.webp" alt="">
                </div>
            </div>
            <div class="info-columns">
                <div class="info-left">
                    <img src="../assets/21.webp" alt="">
                </div>
                <div class="info-right">
                    <h4>Polski producent świec — wyroby przyjazne środowisku</h4>
                    <p>Wierzymy, że dobry produkt to ten, który zadowala zarówno naszych Klientów, jak i naszą planetę. Jako świadomy, polski producent świec sojowych na pierwszym miejscu stawiamy dobro środowiska. Dlatego do tworzenia naszych produktów zapachowych używamy wyłącznie naturalnych surowców, które są w pełni bezpieczne dla nas i naszego otoczenia – od wosku, poprzez etykiety i aż po szklane, estetyczne opakowania. Jeżeli więc zdecydujesz się na zakup naszych produktów, świadomie wybierasz markę, która aktywnie wspiera działania na rzecz środowiska.</p>
                </div>
            </div>
            <div class="info-bottom">
                <p>Jesteśmy pewni, że w naszym asortymencie znajdziesz produkty, które pomogą Ci w wykreowaniu przyjemnej atmosfery. Jeżeli jednak nie posiadamy wersji zapachowej, na której Ci zależy, to śmiało — skontaktuj się z nami! Jako młodzi producenci polskich, ręcznie robionych świec sojowych chętnie podejmiemy się nowych wyzwań i stworzymy dla Ciebie oryginalną kompozycję!</p>
            </div>
        </div>
    </div>
    <div class="cookie-policy" v-if="!cookieAccepted">
        <div class="cookie-policy-content">
            <p>Strona korzysta z ciasteczek aby świadczyć usługi na najwyższym poziomie. Dalsze korzystanie ze strony oznacza, że zgadzasz się na ich użycie.</p>
            <router-link to="/polityka-prywatnosci"><a href="#">Polityka prywatności</a></router-link>
            <button @click="acceptCookies">Akceptuj</button>
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
import { mapActions } from 'vuex';

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
            return {
                products: [],
                cookieAccepted: false,
                policyVisible: false,
            }
        },
        methods: {
            ...mapActions(['addToCart']),
            async fetchProducts() {
        try {
            const response = await axios.get('http://localhost:8000/api/products/Promocje');
            const allProducts = response.data.products; // Zaktualizowane odwołanie do danych
            if (Array.isArray(allProducts)) {
                const filteredProducts = allProducts.filter(product => 
                    [1, 2, 8, 10].includes(product.id)); // Użyj product.id zamiast product.article_id
                this.products = filteredProducts;
            } else {
                console.error('Otrzymano dane w nieprawidłowym formacie:', allProducts);
            }
        } catch (error) {
            console.error('Błąd podczas pobierania produktów:', error);
        }
    },
    addProductToCart(product) {
      this.addToCart(product);
    },
    showPolicy() {
        this.policyVisible = true;
      },
      acceptCookies() {
        this.cookieAccepted = true;
      },
    },
        // inne metody
        mounted() {
    // Sprawdź, czy użytkownik jest zalogowany po załadowaniu komponentu
    this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    // Pobierz rolę użytkownika z localStorage
    this.userRole = localStorage.getItem('userRole') || '';

    this.userName = localStorage.getItem('userName') || '';

    // Wyświetl wynik w konsoli
    if (this.isLoggedIn) {
        console.log('Użytkownik jest zalogowany');
        console.log('Rola użytkownika:', this.userRole);
        console.log('Nazwa użytkownika:', this.userName);
    } else {
        console.log('Użytkownik nie jest zalogowany');
    }
    this.fetchProducts();
},
}
</script>

<style lang="scss" scoped>
.home {
    background-color: var(--black);
    padding-top: 15.25rem;
    padding-bottom: 10rem;
    .home-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        .home-left {
            h2 {
                font-size: 32px;
                color: var(--gold);
                margin-bottom: 1rem;
                font-weight: 400;
            }
            h1 {
                font-size: 96px;
                color: var(--light-gold);
                margin-bottom: 2rem;
                font-weight: 400;
                span {
                    color: var(--gold);
                }
            }
            .home-button {
                a {
                    text-decoration: none;
                    color: var(--black);
                    .home-btn {
                        width: 260px;
                        height: 40px;
                        background-color: var(--gold);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 16px;
                        border-radius: 25px;
                        transition: 0.5s;
                        border: 2px solid var(--gold);
                        cursor: pointer;
                        font-weight: 600;
                        &:hover {
                            background-color: var(--black);
                            color: var(--gold);
                            border: 2px solid var(--gold);
                        }
                    }
                }
            }
        }
    }
}
.candles-info {
    padding-top: 4rem;
    padding-bottom: 4rem;
    background: url('../assets/3.webp');
    background-repeat: no-repeat;
    background-size: cover;
    .candles-info-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
    }
    h3 {
        font-size: 48px;
        font-weight: 600;
        color: var(--black);
        text-align: center;
        margin-bottom: 1rem;
    }
    p:not(:last-child) {
        margin-bottom: 1rem;
    }
    p {
        font-size: 16px;
        font-weight: 600;
        text-align: center;
    }
}

.categories {
    padding-top: 4rem;
    padding-bottom: 4rem;
    .categories-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        .categories-heading {
            h4 {
                font-size: 48px;
                text-align: center;
                font-weight: 600;
                margin-bottom: 4rem;
            }
        }
        .categories-box-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            a {
                text-decoration: none;
                width: 20%;
                color: var(--black);
            }
            .categories-box {
                background-color: var(--light-gold);
                width: 100%;
                cursor: pointer;
                border-radius: 25px;
                .categories-box-top {
                    width: 95%;
                    margin-left: auto;
                    margin-right: auto;
                    height: 300px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    img {
                        max-height: 80%;
                        max-width: 80%;
                    }
                }
                .categories-box-bottom {
                    width: 95%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-bottom: 1rem;
                    p {
                        font-size: 24px;
                        text-align: center;
                        font-weight: 600;
                    }
                }
            }
        }
    }
}

.best-selling {
    padding-bottom: 4rem;
    .best-selling-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        .best-selling-heading {
            h4 {
                font-size: 48px;
                text-align: center;
                font-weight: 600;
                margin-bottom: 4rem;
            }
        }
        .best-selling-box-container {
            display: flex;
            justify-content: space-between;
            .best-selling-box {
                width: 20%;
                .best-selling-box-top {
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    display: flex;
                    justify-content: center;
                    background-color: var(--light-gold);
                    border-radius: 25px;
                    cursor: pointer;
                    .best-selling-box-top-content {
                        width: 80%;
                        padding: 4rem;
                        border: 2px solid var(--gold);
                        border-radius: 25px;
                        .best-selling-box-img {
                            img {
                                max-width: 100%;
                                max-height: 100%;
                            }
                        }
                    }
                }
                .best-selling-box-bottom {
                    p:not(:last-child) {
                        margin-bottom: 1rem;
                        margin-top: 1rem;
                    }
                    p {
                        text-align: center;
                        font-size: 20px;
                        font-weight: 600;
                        &.active {
                            text-decoration: line-through;
                        }
                    }
                    .best-selling-box-cart {
                        text-align: center;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        a {
                            font-size: 20px;
                            text-decoration: none;
                            color: var(--black);
                            font-weight: 600;
                            transition: 0.5s;
                            display: flex;
                            align-items: center;
                            cursor: pointer;
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
    }
}

.collection {
    padding-top: 4rem;
    padding-bottom: 4rem;
    background: url('../assets/12.webp');
    background-repeat: no-repeat;
    background-size: cover;
    .collection-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        .collection-left {
            h5 {
                font-size: 48px;
                color: var(--white);
                margin-bottom: 2rem;
                font-weight: 400;
            }
            .collection-button {
                a {
                    text-decoration: none;
                    .collection-btn {
                        width: 260px;
                        height: 40px;
                        font-size: 16px;
                        background-color: var(--gold);
                        border: 2px solid var(--gold);
                        border-radius: 25px;
                        color: var(--black);
                        transition: 0.5s;
                        cursor: pointer;
                        font-weight: 600;
                        &:hover {
                            background-color: var(--transparent);
                            color: var(--gold);
                        }
                    }
                }
            }
        }
    }
}

.features {
    padding-top: 4rem;
    padding-bottom: 4rem;
    .features-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        .features-heading {
            h6 {
                font-size: 48px;
                color: var(--black);
                margin-bottom: 4rem;
                text-align: center;
            }
        }
        .features-box-container {
            display: flex;
            justify-content: space-between;
            .features-box {
                width: 20%;
                background-color: var(--light-grey);
                padding-top: 1rem;
                padding-bottom: 1rem;
                border-radius: 25px;
                .features-box-top {
                    margin-bottom: 1rem;
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                }
                .features-box-bottom {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    h2 {
                        margin-bottom: 1rem;
                        font-size: 24px;
                        font-weight: 600;
                    }
                    p {
                        font-size: 16px;
                        font-weight: 600;
                    }
                }
            }
        }
    }
}

.aboutus {
    padding-bottom: 4rem;
    .aboutus-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        .aboutus-left {
            img {
                width: 100%;
            }
        }
        .aboutus-right {
            width: 50%;
            height: 400px;
            background: url('../assets/19.webp');
            display: flex;
            align-items: center;
            border-radius: 25px;
            .aboutus-right-content {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                h2 {
                    font-size: 48px;
                    margin-bottom: 2rem;
                }
                p {
                    font-size: 16px;
                    font-weight: 600;
                    margin-bottom: 2rem;
                }
                .aboutus-button {
                    a {
                        text-decoration: none;
                        .aboutus-btn {
                            width: 260px;
                            height: 40px;
                            background-color: var(--gold);
                            border: 2px solid var(--gold);
                            font-size: 16px;
                            font-weight: 600;
                            border-radius: 25px;
                            cursor: pointer;
                            transition: 0.5s;
                            color: var(--black);
                            &:hover {
                                background-color: var(--transparent);
                                color: var(--black);
                                border: 2px solid var(--black);
                            }
                        }
                    }
                }
            }
        }
    }
}

.info {
    padding-bottom: 4rem;
    .info-content {
        background-color: var(--black);
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 4rem;
        padding-bottom: 4rem;
        border-radius: 25px;
        .info-top {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            p {
                color: var(--white);
                font-size: 20px;
            }
        }
        .info-columns:nth-child(2) {
            display: flex;
            justify-content: space-between;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 4rem;
            margin-bottom: 4rem;
            .info-left {
                width: 60%;
                h3 {
                    font-size: 48px;
                    color: var(--white);
                    font-weight: 400;
                    margin-bottom: 2rem;
                }
                p {
                    color: var(--white);
                    font-size: 20px;
                }
            }
        }
        .info-columns:nth-child(3) {
            display: flex;
            justify-content: space-between;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 4rem;
            margin-bottom: 4rem;
            .info-right {
                width: 60%;
                h4 {
                    font-size: 48px;
                    color: var(--white);
                    font-weight: 400;
                    margin-bottom: 2rem;
                }
                p {
                    color: var(--white);
                    font-size: 20px;
                }
            }
        }
        .info-bottom {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            p {
                font-size: 20px;
                color: var(--white);
            }
        }
    }
}

.cookie-policy {
        position: fixed;
        bottom: 0;
        width: 100%;
        max-width: 1920px;
        background-color: var(--white);
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-top: 1px solid var(--shadow);
        .cookie-policy-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            p {
                font-weight: 600;
            }
            a {
                color: var(--black);
                text-underline-offset: 4px;
                transition: 0.5s;
                font-weight: 600;
                &:hover {
                    color: var(--gold);
                }
            }
            button {
                padding: 0.2rem 2rem;
                background-color: var(--gold);
                color: var(--white);
                border-radius: 25px;
                transition: 0.5s;
                cursor: pointer;
                color: var(--black);
                font-weight: 600;
                border: 2px solid var(--gold);
                font-size: 14px;
                &:hover {
                    background-color: var(--black);
                    border: 2px solid var(--black);
                    color: var(--gold);
                }
            }
        }
    }

@media screen and (max-width: 1650px) {
    .home {
        .home-content {
            .home-left {
                h1 {
                    font-size: 72px;
                }
            }
            .home-right {
                img {
                    width: 100%;
                }
            }
        }
    }
    .best-selling {
        .best-selling-content {
            .best-selling-box-container {
                .best-selling-box {
                    .best-selling-box-top {
                        .best-selling-box-top-content {
                            padding: 3rem;
                        }
                    }
                }
            }
        }
    }
    .aboutus {
        .aboutus-content {
            .aboutus-left {
                img {
                    width: 90%;
                }
            }
        }
    }
    .info {
        .info-content {
            .info-columns:nth-child(2) {
                .info-left {
                    width: 50%;
                }
            }
            .info-columns:nth-child(3) {
                .info-right {
                    width: 50%;
                }
            }
        }
    }
    .cookie-policy {
            .cookie-policy-content {
                flex-direction: column;
                p {
                    margin-bottom: 1rem;
                    text-align: center;
                }
                a {
                    margin-bottom: 1rem;
                }
            }
        }
        
}

@media screen and (max-width: 1200px) {
    .home {
        padding-top: 6.5rem;
        padding-bottom: 2rem;
        .home-content {
            flex-direction: column;
            width: 90%;
            .home-left {
                width: 100%;
                margin-bottom: 2rem;
                h1 {
                    font-size: 32px;
                    margin-bottom: 1rem;
                }
                h2 {
                    font-size: 24px;
                    margin-bottom: 0;
                }
            }
        }
    }
    .candles-info {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .candles-info-content {
            width: 90%;
            h3 {
                text-align: start;
                font-size: 32px;
            }
            p {
                text-align: start;
            }
        }
    }
    .categories {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .categories-content {
            width: 90%;
            .categories-heading {
                h4 {
                    font-size: 32px;
                    text-align: start;
                    margin-bottom: 2rem;
                }
            }
            .categories-box-container {
                flex-direction: column;
                a:not(:last-child) {
                    margin-bottom: 2rem;
                }
                a {
                    width: 100%;
                    .categories-box {
                        width: 100%;
                        .categories-box-bottom {
                            p {
                                font-size: 20px;
                            }
                        }
                    }
                }
            }
        }
    }
    .best-selling {
        padding-bottom: 0;
        .best-selling-content {
            width: 90%;
            .best-selling-heading {
                h4 {
                    font-size: 32px;
                    text-align: start;
                    margin-bottom: 2rem;
                }
            }
            .best-selling-box-container {
                flex-direction: column;
                .best-selling-box {
                    width: 100%;
                    .best-selling-box-top {
                    margin-bottom: 2rem;
                        .best-selling-box-top-content {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                    }
                    .best-selling-box-bottom {
                        p:not(:last-child) {
                            margin-top: 0;
                        }
                        .best-selling-box-cart {
                            margin-bottom: 2rem;
                        }
                    }
                }
            }
        }
    }
    .collection {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .collection-content {
            width: 90%;
            flex-direction: column;
            .collection-left {
                width: 100%;
                h5 {
                    font-size: 32px;
                }
                .collection-button {
                    margin-bottom: 2rem;
                }
            }
            .collection-right {
                width: 100%;
                img {
                    width: 100%;
                }
            }
        }
    }

    .features {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .features-content {
            width: 90%;
            .features-heading {
                h6 {
                    font-size: 32px;
                    text-align: start;
                    margin-bottom: 2rem;
                }
            }
            .features-box-container {
                flex-direction: column;
                .features-box:not(:last-child) {
                    margin-bottom: 2rem;
                }
                .features-box {
                    width: 100%;
                    .features-box-bottom {
                        h2 {
                            font-size: 20px;
                        }
                    }
                }
            }
        }
    }

    .aboutus {
        padding-top: 0;
        padding-bottom: 2rem;
        .aboutus-content {
            width: 90%;
            flex-direction: column;
            .aboutus-left {
                width: 100%;
                margin-bottom: 2rem;
            }
            .aboutus-right {
                width: 100%;
                height: 100%;
                padding-top: 2rem;
                padding-bottom: 2rem;
                .aboutus-right-content {
                    h2 {
                        font-size: 32px;
                    }
                }
            }
        }
    }

    .info {
        padding-bottom: 2rem;
        .info-content {
            width: 90%;
            padding-top: 2rem;
            padding-bottom: 2rem;
            .info-top {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                p {
                    font-size: 16px;
                }
            }
            .info-columns:nth-child(2) {
                flex-direction: column;
                margin-top: 2rem;
                margin-bottom: 0rem;
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                .info-left {
                    width: 100%;
                    margin-bottom: 2rem;
                    h3 {
                        font-size: 32px;
                    }
                    p {
                        font-size: 16px
                    }
                }
                .info-right {
                    img {
                        width: 100%;
                    }
                }
            }
            .info-columns:nth-child(3) {
                flex-direction: column;
                margin-top: 2rem;
                margin-bottom: 2rem;
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                .info-right {
                    width: 100%;
                    margin-top: 2rem;
                    h4 {
                        font-size: 32px;
                    }
                    p {
                        font-size: 16px
                    }
                }
                .info-left {
                    img {
                        width: 100%;
                    }
                }
            }
            
            .info-bottom {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                p {
                    font-size: 16px;
                }
            }
        }
    }
}

@media screen and (max-width: 320px) {
    .home {
        padding-top: 6.5rem;
        padding-bottom: 2rem;
        .home-content {
            flex-direction: column;
            width: 90%;
            .home-left {
                width: 100%;
                margin-bottom: 2rem;
                h1 {
                    font-size: 28px;
                    margin-bottom: 1rem;
                }
                h2 {
                    font-size: 28px;
                    margin-bottom: 0;
                }
                .home-button {
                    width: 100%;
                }
            }
        }
    }
    .candles-info {
        .candles-info-content {
            h3 {
                font-size: 28px;
            }
        }
    }
    .collection {
        .collection-content {
            .collection-left {
                .collection-button {
                    width: 100%;
                    .collection-btn {
                        width: 100%;
                    }
                }
            }
        }
    }
    .aboutus {
        .aboutus-content {
            .aboutus-right {
                .aboutus-right-content {
                    .aboutus-button {
                        .aboutus-btn {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
}

</style>
  