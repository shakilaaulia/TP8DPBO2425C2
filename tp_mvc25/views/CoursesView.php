<?php
include_once("Template.php");
class CoursesView
{
    public function render($data)
    {
        $no = 1;
        $rows = "";

        foreach ($data as $row) {
            // PERBAIKAN: Akses data menggunakan key/nama kolom dari query JOIN
            $course_id = $row['course_id'];
            $course_code = $row['course_code'];
            $course_name = $row['course_name'];
            $credit = $row['credit'];
            $semester = $row['semester'];
            $lecturer_name = $row['lecturer_name']; // AMBIL NAMA DOSEN DI SINI
            $description = $row['description'];

            $rows .= "
            <tr>
                <td>{$no}</td>
                <td>{$course_code}</td>
                <td>{$course_name}</td>
                <td>{$credit}</td>
                <td>{$semester}</td>
                <td>{$lecturer_name}</td> 
                <td>{$description}</td>
                <td>
                    <a href='course.php?action=edit&id={$course_id}' class='btn btn-warning'>Edit</a>
                    <a href='course.php?delete={$course_id}' class='btn btn-danger'>Delete</a>
                </td>
            </tr>
        ";

            $no++;
        }

        $tpl = new Template("templates/course.html");
        $tpl->replace("JUDUL", "Courses");
        $tpl->replace("DATA_TABEL", $rows);
        $tpl->write();
    }

    public function renderAddForm($lecturers)
    {
        // Logika untuk membuat opsi dropdown
        $lecturer_options = "";
        foreach ($lecturers as $lecturer) {
            // Asumsi data dosen adalah array numerik
            list($id, $name, $nidn, $phone, $join_date) = $lecturer;
            $lecturer_options .= "<option value='{$id}'>{$name}</option>";
        }

        $tpl = new Template("templates/course_form.html"); // Sesuaikan jalur
        $tpl->replace("DATA_LECTURER_OPTIONS", $lecturer_options);
        $tpl->write();
    }

    public function renderEditForm($course_data, $lecturers)
    {
        // Logika untuk membuat opsi dropdown dan memilih dosen yang sesuai
        $lecturer_options = "";
        $selected_lecturer_id = $course_data['lecturer_id'];

        foreach ($lecturers as $lecturer) {
            // Asumsi data dosen adalah array numerik
            list($id, $name, $nidn, $phone, $join_date) = $lecturer;

            $selected = ($id == $selected_lecturer_id) ? "selected" : "";
            $lecturer_options .= "<option value='{$id}' {$selected}>{$name}</option>";
        }

        // Asumsi: Template.php sudah di-include dan berfungsi
        $tpl = new Template("templates/course_edit.html"); // Sesuaikan jalur!

        // Ganti placeholder dengan data dari database
        $tpl->replace('DATA_COURSE_ID', $course_data['course_id']);
        $tpl->replace('DATA_COURSE_CODE', $course_data['course_code']);
        $tpl->replace('DATA_COURSE_NAME', $course_data['course_name']);
        $tpl->replace('DATA_CREDIT', $course_data['credit']);
        $tpl->replace('DATA_SEMESTER', $course_data['semester']);
        $tpl->replace('DATA_LECTURER_OPTIONS', $lecturer_options);
        $tpl->replace('DATA_DESCRIPTION', $course_data['description']);
        $tpl->write();
    }
}
