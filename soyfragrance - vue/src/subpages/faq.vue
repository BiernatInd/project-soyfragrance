<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>FAQ</h1>
                <p>Najczęściej zadawane pytania</p>
            </div>
        </div>
    </div>
    <div class="faq">
        <div class="faq-content">
            <div class="faq-box-container">
                <div class="faq-box" v-for="(faq, index) in faqList" :key="index">
                    <div class="faq-box-top" @click="toggleFaq(index)" :class="{ 'active': faq.active }">
                        <p>{{ faq.question }}</p>
                        <svg width="32" height="18" viewBox="0 0 32 18" fill="none" xmlns="http://www.w3.org/2000/svg" :class="{ 'active': faq.active }">
                            <path d="M31 0.999999L16 16L0.999998 1" stroke="#33363F" stroke-width="2"/>
                        </svg>

                    </div>
                    <div class="faq-box-bottom" :class="{ 'active': faq.active }">
                        <p>{{ faq.answer }}</p>
                        <p>{{ faq.answer2 }}</p>
                        <p>{{ faq.answer3 }}</p>
                        <p>{{ faq.answer4 }}</p>
                        <p>{{ faq.answer5 }}</p>
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

    export default {
        components: {
            MainHeader,
            MainFooterTop,
            MainFooterBottom
        },
        data() {
    return {
      faqList: [
        {
          question: "Dlaczego świeca sojowa?",
          answer: "Spala się znacznie dłużej od parafinowej, w pełni oddaje aromat oraz wytwarza do 90% mniej sadzy od tradycyjnej świecy. Nie wywołuje alergii i jest wegańska.",
          active: true,
        },
        {
          question: "Zalety drewnianego knota?",
          answer: "Naturalny drewniany knot podczas wypalania wydaje kojący dźwięk przypominający strzelanie drewna w domowym kominku. Zapewnia dużo szybsze uwalnianie zapachu i czyste spalanie świecy.",
          active: false,
        },
        {
          question: "Czy znajdę Soy Fragrance stacjonarnie?",
          answer: "Tak, dołącz do naszego instagrama: soy.fragrance gdzie na bieżąco wrzucamy nie tylko nowości, ale informujemy na jakich wydarzeniach możecie nas spotkać.",
          active: false,
        },
        {
          question: "Chcę dodać do opłaconego zamówienia jeszcze jeden produkt?",
          answer: "Skontaktuj się z nami telefonicznie pod nr: 514 515 895",
          active: false,
        },
        {
          question: "Czy jest możliwość zwrotu towaru?",
          answer: "W celu reklamacji prosimy o jej uzasadnienie na e-mail: soy.fragrance@gmail.com w terminie 14 dni od otrzymania towaru.",
          active: false,
        },
      ],
    };
  },
  methods: {
    toggleFaq(index) {
      this.faqList[index].active = !this.faqList[index].active;
    },
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
    
    .faq {
        padding-top: 4rem;
        padding-bottom: 4rem;
        .faq-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .faq-box-container {
                margin-top: 2rem;
                .faq-box {
                    width: 80%;
                    margin-left: auto;
                    margin-right: auto;
                    border-radius: 10px;
                    border: 1px solid var(--light-gold);
                    background-color: var(--light-gold);
                    .faq-box-top {
                        display: flex;
                        justify-content: space-between;
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        cursor: pointer;
                        align-items: center;
                        svg {
                            transition: 0.5s;
                            user-select: none;
                            z-index: 0;
                        }
                        p {
                            font-size: 24px;
                            font-weight: 600;
                        }
                        &.active {
                            svg {
                                transform: rotate(180deg);
                            }
                        }
                    }
                    .faq-box-bottom {
                        border-top: 1px solid var(--black);
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        display: none;
                        p {
                            font-size: 20px;
                            margin-bottom: 1rem;
                            font-weight: 600;
                        }
                        &.active {
                            display: block;
                        }
                    }
                }
                .faq-box:not(:last-child) {
                    margin-bottom: 2rem;
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
        .faq {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .faq-content {
                width: 90%;
                .faq-box-container {
                    .faq-box {
                        width: 100%;
                        .faq-box-top {
                            svg {
                                width: 24px;
                                height: 24px;
                            }
                            p {
                                width: 90%;
                                font-size: 16px;
                            }
                        }
                        .faq-box-bottom {
                            p {
                                font-size: 16px;
                            }
                        }
                    }
                }
            }
        }
    }
</style>