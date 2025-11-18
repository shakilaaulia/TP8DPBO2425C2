<?php
include_once("connection.php");
include_once("models/Lecturers.php");
include_once("views/LecturersView.php");

class LecturersController
{
    private $lecturer;

    function __construct()
    {
        $this->lecturer = new Lecturers(
            Connection::$db_host,
            Connection::$db_user,
            Connection::$db_pass,
            Connection::$db_name
        );
    }

    // INDEX
    public function index()
    {
        $this->lecturer->open();
        $this->lecturer->getLecturers();

        $data = [];
        while ($row = $this->lecturer->getResult()) {
            $data[] = $row;
        }

        $this->lecturer->close();

        $view = new LecturersView();
        $view->render($data);
    }

    // ADD
    public function add($POST)
    {
        $this->lecturer->open();
        $this->lecturer->addLecturer($POST);
        $this->lecturer->close();

        header("Location: lecturer.php");
    }

    public function addForm()
    {
        $view = new LecturersView();
        $view->renderAddForm();
    }
    
    public function edit($id, $POST = null)
    {
        // Jika ada data POST, proses UPDATE
        if ($POST) {
            $this->lecturer->open();
            $this->lecturer->updateLecturer($id, $POST);
            $this->lecturer->close();

            header("Location: lecturer.php");
            exit;
        }
        // Jika tidak ada data POST (GET request), tampilkan form
        else {
            $this->lecturer->open();
            $this->lecturer->getLecturerById($id);

            $data = $this->lecturer->getResult();

            $this->lecturer->close();

            $view = new LecturersView();
            $view->renderEditForm($data);
        }
    }

    // DELETE
    public function delete($id)
    {
        $this->lecturer->open();
        $this->lecturer->deleteLecturer($id);
        $this->lecturer->close();

        header("Location: lecturer.php");
    }
}
