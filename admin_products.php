<?php
include 'db.php';

// Fetch products from the admin_products table
$query = "SELECT * FROM admin_products ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubricon Admin - Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #1a365d;
            --secondary: #2c5282;
            --accent: #ed8936;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7fafc; }
        .sidebar { transition: all 0.3s ease; }
        .status-active { background-color: #dcfce7; color: #166534; }
        .status-discontinued { background-color: #fee2e2; color: #991b1b; }
        .dropdown:hover .dropdown-menu { display: block; }
        table.dataTable tbody tr { border-bottom: 1px solid #e5e7eb; }
        table.dataTable tbody tr:hover { background-color: #f9fafb; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="sidebar fixed inset-y-0 left-0 bg-[color:var(--primary)] text-white w-64 z-50">
        <div class="flex items-center justify-center h-16 px-4 border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/40x40" alt="Logo" class="rounded-full">
                <span class="text-xl font-bold">Lubricon Admin</span>
            </div>
        </div>
        
        <div class="overflow-y-auto h-full py-4">
            <nav>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[color:var(--secondary)]">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-white bg-[color:var(--secondary)]">
                    <i class="fas fa-oil-can mr-3"></i> Products
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[color:var(--secondary)]">
                    <i class="fas fa-shopping-cart mr-3"></i> Orders
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[color:var(--secondary)]">
                    <i class="fas fa-users mr-3"></i> Customers
                </a>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 overflow-auto ml-0 md:ml-64 transition-all duration-300">
        <div class="bg-white shadow-sm">
            <div class="flex items-center justify-between px-4 py-3">
                <h1 class="text-xl font-semibold">Product Management</h1>
            </div>
        </div>

        <div class="p-4 md:p-6">
        <!-- Action bar Start  -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div class="w-full md:w-auto">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" placeholder="Search products..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-[color:var(--accent)]">
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 w-full md:w-auto">
                        <div class="relative">
                            <select class="appearance-none bg-gray-100 border border-gray-300 rounded-md px-3 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--accent)]">
                                <option>All Categories</option>
                                <option>Synthetic Oil</option>
                                <option>Conventional Oil</option>
                                <option>High Mileage</option>
                                <option>Diesel Oil</option>
                                <option>Motorcycle Oil</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-3 text-xs text-gray-500"></i>
                        </div>
                        <div class="relative">
                            <select class="appearance-none bg-gray-100 border border-gray-300 rounded-md px-3 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--accent)]">
                                <option>All Status</option>
                                <option>Active</option>
                                <option>Discontinued</option>
                                <option>Backordered</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-3 text-xs text-gray-500"></i>
                        </div>
                        <button class="bg-[color:var(--primary)] text-white px-4 py-2 rounded-md hover:bg-[color:var(--secondary)] flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Add Product
                        </button>
                    </div>
                </div>
            <!-- Action bar End  -->
           

            <!-- Products table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="h-10 w-10 rounded-md">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['name']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($row['description']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['sku']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['category']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <span><?php echo intval($row['stock']); ?></span>
                                    <div class="ml-2 w-24 bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: <?php echo min(100, intval($row['stock'])); ?>%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                $<?php echo number_format($row['price'], 2); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo strtolower($row['status']) == 'active' ? 'status-active' : 'status-discontinued'; ?>">
                                    <?php echo htmlspecialchars($row['status']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <!-- Actions dropdown -->
                                <div class="dropdown relative inline-block">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        const button = dropdown.querySelector('button');
        button.addEventListener('click', () => {
            const menu = dropdown.querySelector('.dropdown-menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    });
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
</script>
</body>
</html>
