# Inventory System Management (Laravel)

This project is a robust inventory management system built on the Laravel framework. It provides a web interface for standard CRUD operations (using Blade/Inertia/Livewire, etc., typical of a Laravel app) and a secure, token-authenticated REST API for product management.

## 1. Prerequisites

Ensure your system meets the following requirements:

* PHP (8.1+)

* Composer

* Node.js & NPM (for frontend assets, if applicable)

* MySQL/PostgreSQL database

* A basic understanding of the Laravel framework.

## 2. Installation and Setup

Follow these steps to get the application running locally:

### 2.1. Clone the Repository

```

git clone git@github.com:YourUsername/inventory-system.git
cd inventory-system

```

### 2.2. Install Dependencies

Install PHP dependencies via Composer and (if using assets like Vite/Mix) Node dependencies:

```

composer install
npm install
npm run dev \# Or npm run build

```
open new terminal and 

```
php artisan serve
```

### 2.3. Environment Configuration

1. Copy the example environment file:

```

cp .env.example .env

```

2. Generate a unique application key:

```

php artisan key:generate

```

3. Edit the `.env` file to configure your database connection (see section 3).

### 2.4. Database Migration

Set up the database structure and seed initial data (if seeders exist):

```

php artisan migrate --seed

```

## 3. Database and Models

The core functionality revolves around two main models: `User`, `Product`, and `Category`.

* **Product Model:** Stores product details (`name`, `sku`, `price`, `quantity`, `status`, `description`).

* **Category Model:** Stores category details (`name`, `slug`).

* **Pivot Table:** `product_category` (Many-to-Many relationship between Products and Categories).

## 4. Security and Authentication

This application uses Laravel Breeze/Jetstream for session-based authentication for the web interface, and **Laravel Sanctum** for securing the API endpoints.

### API Token Generation

To access the protected API, you must obtain a token for an existing user. There are two common methods:

#### Method 1: Via API Login Endpoint (Recommended for Clients)

This assumes you have a separate, unprotected login route that generates a token upon successful authentication.

**Request:**
| Method | URL |
| --- | --- |
| `POST` | `http://127.0.0.1:8000/api/login` |

**Headers:** `Accept: application/json`

**Body (JSON):**

```

{
"email": "test@example.com",
"password": "password"
}

```

**Successful Response:**
The response should return the user details and the `plainTextToken`.

#### Method 2: Via Tinker Console (For Development/Testing)

You can manually generate a token using the Laravel console:

1. Access Laravel Tinker:

```

php artisan tinker

```

2. Generate the token:

```

> > > $user = App\\Models\\User::find(1); // Get the user you want to authorize
> > > $token = $user-\>createToken('inventory-api-token');
> > > echo $token-\>plainTextToken; // Copy this value\!

```

### Using the Token in API Requests

Include the generated token in the `Authorization` header of every API request:

| 

| **Key** | **Value** | 
| `Authorization` | `Bearer <YOUR_GENERATED_TOKEN>` | 

## 5. REST API Endpoints (Protected)

The product management API is fully secured and uses standard HTTP methods.

| **Method** | **Endpoint** | **Purpose** | **Controller Action** | 
| `GET` | `/api/user` | **Test Auth** | Confirms token validity. | 
| `GET` | `/api/products` | **Index** (List) | Retrieve paginated products. | 
| `POST` | `/api/products` | **Store** (Create) | Create a new product. | 
| `GET` | `/api/products/{id}` | **Show** (Retrieve) | Retrieve a single product. | 
| `PUT/PATCH` | `/api/products/{id}` | **Update** | Update an existing product. | 
| `DELETE` | `/api/products/{id}` | **Destroy** (Delete) | Delete a specified product. | 

### POST /api/products Request/Response Structure

**Required JSON Input Fields:**
| Field | Type | Required? | Notes |
| :--- | :--- | :--- | :--- |
| `name` | string | Yes | |
| `sku` | string | Yes | Must be unique. |
| `price` | numeric | Yes | Min `0.01`. |
| `quantity`| integer | Yes | Min `0`. |
| `status` | string | Yes | `active` or `inactive`. |
| `category_ids`| array | No | Array of existing category IDs. |

**Success Response Example (HTTP 201 Created):**

```

{
"success": true,
"message": "Product created successfully.",
"data": {
"id": 1,
"name": "Smart Watch Series 7",
"sku": "SW-S7-A1",
"price": "499.00",
"quantity": 150,
/\* ... other fields ... \*/
}
}

```
