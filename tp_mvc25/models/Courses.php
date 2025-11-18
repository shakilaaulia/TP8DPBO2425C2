<?php
require_once 'DB.php';

class Courses extends DB
{
    function getCourses()
    {
        $query = "SELECT c.*, l.name as lecturer_name 
              FROM courses c 
              LEFT JOIN lecturers l ON c.lecturer_id = l.id";
        return $this->execute($query);
    }

    function addCourse($data)
    {
        $course_code = $data['course_code'];
        $course_name = $data['course_name'];
        $credit = $data['credit'];
        $semester = $data['semester'];
        $lecturer_id = $data['lecturer_id'];
        $description = $data['description'];

        $query = "INSERT INTO courses 
                 (course_code, course_name, credit, semester, lecturer_id, description)
                 VALUES 
                 ('$course_code', '$course_name', $credit, $semester, $lecturer_id, '$description')";

        return $this->execute($query);
    }

    function deleteCourse($id)
    {
        $query = "DELETE FROM courses WHERE course_id = $id";
        return $this->execute($query);
    }

    // 🔧 Update data mata kuliah
    function updateCourse($id, $data)
    {
        $course_code = $data['course_code'];
        $course_name = $data['course_name'];
        $credit = $data['credit'];
        $semester = $data['semester'];
        $lecturer_id = $data['lecturer_id'];
        $description = $data['description'];

        $query = "UPDATE courses 
                  SET course_code = '$course_code',
                      course_name = '$course_name',
                      credit = $credit,
                      semester = $semester,
                      lecturer_id = $lecturer_id,
                      description = '$description'
                  WHERE course_id = $id";

        return $this->execute($query);
    }

    function getCourseById($id)
    {
        $query = "SELECT * FROM courses WHERE course_id = $id";
        return $this->execute($query);
    }
}
