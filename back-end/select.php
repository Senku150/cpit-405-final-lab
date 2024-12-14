<?php 
function select_all()
{
    $sql_query = "SELECT * FROM bookmarks";
    $stmt = $GLOBALS["conn"]->prepare($sql_query);
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}


function select_one($title)
{
    $sql_query = "SELECT * FROM bookmarks Where title = :title_value";
    $stmt = $GLOBALS["conn"]->prepare($sql_query);
    if ($stmt) {
        $stmt->bindParam("title_value", $title, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
}
?>