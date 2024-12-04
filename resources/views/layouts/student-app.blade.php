<!doctype html>
<html lang="en">
<head>
    @include('components.student.head')
</head>
<body class="h-full">
<div class="min-h-screen bg-white">
    @include('components.student.nav')

    <!-- Main Content Area -->
    <main id="main-content" class="content-transition pt-16 ml-0 border-l border-gray-300">
        <div class="py-6 px-4 pt-0 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    @include('components.student.scripts')
</div>
</body>
</html>
