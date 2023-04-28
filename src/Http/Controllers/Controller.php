<?php

namespace Jezzdk\StatamicAiAssistant\Http\Controllers;

use OpenAI;
use OpenAI\Client;
use OpenAI\Exceptions\ErrorException;

class Controller
{
    protected function chat(string $instructions, string $prompt): string
    {
        $result = $this->client()->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $instructions,
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
        ]);

        if (empty($result->choices)) {
            throw new ErrorException([
                'message' => 'The result contains no choices',
                'type' => 'choices',
                'code' => 500,
            ]);
        }

        return $result->choices[0]->message->content;
    }

    protected function completion(string $prompt): string
    {
        $result = $this->client()->completions()->create([
            'model' => 'gpt-3',
            'prompt' => $prompt,
        ]);

        if (empty($result->choices)) {
            throw new ErrorException([
                'message' => 'The result contains no choices',
                'type' => 'choices',
                'code' => 500,
            ]);
        }

        return $result->choices[0]->text;
    }

    protected function client(): Client
    {
        ini_set('default_socket_timeout', 300);

        return OpenAI::client(config('ai-assistant.openai_api_key'));
    }
}
