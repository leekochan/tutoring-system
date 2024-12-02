<section class="grid-container">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .grid-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 15px;
            transition: transform 0.2s ease-in-out;
        }

        .grid-item:hover {
            transform: translateY(-5px);
        }

        .grid-item img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>

    @foreach ($team as $person)
        <div class="grid-item">
            <img src="{{ asset('images/1.jpeg') }}" alt="{{ $person['name'] }}">
            <h2 class="text-xl font-semibold mt-2">{{ $person['name'] }}</h2>
            <p class="text-gray-600">{{ $person['role'] }}</p>
            <button class="mt-3 bg-blue-500 text-white py-1 px-3 rounded">View</button>
            <button class="mt-3 bg-green-500 text-white py-1 px-3 rounded">Sessions</button>
        </div>
    @endforeach
</section>
