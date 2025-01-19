<?php
#[\AllowDynamicProperties]

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
        if ($this->role === null) {
            $this->role = new RoleModel();
        }
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
    public function getAllUsers()
    {
        $this->conn = new Connection();
    
        $query = "SELECT users.id, users.firstname, users.lastname, users.email, users.password, users.phone, users.status, roles.id as role_id, roles.role_name as role_name, users.photo
                  FROM users
                  JOIN roles ON users.role_id = roles.id";
        $stmt = $this->conn->connect()->query($query);
    
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
        if (!empty($users)) {
            foreach ($users as &$user) {
                $role = new RoleModel();
                $role->setId($user['role_id']);
                $role->setRoleName($user['role_name']); 
                $user['role'] = $role;
            
                $userModel = new UserModel();
                $userModel->setId($user['id']);
                $userModel->setFirstname($user['firstname']);
                $userModel->setLastname($user['lastname']);
                $userModel->setEmail($user['email']);
                $userModel->setPhone($user['phone']);
                $userModel->setStatus($user['status']);
                $userModel->setPhoto($user['photo']);
                $userModel->setRole($role);  
                $userModel->setCourses([]);  
            
                $user = $userModel;
            }
            return $users;
        }
    }
    public function findByEmailAndPassword(UserModel $user)
    {
        $query = "SELECT id, firstname, lastname, email, phone, photo, role_id, password FROM users WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);

        $result = $stmt->fetchObject(__CLASS__);

        if (!$result) {
            echo "L'utilisateur n'existe pas";
            return false;
        }
        return $result;
    }

    
    // edit status

    public function ModifierStatus(string $status, int $userId)
    {
        $query = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }
    // delete user
    public function deleteUser($userId)
    {
        $existingUser = $this->getUserById($userId);
    
        if ($existingUser) {
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        
            if ($stmt->execute()) {
                echo "Utilisateur supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression de l'utilisateur.";
            }
        } else {
            echo "Utilisateur introuvable.";
        }
    }

    public function getUserById(int $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $role = new RoleModel();
            $role->setId($user['role_id']);
            $role->setRoleName($user['role_name']);
    
            $userModel = new UserModel();
            $userModel->setId($user['id']);
            $userModel->setFirstname($user['firstname']);
            $userModel->setLastname($user['lastname']);
            $userModel->setEmail($user['email']);
            $userModel->setPhone($user['phone']);
            $userModel->setStatus($user['status']);
            $userModel->setPhoto($user['photo']);
            $userModel->setRole($role);
    
            return $userModel;
        }
    
        return null;
    }
    
    
}
