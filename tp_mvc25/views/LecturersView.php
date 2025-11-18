<?php
include_once("Template.php");
class LecturersView
{
    public function render($data)
    {
        $no = 1;
        $rows = "";

        foreach ($data as $row) {
            list($id, $name, $nidn, $phone, $join_date) = $row;

            $rows .= "
                <tr>
                    <td>{$no}</td>
                    <td>{$name}</td>
                    <td>{$nidn}</td>
                    <td>{$phone}</td>
                    <td>{$join_date}</td>
                    <td>
                        <a href='lecturer.php?action=edit&id={$id}' class='btn btn-warning'>Edit</a>
                        <a href='lecturer.php?delete={$id}' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>
            ";

            $no++;
        }

        $tpl = new Template("templates/lecturer.html");
        $tpl->replace("JUDUL", "Lecturers");
        $tpl->replace("DATA_TABEL", $rows);
        $tpl->write();
    }

    public function renderAddForm()
    {
        $tpl = new Template("templates/lecturer_form.html");

        $tpl->write();
    }

    public function renderEditForm($data)
    {
        // Asumsi: Template.php sudah di-include dan berfungsi
        $tpl = new Template("templates/lecturer_edit.html"); // Sesuaikan jalur template!

        // Ganti placeholder dengan data dari database
        $tpl->replace('DATA_ID_LECTURER', $data['id']);
        $tpl->replace('DATA_NAME', $data['name']);
        $tpl->replace('DATA_NIDN', $data['nidn']);
        $tpl->replace('DATA_PHONE', $data['phone']);
        $tpl->replace('DATA_JOIN_DATE', $data['join_date']);

        // Tampilkan hasilnya
        $tpl->write();
    }
}
