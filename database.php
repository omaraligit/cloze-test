<?php

// Set default timezone
date_default_timezone_set('UTC');

try {
    /**************************************
     * Create databases and                *
     * open connections                    *
     **************************************/

    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:messaging.sqlite3');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    /**************************************
     * Create tables                       *
     **************************************/

    // Create table messages
    $file_db->exec("CREATE TABLE IF NOT EXISTS test_tables (
                    id INTEGER PRIMARY KEY,
                    text_content TEXT,
                    words_missing TEXT,
                    date_start date,
                    date_end date,
                    missing_words_counter INTEGER)");

    /**************************************
     * Play with databases and tables      *
     **************************************/
    /**
     * @param $text_content
     * @param $words_missing
     * @param $date_start
     * @param $date_end
     * @param $missing_words_counter
     * @return bool|string
     * this will add a new test to database
     */
    function newTest($text_content,$words_missing,$date_start, $date_end,$missing_words_counter){
        global $file_db;
        // Prepare INSERT statement to SQLite3 file db
        $insert = "INSERT INTO test_tables (text_content, words_missing, date_start, date_end, missing_words_counter) VALUES (
                        :text_content,
                        :words_missing,
                        :date_start,
                        :date_end,
                        :missing_words_counter)";
        $stmt = $file_db->prepare($insert);

        // Bind parameters to statement variables
        $stmt->bindParam(':text_content', $text_content);
        $stmt->bindParam(':words_missing', $words_missing);
        $stmt->bindParam(':date_start', $date_start);
        $stmt->bindParam(':date_end', $date_end);
        $stmt->bindParam(':missing_words_counter', $missing_words_counter);

        $res = $stmt->execute();
        if ($res)
            return $file_db->lastInsertId();
        else
            return $res;
    }

    function getAllTests(){
        global $file_db;
        // Select all data from file db messages table
        $result = $file_db->query('SELECT * FROM test_tables');
        $res = [];
        foreach($result as $row) {
            $res[] = $row;
        }
        return $res;
    }

    /**
     * @param $text_content
     * @param $words_missing
     * @param $date_start
     * @param $date_end
     * @param $missing_words_counter
     * @return bool|string
     * this function will delete a given test
     */
    function deleteTest($id){
        global $file_db;
        // Prepare delete stmt db
        $insert = "DELETE FROM test_tables WHERE id like :id";
        $stmt = $file_db->prepare($insert);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);
        $res = $stmt->execute();
        return $res;
    }

}
catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
}
?>