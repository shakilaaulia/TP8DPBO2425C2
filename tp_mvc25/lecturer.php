<?php
include_once("connection.php");
include_once("controllers/LecturersController.php");

$lecturerController = new LecturersController();

// Ambil ID jika ada di URL (untuk edit/delete)
$id = isset($_GET['id']) ? $_GET['id'] : null;
// Ambil aksi jika ada di URL (untuk tampil form add/edit)
$action = isset($_GET['action']) ? $_GET['action'] : null;

// ROUTER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_add'])) { 
        $lecturerController->add($_POST);
    } else if (isset($_POST['submit_edit'])) { 
        $id_post = $_POST['id'];
        $lecturerController->edit($id_post, $_POST);
    }

} else {
    if ($action == 'edit' && $id) {
        // Tampilkan Form Edit (tanpa data POST)
        // Method edit di Controller akan menangani pemuatan data tunggal
        $lecturerController->edit($id, null);
    } else if ($action == 'add') {
        // Tampilkan Form Tambah
        $lecturerController->addForm(); // Asumsi Anda membuat method ini di Controller
    } else if (isset($_GET['delete'])) {
        // Proses delete
        $lecturerController->delete($_GET['delete']);
    } else {
        // Tampilkan Index (Default)
        $lecturerController->index();
    }
}