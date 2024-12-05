<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
    <title>TutorLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-gray-50">

<?php
// Hero Section
echo '
<div class="bg-white pb-16 h-[100vh]">
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="mx-auto max-w-2xl py-24 lg:py-32">
            <div class="text-center">
                <h1 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    Welcome to TutorLink
                </h1>
                <p class="mt-8 text-lg leading-relaxed text-gray-600">
                    Connecting SKSU students with peer tutors for academic excellence.
                </p>
                <div class="mt-12 flex justify-center gap-x-6">
                    <a href="/login" class="rounded-md bg-green-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-green-500">
                        Login
                    </a>
                    <a href="/register" class="text-base font-semibold text-gray-900 border-2 border-green-600 rounded-md px-6 py-3 hover:bg-white hover:text-green-600 transition duration-500">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
';

// Features Section
echo '
<div class="bg-gray-100 py-28">
    <div class="mx-auto max-w-7xl px-8 lg:px-12">
        <div class="lg:text-center">
            <h2 class="text-base font-semibold text-green-600">Learn Better</h2>
            <p class="mt-6 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Everything you need to excel in your studies
            </p>
        </div>
        <div class="mt-20 grid grid-cols-1 gap-y-16 gap-x-12 lg:grid-cols-3">
            <div class="flex flex-col items-center text-center lg:items-start lg:text-left">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-lg bg-green-600">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Peer Tutoring</h3>
                <p class="mt-4 text-sm leading-7 text-gray-600">Connect with experienced peer tutors who understand your academic challenges.</p>
            </div>
            <div class="flex flex-col items-center text-center lg:items-start lg:text-left">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-lg bg-green-600">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Flexible Scheduling</h3>
                <p class="mt-4 text-sm leading-7 text-gray-600">Book tutoring sessions that fit your schedule and learning pace.</p>
            </div>
            <div class="flex flex-col items-center text-center lg:items-start lg:text-left">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-lg bg-green-600">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Track Progress</h3>
                <p class="mt-4 text-sm leading-7 text-gray-600">Monitor your academic improvement and get personalized feedback.</p>
            </div>
        </div>
    </div>
</div>
';

// CTA Section
echo '
<div class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-8 lg:px-12">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center">
            Ready to boost your academic performance? Join TutorLink today.
        </h2>
        <div class="mt-12 flex justify-center gap-x-6">
            <a href="/login" class="rounded-md bg-green-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-green-500">
                Get started
            </a>
           <a href="/register" class="text-base font-semibold text-gray-900 border-2 border-green-600 rounded-md px-6 py-3 hover:bg-white hover:text-green-600 transition duration-500">
                Register Now
            </a>
        </div>
    </div>
</div>
';

// Footer
echo '
<footer class="bg-green-600 py-10">
    <div class="mx-auto max-w-7xl px-6 text-center">
        <p class="text-sm text-white">
            © 2024 TutorLink, SKSU. All rights reserved.
        </p>
        <p class="mt-3 text-sm text-white">Connect with us on social media</p>
    </div>
</footer>
';
?>

</body>
</html>
