<template>
  <main class="main">
    <router-view></router-view>
  </main>
</template>

<style lang="scss">
@font-face {
  font-family: 'KudryashevDisplay';
  src: url('./fonts/KudryashevDisplay.woff') format('woff');
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'KudryashevDisplay', sans-serif;
}
.body {
  background-color: var(--background);
}

.body.active {
  overflow: hidden;
}

.main {
  max-width: 1920px;
  width: 100%;
  height: 100%;
  margin-inline: auto;
  background-color: var(--white);
}

:root {
  --background: #f5f5f5;
  --white: #ffffff;
  --black: #121212;
  --gold: #E2C799;
  --light-gold: #FCF6ED;
  --light-grey: rgba(40, 40, 40, 0.05);
  --shadow: rgb(0, 0, 0, 0.1);
}

@media screen and (max-width: 1024px) {
  .main {
    height: 100%;
  }
}
</style>
