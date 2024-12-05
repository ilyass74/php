<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AcademicXchange</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100">
    <div id="app" class="container mx-auto px-4">
     
        <nav class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-blue-600">AcademicXchange</h1>
                <div class="ml-6 space-x-4">
                    <a href="#" class="text-gray-700 hover:text-blue-600">Explore</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Publications</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Collaborate</a>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <input 
                    type="text" 
                    placeholder="Search researchers, papers..." 
                    class="px-3 py-2 border rounded-lg"
                >
                <button 
                    @click="openLoginModal"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                >
                    Login
                </button>
            </div>
        </nav>

       
        <div class="grid grid-cols-4 gap-6 mt-8">
        
            <div class="col-span-1 bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Recommended Researchers</h2>
                <div 
                    v-for="researcher in recommendedResearchers" 
                    :key="researcher.id"
                    class="flex items-center mb-3 p-2 hover:bg-gray-100 rounded"
                >
                    <img 
                        :src="researcher.avatar" 
                        class="w-12 h-12 rounded-full mr-3"
                    >
                    <div>
                        <h3 class="font-medium">Dr. Chakir Ilyass</h3>
                        <p class="text-sm text-gray-500">
                            {{ researcher.department }}
                        </p>
                    </div>
                    <button 
                        class="ml-auto bg-blue-500 text-white px-2 py-1 rounded text-xs"
                    >
                        Connect
                    </button>
                </div>
            </div>

        
            <div class="col-span-2 space-y-4">
           
                <div class="bg-white p-4 rounded-lg shadow">
                    <textarea 
                        placeholder="Share your research insights..."
                        class="w-full p-2 border rounded-lg mb-3"
                    ></textarea>
                    <div class="flex justify-between">
                        <div class="space-x-2">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
                                Upload Paper
                            </button>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                                Post
                            </button>
                        </div>
                    </div>
                </div>

      
                <div 
                    v-for="post in researchPosts" 
                    :key="post.id"
                    class="bg-white p-4 rounded-lg shadow"
                >
                    <div class="flex items-center mb-3">
                        <img 
                            :src="post.author.avatar" 
                            class="w-10 h-10 rounded-full mr-3"
                        >
                        <div>
                            <h3 class="font-medium">{{ post.author.name }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ post.timestamp }}
                            </p>
                        </div>
                    </div>
                    <h2 class="text-lg font-semibold mb-2">
                        {{ post.title }}
                    </h2>
                    <p class="text-gray-700 mb-3">
                        {{ post.content }}
                    </p>
                    <div class="flex justify-between text-gray-600">
                        <button>👏 {{ post.likes }} Likes</button>
                        <button>💬 {{ post.comments }} Comments</button>
                        <button>🔬 Cite</button>
                    </div>
                </div>
            </div>

       
            <div class="col-span-1 bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Trending Research</h2>
                <ul class="space-y-3">
                    <li 
                        v-for="trend in trendingResearch" 
                        :key="trend.id"
                        class="border-b pb-2 last:border-b-0"
                    >
                        <h3 class="font-medium">{{ trend.title }}</h3>
                        <p class="text-sm text-gray-500">
                            {{ trend.field }} • {{ trend.citations }} Citations
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
    new Vue({
        el: '#app',
        data: {
            recommendedResearchers: [
                {
                    id: 1,
                    name: 'Dr. Elena Rodriguez',
                    department: 'AI & Machine Learning',
                    avatar: '/placeholder/researcher1.jpg'
                },
               
            ],
            researchPosts: [
                {
                    id: 1,
                    title: 'Quantum Computing Breakthroughs',
                    content: 'Recent advances in quantum entanglement...',
                    likes: 42,
                    comments: 12,
                    timestamp: '2 hours ago',
                    author: {
                        name: 'Prof. Michael Chen',
                        avatar: '/placeholder/author1.jpg'
                    }
                },
           
            ],
            trendingResearch: [
                {
                    id: 1,
                    title: 'Climate Change Modeling',
                    field: 'Environmental Science',
                    citations: 258
                },
              
            ]
        },
        methods: {
            openLoginModal() {
             
            }
        }
    });
    </script>
</body>
</html>
<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'research_admin');
define('DB_PASS', 'secure_password');
define('DB_NAME', 'research_network');

class Database {
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, 
                DB_USER, 
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            throw new Exception("Database connection failed");
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class User {
    private $db;
    private $conn;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->conn = $db->getConnection();
    }

    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, password, created_at) 
            VALUES (:username, :email, :password, NOW())"
        );
        
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    public function authenticate($email, $password) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user && password_verify($password, $user['password']) 
            ? $user 
            : false;
    }
}


class Publication {
    private $db;
    private $conn;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->conn = $db->getConnection();
    }

    public function createPublication($userId, $title, $abstract, $file) {
        $stmt = $this->conn->prepare(
            "INSERT INTO publications 
            (user_id, title, abstract, file_path, published_at) 
            VALUES (:user_id, :title, :abstract, :file_path, NOW())"
        );
        
        return $stmt->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':abstract' => $abstract,
            ':file_path' => $file
        ]);
    }

    public function getPublicationsByUser($userId) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM publications 
            WHERE user_id = :user_id 
            ORDER BY published_at DESC"
        );
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


class AuthController {
    private $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function register($data) {
      
        $errors = [];
        
        if (empty($data['username'])) {
            $errors[] = "Username is required";
        }
        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address";
        }
        
        if (empty($data['password']) || strlen($data['password']) < 8) {
            $errors[] = "Password must be at least 8 characters";
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        try {
            $result = $this->userModel->register(
                $data['username'], 
                $data['email'], 
                $data['password']
            );
            
            return [
                'success' => $result,
                'message' => $result 
                    ? 'Registration successful' 
                    : 'Registration failed'
            ];
        } catch (Exception $e) {
            return [
                'success' => false, 
                'errors' => [$e->getMessage()]
            ];
        }
    }
}


class RecommendationEngine {
    private $conn;

    public function __construct(Database $db) {
        $this->conn = $db->getConnection();
    }

    public function getRecommendedResearchers($userId) {
      
        $stmt = $this->conn->prepare("
            SELECT u.id, u.username, u.research_interests
            FROM users u
            JOIN user_connections uc ON u.id != :user_id
            WHERE u.research_interests SIMILAR TO 
            (SELECT research_interests FROM users WHERE id = :user_id)
            LIMIT 5
        ");
        
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


class ResearchPlatform {
    private $db;
    private $authController;
    private $recommendationEngine;

    public function __construct() {
        $this->db = new Database();
        $userModel = new User($this->db);
        $this->authController = new AuthController($userModel);
        $this->recommendationEngine = new RecommendationEngine($this->db);
    }

    public function run() {
     
        $action = $_GET['action'] ?? 'home';
        
        switch($action) {
            case 'register':
                $result = $this->authController->register($_POST);
                $this->renderResponse($result);
                break;
            
            case 'recommendations':
                $recommendations = $this->recommendationEngine
                    ->getRecommendedResearchers($_SESSION['user_id']);
                $this->renderRecommendations($recommendations);
                break;
            
            default:
                $this->renderHomePage();
        }
    }
}

class SecurityMiddleware {
    public static function preventCSRF() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || 
                $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF Token Validation Failed');
            }
        }
    }

    public static function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }
}