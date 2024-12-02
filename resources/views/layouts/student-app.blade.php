<!doctype html>
<html lang="en">
<head>
    @include('components.student.head')
</head>
<body class="h-full">
@include('components.student.nav')
@include('components.student.sidebar')

<!-- Main Content Area -->
<main id="main-content" class="content-transition pt-16 ml-0 border-l border-gray-300">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</main>

@include('components.student.scripts')
</body>
</html>
