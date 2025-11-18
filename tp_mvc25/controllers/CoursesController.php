<?php
include_once("connection.php");
include_once("models/Courses.php");
include_once("models/Lecturers.php");
include_once("views/CoursesView.php");

class CoursesController
{
    private $course;
    private $lecturer;

    function __construct()
    {
        $this->course = new Courses(
            Connection::$db_host,
            Connection::$db_user,
            Connection::$db_pass,
            Connection::$db_name
        );

        $this->lecturer = new Lecturers(
            Connection::$db_host,
            Connection::$db_user,
            Connection::$db_pass,
            Connection::$db_name
        );
    }

    public function index()
    {
        $this->course->open();
        $this->lecturer->open();

        $this->course->getCourses();
        $this->lecturer->getLecturers();

        $data = [];
        while ($row = $this->course->getResult()) {
            $data[] = $row;
        }

        $this->course->close();
        $this->lecturer->close();

        $view = new CoursesView();
        $view->render($data);
    }

    // Tampilkan Form Tambah (GET)
    public function addForm()
    {
        $this->lecturer->open();
        $this->lecturer->getLecturers();
        $lecturers = [];
        while ($row = $this->lecturer->getResult()) {
            $lecturers[] = $row;
        }
        $this->lecturer->close();

        $view = new CoursesView();
        $view->renderAddForm($lecturers); // Pass data dosen untuk dropdown
    }

    // Proses Tambah (POST)
    public function add($POST)
    {
        $this->course->open();
        $this->course->addCourse($POST);
        $this->course->close();

        header("Location: course.php");
    }

    public function edit($id, $POST = null) // Tambahkan $POST = null agar bisa dipanggil tanpa POST
    {
        // 1. Jika ada data POST, proses UPDATE
        if ($POST) {
            $this->course->open();
            $this->course->updateCourse($id, $POST);
            $this->course->close();

            header("Location: course.php");
            exit;
        }
        // 2. Jika tidak ada data POST (GET request), tampilkan form
        else {
            $this->course->open();
            $this->lecturer->open();

            $this->course->getCourseById($id);
            $course_data = $this->course->getResult(); // Data mata kuliah

            $this->lecturer->getLecturers();
            $lecturers = [];
            while ($row = $this->lecturer->getResult()) {
                $lecturers[] = $row; // Data semua dosen untuk dropdown
            }

            $this->course->close();
            $this->lecturer->close();

            $view = new CoursesView();
            $view->renderEditForm($course_data, $lecturers); // Pass data mata kuliah dan daftar dosen
        }
    }

    public function delete($id)
    {
        $this->course->open();
        $this->course->deleteCourse($id);
        $this->course->close();

        header("Location: course.php");
    }
}