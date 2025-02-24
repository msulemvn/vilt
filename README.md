

# VILT

VILT is a web application built using the VILT stack, which includes **Vue.js**, **Inertia.js**, **Laravel**, and **Tailwind CSS**. This project provides a modern, efficient, and scalable foundation for building web applications.

---

## Project Setup

Follow these steps to set up the project on your local machine:

### 1. Install Laravel
```bash
composer create-project --prefer-dist laravel/laravel vilt "9.*"
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

### 3. Install Dependencies and Configure Environment
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```
---

## 3. Shadcn
<https://www.shadcn-vue.com/docs/installation/laravel.html>

## 4. Tailwind CSS
<https://www.shadcn-vue.com/docs/installation/vite>

To set up the front-end, run the following commands:
```bash
npm install
npm run dev
```


---

To start the Laravel development server, run:

```bash
php artisan serve
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