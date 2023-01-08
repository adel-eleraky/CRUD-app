<?php 
namespace App\Database\Models;

use App\Database\Config\Connection;

include_once __DIR__ . "/../Config/Connection.php";

class User extends Connection {
    private $id , $email , $national_id , $role , $gender , $country , $city , $phone , $name , $age , $image,  $created_at , $updated_at;


    // get all users data from database
    public function AllUsersData(){

        $query = "SELECT * FROM users";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->get_result();
    }

    // get specific user data by id
    public function getUserById(){

        $query = "SELECT * FROM users WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i' , $this->id);
        $statement->execute();
        return $statement->get_result();
    }

    // get specific user by email
    public function getUserByEmail(){

        $query = "SELECT * FROM users WHERE email = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('s' , $this->email);
        $statement->execute();
        return $statement->get_result();
    }


    // insert new user data in database
    public function Create(): bool {

        $query = "INSERT INTO users 
                            (name , national_id , email , phone , country , city , role , age , gender)
                    VALUES 
                            ( ? , ? , ? , ? , ? , ? , ? , ? , ? )";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sisisssis' , $this->name , $this->national_id , $this->email , $this->phone , $this->country , $this->city , $this->role , $this->age , $this->gender);
        return  $statement->execute();
    }

    // update user data in database
    public function Update(): bool {
        
        $query = "UPDATE users SET name = ? , national_id = ? , email = ? , phone = ? , country = ? , city = ? , role = ? , age = ? , gender = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sisisssisi' , $this->name , $this->national_id , $this->email , $this->phone , $this->country , $this->city , $this->role , $this->age , $this->gender , $this->id );
        return $statement->execute();

    }

    // delete user by id
    public function Delete(int $id) : bool {

        $query = "DELETE FROM users WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i' , $id);
        return $statement->execute();
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of national_id
     */ 
    public function getNational_id()
    {
        return $this->national_id;
    }

    /**
     * Set the value of national_id
     *
     * @return  self
     */ 
    public function setNational_id($national_id)
    {
        $this->national_id = $national_id;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}


?>