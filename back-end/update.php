<?php 
function update($link ,$id){
    $sql_query = "UPDATE bookmarks SET link = :link_value WHERE id = :id_vaule";
    $stmt = $GLOBALS["conn"]->prepare($sql_query);
    if ($stmt) {
        $stmt->bindParam("link_value", $link, PDO::PARAM_STR);
        $stmt->bindParam("id_vaule", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>