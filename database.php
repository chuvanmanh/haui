<?php
global $conn;

// Hàm kết nối database
function connectDb()
{
    global $conn;

    if (!$conn) {
        $conn = mysqli_connect('localhost', 'root', 'mysql', 'haui') or die ('Can\'t not connect to database');
        mysqli_set_charset($conn, 'utf8');
    }
}

function getUsername($username)
{
    global $conn;
    connectDb();
    $query = "SELECT username, password FROM user where username = '$username'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getAllStudents()
{
    global $conn;

    connectDb();

    $sql = "select * from student";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function getStudent($studentId)
{
    global $conn;

    connectDb();

    $sql = "select * from student where id = {$studentId}";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    return $result;
}

function addStudent($studentCode, $name, $email, $gender, $dob, $phone, $address, $image)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $studentCode = addslashes($studentCode);
    $name = addslashes($name);
    $email = addslashes($email);
    $gender = addslashes($gender);
    $dob = addslashes($dob);
    $phone = addslashes($phone);
    $address = addslashes($address);
    $image = addslashes($image);

    $sql = "INSERT INTO student(student_code, name, email, gender, dob, phone_number, address, image) VALUES
        ('$studentCode','$name','$email','$gender','$dob','$phone','$address','$image') ";
    echo $sql;

    $query = mysqli_query($conn, $sql) or die("thêm student dữ liệu thất bại");

    return $query;
}

function addUser($username, $password, $type)
{
    global $conn;

    connectDb();

    $username = addslashes($username);
    $password = addslashes($password);
    $type = addslashes($type);
    $sql = "INSERT INTO user(username, password, type) VALUES
            ('$username','$password','$type')";

    $query = mysqli_query($conn, $sql) or die("thêm user dữ liệu thất bại");

    return $query;
}

function getStudentIdByStudentCode($studentCode)
{
    global $conn;

    connectDb();

    $sql = "select * from student where student_code = '$studentCode'";

    $query = mysqli_query($conn, $sql) or die("không lấy được student id");

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    return $result['id'];
}

function editStudent($studentId, $studentCode, $name, $email, $gender, $dob, $phone, $address, $image)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $studentCode = addslashes($studentCode);
    $name = addslashes($name);
    $email = addslashes($email);
    $gender = addslashes($gender);
    $dob = addslashes($dob);
    $phone = addslashes($phone);
    $address = addslashes($address);
    $image = addslashes($image);

    $sql = "UPDATE student SET
                    student_code = '$studentCode', 
                    name = '$name', 
                    email = '$email', 
                    gender = '$gender', 
                    dob = '$dob', 
                    phone_number = '$phone', 
                    address = '$address',
                    image = '$image'
            WHERE id = {$studentId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function deleteStudent($studentId)
{
    global $conn;

    connectDb();

    $sql = "DELETE FROM student
            WHERE id = {$studentId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function getAllClasses()
{
    global $conn;

    connectDb();

    $sql = "select * from class";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function getClass($classId)
{
    global $conn;

    connectDb();

    $sql = "select * from class where id = {$classId}";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    return $result;
}

function getTeacher($teacherId)
{
    global $conn;

    connectDb();

    $sql = "select * from teacher where id = {$teacherId}";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    return $result;
}

function addClass($name, $teacherName)
{
    global $conn;

    connectDb();

    $name = addslashes($name);
    $teacherName = addslashes($teacherName);
    $sql = "INSERT INTO class(name, teacher_name) VALUES
            ('$name','$teacherName')";

    $query = mysqli_query($conn, $sql) or die("thêm dữ liệu class thất bại");

    return $query;
}

function editClass($classId, $name, $teacherName)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $classId = addslashes($classId);
    $name = addslashes($name);
    $teacherName = addslashes($teacherName);

    $sql = "UPDATE class SET
                    name = '$name', 
                    teacher_name = '$teacherName'
            WHERE id = {$classId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function deleteClass($classId)
{
    global $conn;

    connectDb();

    $sql = "DELETE FROM class
            WHERE id = {$classId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function getListStudentByClassId($classId)
{
    global $conn;

    connectDb();

    $sql = "select * from student where class_id = {$classId}";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function getAllTeachers()
{
    global $conn;

    connectDb();

    $sql = "select * from teacher";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function addTeacher($teacherCode, $name, $email, $specialize, $gender, $phone, $address, $image)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $teacherCode = addslashes($teacherCode);
    $name = addslashes($name);
    $email = addslashes($email);
    $specialize = addslashes($specialize);
    $gender = addslashes($gender);
    $phone = addslashes($phone);
    $address = addslashes($address);
    $image = addslashes($image);

    $sql = "INSERT INTO teacher( teacher_code, name, email, specialize, gender, phone_number, address, image) VALUES
        ('$teacherCode','$name','$email','$specialize','$gender','$phone','$address','$image') ";

    $query = mysqli_query($conn, $sql) or die("thêm teacher dữ liệu thất bại");

    return $query;
}

function editTeacher($teacherId, $teacherCode, $name, $email, $specialize, $gender, $phone, $address, $image)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $teacherCode = addslashes($teacherCode);
    $name = addslashes($name);
    $email = addslashes($email);
    $specialize = addslashes($specialize);
    $gender = addslashes($gender);
    $phone = addslashes($phone);
    $address = addslashes($address);
    $image = addslashes($image);

    $sql = "UPDATE teacher SET
                    teacher_code = '$teacherCode', 
                    name = '$name', 
                    email = '$email', 
                    specialize = '$specialize', 
                    gender = '$gender', 
                    phone_number = '$phone', 
                    address = '$address',
                    image = '$image'
            WHERE id = {$teacherId}";

    $query = mysqli_query($conn, $sql) or die("sửa teacher dữ liệu thất bại");;

    return $query;
}

function deleteTeacher($teacherId)
{
    global $conn;

    connectDb();

    $sql = "DELETE FROM teacher
            WHERE id = {$teacherId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function getAllSubjects()
{
    global $conn;

    connectDb();

    $sql = "select * from subject";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function getSubject($subjectId)
{
    global $conn;

    connectDb();

    $sql = "select * from subject where id = {$subjectId}";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    return $result;
}

function addSubject($subjectCode, $name, $numberCredit, $major)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $subjectCode = addslashes($subjectCode);
    $name = addslashes($name);
    $numberCredit = addslashes($numberCredit);
    $major = addslashes($major);

    $sql = "INSERT INTO subject(subject_code, name, num_credit, major) VALUES
        ('$subjectCode','$name','$numberCredit','$major') ";

    $query = mysqli_query($conn, $sql) or die("thêm subject dữ liệu thất bại");

    return $query;
}

function editSubject($subjectId, $subjectCode, $name, $numberCredit, $major)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $subjectCode = addslashes($subjectCode);
    $name = addslashes($name);
    $numberCredit = addslashes($numberCredit);
    $major = addslashes($major);

    $sql = "UPDATE subject SET
                    subject_code = '$subjectCode', 
                    name = '$name', 
                    num_credit = '$numberCredit', 
                    major = '$major'
            WHERE id = {$subjectId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function addCourse($courseCode, $room, $teacherCode, $subjectCode, $numberOfLesson, $dayOfWeek)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $courseCode = addslashes($courseCode);
    $room = addslashes($room);
    $teacherCode = addslashes($teacherCode);
    $subjectCode = addslashes($subjectCode);
    $numberOfLesson = addslashes($numberOfLesson);
    $dayOfWeek = addslashes($dayOfWeek);

    $sql = "INSERT INTO course(course_code, room, teacher_code, subject_code, number_lesson, day_of_week) VALUES
        ('$courseCode','$room','$teacherCode','$subjectCode','$numberOfLesson','$dayOfWeek') ";

    $query = mysqli_query($conn, $sql) or die("thêm course dữ liệu thất bại");

    return $query;
}

function editCourse($courseId, $courseCode, $room, $teacherCode, $numberOfLesson, $dayOfWeek)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $courseId = addslashes($courseId);
    $courseCode = addslashes($courseCode);
    $room = addslashes($room);
    $teacherCode = addslashes($teacherCode);
    $numberOfLesson = addslashes($numberOfLesson);
    $dayOfWeek = addslashes($dayOfWeek);

    $sql = "UPDATE course SET
                    course_code = '$courseCode', 
                    room = '$room', 
                    teacher_code = '$teacherCode', 
                    number_lesson = '$numberOfLesson', 
                    day_of_week = '$dayOfWeek'
            WHERE id = {$courseId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function getAllCourses()
{
    global $conn;

    connectDb();

    $sql = "select c.id, c.course_code, s.name, c.room, c.number_lesson, c.day_of_week, c.subject_code
    from course c inner join subject s on c.subject_code = s.subject_code;";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function getCourse($courseId)
{
    global $conn;

    connectDb();

    $sql = "select * from course where id = {$courseId}";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    return $result;
}

function deleteCourse($courseId)
{
    global $conn;

    connectDb();

    $sql = "DELETE FROM course
            WHERE id = {$courseId}";

    $query = mysqli_query($conn, $sql);

    return $query;
}

function addCourseHasStudent($chsCode, $courseCode, $studentCode)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $chsCode = addslashes($chsCode);
    $courseCode = addslashes($courseCode);
    $studentCode = addslashes($studentCode);

    $sql = "INSERT INTO course_has_student(chs_code, course_code, student_code) VALUES
        ('$chsCode','$courseCode','$studentCode') ";

    $query = mysqli_query($conn, $sql) or die("Sinh viên đã có trong lớp học");

    return $query;
}

function getStudentByCourseCode($courseCode)
{
    global $conn;

    connectDb();

    $sql = "select chs.chs_code, chs.student_code, stu.name
    from course_has_student chs inner join student stu on chs.student_code = stu.student_code
    where chs.course_code = '{$courseCode}'";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function addPointForStudent($chsCode, $l1, $l2, $l3)
{
    global $conn;

    connectDb();

    // Chống SQL Injection
    $chsCode = addslashes($chsCode);
    $l1 = addslashes($l1);
    $l2 = addslashes($l2);
    $l3 = addslashes($l3);

    $sql = "INSERT INTO point(chs_code, point_l1, point_l2, point_l3) VALUES
        ('$chsCode','$l1','$l2','$l3')";

    $query = mysqli_query($conn, $sql) or die("Không nhập được điểm");

    return $query;
}

function getPoint()
{
    global $conn;

    connectDb();

    $sql = "select stu.student_code, stu.name, p.point_l1, p.point_l2, p.point_l3
    from point p inner join course_has_student chs on p.chs_code = chs.chs_code
    inner join student stu on chs.student_code = stu.student_code";

    $query = mysqli_query($conn, $sql);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    return $result;
}

function searchStudent($keySearch)
{
    global $conn;

    connectDb();

    $sql = "SELECT * FROM `student` WHERE (`student_code` LIKE '%$keySearch%' OR `name` LIKE '%$keySearch%' OR `email` LIKE '%$keySearch%')";

    $query = mysqli_query($conn, $sql);

    $result = '';

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result .= "<tr><td>" . $row['name'] . "</td>" . "<td>" . $row['student_code'] . "</td>" . "<td>" . $row['email'] . "</td></tr>";
        }

        return $result;
    }
}