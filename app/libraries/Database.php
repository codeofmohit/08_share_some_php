<?php 
    # PDO Database class
    # Connects to the database
    # Creates prepared statements
    # Bind values and executes the function
    # Return rows and results

    class Database{
        private $db_host = DB_HOST;
        private $db_user = DB_USER;
        private $db_pass = DB_PASS;
        private $db_name = DB_NAME;

        private $dbh; // Database handler => Would hold the instance of PDO class
        private $stmt; // Result object (statement object) => Would hold the instance of PDOStatement class [for execute and fetch]
        private $error;

        public function __construct(){
            // Setting DSN
            $dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name;
            $options = [
                // Options we are giving for validating connection establishment + Error handling
                // Options = A key=>value array of driver-specific connection options.
                PDO::ATTR_PERSISTENT=>true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ];

            // Create PDO instance [with error handling]
            // Try [throws the exception/error if any], Catch [catch & handle the exception/error thrown by try block]
            try{
                $this->dbh = new PDO($dsn,$this->db_user,$this->db_pass,$options);
            }catch(PDOException $e){
                // PDOException is the exception handing class of PDO
                // $e is the object of the PDOException class, thrown via the try block
                // This is the syntax of error handling DONT CONFUSE
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepared statement with query
        public function query($sql){
            // storing the statement object (result object) returned via prepare method of PDO class
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Bind values
        public function bind($param,$value,$type=null){
            if(is_null($type)){
                switch($value){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param,$value,$type);
            // bindValue method is a method od PDOStatement class, use to mannual bind the values of the dynamic data to SQL statement before their execution
            // Other alternate is to directly pass the values into the execute() as a parameter 
        }

        // Execute a prepared statement
        public function execute(){
            return $this->stmt->execute();
        }

        // Get result set as an array of objects
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get result as a single record/row
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount(){
            $this->execute();
            return $this->stmt->rowCount();
        }
    }
?>