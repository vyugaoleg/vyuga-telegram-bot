<?php

$BOT_TOKEN = getenv('BOT_TOKEN');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo "BOT IS READY";
    exit;
}

if (isset($data['message'])) {
    $chat_id = $data['message']['chat']['id'];
    $username = $data['message']['from']['username'] ?? '';
    $first_name = $data['message']['from']['first_name'] ?? '';

    $text = "Твой Telegram ID: " . $chat_id . "\n";
    $text .= "Username: @" . $username . "\n";
    $text .= "Имя: " . $first_name;

    file_get_contents(
        "https://api.telegram.org/bot" . $BOT_TOKEN . "/sendMessage?" .
        http_build_query([
            'chat_id' => $chat_id,
            'text' => $text
        ])
    );
}

echo "OK";
