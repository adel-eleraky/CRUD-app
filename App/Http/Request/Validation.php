<?php 

namespace App\Http\Request;

use App\Database\Config\Connection;

include_once __DIR__ . "/../../Database/Config/Connection.php";

class Validation extends Connection {

    private $Input , $InputName;
    private array $errors = [];
    

    // check if the input is empty
    public function required(): self {

        if(empty($this->Input)){
            $this->errors[$this->InputName][__FUNCTION__] = "{$this->InputName} Is Required";
        }
        return $this;
    }

    // check if the input is string
    public function string(): self {
        
        if(! is_string($this->Input)){
            $this->errors[$this->InputName][__FUNCTION__] = "{$this->InputName} Must Be String";
        }
        return $this;
    }

     // check if the input is number
    public function numeric(): self{

        if(! is_numeric($this->Input)){
            $this->errors[$this->InputName][__FUNCTION__] = "{$this->InputName} Must Be Numeric";
        }
        return $this;
    } 

    //check if the length of the input 
    public function between(int $min , int $max): self {

        if( strlen($this->Input) < $min | strlen($this->Input) > $max ){
            $this->errors[$this->InputName][__FUNCTION__] = "{$this->InputName} Must Be Between {$min} , {$max}";
        }
        return $this;
    }

    // check if the input match the regex pattern
    public function regex(string $pattern): self {

        if(! preg_match($pattern , $this->Input)){
            $this->errors[$this->InputName][__FUNCTION__] = "{$this->InputName} Is Not Valid";
        }
        return $this;
    }

    // check if the input exits in the database 
    public function unique(string $tableName , string $columnName): self {

        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ? ";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('s' , $this->Input);
        $statement->execute();
        if($statement->get_result()->num_rows == 1){
            $this->errors[$this->InputName][__FUNCTION__] = "This {$this->InputName} Exists In DataBase";
        }
        return $this;
    }

    // check if the input match the available values
    public function In(array $values): self {

        if(! in_array($this->Input , $values)){
            $this->errors[$this->InputName][__FUNCTION__] = "( {$this->Input} ) This Value Isn't Available";
        }
        return $this;
    }


    /**
     * Get the value of Input
     */ 
    public function getInput()
    {
        return $this->Input;
    }

    /**
     * Set the value of Input
     *
     * @return  self
     */ 
    public function setInput($Input)
    {
        $this->Input = $Input;

        return $this;
    }

    /**
     * Get the value of InputName
     */ 
    public function getInputName()
    {
        return $this->InputName;
    }

    /**
     * Set the value of InputName
     *
     * @return  self
     */ 
    public function setInputName($InputName)
    {
        $this->InputName = $InputName;

        return $this;
    }

    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */ 
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    // get the first error message to display
    public function getErrorMessage(string $InputName): ?string {

        if(isset($this->errors[$InputName])){
            foreach($this->errors[$InputName] as $error){
                return "<p class='text-danger font-weight-bold' > ". $error ." </p>";
            }
        }
        return null;
    }
}





?>