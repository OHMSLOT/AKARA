<?php
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'akara';

    $con = mysqli_connect($hname, $uname, $pass, $db);

    if (!$con) {
        die("Cannot Connect to Database" . mysqli_connect());
    }

    // function filteration($data) {
    //     foreach ($data as $key => $value) {
    //         $value = trim($value);
    //         $value = stripslashes($value);
    //         $value = strip_tags($value);
    //         $value = htmlspecialchars($value);
    //         $data[$key] = $value;
    //     }
    //     return $data;
    // }

    function filteration($data) {
        if (is_array($data) || is_object($data)) {
            foreach ($data as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);
                $data[$key] = $value;
            }
        } else {
            // If $data is not an array or object, filter it directly.
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
        }
        return $data;
    }
    
    

    function select($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } 
            else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            }
        } 
        else {
            die("Query cannot be prepared - Select");
        }
    }

        function update($sql, $values, $datatypes)
        {
            $con = $GLOBALS['con'];
            if ($stmt = mysqli_prepare($con, $sql))
            {
                mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
                if (mysqli_stmt_execute($stmt)) {
                    $res = mysqli_stmt_affected_rows($stmt);
                    mysqli_stmt_close($stmt);
                    return $res;
                } 
                else {
                    mysqli_stmt_close($stmt);
                    die("Query cannot be executed - Update");
                }
            } 
            else {
                die("Query cannot be prepared - Update");
            }
        }

    function insert($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } 
            else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Insert");
            }
        } 
        else {
            die("Query cannot be prepared - Insert");
        }
    }

    function selectAll($table)
    {
    $con = $GLOBALS['con'];
    $res = mysqli_query($con,"SELECT * FROM $table");
    return $res;
    }

    function delete($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } 
            else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Delete");
            }
        } 
        else {
            die("Query cannot be prepared - Delete");
        }
    }

?>