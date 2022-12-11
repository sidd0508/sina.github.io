<?php
session_start();

// connect to database
$db = dbConnect();

// variable declaration
$username = "";
$email    = "";
$errors   = array();

function dbConnect()
{
    return mysqli_connect('localhost', 'root', '', 'student_management_system');
}

// call the login() function if register_btn is clicked
if (isset($_POST['adminlogin_btn']) || isset($_POST['SAlogin_btn'])) {
    login();
}

if (isset($_POST['del']) && !empty(trim($_POST['del'])) && isset($_POST['id']) && !empty(trim($_POST['id']))) {
    $id = (int) $_POST['id'];
    $mode = trim($_POST['type']);

    deleteRecord($id, $mode);
}

// Staff Registration
if (isset($_POST['registerStaff'])) {
    registerStaff();
}

// Staff Update
if (isset($_POST['updateStaff'])) {
    updateStaff();
}

// student Registration
if (isset($_POST['registerStudent'])) {
    registerStudent();
}

// update student record
if (isset($_POST['updateStudent'])) {
    updateStudent();
}

// Cohort Registration
if (isset($_POST['registerCohort'])) {
    registerCohort();
}

// Cohort Update
if (isset($_POST['updateCohort'])) {
    updateCohort();
}

// Programme Registration
if (isset($_POST['registerProgramme'])) {
    registerProgramme();
}

// Programme Update
if (isset($_POST['updateProgramme'])) {
    updateProgramme();
}

// update programme record
if (isset($_POST['updateprogramme_btn'])) {
    updateProgramme();
}

// Get Staff by id
if (isset($_GET['staffId'])) {
    $staffId = (int) e($_GET['staffId']);
    getStaffById($staffId);
}

// Get Student by id
if (isset($_GET['studentId'])) {
    $studentId = (int) e($_GET['studentId']);
    getStudentById($studentId);
}

// Get Cohort by id
if (isset($_GET['cohortId'])) {
    $cohortId = (int) e($_GET['cohortId']);
    getCohortById($cohortId);
}

// Get Programme by id
if (isset($_GET['programmeId'])) {
    $programmeId = (int) e($_GET['programmeId']);
    getProgrammeById($programmeId);
}

// Escape string
function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

// Display errors
function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }

}

// Delete record
function deleteRecord($id, $mode)
{
    global $db;

    if($id && $mode) {
        $deleteQuery = null;

        switch ($mode) {
            case 'student':
                $deleteQuery = "DELETE FROM student WHERE StudentID=$id";
                break;
            case 'programme':
                $deleteQuery = "DELETE FROM programme WHERE ProgrammeID=$id";
                break;
            case 'cohort':
                $deleteQuery = "DELETE FROM cohort WHERE CohortID=$id";
                break;
            case 'staff':
                $deleteQuery = "DELETE FROM users WHERE UserID=$id";
                break;
        }

        if (!is_null($deleteQuery)) {
            $queryRun = mysqli_query($db, $deleteQuery);

            if($queryRun) {
                $res = [
                    'status' => 200,
                    'message' => 'Record deleted successfully',
                ];

                echo json_encode($res);
                return false;
            }
            else {
                $res = [
                    'status' => 406,
                    'message' => 'Record could not be deleted',
                ];

                echo json_encode($res);
                return false;
            }
        }
    } else {
        $res = [
            'status' => 404,
            'message' => 'Record not found',
        ];

        echo json_encode($res);
        return false;
    }
}

// REGISTER STAFF
function registerStaff() {
    global $db;

    $staffUsername    =  e($_POST['susername']);
    $staffEmail       =  e($_POST['semailaddress']);
    $staffPassword  =  e($_POST['spassword']);
    $staffUserType  =  e($_POST['susertype']);

    if (empty($staffUsername) || empty($staffEmail) || empty($staffPassword) || empty($staffUserType)) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        // Check if email already exists
        $query = "SELECT u.* FROM users u WHERE u.EmailAddress ='$staffEmail'";
        $result = mysqli_query($db, $query)->num_rows;

        if ($result > 0) {
            $res = [
                'status' => 406,
                'message' => 'Email already exists',
            ];

            echo json_encode($res);
            return false;
        } else {
            $password = md5($staffPassword);
            $addStaffQuery = "INSERT INTO users (Username, EmailAddress, Password, UserType) VALUES('$staffUsername', '$staffEmail', '$password', '$staffUserType')";
            $queryRun = mysqli_query($db, $addStaffQuery);

            if ($queryRun) {
                $res = [
                    'status' => 200,
                    'message' => 'Staff registered successfully',
                ];

                echo json_encode($res);
                return false;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Staff not registered',
                ];

                echo json_encode($res);
                return false;
            }
        }
    }
}

// UPDATE STAFF
function updateStaff() {
    global $db;

    $staffUid = e($_POST['staffUid']);
    $staffUname = e($_POST['staffUname']);
    $staffEmail = e($_POST['staffEmail']);
    $staffPassword = e($_POST['staffPassword']);
    $staffUserType = e($_POST['staffUsertype']);

    if (empty($staffUname) || empty($staffEmail) || empty($staffUserType)) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        // Check if email already exists
        $query = "SELECT u.* FROM users u WHERE u.EmailAddress ='$staffEmail' AND u.UserID != $staffUid";
        $result = mysqli_query($db, $query)->num_rows;

        if ($result > 0) {
            $res = [
                'status' => 406,
                'message' => 'Email already exists',
            ];

            echo json_encode($res);
            return false;
        } else {
            if (!empty($staffPassword)) {
                $password = md5($staffPassword);
                $updateStaffQuery = "UPDATE users SET Username='$staffUname', EmailAddress='$staffEmail', Password='$password', UserType='$staffUserType' WHERE UserID=$staffUid";
            } else {
                $updateStaffQuery = "UPDATE users SET Username='$staffUname', EmailAddress='$staffEmail', UserType='$staffUserType' WHERE UserID=$staffUid";
            }

            $queryRun = mysqli_query($db, $updateStaffQuery);
            if ($queryRun) {
                $res = [
                    'status' => 200,
                    'message' => 'Staff updated successfully',
                ];

                echo json_encode($res);
                return false;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Staff not updated',
                ];

                echo json_encode($res);
                return false;
            }
        }
    }
}

// Register student
function registerStudent(){
    global $db;

    $studentFullname = $_POST['studentFullname'];
    $studentEmail = $_POST['studentEmail'];
    $studentPhone = $_POST['studentPhone'];
    $studentDob =  $_POST['studentDob'];
    $studentAddress = $_POST['studentAddress'];
    $studentGender = $_POST['studentGender'];
    $studentProgramme = $_POST['studentProgramme'];
    $studentCohort = $_POST['studentCohort'];

    if (empty($studentFullname) || empty($studentEmail) || empty($studentPhone) || empty($studentDob) ||
        empty($studentAddress) || empty($studentGender) || empty($studentProgramme) || empty($studentCohort)
    ) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        // Check if email already exists
        $query = "SELECT s.* FROM student s WHERE s.SEmailAddress ='$studentEmail'";
        $result = mysqli_query($db, $query)->num_rows;

        if ($result > 0) {
            $res = [
                'status' => 406,
                'message' => 'Email already exists',
            ];

            echo json_encode($res);
            return false;
        } else {
            $addStudentQuery = "INSERT INTO student (SFullName, DOB, SGender, SAddress, SPhoneNumber, SEmailAddress, CohortId, ProgrammeId) 
                VALUES('$studentFullname', '$studentDob', '$studentGender', '$studentAddress', '$studentPhone', '$studentEmail', '$studentCohort', '$studentProgramme')";

            $queryRun = mysqli_query($db, $addStudentQuery);

            if ($queryRun) {
                $res = [
                    'status' => 200,
                    'message' => 'Student registered successfully',
                ];

                echo json_encode($res);
                return false;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Student not registered',
                ];

                echo json_encode($res);
                return false;
            }
        }
    }
}

// Update student
function updateStudent(){
    global $db;

    $studentId = e($_POST['sId']);
    $studentFullname = $_POST['sFullname'];
    $studentEmail = $_POST['sEmail'];
    $studentPhone = $_POST['sPhone'];
    $studentDob =  $_POST['sDob'];
    $studentAddress = $_POST['sAddress'];
    $studentGender = $_POST['sGender'];
    $studentProgramme = $_POST['sProgramme'];
    $studentCohort = $_POST['sCohort'];

    if (empty($studentFullname) || empty($studentEmail) || empty($studentPhone) || empty($studentDob) ||
        empty($studentAddress) || empty($studentGender) || empty($studentProgramme) || empty($studentCohort)
    ) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        // Check if email already exists
        $query = "SELECT s.* FROM student s WHERE s.SEmailAddress ='$studentEmail' AND s.StudentID != $studentId";
        $result = mysqli_query($db, $query)->num_rows;

        if ($result > 0) {
            $res = [
                'status' => 406,
                'message' => 'Email already exists',
            ];

            echo json_encode($res);
            return false;
        } else {
            $updateStaffQuery = "UPDATE student SET SFullname='$studentFullname', DOB='$studentDob', SGender='$studentGender', SAddress='$studentAddress', 
                   SPhoneNumber='$studentPhone', SEmailAddress='$studentEmail', CohortId='$studentCohort', ProgrammeId='$studentProgramme' WHERE StudentID=$studentId";
            $queryRun = mysqli_query($db, $updateStaffQuery);

            if ($queryRun) {
                $res = [
                    'status' => 200,
                    'message' => 'Student updated successfully',
                ];

                echo json_encode($res);
                return false;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Student not updated',
                ];

                echo json_encode($res);
                return false;
            }
        }
    }
}

// REGISTER COHORT
function registerCohort() {
    global $db;

    $cohortName = e($_POST['cohortName']);

    if (empty($cohortName)) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        $addCohortQuery = "INSERT INTO cohort (CohortName) VALUES('$cohortName')";
        $queryRun = mysqli_query($db, $addCohortQuery);

        if ($queryRun) {
            $res = [
                'status' => 200,
                'message' => 'Cohort added successfully',
            ];

            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Cohort not added',
            ];

            echo json_encode($res);
            return false;
        }
    }
}

// Update cohort
function updateCohort() {
    global $db;

    $cohortId = e($_POST['cohortUid']);
    $cName = e($_POST['cName']);

    if (empty($cName)) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        $updateCohortQuery = "UPDATE cohort SET CohortName='$cName' WHERE CohortID=$cohortId";
        $queryRun = mysqli_query($db, $updateCohortQuery);

        if ($queryRun) {
            $res = [
                'status' => 200,
                'message' => 'Cohort updated successfully',
            ];

            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Cohort not updated',
            ];

            echo json_encode($res);
            return false;
        }
    }
}

// REGISTER PROGRAMME
function registerProgramme() {
    global $db;

    $programmeName = e($_POST['programmeName']);
    $programmeDepartment = e($_POST['programmeDepartment']);
    $programmeDuration = e($_POST['programmeDuration']);

    if (empty($programmeName) || empty($programmeDepartment) || empty($programmeDuration)) {
        $res = [
            'status' => 406,
            'message' => 'All fields are required',
        ];

        echo json_encode($res);
        return false;
    } else {
        $addProgrammeQuery = "INSERT INTO programme (ProgrammeName, ProgrammeDepartment, ProgrammeDuration) VALUES('$programmeName', '$programmeDepartment', '$programmeDuration')";
        $queryRun = mysqli_query($db, $addProgrammeQuery);

        if ($queryRun) {
            $res = [
                'status' => 200,
                'message' => 'Programme updated successfully',
            ];

            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Programme not updated',
            ];

            echo json_encode($res);
            return false;
        }
    }
}

// Update programme
function updateProgramme(){
    global $db;

    $programmeId    =  $_POST['programmeUid'];
    $programmeName    =  $_POST['pName'];
    $programmeDepartment       =  $_POST['pDepartment'];
    $programmeDuration  =  $_POST['pDuration'];

    $updateProgrammeQuery = "UPDATE programme SET ProgrammeName='$programmeName', ProgrammeDepartment='$programmeDepartment', ProgrammeDuration='$programmeDuration' WHERE ProgrammeID=$programmeId";
    $queryRun= mysqli_query($db, $updateProgrammeQuery);

    if ($queryRun) {
        $res = [
            'status' => 200,
            'message' => 'Programme added successfully',
        ];

        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Programme not registered',
        ];

        echo json_encode($res);
        return false;
    }
}

// Get user by ID
function getStaffById($id){
    global $db;
    $query = "SELECT * FROM users WHERE UserID = $id ";
    $queryRun = mysqli_query($db, $query);

    if (mysqli_num_rows($queryRun) == 1) {
        $staff = mysqli_fetch_assoc($queryRun);
        $res = [
            'status' => 200,
            'message' => 'Staff fetched successfully',
            'user' => $staff
        ];

        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 406,
            'message' => 'Staff not found',
        ];

        echo json_encode($res);
        return false;
    }
}

// Get student by ID
function getStudentById($id){
    global $db;
    $query = "SELECT * FROM student WHERE StudentID = $id ";
    $queryRun = mysqli_query($db, $query);

    if (mysqli_num_rows($queryRun) == 1) {
        $student = mysqli_fetch_assoc($queryRun);
        $res = [
            'status' => 200,
            'message' => 'Student fetched successfully',
            'student' => $student
        ];

        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 406,
            'message' => 'Student not found',
        ];

        echo json_encode($res);
        return false;
    }
}

// Get cohort by ID
function getCohortById($id){
    global $db;
    $query = "SELECT * FROM cohort WHERE CohortID = $id ";
    $queryRun = mysqli_query($db, $query);

    if (mysqli_num_rows($queryRun) == 1) {
        $cohort = mysqli_fetch_assoc($queryRun);
        $res = [
            'status' => 200,
            'message' => 'Cohort fetched successfully',
            'cohort' => $cohort
        ];

        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 406,
            'message' => 'Cohort not found',
        ];

        echo json_encode($res);
        return false;
    }
}

// Get programme by ID
function getProgrammeById($id){
    global $db;
    $query = "SELECT * FROM programme WHERE ProgrammeID = $id ";
    $queryRun = mysqli_query($db, $query);

    if (mysqli_num_rows($queryRun) == 1) {
        $programme = mysqli_fetch_assoc($queryRun);
        $res = [
            'status' => 200,
            'message' => 'Programme fetched successfully',
            'programme' => $programme
        ];

        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 406,
            'message' => 'Programme not found',
        ];

        echo json_encode($res);
        return false;
    }
}

// Get user by id
function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE UserID = $id ";
    $queryRun = mysqli_query($db, $query);
    $user = [];

    if (mysqli_num_rows($queryRun) == 1) {
        $user = mysqli_fetch_assoc($queryRun);
    }

    return $user;
}

// LOGIN USER
function login(){
    global $db, $errors, $email;

    // grap form values
    $email = e($_POST['email']);
    $password = e($_POST['password']);

    // make sure form is filled properly
    if (empty($email)) {
        array_push($errors, "Email Address is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "SELECT * FROM users WHERE EmailAddress='$email' AND Password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
            // check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);

            $_SESSION['user'] = $logged_in_user;
            $_SESSION['UserID'] = $logged_in_user['UserID'];
            $_SESSION['success']  = "You are now logged in";

            if ($logged_in_user['UserType'] == 'admin') {
                $_SESSION['admin'] = $logged_in_user;
                header('location: admindashboard.php');
            }

            if ($logged_in_user['UserType'] == 'staff') {
                $_SESSION['staff'] = $logged_in_user;
                header('location: SAdashboard.php');
            }
        }else {
            array_push($errors, "Wrong email address/password combination");
        }
    }
}

// Check if logged in
function isLoggedIn()
{
    if (isset($_SESSION['staff']) || isset($_SESSION['admin'])) {
        return true;
    }else{
        return false;
    }
}

// Check if logged in user is an Admin
function isAdmin()
{
    if (isset($_SESSION['admin']) && $_SESSION['admin']['UserType'] == 'admin' ) {
        return true;
    }else{
        return false;
    }
}

// Get report page details
function getReportDetails()
{
    return [
        'totalStudents' => count(getAllStudents()),
        'totalMaleStudents' => getTotalMaleStudents(),
        'totalFemaleStudents' => getTotalFemaleStudents(),
        'totalCohorts' => count(getAllCohorts()),
        'studentsByCohort' => getTotalStudentsByCohort(),
        'totalProgrammes' => count(getAllProgrammes()),
        'totalStaffs' => count(getAllStaffs()),
    ];
}

function getTotalMaleStudents()
{
    global $db;
    $query = "SELECT count(*) AS sm FROM student WHERE SGender = 'male'";

    return mysqli_query($db, $query)->fetch_object()->sm;
}

function getTotalFemaleStudents()
{
    global $db;
    $query = "SELECT count(*) AS sf FROM student WHERE SGender = 'female'";

    return mysqli_query($db, $query)->fetch_object()->sf;
}

function getAllCohorts()
{
    global $db;
    $query = "SELECT * FROM cohort";

    return mysqli_query($db, $query)->fetch_all(MYSQLI_ASSOC);
}

function getTotalStudentsByCohort()
{
    global $db;
    $query = "SELECT c.*, count(s.CohortId) AS TotalStudents, 
       (
           SELECT count(sm.StudentID) FROM student sm 
               LEFT JOIN cohort c1 ON c1.CohortID = sm.CohortId 
                WHERE sm.SGender = 'male' AND sm.CohortId = c.CohortID GROUP BY c1.CohortID ORDER BY c1.CohortID
       ) AS TotalMaleStudents,
       (
           SELECT count(sf.StudentID) FROM student sf 
               LEFT JOIN cohort c1 ON c1.CohortID = sf.CohortId 
                WHERE sf.SGender = 'female' AND sf.CohortId = c.CohortID GROUP BY c1.CohortID ORDER BY c1.CohortID
       ) AS TotalFemaleStudents
        FROM cohort c 
        LEFT JOIN student s ON s.CohortId = c.CohortID 
        GROUP BY c.CohortID ORDER BY c.CohortID
    ";

    return mysqli_query($db, $query)->fetch_all();
}

function getAllProgrammes()
{
    global $db;
    $query = "SELECT * FROM programme";
    return mysqli_query($db, $query)->fetch_all(MYSQLI_ASSOC);
}

function getAllStaffs($orderBy = 'DESC')
{
    global $db;
    $query = "SELECT * FROM users WHERE UserType = 'staff' ORDER BY UserID $orderBy";

    return mysqli_query($db, $query)->fetch_all(MYSQLI_ASSOC);
}

function getAllStudents($orderBy = 'DESC')
{
    global $db;

    $query = "SELECT s.StudentID, s.SFullName, s.DOB, s.SGender, s.SAddress, s.SPhoneNumber, s.SEmailAddress, s.CohortId AS cohortId, s.ProgrammeId AS programmeId, c.CohortName, p.ProgrammeName 
                FROM student s 
                JOIN cohort c ON c.CohortID = s.CohortId
                JOIN programme p ON p.ProgrammeID = s.ProgrammeId ORDER BY s.StudentID $orderBy";

    return mysqli_query($db, $query)->fetch_all(MYSQLI_ASSOC);
}
