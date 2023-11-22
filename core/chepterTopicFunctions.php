<?php  
include("db_config.php");
function word_limiter( $text, $limit = 50, $chars = '0123456789' ) {
    if( strlen( $text ) > $limit ) {
        $words = str_word_count( $text, 2, $chars );
        $words = array_reverse( $words, TRUE );
        foreach( $words as $length => $word ) {
            if( $length + strlen( $word ) >= $limit ) {
                array_shift( $words );
            } else {
                break;
            }
        }
        $words = array_reverse( $words );
        $text = implode( " ", $words ) . '&hellip;';
    }
    return $text;
}

$topicId = $_GET['topicId'];


// Query the database to get subtopics for the selected topic
$query = "SELECT Id, subtopicName FROM subtopics WHERE topicId = $topicId";
$result = mysqli_query($con, $query);


if ($result) {
    $options = '<option>select subtopic name</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['Id']}'>{$row['subtopicName']}</option>";
    }
    echo $options;
    
} else {
    echo '<option>Failed to fetch subtopics</option>';
}


?>