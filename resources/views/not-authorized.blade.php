<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Authorized</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white dark:bg-gray-800 rounded shadow p-8">
            <h1 class="text-4xl font-bold text-red-500 dark:text-yellow-500 mb-4">Not Authorized</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-8">Sorry, you are not authorized to access this page.</p>
            <a href="{{ route('dashboard') }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Go Back</a>
        </div>
    </div>
</body>
</html>
