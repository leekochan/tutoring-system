<?php

namespace App\Services;

use App\Models\Lesson;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    private $openAIApiKey;
    private $caPath;

    public function __construct()
    {
        $this->openAIApiKey = config('services.openai.api_key');

        // Attempt to find the CA certificate path
        $this->caPath = $this->findCACertPath();
    }

    /**
     * Find the CA certificate path
     */
    private function findCACertPath(): ?string
    {
        $possiblePaths = [
            ini_get('curl.cainfo'),
            ini_get('openssl.cafile'),
            storage_path('cacert.pem'),
            public_path('cacert.pem'),
            'C:\php\cacert.pem',
            '/etc/ssl/certs/ca-certificates.crt',
            '/usr/local/etc/openssl/cert.pem'
        ];

        foreach ($possiblePaths as $path) {
            if ($path && file_exists($path)) {
                Log::info("CA Certificate found: " . $path);
                return $path;
            }
        }

        Log::warning("No CA certificate found. Falling back to system default.");
        return null;
    }

    /**
     * Perform advanced semantic search using OpenAI's embeddings
     */
    public function searchLessons(string $query)
    {
        // Log the search query for debugging
        Log::info("Semantic Search Query: " . $query);

        try {
            // Generate embedding for the search query
            $queryEmbedding = $this->generateEmbedding($query);

            // Fetch all lessons and calculate semantic similarity
            $lessons = Lesson::with('tutor')->get()->map(function ($lesson) use ($queryEmbedding) {
                try {
                    // Create comprehensive lesson text for embedding comparison
                    $lessonText = implode(' ', [
                        $lesson->title,
                        $lesson->description,
                        $lesson->topics,
                        $lesson->tutor->name ?? ''
                    ]);

                    $lessonEmbedding = $this->generateEmbedding($lessonText);

                    // Calculate cosine similarity
                    $similarity = $this->cosineSimilarity($queryEmbedding, $lessonEmbedding);

                    $lesson->similarity = $similarity;
                    return $lesson;
                } catch (Exception $e) {
                    // Log individual lesson embedding errors
                    Log::error("Lesson Embedding Error for Lesson ID {$lesson->id}: " . $e->getMessage());
                    return null;
                }
            })
                // Remove any null values from failed embeddings
                ->filter()
                // Filter out very low similarity scores
                ->filter(function ($lesson) {
                    return $lesson->similarity > 0.3; // Lowered threshold for more results
                })
                // Sort by similarity in descending order
                ->sortByDesc('similarity')
                ->take(5);

            // Log the number of lessons found
            Log::info("Semantic Search Results: " . $lessons->count() . " lessons");

            return $lessons;
        } catch (Exception $e) {
            // Log detailed error information
            Log::error('Semantic Search Error: ' . $e->getMessage(), [
                'query' => $query,
                'trace' => $e->getTraceAsString()
            ]);

            // Fallback to traditional search if AI service fails
            $fallbackLessons = Lesson::where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->orWhere('topics', 'LIKE', '%' . $query . '%')
                ->take(5)
                ->get();

            Log::info("Fallback Search Results: " . $fallbackLessons->count() . " lessons");

            return $fallbackLessons;
        }
    }

    /**
     * Generate embedding for a given text using OpenAI
     * @throws Exception
     */
    private function generateEmbedding(string $text): array
    {
        // Truncate text if it's too long
        $text = substr($text, 0, 8192);

        // Prepare HTTP client with SSL options
        $httpOptions = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->openAIApiKey,
                'Content-Type' => 'application/json'
            ]
        ];

        // Add SSL verification if CA path is found
        if ($this->caPath) {
            $httpOptions['verify'] = $this->caPath;
        }

        // Perform the API request
        $response = Http::withOptions($httpOptions)
            ->post('https://api.openai.com/v1/embeddings', [
                'model' => 'text-embedding-ada-002',
                'input' => $text
            ]);

        // Check response and handle potential errors
        if ($response->successful()) {
            return $response->json('data.0.embedding');
        }

        // Log detailed error information
        Log::error('OpenAI Embedding API Error', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        throw new Exception('Failed to generate embedding: ' . $response->body());
    }

    /**
     * Calculate cosine similarity between two vectors
     */
    private function cosineSimilarity(array $vec1, array $vec2): float
    {
        // Ensure vectors are of equal length
        $length = min(count($vec1), count($vec2));

        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        for ($i = 0; $i < $length; $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $normA += $vec1[$i] * $vec1[$i];
            $normB += $vec2[$i] * $vec2[$i];
        }

        // Prevent division by zero
        if ($normA == 0 || $normB == 0) {
            return 0;
        }

        return $dotProduct / (sqrt($normA) * sqrt($normB));
    }

    /**
     * Test OpenAI API connection
     */
    public function testConnection()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openAIApiKey,
                'Content-Type' => 'application/json'
            ])->withOptions($this->caPath ? ['verify' => $this->caPath] : [])
                ->post('https://api.openai.com/v1/embeddings', [
                    'model' => 'text-embedding-ada-002',
                    'input' => 'Connection Test'
                ]);

            return $response->successful();
        } catch (Exception $e) {
            Log::error('OpenAI Connection Test Failed: ' . $e->getMessage());
            return false;
        }
    }

    public function getCaPath()
    {
        return "C:\php\cacert.pem";
    }
}
