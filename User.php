<?php
class User {
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function displayInfo() {
        echo "<p>Name: $this->name</p>";
        echo "<p>Email: $this->email</p>";
    }

    public function updateInfo($newName, $newEmail) {
        $this->name = $newName;
        $this->email = $newEmail;
        echo "<p>User data updated successfully.</p>";
    }
}
?>
