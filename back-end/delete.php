<?php 
function delete($id)
{
    $sql_query = "DELETE FROM bookmarks WHERE id = :id_value";
    $stmt = $GLOBALS["conn"]->prepare($sql_query);
    if ($stmt) {
        $stmt->bindParam("id_value", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>