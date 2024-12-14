<?php 
function insert($title, $link)
{
    $sql_query = "INSERT INTO bookmarks (title, link, date_added) VALUES(:title_value, :link_value, NOW())";
    $stmt = $GLOBALS["conn"]->prepare($sql_query);
    if ($stmt) {
        $stmt->bindParam(":title_value", $title, PDO::PARAM_STR);
        $stmt->bindParam(":link_value", $link, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
