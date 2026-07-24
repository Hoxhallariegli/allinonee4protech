# 🍎 E4ProTech Starterkit Laravel

The ultimate Laravel 12 & Livewire 3 starter kit, architected for scalability, speed, and a premium Apple-style user experience. This template is designed to automate the heavy lifting while following **Enterprise Best Practices (DDD, Actions, DTOs)**.

## 🚀 Key Features

- **Architectural Excellence**: Implements Domain-Driven Design (DDD) patterns.
- **Layered Logic**: Separation of concerns using **Actions**, **DTOs**, and **Dedicated Queries**.
- **Centralized Validation**: All business rules are defined once in the Model and shared across the UI.
- **Apple UI/UX**: Ultra-minimalist design, responsive grids, and full **Dark Mode** support.
- **Smart Data Components**: 
    - **Searchable Dropdowns**: Native `x-form.dropdown-search` for handling large datasets.
    - **Sortable Headers**: Dynamic table column sorting with visual feedback.
    - **Create-on-the-fly**: Create related records directly from dropdowns.
- **One-Command Scaffolding**: Generate a full feature in seconds.

---

## 🛠️ How to Generate a New Module

To create a new CRUD feature with full architecture, run:

```bash
php artisan new:view {ModelName}
```

### What happens behind the scenes?

When you run this command, the system automatically generates:

1.  **Domain Layer** (`app/Domain/{Model}`):
    - `Actions/`: Logic for Creating, Updating, and Deleting.
    - `DTOs/`: Data Transfer Objects for safe data handling.
    - `Queries/`: Dedicated list queries with built-in filtering, searching, and eager loading.
2.  **Infrastructure Layer**:
    - **Migration**: Schema with correct types (Enum, Date, ForeignId, etc.).
    - **Model**: Centralized `rules()`, `sortable()` fields, and Relationships.
3.  **UI Layer** (`app/Livewire/Admin` & `resources/views/livewire`):
    - **Index**: Data table with Pagination, Sortable Headers, and Filters.
    - **Create/Edit**: Beautifully spaced forms with smart inputs.
    - **Row**: Modular table rows.
4.  **Security & Ecosystem**:
    - Registers **Permissions** in the database.
    - Adds **Translations** to `en.json`.
    - Generates **Modular Routes** in `routes/admin/`.
    - Injects a new link into the **Navigation** sidebar.

---

## 🏗️ Architecture Breakdown

### 1. Centralized Rules (Model)
Instead of repeating validation in Controllers, we define it in the Model:
```php
public static function rules($id = null): array {
    return [
        'name' => ['required', 'string'],
        'price' => ['required', 'numeric'],
    ];
}
```

### 2. Actions & DTOs
Livewire components never touch the database directly. They pass data through DTOs to Actions:
```php
public function store(CreateProductAction $action) {
    $this->validate();
    $dto = ProductDTO::fromArray($this->all());
    $action->execute($dto);
}
```

### 3. Separate Queries
Tired of messy `where` clauses in Livewire? All filtering logic lives in a dedicated Query class:
```php
$query = (new ProductListQuery())->handle($params, $sortField, $sortAsc);
```

---

## 🎨 UI Components

| Component | Description |
| :--- | :--- |
| `<x-table.th>` | High-contrast sortable headers with blue visual cues. |
| `<x-form.dropdown-search>` | Stable Alpine.js dropdown for high-performance searching. |
| `<x-form.input>` | Smart inputs that adapt to `date`, `number`, and `text` types. |
| `<x-btn>` | Apple-style action buttons with Heroicon support. |

---

## 📦 Deployment & Git
This starter kit is optimized for production. 
1.  Push to Git.
2.  Run `composer install`.
3.  Run `php artisan migrate`.

Developed by **E4ProTech**. Empowering developers to build professional Laravel apps at the speed of thought. 🚀
