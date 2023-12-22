<?php
require_once 'connection.php';

function searchEmployeeById($employeId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE NUMEMPLOYE = :employeId LIMIT 1');
    $result->execute(array(
        'employeId' => $employeId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $employe = $result->fetch();
    $result->closeCursor();

    if (empty($employe)) {
        return null;
    }

    return $employe;
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