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
            case 'intro-text':
                return $this->introText($request);
            case 'summarizer':
                return $this->summarizer($request);
            case 'rephraser':
                return $this->rephraser($request);
            case 'grammar-check':
                return $this->grammarCheck($request);
            case 'copywriting':
                return $this->copywriting($request);
            case 'product-headlines':
                return $this->productHeadlines($request);
            case 'product-description':
                return $this->productDescription($request);
            case 'category-description':
                return $this->categoryDescription($request);
            case 'call-to-action':
                return $this->callToAction($request);
            default:
                abort(404, 'Tool not found');
        }
    }

    protected function ideaGenerator(Request $request)
    {
        $request->validate([
            'topics' => 'required|string|max:200',
            'amount' => 'sometimes|numeric|min:1|max:10|nullable',
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
            'amount' => 'sometimes|numeric|min:5|max:25|nullable',
        ]);

        $prompt = <<<EOT
        Create an article outline based on this summary:
        "{$request->input('summary')}"

        The outline should be {$request->input('amount', 5)} points long.
        Article outline:
        EOT;

        return $this->completion($prompt);
    }

    protected function introText(Request $request)
    {
        $request->validate([
            'headline' => 'required|string|max:200',
        ]);

        $prompt = <<<EOT
        Create a compelling intro text under the headline:
        "{$request->input('headline')}"

        Intro text:
        EOT;

        return $this->completion($prompt);
    }

    protected function summarizer(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:10000',
            'level' => 'sometimes|string|nullable',
        ]);

        $level = $request->input('level') ? 'Summarize it to the level of a' . $request->input('level') : '';

        $prompt = <<<EOT
        Summarize the following text:
        "{$request->input('text')}"

        {$level}

        Summary:
        EOT;

        return $this->completion($prompt);
    }

    protected function rephraser(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:10000',
            'tone' => 'sometimes|string|nullable',
            'audience' => 'sometimes|string|nullable',
            'keywords' => 'sometimes|string|nullable',
            'expand' => 'sometimes|boolean|nullable',
        ]);

        $tone = $request->input('tone', false) ? 'Rephrase it in a ' . $request->input('tone') . ' tone.' : '';
        $audience = $request->input('audience', false) ? 'Rephrase it to fit a ' . $request->input('audience') . ' audience.' : '';
        $keywords = $request->input('keywords', false) ? 'Rephrase it to include the keywords: ' . $request->input('keywords') : '';
        $expand = $request->input('expand', false) ? 'Expand it to include more information.' : '';

        $prompt = <<<EOT
        Rephrase the following text:
        "{$request->input('text')}"

        {$tone}
        {$audience}
        {$keywords}
        {$expand}

        Rephrased text:
        EOT;

        return $this->completion($prompt);
    }

    protected function grammarCheck(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:10000',
            'fix' => 'sometimes|boolean|nullable',
        ]);

        $fix = $request->input('fix', false) ? 'Fix all the grammatical errors.' : 'Do not fix the errors, but point them out to me. Put an asterisk (*) next to each error.';

        $prompt = <<<EOT
        Please check the following text for grammatical errors:
        "{$request->input('text')}"

        {$fix}

        Checked text:
        EOT;

        return $this->completion($prompt);
    }

    protected function copywriting(Request $request)
    {
        $request->validate([
            'formula' => 'required|string|in:4C,AIDA,FAB,PAS,PPPP,QUEST',
            'audience' => 'required|string',
            'product_title' => 'required|string',
            'product_description' => 'required|string',
        ]);

        $prompt = <<<EOT
        Write a SEO optimized copy that converts for a new product.

        Use the {$request->input('formula')} copywriting formula to write the copy.
        The audience is {$request->input('audience')}.
        The product title is {$request->input('product_title')}.
        The product description is {$request->input('product_description')}.

        Copy:
        EOT;

        return $this->completion($prompt);
    }

    protected function productHeadlines(Request $request)
    {
        $request->validate([
            'audience' => 'required|string',
            'tone' => 'required|string',
            'product_title' => 'required|string',
            'product_description' => 'required|string',
            'amount' => 'numeric|nullable',
        ]);

        $prompt = <<<EOT
        Write some SEO optimized product headlines that stands out.

        The audience is {$request->input('audience')}.
        The tone is {$request->input('tone')}.
        The product title is {$request->input('product_title')}.
        The product description is {$request->input('product_description')}.

        Here is {$request->input('amount', 5)} headlines:
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

    protected function categoryDescription(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'keyword' => 'required|string',
            'audience' => 'required|string',
            'business_name' => 'required|string',
            'business_description' => 'required|string',
        ]);

        $instructions = <<<EOT
        You are a marketing assistant.
        You will help generate a SEO optimized category description for a product category.
        I will provide you with the category name, audience, keyword, business name and business description.
        You will provide me with a new product category description only.
        EOT;

        $prompt = <<<EOT
        The category name is {$request->input('category')}.
        Include the keyword {$request->input('keyword')}.
        The audience is {$request->input('audience')}.
        The business name is {$request->input('business_name')}.
        The business description is {$request->input('business_description')}.
        Please write a great new product category description.
        EOT;

        return $this->chat($instructions, $prompt);
    }

    protected function callToAction(Request $request)
    {
        $request->validate([
            'audience' => 'required|string',
            'tone' => 'required|string',
            'product_title' => 'required|string',
            'product_description' => 'required|string',
        ]);

        $instructions = <<<EOT
        You are a marketing assistant.
        You will help generate a SEO optimized call-to-action text for a new product.
        I will provide you with the audience, tone, product title and description.
        You will provide me with a call-to-action.
        EOT;

        $prompt = <<<EOT
        The audience is {$request->input('audience')}.
        The tone should be {$request->input('tone')}.
        The product title is {$request->input('product_title')}.
        The product description is {$request->input('product_description')}.
        Please write a converting call-to-action.
        EOT;

        return $this->chat($instructions, $prompt);
    }
}
