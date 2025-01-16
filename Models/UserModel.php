<?php

class UserModel
{
    private $conn;
    private int $id = 0;
    private string $firstname = "";
    private string $lastname = "";
    private string $password = "";
    private string $email = "";
    private string $phone = "";
    private string $photo = "";
    private string $status = "";
    private ?RoleModel $role;
    private $courses = [];

    public function __construct()
    {
        $this->conn = (new Connection())->connect();
        // $this->role = new RoleModel($this->conn);
    }


    public static function instanceWithFirstnameAndLastname(string $firstName, string $lastName)
    {
        $instance = new self();
        $instance->firstname = $firstName;
        $instance->lastname = $lastName;

        return $instance;
    }

    // login
    public static function instaceWithEmailAndPassword(string $email, string $password): self
    {
        $instance = new self();
        $instance->email = $email;
        $instance->password = $password;

        return $instance;
    }

    public static function instanceWithFirstnameAndLastnameAndEmail(string $firstname, string $lastname, string $email)
    {
        $instance = self::instanceWithFirstnameAndLastname($firstname, $lastname);

        $instance->email = $email;

        return $instance;
    }

    // register
    public static function instanceWithoutId(string $firstname, string $lastname, string $email, string $password, string $phone, string $photo, string $status, RoleModel $role, array $courses)
    {
        $instance = self::instanceWithFirstnameAndLastnameAndEmail($firstname, $lastname, $email);

        $instance->password = $password;
        $instance->phone = $phone;
        $instance->photo = $photo;
        $instance->status = $status;
        $instance->role = $role;
        $instance->courses = $courses;

        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getRole(): RoleModel
    {
        return $this->role;
    }

    public function setRole(RoleModel $role): void
    {
        $this->role = $role;
    }

    public function getCourses(): array
    {
        return $this->courses;
    }

    public function setCourses(array $courses): void
    {
        $this->courses = $courses;
    }

    public function toStringWithFirstnameAndLastname()
    {
        return "(Utilisateur) => id : " . $this->id . " , firstname : " . $this->firstname . " , lastname : " . $this->lastname;
    }

    public function __toString()
    {
        return $this->toStringWithFirstnameAndLastname() .
            " , phone : " . $this->phone . " , email : " . $this->email  . " , password : " . $this->password . " photo : " . $this->photo . " , Role : " . $this->role . " , courses : [" . implode(",", $this->courses) . "]";
    }


    public function insertUser(UserModel $user)
    {
        // die($user);
        $query = "INSERT INTO users (firstname, lastname, email, password, photo, phone, status, role_id ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhoto(),
            $user->getPhone(),
            $user->getStatus(),
            $user->getRole()->getId()
        ]);
    }
}
