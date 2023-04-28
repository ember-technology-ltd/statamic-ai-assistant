# Statamic AI Assistant

![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jezzdk/statamic-ai-assistant.svg?style=for-the-badge)](https://packagist.org/packages/jezzdk/statamic-ai-assistant)

A personal assistant for Statamic, powered by artificial intelligence.

> You will need an OpenAI developer account if you want to use this addon.

> You can use this addon without access to GPT-4!

## Features

This addon does:

- Idea generation
- Outlining
- Summarizing
- Rephrasing
- And more...

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require jezzdk/statamic-ai-assistant
```

After installing the addon, you can publish the config file:

```
php artisan vendor:publish --provider="Jezzdk\StatamicAiAssistant\ServiceProvider" --tag config
```

Add this environment variable, since this library uses [OpenAI](https://www.openai.com/) under the hood.

```
OPENAI_API_KEY=sk-...
```

You can also add your organization if needed:

```
OPENAI_ORGANIZATION=...
```

## How to Use

This addon inserts a button on the right side of the control panel. The button is visible at all times while logged in. Clicking the button opens a panel where you have a choice of several AI-backed tools for impriving your workflow.

After running a tool, which generates some text for use on your website, you can easily copy the result to the clipboard and insert it anywhere you wish.

## Disclaimer

The generated text is for inspiration only and should not be used as is. It is your responsibility to ensure that the generated text is in compliance with your local laws and regulations.
