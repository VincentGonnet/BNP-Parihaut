<?php
require_once 'connection.php';

function getEventsByAdvisor($advisorId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM rdv WHERE NUMEMPLOYE = :advisorId');
    $result->execute(array(
        'advisorId' => $advisorId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $events = $result->fetchAll();
    $result->closeCursor();
    
    if (!is_array($events)) return array($events);

    return $events;
}

function getEventMinute($event) {
    return date('i', strtotime($event->DATERDV));
}

function getEventHour($event) {
    return date('H', strtotime($event->DATERDV));
}

function getEventDay($event) {
    return date('d', strtotime($event->DATERDV));
}

function getEventMonth($event) {
    return date('m', strtotime($event->DATERDV));
}

function getEventYear($event) {
    return date('Y', strtotime($event->DATERDV));
}

