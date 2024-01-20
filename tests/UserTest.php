<?php

use App\Models\Db;
use App\Models\User;
use App\Models\Auth;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $db;
    private $auth;
    private $user;
    private $party; // New user instance
    private $faker;

    protected function setUp(): void
    {
        //session_start();
        // Set up a test database or any other necessary preparations
        $this->db = new Db(true); // true indicates using SQLite for testing
        $this->db->createTables(); // Automatically create tables on instantiation
        $this->auth = new Auth($this->db);
        session_start();

        // Initialize Faker
        $this->faker = Factory::create();

        // Provide fake test data
        $userEmail = $this->faker->email;
        $userPswd = $this->faker->password;
        
        // Register a new user with fake data
        $this->auth->registerUser($this->faker->name, $userEmail, $this->faker->address, 'buyer', $userPswd);
            
        // Login user to create a new instance of the User class
        $this->user = $this->auth->loginUser($userEmail, $userPswd);

        $partyEmail = $this->faker->email;
        $partyPswd = $this->faker->password;

        // Register and Create a new instance of the User class for the party
        $this->party = $this->auth->registerUser($this->faker->name, $partyEmail, $this->faker->address, 'Seller', $partyPswd);
        
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertInstanceOf(User::class, $this->party);
    }

    public function testGetPublicKey(): void
    {
        $this->assertNotEmpty($this->user->getPublicKey());
        $this->assertNotEmpty($this->party->getPublicKey());
    }

    public function testGetPrivateKey(): void
    {
        $this->assertNotNull($this->user->getPrivateKey());
        $this->assertNull($this->party->getPrivateKey());
    }

    public function testSendMessage(): void
    {
        $message = $this->faker->sentence;
        $this->assertNotNull($this->user->sendMessage($this->party, $message));
    }

    public function testGetChats(): void
    {
        $this->assertIsArray($this->user->getChats($this->party));
    }

    public function testEncryptMessage(): void
    {
        $message = $this->faker->sentence;
        $encryptedMessage = $this->user->encryptMessage($this->party->getPublicKey(), $message);
        $this->assertNotEmpty($encryptedMessage);
    }

    public function testDecryptMessage(): void
    {
        $message = $this->faker->sentence;
        //echo "message : ".$message."\n\n";
        $encryptedMessage = $this->user->encryptMessage($this->party->getPublicKey(), $message);
        //echo "encrypted Message : ".$encryptedMessage."\n\n";
        $decryptedMessage = $this->user->decryptMessage($this->party->getPublicKey(), $encryptedMessage);
        //echo "decrypted Message : ".$decryptedMessage."\n\n";
        $this->assertEquals($message, $decryptedMessage);
    }

    public function testGetMyPosts(): void
    {
        $content = $this->faker->sentence;
        $this->user->createPost($content);
        $conn = $this->db->getConnection();
        $postId = $conn->lastInsertId();
        $myPost = $this->user->getPost($postId);
        $this->assertNotEmpty($myPost);
        $this->assertEquals($content, $myPost['content']);
    }

    public function testGetPosts(): void
    {
        $content = $this->faker->sentence;
        $this->party->createPost($content);
        $allPosts = $this->user->getPosts(null);
        $this->assertNotEmpty($allPosts);
        $this->assertEquals($content, $allPosts[0]->content);

        $postType = 'Seller';
        $typePosts = $this->user->getPosts($postType);
        $this->assertNotEmpty($typePosts);
        $this->assertEquals($postType, $typePosts[0]->post_type);
    }

    public function testGetPost(): void
    {
        $content = $this->faker->sentence;
        $postId = $this->user->createPost($content);
        $post = $this->user->getPost($postId);
        $this->assertNotNull($post);
        $this->assertEquals($content, $post['content']);
    }

    public function testCreatePost(): void
    {
        $content = $this->faker->sentence;
        $this->assertTrue($this->user->createPost($content));
    }

    public function testDeletePost(): void
    {
        $content = $this->faker->sentence;
        $this->user->createPost($content);
        $postId = $this->db->getConnection()->lastInsertId();
        $this->assertTrue($this->user->deletePost($postId));
        $this->assertFalse($this->user->getPost($postId));
    }

    protected function tearDown(): void
    {
        session_destroy();
        // Clean up any resources or database entries after each test
        unlink(__DIR__ . '/../' . $_ENV['DB_NAME'] . '_test.db'); // Replace with the actual path to your SQLite database file
    }
}
