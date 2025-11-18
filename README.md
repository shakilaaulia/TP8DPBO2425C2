# TP8DPBO2425C2

## JANJI
Saya Shakila Aulia dengan NIM 2403086 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Desain Program

Proyek ini adalah implementasi sederhana dari operasi CRUD (Create, Read, Update, Delete) untuk entitas Dosen (Lecturers) dan Mata Kuliah (Courses) menggunakan PHP dengan pola arsitektur Model-View-Controller (MVC).

Sistem ini dirancang dengan memisahkan logika aplikasi menjadi tiga lapisan utama untuk menjaga keterbacaan, pemeliharaan, dan skalabilitas kode:

1. Model
   
Bertanggung jawab penuh atas interaksi dengan database.

DB.php: Kelas dasar untuk mengelola koneksi dan eksekusi query MySQL/MariaDB.

Lecturers.php & Courses.php: Berisi logika bisnis spesifik seperti query untuk menambah data (addLecturer), mengambil data dengan relasi (misalnya getCourses yang join dengan lecturers), mengubah, dan menghapus data.

3. View
   
Bertanggung jawab untuk menyajikan data kepada pengguna. Lapisan ini tidak mengandung logika bisnis.

Template.php: Utility kelas untuk membaca file HTML template dan mengganti placeholder dengan data dinamis.

LecturersView.php & CoursesView.php: Menerima data dari Controller dan memprosesnya menjadi format HTML yang siap ditampilkan (render, renderAddForm, renderEditForm).

templates/*.html: File-file HTML murni yang berisi markup dan placeholder untuk diisi data.

4. Controller
   
Bertindak sebagai "jembatan" yang menerima permintaan dari pengguna, memprosesnya (memanggil Model), dan memilih tampilan yang sesuai (memanggil View).

lecturer.php & course.php: Berfungsi sebagai router spesifik modul. Menganalisis parameter URL (GET) atau data form (POST) untuk menentukan aksi apa yang harus dijalankan.

LecturersController.php & CoursesController.php: Mengimplementasikan semua aksi CRUD (misalnya index(), add(), edit(), delete()).

## Alur Program
A. Tampilan Awal (Index)

Pengguna mengakses index.php (yang dialihkan ke lecturer.php).

Controller: LecturersController->index() dipanggil.

Model: Lecturers.php menjalankan SELECT * untuk mengambil data.

View: LecturersView.php menerima data, memprosesnya menjadi baris tabel, dan merender templates/lecturer.html.

B. Proses Tambah Data (Create)

Permintaan Form: Pengguna mengklik "Add New" (course.php?action=add). Controller memanggil CoursesController->addForm() yang hanya menampilkan form.

Input Data: Pengguna mengisi data dan menekan tombol Save (metode POST ke course.php).

Controller: CoursesController->add($_POST) dipanggil.

Model: Courses.php menjalankan query INSERT INTO courses (...) VALUES (...).

Redirect: Setelah berhasil, Controller mengalihkan (header("Location: course.php")) pengguna kembali ke halaman daftar kursus untuk melihat data baru.

C. Alur Pembaruan Data (Update / edit())

Proses pembaruan data melibatkan dua langkah utama: menampilkan form (GET) dan memproses data yang diubah (POST).

Permintaan Form Edit (GET): Pengguna mengklik tombol Edit pada baris data di halaman daftar (lecturer.php?action=edit&id=101).

Router: Router mendeteksi action=edit dan adanya id. Router memanggil LecturersController->edit($id, null).

Controller: Controller memanggil Lecturers.php untuk menjalankan getLecturerById($id) guna mengambil data dosen tunggal.

View: Controller meneruskan data tunggal tersebut ke LecturersView->renderEditForm(). View mengisi placeholder form edit (misalnya DATA_NAME, DATA_NIDN) dengan data yang diambil, lalu ditampilkan kepada pengguna.

Proses Update (POST): Pengguna mengubah data di form dan menekan tombol Update (metode POST ke lecturer.php).

Router: Router mendeteksi metode POST dan adanya $_POST['submit_edit']. Router memanggil LecturersController->edit($id_post, $_POST).

Controller: Controller menerima data baru. Controller memanggil Lecturers.php untuk menjalankan updateLecturer($id, $POST).

Model: Model menjalankan query UPDATE ke database.

Redirect: Setelah sukses, Controller mengarahkan (header("Location: lecturer.php")) pengguna kembali ke halaman daftar.

D. Alur Penghapusan Data (Delete)

Permintaan Delete: Pengguna mengklik tombol Delete pada baris data (course.php?delete=CS101).

Router: Router mendeteksi parameter $_GET['delete'] dengan nilai ID. Router memanggil CoursesController->delete($id).

Controller: Controller memanggil Courses.php untuk menjalankan deleteCourse($id).

Model: Model menjalankan query DELETE FROM database.

Redirect: Setelah sukses, Controller mengarahkan (header("Location: course.php")) pengguna kembali ke halaman daftar kursus.

## Dokumentasi
![CREATELECTURE](https://github.com/user-attachments/assets/b8be146e-09b2-4dde-87d0-48fec03a76c6)
![UpdateLecture](https://github.com/user-attachments/assets/d87d8f78-761c-4a3c-9dc8-f8f27cac294a)
![DeleteLecture](https://github.com/user-attachments/assets/6e5a4b06-8deb-4ec0-86de-c578b7267eeb)
![CREATECOURSE](https://github.com/user-attachments/assets/cf6ec31f-1aea-4a1c-9d92-1a37d2686338)
![EditCourse](https://github.com/user-attachments/assets/f185ca1e-19bd-4db5-8153-985f261fef1b)
![DeleteCourse](https://github.com/user-attachments/assets/3c8d707e-ac5d-4664-b6fb-43e073e865c0)
