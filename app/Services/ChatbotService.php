<?php

namespace App\Services;

use OpenAI\Factory;

class ChatbotService
{
    /**
     * Create a new class instance.
     */

    protected $client;
    public function __construct()
    {
        $this->client = (new Factory())
            ->withApiKey(env('OPENAI_API_KEY'))
            ->make();
            
    }

    public function generateReply($text)
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Kamu chatbot ramah yang membalas postingan mengenai seni. Jawab maksimal 100 kata'],
                ['role' => 'user', 'content' => $text],
            ],
            'max_tokens' => 150,
        ]);

        return $response['choices'][0]['message']['content'] ?? null;
    }
}
