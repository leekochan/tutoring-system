
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
<title>{{ 'TutorLink' }}</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<style>
    .sidebar-transition {
        transition: transform 0.5s ease-in-out;
    }
    .content-transition {
        transition: margin-left 0.5s ease-in-out;
    }
    .sidebar {
        top: 4rem;
        height: calc(100vh - 4rem);
        width: 16rem;
        transform: translateX(0); /* Ensure sidebar is always visible */
    }
    .content-with-sidebar {
        margin-left: 16rem; /* Match sidebar width to keep content shifted */
    }
</style>
