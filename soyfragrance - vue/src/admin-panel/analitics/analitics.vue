<template>
    <AdminHeader />
    <div class="home">
        <div class="home-content">
            <h1>Analityka</h1>
        </div>
    </div>
    <div class="analitics">
        <div class="analitics-content">
            <div class="analitics-left">
                <div class="analitics-box">
                    <div class="analitics-box-top">
                        <h2>Zysk z zamówień</h2>
                        <select v-model="selectedMonth">
                            <option value="Cały rok">Cały rok</option>
                            <option value="styczen">Styczeń</option>
                            <option value="luty">Luty</option>
                            <option value="marzec">Marzec</option>
                            <option value="kwiecien">Kwiecień</option>
                            <option value="maj">Maj</option>
                            <option value="czerwiec">Czerwiec</option>
                            <option value="lipiec">Lipiec</option>
                            <option value="sierpien">Sierpień</option>
                            <option value="wrzesien">Wrzesień</option>
                            <option value="pazdziernik">Październik</option>
                            <option value="listopad">Listopad</option>
                            <option value="grudzien">Grudzień</option>
                        </select>
                    </div>
                    <div class="analitics-box-bottom">
                        <div class="analitics-chart">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="analitics-right">
                <div class="analitics-box">
                    <div class="analitics-box-top">
                        <h2>Ilość zamówień czasie</h2>
                        <select value="Cały rok">
                            <option value="Cały rok">Cały rok</option>
                            <option value="Styczeń">Styczeń</option>
                            <option value="Luty">Luty</option>
                            <option value="Marzec">Marzec</option>
                            <option value="Kwiecień">Kwiecień</option>
                            <option value="Maj">Maj</option>
                            <option value="Czerwiec">Czerwiec</option>
                            <option value="Lipiec">Lipiec</option>
                            <option value="Sierpień">Sierpień</option>
                            <option value="Wrzesień">Wrzesień</option>
                            <option value="Październik">Październik</option>
                            <option value="Listopad">Listopad</option>
                            <option value="Grudzień">Grudzień</option>
                        </select>
                    </div>
                    <div class="analitics-box-bottom">
                        <div class="analitics-chart">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <AdminFooterBottom />
  </template>
  
  <script>
  import AdminHeader from '@admin-components/admin-header.vue'
  import AdminFooterBottom from '@admin-components/admin-footer-bottom.vue'
  import axios from 'axios';
  import { Chart, registerables } from 'chart.js';
  import 'chartjs-adapter-date-fns';
  
  Chart.register(...registerables);
  
  export default {
  components: {
    AdminHeader,
    AdminFooterBottom
  },
  data() {
    return {
      selectedMonth: 'styczen', // Domyślny miesiąc
      chart: null,
    };
  },
  watch: {
    selectedMonth(newMonth, oldMonth) {
      if (newMonth !== oldMonth) {
        this.fetchData(newMonth);
      }
    },
  },
  mounted() {
    this.fetchData(this.selectedMonth);
  },
  methods: {
      getMonthRange(month) {
    const year = new Date().getFullYear();
  
    if (month === 'Cały rok') {
      const firstDay = `${year}-01-01`;
      const lastDay = `${year}-12-31`;
      return { firstDay, lastDay };
    } else {
      const monthIndex = this.getMonthIndex(month);
      const firstDay = new Date(year, monthIndex, 1).toISOString().split('T')[0];
      const lastDay = new Date(year, monthIndex + 1, 0).toISOString().split('T')[0];
      return { firstDay, lastDay };
    }
  },
  
  // Funkcja, która przekształca nazwę miesiąca na indeks (0 dla stycznia, 11 dla grudnia)
  getMonthIndex(monthName) {
    const monthNames = ['styczen', 'luty', 'marzec', 'kwiecien', 'maj', 'czerwiec', 'lipiec', 'sierpien', 'wrzesien', 'pazdziernik', 'listopad', 'grudzien'];
    return monthNames.indexOf(monthName);
  },
  
  fetchData(month) {
    let url;
    if (month === 'Cały rok') {
      url = 'http://localhost:8000/api/analytics-data-yearly';
      this.fetchYearlyData(url);
    } else {
      url = `http://localhost:8000/api/analytics-data/${month}`;
      this.fetchMonthlyData(url);
    }
  },
  
  fetchYearlyData(url) {
    axios.get(url)
      .then(response => {
        this.updateYearlyChart(response.data);
      })
      .catch(error => {
        console.error("There was an error fetching the yearly data", error);
      });
  },
  
  fetchMonthlyData(url) {
    axios.get(url)
      .then(response => {
        this.updateChart(response.data);
      })
      .catch(error => {
        console.error("There was an error fetching the monthly data", error);
      });
  },
  
  updateYearlyChart(data) {
    // Stała lista miesięcy
    const monthNames = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
  
    // Przetwarzanie danych rocznych na format miesięczny
    let monthlyTotals = monthNames.reduce((acc, month, index) => {
      acc[month] = 0; // Ustaw wszystkie miesiące na 0
      return acc;
    }, {});
  
    // Sumowanie danych dla każdego miesiąca
    [...data.private_orders, ...data.company_orders].forEach(order => {
      const monthName = this.getMonthName(order.month);
      monthlyTotals[monthName] += parseFloat(order.total);
    });
  
    // Przygotowanie danych do wykresu
    const chartData = {
      labels: monthNames,
      datasets: [{
        label: 'Zysk z zamówień',
        data: Object.values(monthlyTotals),
        fill: false,
        borderColor: '#E2C799',
        tension: 0.1
      }]
    };
  
    // Tworzenie wykresu
    const ctx = document.getElementById('myChart').getContext('2d');
    if (this.chart) {
      this.chart.destroy(); // Usuń poprzedni wykres, jeśli istnieje
    }
    this.chart = new Chart(ctx, {
      type: 'line',
      data: chartData,
      options: {
        scales: {
          x: {
            type: 'category'
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });
  },
  
  // Dodatkowa metoda do konwersji numeru miesiąca na nazwę
  getMonthName(monthNumber) {
    const monthNames = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
    return monthNames[monthNumber - 1];
  },
  
  updateChart(data) {

    if (this.chart) {
  this.chart.destroy(); // Niszczymy istniejący wykres
}

    const { firstDay, lastDay } = this.getMonthRange(this.selectedMonth);
    let dailyTotals = this.generateEmptyDailyTotals(firstDay, lastDay);

    // Zsumuj dane z każdego dnia
    [...data.private_orders, ...data.company_orders].forEach(order => {
      const day = order.created_at.substring(0, 10); // 'YYYY-MM-DD'
      const formattedDay = this.formatDateToPolish(day);
      if (dailyTotals.hasOwnProperty(formattedDay)) {
        dailyTotals[formattedDay] += parseFloat(order.total_price);
      }
    });

    // Przygotuj dane do wykresu
    const chartData = {
      labels: Object.keys(dailyTotals),
      datasets: [{
        label: 'Zysk z zamówień',
        data: Object.values(dailyTotals),
        fill: false,
        borderColor: '#E2C799',
        tension: 0.1
      }]
    };

    const ctx = document.getElementById('myChart').getContext('2d');
    this.chart = new Chart(ctx, {
      type: 'line',
      data: chartData,
      options: {
        scales: {
          x: {
            type: 'category',
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });
  },

  generateEmptyDailyTotals(start, end) {
    let totals = {};
    let currentDate = new Date(start);
    let endDate = new Date(end);

    while (currentDate <= endDate) {
      let key = this.formatDateToPolish(currentDate.toISOString().split('T')[0]);
      totals[key] = 0;
      currentDate.setDate(currentDate.getDate() + 1);
    }

    return totals;
  },

  formatDateToPolish(dateString) {
    const dateParts = dateString.split('-'); // Zakładamy format 'YYYY-MM-DD'
    const months = ['sty', 'lut', 'mar', 'kwi', 'maj', 'cze', 'lip', 'sie', 'wrz', 'paź', 'lis', 'gru'];
    const monthIndex = parseInt(dateParts[1], 10) - 1; // Miesiące są od 0 do 11
    return `${dateParts[2]} ${months[monthIndex]}`; // Dzień i skrócona nazwa miesiąca
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

.analitics {
    padding-top: 4rem;
    padding-bottom: 4rem;
    .analitics-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: space-between;
        .analitics-left {
            width: 48%;
            .analitics-box {
                background-color: var(--light-gold);
                border: 2px solid var(--gold);
                padding: 2rem;
                border-radius: 15px;
                .analitics-box-top {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    h2 {
                        font-size: 24px;
                        font-weight: 600;
                    }
                    select {
                        width: 200px;
                        height: 40px;
                        padding-left: 1rem;
                        border: none;
                        border-right: 16px solid var(--white);
                        border-radius: 25px;
                        font-weight: 600;
                        font-size: 16px;
                        cursor: pointer;
                        option {
                            font-weight: 600;
                        }
                    }
                }
                .analitics-box-bottom {
                    .analitics-chart {
                        canvas {
                            width: 100%!important;
                            height: 100%!important;
                        }
                    }
                }
            }
        }
        .analitics-right {
            width: 48%;
            .analitics-box {
                background-color: var(--light-gold);
                border: 2px solid var(--gold);
                padding: 2rem;
                border-radius: 15px;
                .analitics-box-top {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    h2 {
                        font-size: 24px;
                        font-weight: 600;
                    }
                    select {
                        width: 200px;
                        height: 40px;
                        padding-left: 1rem;
                        border: none;
                        border-right: 16px solid var(--white);
                        border-radius: 25px;
                        font-weight: 600;
                        font-size: 16px;
                        cursor: pointer;
                        option {
                            font-weight: 600;
                        }
                    }
                }
                .analitics-box-bottom {
                    .analitics-chart {
                        canvas {
                            width: 100%!important;
                            height: 100%!important;
                        }
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
        .analitics {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .analitics-content {
                width: 90%;
                flex-direction: column;
                .analitics-left {
                    width: 100%;
                    margin-bottom: 2rem;
                    .analitics-box {
                        padding: 1rem;
                        .analitics-box-top {
                            flex-direction: column;
                            justify-content: flex-start;
                            align-items: flex-start;
                            h2 {
                                margin-bottom: 1rem;
                            }
                            select {
                                margin-bottom: 1rem;
                            }
                        }
                        .analitics-box-bottom {
                            .analitics-chart {
                                canvas {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
                .analitics-right {
                    width: 100%;
                    .analitics-box {
                        padding: 1rem;
                        .analitics-box-top {
                            flex-direction: column;
                            justify-content: flex-start;
                            align-items: flex-start;
                            h2 {
                                margin-bottom: 1rem;
                            }
                            select {
                                margin-bottom: 1rem;
                            }
                        }
                        .analitics-box-bottom {
                            .analitics-chart {
                                canvas {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</style>