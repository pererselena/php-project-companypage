<?php
/**
 * Class to handle login CRUD from database.
 */

namespace Elpr\Login;

/**
 * Representation of a login object.
 */
class Login
{
    /**
     * @var string  $table   The table to work on.
     * @var object  $db   The database object.
     */

    private $table;
    private $db;



    /**
     * Constructor to initiate the object with current db and table.
     *
     * @param string $table The table to work on with default.
     * @var object  $db   The database object.
     *
     */

    public function __construct(object $db, string $table = "kmom10_users")
    {
        $this->table = $table;
        $this->db = $db;
    }

    /**
     * Adds user to the database
     * @param string $user string The name of the user
     * @param string $pass string The user's password
     * @param string $username string The user's username
     * @param string $image string location of profile picture
     * @param string $email string The user's email
     * @return true or exception message
     */

    public function addUser($name, $pass, $username, $image, $email)
    {
        $this->db->connect();
        $sql = "INSERT into $this->table (name, password, username, image, email) VALUES (?, ?, ?, ?, ?);";
        try {
            $this->db->execute($sql, [
                $name,
                $pass,
                $username,
                $image,
                $email
            ]);
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Get user role from the database
     * @param $username string the users username
     * @return string
     */

    public function getUserRole($username)
    {
        $this->db->connect();
        $sql = "SELECT role AS role FROM $this->table WHERE username=?;";
        try {
            $res = $this->db->executeFetch($sql, [
                $username
            ]);
            return $res->role;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Get user from the database
     * @param string $username the users username
     * @return object
     */

    public function getUser($username)
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE username=?;";
        $res = $this->db->executeFetch($sql, [
            $username
        ]);
        return $res;
    }

    /**
     * Get all users from the database
     *
     * @return object
     */

    public function getAllUsers()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table;";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }

    /**
     * Gets the hashed password from the database
     * @param string $user the users username
     * @return string The hashed password
     */
    public function getHash($user)
    {
        $this->db->connect();
        $sql = "SELECT password AS password FROM $this->table WHERE username=?;";

        $res = $this->db->executeFetch($sql, [$user]);

        return $res->password;
    }

    /**
     * Changes the user information for a user
     * @param string $user string The name of the user
     * @param string $pass string The user's password
     * @param string $username string The user's username
     * @param string $image string location of profile picture
     * @param string $email string The user's email
     * @return true or exception message
     */
    public function changeUser($user, $pass, $name, $image, $email)
    {
        $this->db->connect();
        if ($pass === null) {
            $sql = "UPDATE $this->table SET password=?, name=?, image=?, email=? WHERE username=?;";

            try {
                $this->db->execute($sql, [
                    $pass,
                    $name,
                    $image,
                    $email,
                    $user
                ]);
                return true;
            } catch (\Exception $e) {
                return $e;
            }
        }
        $sql = "UPDATE $this->table SET name=?, image=?, email=? WHERE username=?;";

        try {
            $this->db->execute($sql, [
                $name,
                $image,
                $email,
                $user
            ]);
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Check if user exists in the database
     * @param $user string The user to search for
     * @return bool true if user exists, otherwise false
     */
    public function exists($user)
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE username=?;";
        $res = $this->db->executeFetch($sql, [$user]);
        return !$res ? false : true;
    }

    /**
     * Delete a user from the table
     *
     * @param string $username
     * @return void
     */
    public function deleteUser($username)
    {
        if ($this->getUserRole($username) !== "admin") {
            $this->db->connect();
            $sql = "DELETE FROM $this->table WHERE username = ?;";

            $this->db->execute($sql, [$username]);
        }
    }
}
