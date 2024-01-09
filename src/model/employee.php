<?php



function addEmployee($name, $firstname, $login, $password, $job) {
    $connection = Connection::getInstance()->getConnection();
    $testResult = $connection->prepare("SELECT COUNT(*) FROM employe WHERE LOGIN = :login");
    $testResult->execute(['login' => $login]);

    if ($testResult->fetchColumn() > 0) {
        echo '<script>  alert("Le login existe déjà. Veuillez choisir un autre login.");
                </script>';
        return;
    }

    $result = $connection->prepare("INSERT INTO employe (NOM, PRENOM, LOGIN, MDP, CATEGORIE) VALUES (:name, :firstname, :login, :password, :job)");
    $result->execute([
        'name' => $name,
        'firstname' => $firstname,
        'login' => $login,
        'password' => $password,
        'job' => $job
    ]);
    $result->closeCursor();
}


function getEmployeeById($employeeId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE NUMEMPLOYE = :employeeId LIMIT 1');
    $result->execute(array(
        'employeeId' => $employeeId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $employee = $result->fetch();
    $result->closeCursor();

    if (empty($employee)) return null;

    return $employee;
}

function getAllEmployees() {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe');
    $result->execute();
    $result->setFetchMode(PDO::FETCH_OBJ);
    $employees = $result->fetchAll();
    $result->closeCursor();

    if (empty($employees)) return array();
    if (!is_array($employees)) return array($employees);

    return $employees;
}

function getAllAdvisors() {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE CATEGORIE = \'advisor\'');
    $result->execute();
    $result->setFetchMode(PDO::FETCH_OBJ);
    $advisors = $result->fetchAll();
    $result->closeCursor();

    if (empty($advisors)) return array();
    if (!is_array($advisors)) return array($advisors);

    return $advisors;
}

function getAllAgents() {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE CATEGORIE = \'agent\'');
    $result->execute();
    $result->setFetchMode(PDO::FETCH_OBJ);
    $agents = $result->fetchAll();
    $result->closeCursor();

    if (empty($agents)) return array();
    if (!is_array($agents)) return array($agents);

    return $agents;
}

function getAllDirectors() {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE CATEGORIE = \'director\'');
    $result->execute();
    $result->setFetchMode(PDO::FETCH_OBJ);
    $directors = $result->fetchAll();
    $result->closeCursor();

    if (empty($directors)) return array();
    if (!is_array($directors)) return array($directors);

    return $directors;
}

// AJAX LIVE SEARCH EMPLOYEES
function liveSearchEmployee($input) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE NOM LIKE :input OR PRENOM LIKE :input');
    $result->execute(array(
        'input' => '%' . $input . '%'
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $employees = $result->fetchAll();
    $result->closeCursor();

    if (empty($employees)) return array();
    if (!is_array($employees)) return array($employees);

    return $employees;
}

function deleteEmployee($employeeId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('DELETE FROM employe WHERE NUMEMPLOYE = :employeeId');
    $result->execute(array(
        'employeeId' => $employeeId
    ));
    $result->closeCursor();
}

function modifyEmployeeJob($employeeId, $job) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('UPDATE employe SET CATEGORIE = :job WHERE NUMEMPLOYE = :employeeId');
    $result->execute(array(
        'job' => $job,
        'employeeId' => $employeeId
    ));
    $result->closeCursor();
}

