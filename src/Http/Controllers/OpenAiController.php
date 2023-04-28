<?php

namespace Jezzdk\StatamicAiAssistant\Http\Controllers;

use Illuminate\Http\Request;

class OpenAiController extends Controller
{
    public function __invoke(Request $request, string $tool)
    {
        switch ($tool) {
            case 'idea-generator':
                return $this->ideaGenerator($request);
            case 'outliner':
                return $this->outliner($request);
            case 'product-description':
                return $this->productDescription($request);
            default:
                abort(404, 'Tool not found');
        }
    }

    protected function ideaGenerator(Request $request)
    {
        $request->validate([
            'topics' => 'required|string|max:200',
            'amount' => 'numeric|min:1|max:10',
        ]);

        $prompt = <<<EOT
        Generate some ideas for an article that I have to write.
        The main topics to include are {$request->input('topics')}
        Generate {$request->input('amount', 5)} ideas with explanations for an exciting article.
        Example:
        1. Idea number one
        <explanation>

        2. Idea number two
        <explanation>

        Generated ideas:
        EOT;

        return $this->completion($prompt);
    }

    protected function outliner(Request $request)
    {
        $request->validate([
            'summary' => 'required|string|max:2000',
            'amount' => 'numeric|min:5|max:25',
        ]);

        $prompt = <<<EOT
        Create an article outline based on this summary:
        "{$request->input('summary')}"

        The outline should be {$request->input('amount', 5)} points long.
        Article outline:
        EOT;

        return $this->completion($prompt);
    }

    protected function productDescription(Request $request)
    {
        $request->validate([
            'audience' => 'required|string',
            'tone' => 'required|string',
            'product_title' => 'required|string',
            'product_description' => 'required|string',
            'max_words' => 'numeric|nullable',
        ]);

        $instructions = <<<EOT
        You are a marketing assistant.
        You will help generate a SEO optimized product description for a new product.
        I will provide you with the audience, tone, product title and description.
        You will provide me with a new product description only.
        EOT;

        $prompt = <<<EOT
        The audience is {$request->input('audience')}.
        The tone should be {$request->input('tone')}.
        The product title is {$request->input('product_title')}.
        The product description is {$request->input('product_description')}.
        Please write a new product description, with a maximum of {$request->input('max_words', 'unlimited')} words.
        EOT;

        return $this->chat($instructions, $prompt);
    }
}
