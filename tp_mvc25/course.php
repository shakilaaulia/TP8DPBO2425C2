<?php
include_once("connection.php");
include_once("controllers/CoursesController.php");

$courseController = new CoursesController();

// Ambil ID jika ada di URL (untuk edit/delete)
$id = isset($_GET['id']) ? $_GET['id'] : null;
// Ambil aksi jika ada di URL (untuk tampil form add/edit)
$action = isset($_GET['action']) ? $_GET['action'] : null;

// ROUTER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_add'])) {
        // Proses Tambah (POST)
        $courseController->add($_POST);
    } else if (isset($_POST['submit_edit'])) {
        // Proses Edit (POST)
        $id_post = $_POST['course_id']; // Asumsi Anda menggunakan hidden input course_id
        $courseController->edit($id_post, $_POST);
    }

} else {
    if ($action == 'edit' && $id) {
        // Tampilkan Form Edit (GET)
        $courseController->edit($id, null);
    } else if ($action == 'add') {
        // Tampilkan Form Tambah (GET)
        $courseController->addForm();
    } else if (isset($_GET['delete'])) {
        // Proses delete
        $courseController->delete($_GET['delete']);
    } else {
        // Tampilkan Index (Default)
        $courseController->index();
    }
}