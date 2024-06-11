<?php

function getDocType()
{

    $link = dbConnection();

    $statement = "SELECT type_doc,paths,datecreate,DATE_FORMAT(datecreate, '%d %m %Y') AS full_date
    FROM document
    WHERE type_doc = ?
    ORDER BY datecreate DESC LIMIT 1";

    $type = 'conseil';

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function getDocOtherType($types)
{
    $link = dbConnection();

    $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d %M %Y') AS full_date
    FROM document
    WHERE type_doc = ?
    ORDER BY datecreate DESC LIMIT 4";

    $type = $types;

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function getDocBySearch($type, $keywords, $begin, $end, $premier, $parPage)
{
    $link = dbConnection();

    $array = array("conseil", "decret", "loi", "ordonnance", "accord", "decision");

    $in  = str_repeat('?,', count($array) - 1) . '?';

    if ($type === 'all') {
        if (empty($keywords) && empty($begin) && empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  IN ($in)
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($keywords) && empty($begin)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc IN ($in)
            AND datecreate <= '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($keywords) && empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc IN ($in)
            AND datecreate >= '$begin'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($begin) && empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  IN ($in)
            AND title LIKE '%$keywords%'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($keywords)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  IN ($in)
            AND datecreate BETWEEN '$begin' AND '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($begin)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc IN ($in)
            AND title LIKE '%$keywords%'
            AND datecreate <= '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc IN ($in)
            AND title LIKE '%$keywords%'
            AND datecreate >= '$begin'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  IN ($in)
            AND title LIKE '%$keywords%'
            AND datecreate BETWEEN '$begin' AND '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        }
    } else {
        if (empty($keywords) && empty($begin) && empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  = ?
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($keywords) && empty($begin)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc = ?
            AND datecreate <= '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($keywords) && empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc = ?
            AND datecreate >= '$begin'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($begin) && empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  = ?
            AND title LIKE '%$keywords%'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($keywords)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  = ?
            AND datecreate BETWEEN '$begin' AND '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($begin)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc = ?
            AND title LIKE '%$keywords%'
            AND datecreate <= '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else if (empty($end)) {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc = ?
            AND title LIKE '%$keywords%'
            AND datecreate >= '$begin'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        } else {
            $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
            FROM document
            WHERE type_doc  = ?
            AND title LIKE '%$keywords%'
            AND datecreate BETWEEN '$begin' AND '$end'
            ORDER BY datecreate DESC LIMIT $premier,$parPage";
        }
    }

    if ($type === 'all') {
        $types = str_repeat('s', count($array));
    } else {
        $types = $type;
    }

    $stmt = $link->prepare($statement);
    if ($type === 'all') {
        $stmt->bind_param($types, ...$array);
    } else {
        $stmt->bind_param("s", $types);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $searchDocs = $result->fetch_all(MYSQLI_ASSOC);

    return $searchDocs;
}

function getNumberDoc($type, $keywords, $begin, $end)
{
    $link = dbConnection();

    $array = array("conseil", "decret", "loi", "ordonnance", "accord", "decision");

    $in  = str_repeat('?,', count($array) - 1) . '?';

    if ($type === 'all') {
        if (empty($keywords) && empty($begin) && empty($end)) {
            $statement = "SELECT COUNT(*)
            FROM document
            WHERE type_doc  IN ($in)";
        } else if (empty($keywords) && empty($begin)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND datecreate <= '$end'";
        } else if (empty($keywords) && empty($end)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND datecreate >= '$begin'";
        } else if (empty($begin) && empty($end)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND title LIKE '%$keywords%'";
        } else if (empty($keywords)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND datecreate BETWEEN '$begin' AND '$end'";
        } else if (empty($begin)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND datecreate <= '$end' 
            AND title LIKE '%$keywords%'";
        } else if (empty($end)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND datecreate >= '$begin' 
            AND title LIKE '%$keywords%'";
        } else {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  IN ($in)
            AND title LIKE '%$keywords%'
            AND datecreate BETWEEN '$begin' AND '$end'";
        }
    } else {
        if (empty($keywords) && empty($begin) && empty($end)) {
            $statement = "SELECT COUNT(*)
            FROM document
            WHERE type_doc  = ?";
        } else if (empty($keywords) && empty($begin)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  = ?
            AND datecreate <= '$end'";
        } else if (empty($keywords) && empty($end)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  = ?
            AND datecreate >= '$begin'";
        } else if (empty($begin) && empty($end)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  = ?
            AND title LIKE '%$keywords%'";
        } else if (empty($keywords)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc = ?
            AND datecreate BETWEEN '$begin' AND '$end'";
        } else if (empty($begin)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  = ?
            AND datecreate <= '$end' 
            AND title LIKE '%$keywords%'";
        } else if (empty($end)) {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  = ?
            AND datecreate >= '$begin' 
            AND title LIKE '%$keywords%'";
        } else {
            $statement = "SELECT COUNT(*) 
            FROM document
            WHERE type_doc  = ?
            AND title LIKE '%$keywords%'
            AND datecreate BETWEEN '$begin' AND '$end'";
        }
    }

    if ($type === 'all') {
        $types = str_repeat('s', count($array));
    } else {
        $types = $type;
    }

    $stmt = $link->prepare($statement);
    if ($type === 'all') {
        $stmt->bind_param($types, ...$array);
    } else {
        $stmt->bind_param("s", $types);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $nbDocs = $result->fetch_row();

    return $nbDocs;
}

function getDocByFilter($type, $premier, $parPage)
{
    $link = dbConnection();

    $array = array("conseil", "decret", "loi", "ordonnance", "accord", "decision");

    $in  = str_repeat('?,', count($array) - 1) . '?';

    if ($type == 'all') {
        $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
        FROM document
        WHERE type_doc  IN ($in)
        ORDER BY datecreate DESC LIMIT $premier,$parPage";
    } else {
        $statement = "SELECT title,type_doc,reference,datecreate,paths,DATE_FORMAT(datecreate, '%d/%m/%Y') AS full_date
        FROM document
        WHERE type_doc  = ?
        ORDER BY datecreate DESC LIMIT $premier,$parPage";
    }

    if ($type === 'all') {
        $types = str_repeat('s', count($array));
    } else {
        $types = $type;
    }

    $stmt = $link->prepare($statement);

    if ($type === 'all') {
        $stmt->bind_param($types, ...$array);
    } else {
        $stmt->bind_param("s", $types);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $filter = $result->fetch_all(MYSQLI_ASSOC);

    return $filter;
}

function getNumber($type)
{
    $link = dbConnection();

    $array = array("conseil", "decret", "loi", "ordonnance", "accord", "decision");

    $in  = str_repeat('?,', count($array) - 1) . '?';

    if ($type == 'all') {
        $statement = "SELECT COUNT(*)
        FROM document
        WHERE type_doc  IN ($in)";
    } else {
        $statement = "SELECT COUNT(*)
        FROM document
        WHERE type_doc  = ? ";
    }

    if ($type === 'all') {
        $types = str_repeat('s', count($array));
    } else {
        $types = $type;
    }

    $stmt = $link->prepare($statement);

    if ($type === 'all') {
        $stmt->bind_param($types, ...$array);
    } else {
        $stmt->bind_param("s", $types);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $nb = $result->fetch_row();

    return $nb;
}

function getAllDoc($premier, $parPage)
{
    $link = dbConnection();

    $statement = "SELECT id, title, type_doc, reference, datecreate, services, username,DATE_FORMAT(datecreate, '%d-%m-%Y') AS full_date 
    FROM document 
    ORDER BY datecreate 
    DESC  LIMIT $premier,$parPage";

    $result  = $link->query($statement);

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function getAllNb()
{
    $link = dbConnection();

    $statement = "SELECT COUNT(*)
    FROM document
    ORDER BY datecreate DESC";

    $result  = $link->query($statement);

    $row = $result->fetch_row();

    return $row;
}

function addDoc($ti, $t, $r, $d, $p, $s, $u)
{

    $link = dbConnection();

    $statement = "INSERT INTO document (title, type_doc, reference, datecreate, paths, services, username) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $data = $link->execute_query($statement, [$ti, $t, $r, $d, $p, $s, $u]);

    return $data;
}

function getDocById($i)
{

    $link = dbConnection();

    $statement = "SELECT *,DATE_FORMAT(datecreate, '%d/%m/%Y') AS datecreate,DATE_FORMAT(created_at, '%d/%m/%Y  %H:%i:%s') AS created_at,DATE_FORMAT(update_date, '%d/%m/%Y  %H:%i:%s') AS update_date 
    FROM document 
    WHERE id = ?";

    $id = $i;

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function deleteDoc($i)
{

    $link = dbConnection();

    $statement = "DELETE FROM document WHERE id = ?";

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $i);
    $data = $stmt->execute();

    return $data;
}

function updateDoc($t, $r, $d, $s, $u, $i)
{

    $link = dbConnection();

    $statement = "UPDATE document SET title=?, reference=?, datecreate=?, services=?, update_date= NOW(),username_update=? WHERE id=?";

    $stmt = $link->prepare($statement);
    $stmt->bind_param("ssssss", $t, $r, $d, $s, $u, $i);
    $data = $stmt->execute();

    return $data;
}
