<?php

namespace Jezzdk\StatamicAiFields\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function description(Request $request)
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
