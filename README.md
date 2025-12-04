Inventory System Management (Laravel)This project is a robust inventory management system built on the Laravel framework. It provides a web interface for standard CRUD operations (using Blade/Inertia/Livewire, etc., typical of a Laravel app) and a secure, token-authenticated REST API for product management.1. PrerequisitesEnsure your system meets the following requirements:PHP (8.1+)ComposerNode.js & NPM (for frontend assets, if applicable)MySQL/PostgreSQL databaseA basic understanding of the Laravel framework.2. Installation and SetupFollow these steps to get the application running locally:2.1. Clone the Repositorygit clone git@github.com:YourUsername/inventory-system.git
cd inventory-system
2.2. Install DependenciesInstall PHP dependencies via Composer and (if using assets like Vite/Mix) Node dependencies:composer install
npm install
npm run dev # Or npm run build
2.3. Environment ConfigurationCopy the example environment file:cp .env.example .env
Generate a unique application key:php artisan key:generate
Edit the .env file to configure your database connection (see section 3).2.4. Database MigrationSet up the database structure and seed initial data (if seeders exist):php artisan migrate --seed
3. Database and ModelsThe core functionality revolves around two main models: User, Product, and Category.Product Model: Stores product details (name, sku, price, quantity, status, description).Category Model: Stores category details (name, slug).Pivot Table: product_category (Many-to-Many relationship between Products and Categories).4. Security and AuthenticationThis application uses Laravel Breeze/Jetstream for session-based authentication for the web interface, and Laravel Sanctum for securing the API endpoints.API Token GenerationTo access the protected API, you must obtain a token for an existing user. There are two common methods:Method 1: Via API Login Endpoint (Recommended for Clients)This assumes you have a separate, unprotected login route that generates a token upon successful authentication.Request:| Method | URL || --- | --- || POST | http://127.0.0.1:8000/api/login |Headers: Accept: application/jsonBody (JSON):{
    "email": "test@example.com",
    "password": "password"
}
Successful Response:The response should return the user details and the plainTextToken.Method 2: Via Tinker Console (For Development/Testing)You can manually generate a token using the Laravel console:Access Laravel Tinker:php artisan tinker
Generate the token:>>> $user = App\Models\User::find(1); // Get the user you want to authorize
>>> $token = $user->createToken('inventory-api-token');
>>> echo $token->plainTextToken; // Copy this value!
Using the Token in API RequestsInclude the generated token in the Authorization header of every API request:KeyValueAuthorizationBearer <YOUR_GENERATED_TOKEN>5. REST API Endpoints (Protected)The product management API is fully secured and uses standard HTTP methods.MethodEndpointPurposeController ActionGET/api/userTest AuthConfirms token validity.GET/api/productsIndex (List)Retrieve paginated products.POST/api/productsStore (Create)Create a new product.GET/api/products/{id}Show (Retrieve)Retrieve a single product.PUT/PATCH/api/products/{id}UpdateUpdate an existing product.DELETE/api/products/{id}Destroy (Delete)Delete a specified product.POST /api/products Request/Response StructureRequired JSON Input Fields:| Field | Type | Required? | Notes || :--- | :--- | :--- | :--- || name | string | Yes | || sku | string | Yes | Must be unique. || price | numeric | Yes | Min 0.01. || quantity| integer | Yes | Min 0. || status | string | Yes | active or inactive. || category_ids| array | No | Array of existing category IDs. |Success Response Example (HTTP 201 Created):{
    "success": true,
    "message": "Product created successfully.",
    "data": {
        "id": 1,
        "name": "Smart Watch Series 7",
        "sku": "SW-S7-A1",
        "price": "499.00",
        "quantity": 150,
        /* ... other fields ... */
    }
}
6. Running TestsThis project uses PHPUnit for all testing. Tests are located in the /tests directory.Running All TestsTo execute all tests (Feature and Unit tests):php artisan test
# OR
./vendor/bin/phpunit
Running Specific TestsTo run tests from a specific directory or file:# Run all Feature tests
php artisan test --group=feature

# Run all tests in a specific file (e.g., ProductControllerTest)
php artisan test tests/Feature/ProductApiTest.php
Clearing Test DataRemember that Feature tests often interact with the database. To ensure a clean slate, it's recommended to use the RefreshDatabase trait in your test classes.
