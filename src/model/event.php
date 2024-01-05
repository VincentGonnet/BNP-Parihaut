<?php
require_once 'connection.php';

function getEventById($eventId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM rdv WHERE NUMRDV = :eventId');
    $result->execute(array(
        'eventId' => $eventId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $event = $result->fetch();
    $result->closeCursor();

    if(empty($event)) {
        return null;
    }

    return $event;
}

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

function addEvent($advisorId, $clientId, $reasonId, $start, $end) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('INSERT INTO rdv (NUMEMPLOYE, NUMCLIENT, IDMOTIF, DATERDV, DATEFINRDV) VALUES (:advisorId, :clientId, :reasonId, :start, :end)');
    $result->execute(array(
        'advisorId' => $advisorId,
        'clientId' => $clientId,
        'reasonId' => $reasonId,
        'start' => $start,
        'end' => $end
    ));
    $result->closeCursor();
}

function reserveTimeSlot($advisorId, $start, $end) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('INSERT INTO rdv (NUMEMPLOYE, DATERDV, DATEFINRDV) VALUES (:advisorId, :start, :end)');
    $result->execute(array(
        'advisorId' => $advisorId,
        'start' => $start,
        'end' => $end
    ));
    $result->closeCursor();
}

function deleteEvent($eventId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('DELETE FROM rdv WHERE NUMRDV = :eventId');
    $result->execute(array(
        'eventId' => $eventId
    ));
    $result->closeCursor();
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

function getAllEventsBeforeDate($date) {
    $connection = Connection::getInstance()->getConnection();
    $request = $connection->prepare("SELECT * FROM rdv WHERE DATERDV < :date");
    $request->execute(array(
        'date' => $date
    ));
    $request->setFetchMode(PDO::FETCH_OBJ);
    $events = $request->fetchAll();
    $request->closeCursor();

    if(empty($events)) {
        return null;
    }

    if(!is_array($events)) {
        $events = array($events);
    }

    return $events;
}

