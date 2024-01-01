import { createRouter, createWebHistory } from "vue-router"
import axios from 'axios'
import store from '@vuex/vuex-functions'

// Podstrony
import MainPage from '@subpages/main-page.vue'
import AboutUs from '@subpages/about-us.vue'
import Collaboration from '@subpages/collaboration.vue'
import Collections from '@subpages/collections.vue'
import Faq from '@subpages/faq.vue'
import Contact from '@subpages/contact.vue'
//Dokumenty
import PolicyPrivacy from '@documents/policy-privacy.vue'
import Statute from '@documents/statute.vue'
//Logowanie
import Login from '@authentication/login.vue'
import Register from '@authentication/register.vue'
import RecoverPassword from '@authentication/recover-password.vue'
import ResetPassword from '@authentication/reset-password.vue'
//Sklep
import Shop from '@shop/shop.vue'
import ProductPage from '@shop/product-page.vue'
import Cart from '@shop/cart.vue'
import CheckoutPage from '@shop/checkout-page.vue'
import ThanksForOrder from '@shop/thanks-for-order.vue'
import OrderStatus from '@shop/order-status.vue'
//Blog
import Blog from '@blog/blog.vue'
import Article from '@blog/article.vue'

//Panel administratora - Blog
import BlogList from '@admin-blog/blog-list.vue'
import BlogAddPost from '@admin-blog/blog-add-post.vue'
import BlogAddMeta from '@admin-blog/blog-add-meta.vue'
import BlogAddPhoto from '@admin-blog/blog-add-photo.vue'
import BlogAddContent from '@admin-blog/blog-add-content.vue'
import BlogEditContent from '@admin-blog/blog-edit-content.vue'
//Panel administratora - Kategorie
import CategoryList from '@admin-category/category-list.vue'
import CategoryAdd from '@admin-category/category-add.vue'
import CategoryEdit from '@admin-category/category-edit.vue'
//Panel administratora - Newsletter
import NewsletterList from '@admin-newsletter/newsletter-list.vue'
//Panel administratora - Zamowienia
import OrderListAdmin from '@admin-orders/order-list-admin.vue'
import OrderContentAdmin from '@admin-orders/order-content-admin.vue'
//Panel administratora - Produkty
import ProductList from '@admin-products/product-list.vue'
import ProductAdd from '@admin-products/product-add.vue'
import ProductAddDescription from '@admin-products/product-add-description.vue'
import ProductAddPhoto from '@admin-products/product-add-photo.vue'
import ProductAddMeta from '@admin-products/product-add-meta.vue'
import ProductEdit from '@admin-products/product-edit.vue'
//Panel administratora - Kod rabatowy
import PromoCodeList from '@admin-promo-code/promo-code-list.vue'
import PromoCodeAdd from '@admin-promo-code/promo-code-add.vue'
//Panel administratora - Użytkownicy
import UsersList from '@admin-users/users-list.vue'
//Panel administratora - Analityka
import Analitics from '@admin-analitics/analitics.vue'
//Panel administratora - Ustawienia
import SettingsAccountAdmin from '@admin-settings/settings-account-admin.vue'
import ChangeEmailAdmin from '@admin-settings/change-email-admin.vue'

//Panel użytkownika - Zamowienia
import OrderListUser from '@user-orders/order-list-user.vue'
import OrderContentUser from '@user-orders/order-content-user.vue'
//Panel użytkownika - Ustawienia
import SettingsAccountUser from '@user-settings/settings-account-user.vue'
import ChangeEmailUser from '@user-settings/change-email-user.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: MainPage,
            name: "main-page",
            meta: {
                title: "SoyFragrance – Naturalne Świece Sojowe i Aromaterapia",
                description: "Odkryj naszą kolekcję naturalnych świec sojowych i produktów aromaterapeutycznych. Idealne do domu i jako prezent.",
            },
        },
        {
            path: '/wspolpraca',
            component: Collaboration,
            name: "collaboration",
            meta: {
                title: "Współpraca z SoyFragrance – Dołącz do Naszych Partnerów",
                description: "Zostań partnerem SoyFragrance. Oferujemy atrakcyjne warunki współpracy dla sklepów i indywidualnych przedsiębiorców.",
            },
        },
        {
            path: '/o-naszej-firmie',
            component: AboutUs,
            name: "about-us",
            meta: {
                title: "O naszej firmie – Poznaj SoyFragrance i Naszą Misję",
                description: "Dowiedz się więcej o SoyFragrance, naszej filozofii i zaangażowaniu w tworzenie ekologicznych produktów zapachowych.",
            },
        },
        {
            path: '/kolekcje',
            component: Collections,
            name: "collections",
            meta: {
                title: "Kolekcje SoyFragrance – Wyjątkowe Świece i Zapachy",
                description: "Przeglądaj nasze ekskluzywne kolekcje świec sojowych i dyfuzorów. Znajdź idealny zapach dla siebie.",
            },
        },
        {
            path: '/faq',
            component: Faq,
            name: "faq",
            meta: {
                title: "Najczęściej Zadawane Pytania – SoyFragrance",
                description: "Masz pytania? Znajdź odpowiedzi na najczęściej zadawane pytania dotyczące naszych produktów i usług.",
            },
        },
        {
            path: '/kontakt',
            component: Contact,
            name: "contact",
            meta: {
                title: "Kontakt z SoyFragrance – Skontaktuj się z Nami",
                description: "Masz pytania lub sugestie? Skontaktuj się z nami przez formularz kontaktowy, e-mail lub telefon.",
            },
        },
        //Dokumenty
        {
            path: '/polityka-prywatnosci',
            component: PolicyPrivacy,
            name: "policy-privacy",
            meta: {
                title: "Polityka Prywatności – SoyFragrance",
                description: "Przeczytaj naszą politykę prywatności, aby dowiedzieć się, jak chronimy Twoje dane osobowe i jakie masz prawa.",
            },
        },
        {
            path: '/regulamin',
            component: Statute,
            name: "statute",
            meta: {
                title: "Regulamin sklepu - SoyFragrance",
                description: "Zapoznaj się z regulaminem naszego sklepu, aby poznać zasady zakupów i korzystania z naszych usług.",
            },
        },
        //Blog
        {
            path: '/blog',
            component: Blog,
            name: "blog",
            meta: {
                title: "Blog SoyFragrance – Porady, Nowości i Inspiracje",
                description: "Czytaj nasz blog i bądź na bieżąco z nowościami, poradami i inspiracjami dotyczącymi świec sojowych i aromaterapii.",
            },
        },
        {
            path: '/artykul/:slug',
            component: Article,
            name: "article",
            meta: {
                title: "",
                description: "",
            },
        },
        //System autoryzujący
        {
            path: '/logowanie',
            component: Login,
            name: "login",
            meta: {
                title: "Logowanie – Dostęp do Twojego Konta SoyFragrance",
                description: "Zaloguj się, aby uzyskać dostęp do swojego konta, śledzić zamówienia i korzystać z ekskluzywnych ofert.",
            },
        },
        {
            path: '/rejestracja',
            component: Register,
            name: "register",
            meta: {
                title: "Rejestracja – Dołącz do Społeczności SoyFragrance",
                description: "Zarejestruj się, aby tworzyć listy życzeń, szybko składać zamówienia i otrzymywać aktualności o promocjach.",
            },
        },
        {
            path: '/odzyskiwanie-hasla',
            component: RecoverPassword,
            name: "recover-password",
            meta: {
                title: "Odzyskiwanie Hasła – Zresetuj Swoje Hasło",
                description: "Zapomniałeś hasła? Zresetuj je łatwo, aby ponownie uzyskać dostęp do swojego konta SoyFragrance.",
            },
        },
        {
            path: '/resetowanie-hasla/:token',
            component: ResetPassword,
            name: "reset-password",
            meta: {
                title: "Resetowanie Hasła – Utwórz Nowe Hasło",
                description: "Bezpiecznie utwórz nowe hasło do swojego konta SoyFragrance, aby kontynuować zakupy i korzystanie z naszych usług.",
            },
        },
        //Sklep
        {
            path: '/sklep/:category_name/:page?',
            component: Shop,
            name: "shop",
            meta: {
                title: "Sklep SoyFragrance – Naturalne Świece i Aromaterapia",
                description: "Przeglądaj nasz asortyment naturalnych świec sojowych, olejków i akcesoriów do aromaterapii. Znajdź coś dla siebie.",
            },
            params: true,
        },
        {
            path: '/strona-produktu/:id',
            component: ProductPage,
            name: "product-page",
            meta: {
                title: "",
                description: "",
            },
        },
        {
            path: '/koszyk',
            component: Cart,
            name: "cart",
            meta: {
                title: "Twój Koszyk – SoyFragrance",
                description: "Przejrzyj produkty w Twoim koszyku i przejdź do realizacji zamówienia. Odkryj świat naturalnych zapachów.",
            },
        },
        {
            path: '/strona-zamowienia',
            component: CheckoutPage,
            name: "checkout-page",
            meta: {
                title: "Złóż Zamówienie – SoyFragrance",
                description: "Skompletuj swoje zamówienie. Prosty i bezpieczny proces zakupu naturalnych produktów zapachowych.",
            },
        },
        {
            path: '/podziekowanie-za-zamowienie',
            component: ThanksForOrder,
            name: "thanks-for-order",
            meta: {
                title: "Dziękujemy za Zamówienie – SoyFragrance",
                description: "Dziękujemy za Twoje zamówienie. Przygotowujemy Twoje naturalne świece i aromaty do wysyłki.",
            },
        },
        {
            path: '/status-zamowienia/:orderNumber',
            component: OrderStatus,
            name: "order-status",
            meta: {
                title: "Sprawdź Status Zamówienia – SoyFragrance",
                description: "Śledź status swojego zamówienia. Zapewniamy szybką i bezpieczną dostawę Twoich produktów.",
            },
        },
        //Panel administratora

        //Panel administratora - Blog
        {
            path: '/blog-lista',
            component: BlogList,
            name: "blog-list",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/blog-dodaj-post',
            component: BlogAddPost,
            name: "blog-add-post",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/blog-dodaj-meta/:slug',
            component: BlogAddMeta,
            name: "blog-add-meta",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/blog-dodaj-zdjecie/:slug',
            component: BlogAddPhoto,
            name: "blog-add-photo",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/blog-dodaj-tresc/:slug',
            component: BlogAddContent,
            name: "blog-add-content",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/blog-edytuj-tresc/:slug',
            component: BlogEditContent,
            name: "blog-edit-content",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },

        //Panel administratora - Kategorie
        {
            path: '/kategorie-lista',
            component: CategoryList,
            name: "category-list",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/kategorie-dodaj',
            component: CategoryAdd,
            name: "category-add",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/kategorie-edytuj/:id',
            component: CategoryEdit,
            name: "category-edit",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },

        //Panel administratora - Newsletter
        {
            path: '/newsletter-lista',
            component: NewsletterList,
            name: "newsletter-list",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
         //Panel administratora - Zamowienia
        {
            path: '/lista-zamowien-administrator',
            component: OrderListAdmin,
            name: "order-list-admin",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/zamowienia-tresc-administrator/:order_number',
            component: OrderContentAdmin,
            name: "order-content-admin",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        //Panel administratora - Produkty
        {
            path: '/lista-produktow',
            component: ProductList,
            name: "product-list",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/produkt-dodaj',
            component: ProductAdd,
            name: "product-add",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/produkt-dodaj-opis/:id',
            component: ProductAddDescription,
            name: "product-add-description",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/produkt-dodaj-zdjecia/:id',
            component: ProductAddPhoto,
            name: "product-add-photo",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/produkt-dodaj-meta/:id',
            component: ProductAddMeta,
            name: "product-add-meta",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/produkt-edytuj/:id',
            component: ProductEdit,
            name: "product-edit",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        //Panel administratora - Kod rabatowy
        {
            path: '/lista-kodow-rabatowych',
            component: PromoCodeList,
            name: "promo-code-list",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/kod-rabatowy-dodaj',
            component: PromoCodeAdd,
            name: "promo-code-add",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
         //Panel administratora - Użytkownicy
         {
            path: '/lista-uzytkownikow',
            component: UsersList,
            name: "users-list",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/analityka',
            component: Analitics,
            name: "analitics",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        //Panel administratora - Ustawienia
        {
            path: '/ustawienia-konta-administrator',
            component: SettingsAccountAdmin,
            name: "settings-account-admin",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/zmien-email-administrator/:id',
            component: ChangeEmailAdmin,
            name: "change-email-admin",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        //Panel użytkownika - Zamowienia
        {
            path: '/lista-zamowien-uzytkownik',
            component: OrderListUser,
            name: "order-list-user",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/zamowienia-tresc-uzytkownik/:order_number',
            component: OrderContentUser,
            name: "order-content-user",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
         //Panel użytkownika - Ustawienia
         {
            path: '/ustawienia-konta-uzytkownik',
            component: SettingsAccountUser,
            name: "settings-account-user",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
        {
            path: '/zmien-email-uzytkownik/:id',
            component: ChangeEmailUser,
            name: "change-email-user",
            meta: {
                title: "",
                description: "",
            },
            content: 'noindex, nofollow',
        },
    ]
});

router.beforeEach(async (to, from, next) => {
    window.scrollTo(0, 0);
    store.dispatch('resetMenuStates');

    console.log('Routing to:', to.name); // Pokaż nazwę docelowej trasy

    if (to.meta && to.meta.title) {
        document.title = to.meta.title;
    }

    if (to.name === 'product-page') {
        const productId = to.params.id;
        console.log('Fetching product meta-data for ID:', productId);

        try {
            const response = await axios.get(`https://soyfragrance.pl/server/api/product-meta-data/${productId}`);
            const product = response.data.article;
            console.log('Product meta-data received:', product); // Pokaż otrzymane metadane produktu

            if (product) {
                if (product.product_title) {
                    document.title = product.product_title;
                    console.log('Document title set to:', product.product_title); // Pokaż ustawiony tytuł
                }

                if (product.product_description) {
                    let descriptionMetaTag = document.querySelector('meta[name="description"]');
                    if (!descriptionMetaTag) {
                        descriptionMetaTag = document.createElement('meta');
                        descriptionMetaTag.setAttribute('name', 'description');
                        document.getElementsByTagName('head')[0].appendChild(descriptionMetaTag);
                        console.log('Meta description tag created and appended to head'); // Informacja o utworzeniu tagu
                    }
                    descriptionMetaTag.setAttribute('content', product.product_description);
                    console.log('Meta description content set to:', product.product_description); // Pokaż ustawiony opis
                }
            }
        } catch (error) {
            console.error('Error fetching product meta-data:', error);
            next({ name: '404' });
            return;
        }
    }

    // Dla strony artykułu
    if (to.name === 'article') {
        const slug = to.params.slug;
        console.log('Article Name:', slug);
    
        try {
            const response = await axios.get(`http://localhost:8000/api/blog-download-meta/${slug}`);
            const article = response.data.article;
        
            if (article.article_meta_title) {
                document.title = article.article_meta_title;
            }
        
            if (article.article_meta_description) {
                const descriptionMetaTag = document.querySelector('meta[name="description"]');
                if (descriptionMetaTag) {
                    descriptionMetaTag.setAttribute('content', article.article_meta_description);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            next({ name: '404' });
            return;
        }
    }

    next();
});


export default router