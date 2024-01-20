<?php
ob_start();

use Faker\Factory;
use App\Models\Db;
use App\Models\Auth;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $db;
    private $auth;
    private $faker;

    protected function setUp(): void
    {
        // Set up a test database or any other necessary preparations
        $this->db = new Db(true); // true indicates using SQLite for testing
        $this->db->createTables(); // Automatically create tables on instantiation
        $this->faker = Factory::create(); // Initialize Faker
        $this->auth = new Auth($this->db); // Initialize Auth 
    }

    public function testRegisterUser(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $address = $this->faker->address;
        $password = $this->faker->password;
        $type = $this->faker->randomElement(['buyer', 'farmer']);

        $user = $this->auth->registerUser($name, $email, $address, $type, $password);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($type, $user->type);
    }

    public function testLoginUser(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $address = $this->faker->address;
        $password = $this->faker->password;
        $type = $this->faker->randomElement(['buyer', 'farmer']);

        $this->auth->registerUser($name, $email, $address, $type, $password);


        $loggedInUser = $this->auth->loginUser($email, $password);

        $this->assertEquals($name, $loggedInUser->name);
        $this->assertEquals($type, $loggedInUser->type);
        $this->assertEquals($email, $loggedInUser->email);
        $this->assertTrue($this->auth->isAuthenticated());
        $this->assertInstanceOf(User::class, $loggedInUser);
        $this->assertTrue($this->auth->amIthisUser($loggedInUser->id));
    }

    // Add more test methods for other Auth class functions...

    protected function tearDown(): void
    {
        ob_end_clean();
        // Clean up any resources or database entries after each test
        unlink(__DIR__ . '/../' . $_ENV['DB_NAME'] . '_test.db'); // Replace with the actual path to your SQLite database file
    }
}
