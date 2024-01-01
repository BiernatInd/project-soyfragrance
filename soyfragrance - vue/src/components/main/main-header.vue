<template>
    <div class="top-bar">
       <div class="top-bar-content">
           <div class="top-bar-left">
               <router-link to="/polityka-prywatnosci">Polityka prywatności</router-link>
               <router-link to="/faq">FAQ</router-link>
               <router-link to="/regulamin">Regulamin</router-link>
           </div>
           <div class="top-bar-right">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <circle cx="15" cy="15" r="14.5" stroke="black"/>
                   <path d="M12.6133 21H15.3067V15.5195H17.7334L18 12.7963H15.3067V11.4211C15.3067 11.2396 15.3776 11.0656 15.5039 10.9372C15.6301 10.8089 15.8014 10.7368 15.98 10.7368H18V8H15.98C15.0871 8 14.2308 8.36043 13.5994 9.002C12.968 9.64357 12.6133 10.5137 12.6133 11.4211V12.7963H11.2666L11 15.5195H12.6133V21Z" fill="black"/>
               </svg>
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <circle cx="15" cy="15" r="14.5" stroke="black"/>
                   <path d="M15.5 11.9001C14.8104 11.9001 14.1491 12.1741 13.6615 12.6617C13.1739 13.1493 12.9 13.8106 12.9 14.5001C12.9 15.1897 13.1739 15.851 13.6615 16.3386C14.1491 16.8262 14.8104 17.1001 15.5 17.1001C16.1896 17.1001 16.8509 16.8262 17.3385 16.3386C17.8261 15.851 18.1 15.1897 18.1 14.5001C18.1 13.8106 17.8261 13.1493 17.3385 12.6617C16.8509 12.1741 16.1896 11.9001 15.5 11.9001Z" fill="black"/>
                   <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8018 8.204C14.2597 7.932 16.7403 7.932 19.1983 8.204C20.5411 8.35366 21.6237 9.40905 21.7814 10.7546C22.0729 13.2428 22.0729 15.7564 21.7814 18.2447C21.6237 19.5902 20.5411 20.6456 19.199 20.7959C16.7408 21.068 14.26 21.068 11.8018 20.7959C10.4589 20.6456 9.37633 19.5902 9.21865 18.2454C8.92712 15.7569 8.92712 13.243 9.21865 10.7546C9.37633 9.40905 10.4589 8.35366 11.8018 8.204ZM19.0356 10.2639C18.8481 10.2639 18.6682 10.3383 18.5356 10.4707C18.403 10.6031 18.3285 10.7827 18.3285 10.9699C18.3285 11.1571 18.403 11.3367 18.5356 11.4691C18.6682 11.6015 18.8481 11.6758 19.0356 11.6758C19.2232 11.6758 19.403 11.6015 19.5356 11.4691C19.6683 11.3367 19.7428 11.1571 19.7428 10.9699C19.7428 10.7827 19.6683 10.6031 19.5356 10.4707C19.403 10.3383 19.2232 10.2639 19.0356 10.2639ZM12.1412 14.4996C12.1412 13.6103 12.4951 12.7574 13.125 12.1285C13.7549 11.4997 14.6092 11.1464 15.5 11.1464C16.3908 11.1464 17.2452 11.4997 17.8751 12.1285C18.505 12.7574 18.8588 13.6103 18.8588 14.4996C18.8588 15.389 18.505 16.2419 17.8751 16.8707C17.2452 17.4996 16.3908 17.8529 15.5 17.8529C14.6092 17.8529 13.7549 17.4996 13.125 16.8707C12.4951 16.2419 12.1412 15.389 12.1412 14.4996Z" fill="black"/>
               </svg>
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <circle cx="15" cy="15" r="14.5" stroke="black"/>
                   <path d="M19.238 8H21.2314L16.8764 13.5073L22 21H17.9884L14.8468 16.4551L11.2512 21H9.25675L13.9151 15.1092L9 8.0006H13.1134L15.9534 12.1548L19.238 8ZM18.5388 19.6804H19.6432L12.5133 9.25068H11.3281L18.5388 19.6804Z" fill="black"/>
               </svg>
           </div>
       </div>
   </div>
   <header class="header" :class="{ sticky: headerSticky }">
       <nav class="nav">
           <div class="nav-left">
               <router-link to="/">
                   <img src="../../assets/logo.svg" alt="">
               </router-link>
           </div>
           <div class="nav-center">
               <router-link to="/" :class="{ 'active': $route.path === '/' }" href="#">Strona główna</router-link>
               <router-link :to="{ name: 'shop', params: { category_name: 'Promocje', page: 1 }}" :class="{ 'active': $route.path.startsWith('/sklep/') }">Sklep</router-link>
               <router-link to="/kolekcje" :class="{ 'active': $route.path === '/kolekcje' }" href="#">Kolekcje</router-link>
               <router-link to="/wspolpraca" :class="{ 'active': $route.path === '/wspolpraca' }" href="#">Współpraca B2B</router-link>
               <router-link to="/o-naszej-firmie" :class="{ 'active': $route.path === '/o-naszej-firmie' }" href="#">O nas</router-link>
               <router-link to="/blog" :class="{ 'active': $route.path === '/blog' }" href="#">Blog</router-link>
               <router-link to="/kontakt" :class="{ 'active': $route.path === '/kontakt' }" href="#">Kontakt</router-link>
           </div>
           <div class="nav-right">
               <div class="nav-menu" @click="toggleMainMenu" :class="{ 'active': mainMenuActive }"> <!-- Dodaje klasę active dla wrapper-menu, nav-menu i main-menu-->
                   <div class="wrapper-menu">
                       <div class="line-menu half start"></div>
                       <div class="line-menu"></div>
                       <div class="line-menu half end"></div>
                   </div>
               </div>
               <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="toggleAuthMenu"> 
                   <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                   <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 16.25C16.5 15.6919 16.6099 15.1392 16.8235 14.6236C17.0371 14.108 17.3501 13.6394 17.7448 13.2448C18.1394 12.8501 18.608 12.5371 19.1236 12.3235C19.6392 12.1099 20.1919 12 20.75 12C21.3081 12 21.8608 12.1099 22.3764 12.3235C22.892 12.5371 23.3606 12.8501 23.7552 13.2448C24.1499 13.6394 24.4629 14.108 24.6765 14.6236C24.8901 15.1392 25 15.6919 25 16.25C25 17.3772 24.5522 18.4582 23.7552 19.2552C22.9582 20.0522 21.8772 20.5 20.75 20.5C19.6228 20.5 18.5418 20.0522 17.7448 19.2552C16.9478 18.4582 16.5 17.3772 16.5 16.25ZM20.75 13.5C20.0207 13.5 19.3212 13.7897 18.8055 14.3055C18.2897 14.8212 18 15.5207 18 16.25C18 16.9793 18.2897 17.6788 18.8055 18.1945C19.3212 18.7103 20.0207 19 20.75 19C21.4793 19 22.1788 18.7103 22.6945 18.1945C23.2103 17.6788 23.5 16.9793 23.5 16.25C23.5 15.5207 23.2103 14.8212 22.6945 14.3055C22.1788 13.7897 21.4793 13.5 20.75 13.5ZM16.75 23.5C16.1533 23.5 15.581 23.7371 15.159 24.159C14.7371 24.581 14.5 25.1533 14.5 25.75V26.938C14.5 26.956 14.513 26.972 14.531 26.975C18.65 27.647 22.851 27.647 26.969 26.975C26.9777 26.9736 26.9857 26.969 26.9914 26.9623C26.9971 26.9555 27.0001 26.9469 27 26.938V25.75C27 25.1533 26.7629 24.581 26.341 24.159C25.919 23.7371 25.3467 23.5 24.75 23.5H24.41C24.3832 23.4998 24.3565 23.5038 24.331 23.512L23.466 23.795C21.7012 24.3712 19.7988 24.3712 18.034 23.795L17.168 23.512C17.1431 23.504 17.1171 23.5 17.091 23.5H16.75ZM13 25.75C13 24.7554 13.3951 23.8016 14.0983 23.0983C14.8016 22.3951 15.7554 22 16.75 22H17.09C17.275 22 17.459 22.03 17.634 22.086L18.5 22.369C19.962 22.8462 21.538 22.8462 23 22.369L23.866 22.086C24.041 22.029 24.225 22 24.409 22H24.75C25.7446 22 26.6984 22.3951 27.4017 23.0983C28.1049 23.8016 28.5 24.7554 28.5 25.75V26.938C28.5 27.692 27.954 28.334 27.21 28.455C22.9317 29.1534 18.5683 29.1534 14.29 28.455C13.9299 28.3964 13.6024 28.2116 13.3661 27.9337C13.1298 27.6557 13 27.3028 13 26.938V25.75Z" fill="black"/>
               </svg>
               <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" @click="toggleShoppingBag"> <!-- Dodaje klase active dla main-shopping-bag-->
                   <circle cx="20.5" cy="20.5" r="20.5" fill="#E2C799"/>
                   <path d="M17.329 26.9999C17.6851 26.9999 17.9737 26.7113 17.9737 26.3552C17.9737 25.9991 17.6851 25.7104 17.329 25.7104C16.9729 25.7104 16.6842 25.9991 16.6842 26.3552C16.6842 26.7113 16.9729 26.9999 17.329 26.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M26.3553 26.9999C26.7114 26.9999 27 26.7113 27 26.3552C27 25.9991 26.7114 25.7104 26.3553 25.7104C25.9992 25.7104 25.7106 25.9991 25.7106 26.3552C25.7106 26.7113 25.9992 26.9999 26.3553 26.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M12.2632 13H14.8261L16.7483 23.8684H27" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                   <path d="M16.6728 21.2894H26.6353C26.7092 21.2895 26.7808 21.2637 26.838 21.2164C26.8951 21.1692 26.9343 21.1034 26.9488 21.0303L28.0991 15.2277C28.1084 15.1809 28.1072 15.1326 28.0958 15.0863C28.0843 15.04 28.0628 14.9969 28.0328 14.96C28.0028 14.9231 27.9651 14.8934 27.9223 14.873C27.8796 14.8526 27.8328 14.842 27.7855 14.842H15.3948" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
           </div>
       </nav>
   </header>
   <MainAuthMenu />
   <MainSlideMenu />
   <MainShoppingBag v-if="!['/koszyk', '/strona-zamowienia', '/podziekowanie-za-zamowienie'].includes($route.path)"/>
</template>

<script>
import MainAuthMenu from './main-auth-menu.vue'
import MainSlideMenu from './main-menu.vue'
import MainShoppingBag from './main-shopping-bag.vue'
import { mapState, mapActions } from 'vuex'

export default {
   components: {
       MainAuthMenu,
       MainSlideMenu,
       MainShoppingBag
   },
   data() {
     return {
       headerSticky: false,
     }
   },
   computed: {
   ...mapState(['authMenuActive', 'shoppingBagActive', 'mainMenuActive'])
 },
 methods: {
   ...mapActions(['setAuthMenuActive', 'setShoppingBagActive', 'setMainMenuActive']),
   toggleAuthMenu() {
     this.setAuthMenuActive(!this.authMenuActive);
   },
   toggleShoppingBag() {
     // Sprawdzamy, czy bieżąca ścieżka to 'strona-koszyka'
     if (this.$route.path !== '/strona-koszyka') {
       this.setShoppingBagActive(!this.shoppingBagActive);
     }
     if (this.$route.path !== '/strona-zamowienia') {
       this.setShoppingBagActive(!this.shoppingBagActive);
     }
     if (this.$route.path !== '/podziekowanie-za-zamowienie') {
       this.setShoppingBagActive(!this.shoppingBagActive);
     }
   },
   toggleMainMenu() {
     this.setMainMenuActive(!this.mainMenuActive);
   },
   //Wywołanie dodania klasy sticky
   handleScroll() {
   if (window.scrollY > 0) {
     this.headerSticky = true;
   } else {
     this.headerSticky = false;
   }
 },
 },
 mounted() {
     //Wywołanie dodania klasy sticky
   window.addEventListener('scroll', this.handleScroll);
   // Dodajemy klasę "active" do wrapper-menu przy starcie komponentu, jeśli mainMenuActive jest true
   if (this.mainMenuActive) {
     this.$nextTick(() => {
       document.querySelector('.wrapper-menu').classList.add('active');
     });
   }
 }
}

</script>

<style lang="scss" scoped>
   .top-bar {
       background-color: var(--gold);
       .top-bar-content {
           width: 95%;
           margin-left: auto;
           margin-right: auto;
           display: flex;
           justify-content: space-between;
           align-items: center;
           padding-top: 0.5rem;
           padding-bottom: 0.5rem;
           .top-bar-left {
               a:not(:last-child) {
                   margin-right: 1rem;
               }
               a {
                   color: var(--black);
                   font-size: 16px;
                   font-weight: 600;
                   text-underline-offset: 4px;
               }
           }
           .top-bar-right {
               svg:not(:last-child) {
                   margin-right: 1rem;
               }
               svg {
                   transition: 0.5s;
                   cursor: pointer;
                   &:hover {
                           fill: var(--black);
                           path {
                               fill: var(--gold);
                           }
                   }
               }
           }
       }
   }


   .header {
       position: fixed;
       width: 100%;
       max-width: 1920px;
       background-color: var(--white);
       transition: 0.5s;
       top: 49px;
       border-bottom: 1px solid var(--shadow);
       border-bottom-left-radius: 25px;
       border-bottom-right-radius: 25px;
       z-index: 998;
       &.sticky {
           top: 0;
       }
       .nav {
           width: 95%;
           margin-left: auto;
           margin-right: auto;
           display: flex;
           justify-content: space-between;
           align-items: center;
           padding-top: 0.5rem;
           padding-bottom: 0.5rem;
           .nav-center {
               a:not(:last-child) {
                   margin-right: 2rem;
               }
               a {
                   font-size: 20px;
                   color: var(--black);
                   text-decoration: none;
                   transition: 0.5s;
                   font-weight: 600;
                   &:hover {
                       color: var(--gold);
                   }
                   &.active {
                       color: var(--gold);
                   }
               }
           }
           .nav-right {
               display: flex;
               align-items: center;
               svg:not(:last-child) {
                   margin-right: 1rem;
               }
               svg {
                   cursor: pointer;
                   &:hover {
                       circle {
                           fill: var(--black)
                       }
                       path {
                           stroke: var(--gold);
                       }
                   }
               }
               .nav-menu {
                   width: 41px;
                   height: 41px;
                   border-radius: 50px;
                   background-color: var(--gold);
                   display: flex;
                   align-items: center;
                   justify-content: center;
                   margin-right: 1rem;
                   display: none;
                   cursor: pointer;
                   &:hover {
                       background-color: var(--black);
                       .wrapper-menu {
                           .line-menu {
                               background-color: var(--gold);
                           }
                       }
                   }
               }
               .wrapper-menu {
             width: 18px;
             height: 18px;
             display: flex;
             flex-direction: column;
             justify-content: space-between;
             cursor: pointer;
             transition: transform 330ms ease-out;
           }
   
           .wrapper-menu.active {
             transform: rotate(-45deg);  
           }
   
           .line-menu {
             border-radius: 5px;
             width: 100%;
             height: 2px;
           }
   
           .line-menu:nth-child(1) {
             background-color: var(--black);
           }
           .line-menu:nth-child(2) {
             background-color: var(--black);
           }
           .line-menu:nth-child(3) {
             background-color: var(--black);
           }
   
           .line-menu.half {
             width: 50%;
           }
   
           .line-menu.start {
             transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
             transform-origin: right;
           }
   
           .active .line-menu.start {
             transform: rotate(-90deg) translateX(3px);
           }
   
           .line-menu.end {
             align-self: flex-end;
             transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
             transform-origin: left;
           }
   
           .active .line-menu.end {
             transform: rotate(-90deg) translateX(-3px);
           }
           }
       }
   }

   @media screen and (max-width: 1200px) {
       .top-bar {
           display: none;
       }
       .header {
           top: 0;
           .nav {
               width: 90%;
               .nav-center {
                   display: none;
               }
               .nav-right {
                   .nav-menu {
                       display: flex;
                   }
               }
               .nav-left {
                   img {
                       width: 80%;
                   }
               }
           }
       }
   }
</style>
 