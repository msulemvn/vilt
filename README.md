<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# VILT

VILT is a web application built using the VILT stack, which includes **Vue.js**, **Inertia.js**, **Laravel**, and **Tailwind CSS**. This project provides a modern, efficient, and scalable foundation for building web applications.

---

## Project Setup

Follow these steps to set up the project on your local machine:

### 1. Install Laravel

```bash
composer create-project --prefer-dist laravel/laravel vilt "10.*"
cd vilt
```
### 2. Install Laravel Breeze

```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

During the installation, you will be prompted with the following options:

- **Which stack would you like to install?**  
  Select `2` for Vue.js.
- **Would you like to install dark mode support?**  
  Type `yes` or `no` as per your preference.
- **Would you like to install Inertia SSR support?**  
  Type `yes` or `no` as per your preference.
- **Would you prefer Pest tests instead of PHPUnit?**  
  Type `no` unless you want to use Pest.

Install pnpm \
<https://pnpm.io/installation>


### 3. Install Dependencies and Configure Environment

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 4. To start the Laravel development server, run:

```bash
php artisan serve
```

---

## Shadcn
```bash
npx tailwindcss init -p
```
```js
// "./src/*" --> "./resources/js/*"
```
<https://www.shadcn-vue.com/docs/installation/laravel.html>\
update components.json as
```js
"components": "@/Components",
"composables": "@/Composables",
"ui": "@/Components/ui",
```
run
```bash
pnpm dlx shadcn-vue@latest add button
```

## Tailwind CSS

<https://www.shadcn-vue.com/docs/installation/vite>\
Configure the tailwind template paths in tailwind.config.js:
```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.html', './resources/js/**/*.{ts,js,vue}'],
```

To set up the front-end, run the following commands:

```bash
pnpm install
pnpm run dev
```

## Font Awesome

<https://docs.fontawesome.com/web/use-with/vue>

### Install

```bash
pnpm add @fortawesome/vue-fontawesome@latest-3
pnpm add @fortawesome/fontawesome-svg-core
pnpm add @fortawesome/free-solid-svg-icons
pnpm add @fortawesome/free-regular-svg-icons
pnpm add @fortawesome/free-brands-svg-icons
```

### Add in app.js

```js
import "./bootstrap";
import { createApp } from "vue";
import App from "./App.vue";
import "./assets/main.css";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";

const app = createApp(App);
app.component("FontAwesomeIcon", FontAwesomeIcon);
app.mount("#app");
```

### Add icon

```vue
// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

<script>
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
    // window.scrollIntoView({ behavior: 'smooth' })
    // window.scrollTo(0,0);
}
</script>
<template>
    <a href="#" @click="scrollToTop"
        ><div class="scrolltop">
            <FontAwesomeIcon icon="chevron-up" /></div
    ></a>
</template>
<style>
html {
    scroll-behavior: smooth;
}

.scrolltop {
    color: #fff;
    background: #0099ff;
    position: fixed;
    bottom: 10px;
    right: 10px;
    padding: 15px;
}
</style>
```

---

## Axios

```bash
pnpm add axios vue-axios
```

<https://www.npmjs.com/package/vue-axios>

---

## ESLint

<https://dev.to/devidev/setting-up-eslint-9130-with-prettier-typescript-vuejs-and-vscode-autosave-autoformat-n0

>

## Prettier

```bash
pnpm add -D prettier
```

Add following script in package.json:

```js
"pretty": "prettier --write "./**/*.{js,jsx,mjs,cjs,ts,tsx,json}""
```

In this case only, I need to format my .js, .jsx, and .json files.
Run script:

```bash
pnpm run pretty
```

---

## Project Structure

- **Laravel**: Handles the back-end logic, database migrations, and API routes.
- **Vue.js**: Used for building the front-end components.
- **Inertia.js**: Enables seamless integration between Laravel and Vue.js.
- **Tailwind CSS**: Provides utility-first CSS for styling the application.

---

## Contributing

If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Submit a pull request with a detailed description of your changes.

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

Happy coding! 🚀
