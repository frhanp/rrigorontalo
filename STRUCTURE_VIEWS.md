# Struktur Folder Views Laravel

## 📁 resources/views/

### 🏠 **Halaman Utama**

-   `home.blade.php` - Halaman beranda utama
-   `welcome.blade.php` - Halaman selamat datang
-   `dashboard.blade.php` - Dashboard utama

### 🔐 **Authentication (auth/)**

-   `login.blade.php` - Halaman login
-   `register.blade.php` - Halaman registrasi
-   `forgot-password.blade.php` - Halaman lupa password
-   `reset-password.blade.php` - Halaman reset password
-   `confirm-password.blade.php` - Halaman konfirmasi password
-   `verify-email.blade.php` - Halaman verifikasi email

### 👤 **Profile Management (profile/)**

-   `edit.blade.php` - Edit profil pengguna
-   `partials/` - Komponen partial untuk profil
    -   `delete-user-form.blade.php` - Form hapus user
    -   `update-password-form.blade.php` - Form update password
    -   `update-profile-information-form.blade.php` - Form update informasi profil

### 🎯 **Categories Management (categories/)**

-   `index.blade.php` - Daftar semua kategori
-   `create.blade.php` - Form tambah kategori baru
-   `edit.blade.php` - Form edit kategori
-   `show.blade.php` - Detail kategori

### 📝 **Posts Management (posts/)**

-   `show.blade.php` - Detail post

### 📊 **Dashboard (dashboard/)**

-   `posts/` - Manajemen post di dashboard
    -   `pdf.blade.php` - Template PDF untuk post

### 👨‍💼 **Admin Panel (admin/)**

-   `users/` - Manajemen user
    -   `index.blade.php` - Daftar semua user

### 🧩 **Components (components/)**

-   `application-logo.blade.php` - Logo aplikasi
-   `auth-session-status.blade.php` - Status sesi autentikasi
-   `danger-button.blade.php` - Tombol berbahaya/delete
-   `dropdown.blade.php` - Dropdown menu
-   `dropdown-link.blade.php` - Link dropdown
-   `input-error.blade.php` - Pesan error input
-   `input-label.blade.php` - Label input
-   `modal.blade.php` - Modal dialog
-   `nav-link.blade.php` - Link navigasi
-   `primary-button.blade.php` - Tombol primary
-   `responsive-nav-link.blade.php` - Link navigasi responsif
-   `secondary-button.blade.php` - Tombol secondary
-   `text-input.blade.php` - Input text

#### 📐 **Layout Components (components/layouts/)**

-   `public.blade.php` - Layout untuk halaman publik

### 🎨 **Layouts (layouts/)**

-   `app.blade.php` - Layout utama aplikasi
-   `guest.blade.php` - Layout untuk tamu (non-authenticated)
-   `navigation.blade.php` - Komponen navigasi

---

## 📋 **Keterangan Struktur:**

### **Konvensi Penamaan:**

-   File menggunakan format `kebab-case.blade.php`
-   Folder menggunakan `snake_case` atau `kebab-case`
-   Setiap modul memiliki folder terpisah

### **Organisasi Berdasarkan Fitur:**

1. **Authentication** - Semua halaman terkait login/register
2. **Profile** - Manajemen profil pengguna
3. **Categories** - CRUD kategori
4. **Posts** - Manajemen artikel/post
5. **Admin** - Panel admin khusus
6. **Dashboard** - Halaman dashboard dengan fitur khusus

### **Komponen Reusable:**

-   **Components** - Komponen UI yang dapat digunakan ulang
-   **Layouts** - Template layout dasar
-   **Partials** - Bagian-bagian kecil yang dapat di-include

### **Struktur yang Disarankan untuk Pengembangan:**

```
resources/views/
├── auth/           # Autentikasi
├── admin/          # Panel admin
├── dashboard/      # Dashboard user
├── public/         # Halaman publik
├── components/     # Komponen reusable
├── layouts/        # Template layout
├── partials/       # Bagian-bagian kecil
└── errors/         # Halaman error (opsional)
```

### **Best Practices:**

-   Gunakan folder untuk mengelompokkan view berdasarkan fitur
-   Pisahkan komponen yang dapat digunakan ulang
-   Gunakan partial untuk bagian yang berulang
-   Konsisten dalam penamaan file dan folder
-   Dokumentasikan struktur untuk tim development
