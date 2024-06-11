<?php

function getUsers($username)
{

    $link = dbConnection();

    $statement = "SELECT user_id, user_name, user_password, user_type, user_active
    FROM users
    WHERE user_name = ?";

    $name = $username;

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function getUserByType()
{

    $link = dbConnection();

    $statement = "SELECT user_id, user_name, user_active
    FROM users
    WHERE user_type = ?";

    $type = 'admin';

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function verifyUser($n)
{

    $link = dbConnection();

    $statement = "SELECT user_id
    FROM users
    WHERE user_name = ?";

    $name = $n;

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function addUser($n, $p, $t, $a)
{

    $link = dbConnection();

    $statement = "INSERT INTO users (user_name, user_password, user_type, user_active) 
    VALUES (?, ?, ?, ?)";

    $data = $link->execute_query($statement, [$n, $p, $t, $a]);

    return $data;
}

function setActivity($a, $i)
{

    $link = dbConnection();

    $statement = "UPDATE users SET user_active = ? WHERE user_id = ? ";

    $stmt = $link->prepare($statement);
    $stmt->bind_param("ss", $a, $i);
    $data = $stmt->execute();

    return $data;
}

function deletedUser($i)
{

    $link = dbConnection();

    $statement = "DELETE FROM users WHERE user_id = ?";

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $i);
    $data = $stmt->execute();

    return $data;
}

function changePassword($p, $i)
{

    $link = dbConnection();

    $statement = "UPDATE users SET user_password = ? WHERE user_id = ?";

    $stmt = $link->prepare($statement);
    $stmt->bind_param("ss", $p, $i);
    $data = $stmt->execute();

    return $data;
}

function  getAdmin($i)
{
    $link = dbConnection();

    $statement = "SELECT user_id, user_password, user_type, user_active
    FROM users
    WHERE user_id = ?";

    $id = $i;

    $stmt = $link->prepare($statement);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}
