<?php
use Psr\Log\LogLevel;
return [
    "type" => "log",
    "config" => [
        [
            'name' => 'warnapp',
            'level' => 'all',
            'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
            'format' => null,
            'date_format' => 'd/m/Y H:i:s',
            'max_files' => 6,
            'channel' => 'warnapp',
            'file_perms' => 0777,
            "adapter" => "file"
        ],
//         [
//             'name' => 'errorapp',
//             'level' => LogLevel::ERROR,
//             'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
//             'format' => null, // "[%datetime%] %level_name% %message%\n",
//             'date_format' => 'd/m/Y H:i:s',
//             'max_files' => 3,
//             'channel' => 'warnapp',
//             'file_perms' => 0755,
//             "adapter" => "file"
//         ],
//         [
//             'name' => 'infoapp',
//             'level' => LogLevel::INFO,
//             'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
//             'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
//             'date_format' => 'd/m/Y H:i:s',
//             'max_files' => 10,
//             'channel' => 'warnapp',
//             'file_perms' => 0755,
//             "adapter" => "file"
//         ],
        [
            'name' => 'warndeafult',
            'level' => 'all',
            'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
            'format' => null,
            'date_format' => 'd/m/Y H:i:s',
            'max_files' => 6,
            'file_perms' => 0777,
            "adapter" => "file"
        ],
//         [
//             'name' => 'errordefault',
//             'level' => LogLevel::ERROR,
//             'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
//             'format' => null, // "[%datetime%] %level_name% %message%\n",
//             'date_format' => 'd/m/Y H:i:s',
//             'max_files' => 3,
//             'file_perms' => 0755,
//             "adapter" => "file"
//         ],
//         [
//             'name' => 'infodefault',
//             'level' => LogLevel::INFO,
//             'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
//             'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
//             'date_format' => 'd/m/Y H:i:s',
//             'max_files' => 10,
//             'file_perms' => 0755,
//             "adapter" => "file"
//         ],
//         [
//             'name' => 'error' . APP_NAME,
//             'level' => LogLevel::ERROR,
//             'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '_e2.txt',
//             'format' => null, // "[%datetime%] %level_name% %message%\n",
//             'date_format' => 'd/m/Y H:i:s',
//             'max_files' => 3,
//             'channel' => APP_NAME,
//             'file_perms' => 0755,
//             "adapter" => "file"
//         ],
//         [
//             'name' => 'info' . APP_NAME,
//             'level' => LogLevel::INFO,
//             'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '_e2.txt',
//             'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
//             'date_format' => 'd/m/Y H:i:s',
//             'max_files' => 10,
//             'channel' => APP_NAME,
//             'file_perms' => 0755,
//             "adapter" => "file"
//         ],
//         [
//             'name' => 'redislog',
//             'level' => LogLevel::INFO,
//             'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
//             'date_format' => 'd/m/Y H:i:s',
//             'channel' => 'redislog',
//             "adapter" => "queue"
    //         ],
        [
            'name' => 'redislogall',
            'level' => 'all',
            'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
            'date_format' => 'd/m/Y H:i:s',
            'channel' => 'redisall',
            "adapter" => "queue"
        ],
        [
            'name' => 'redisloginfo',
            'level' => 'info',
            'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
            'date_format' => 'd/m/Y H:i:s',
            'channel' => 'redislog',
            "adapter" => "queue"
        ],
        [
            'name' => 'rabbitapp',
            'level' => 'all',
            'format' => null,
            'date_format' => 'd/m/Y H:i:s',
            'channel' => 'rabbit',
            "adapter" => "queue"
        ],
        // [
        // 'name' => 'infodefault',
        // 'level' => LogLevel::ERROR,
        // 'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
        // 'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
        // 'date_format' => 'd/m/Y H:i:s',
        // 'max_files' => 10,
        // 'file_perms' => 0755,
        // "adapter" => "file"
        // ],
        // [
        // 'name' => 'infodefault',
        // 'level' => LogLevel::INFO,
        // 'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '.txt',
        // 'format' => null, // '[%datetime%] %level_name%: %message%\n\n\n\n',
        // 'date_format' => 'd/m/Y H:i:s',
        // 'max_files' => 10,
        // 'file_perms' => 0755,
        // "adapter" => "file"
        // ],
        // [
        // 'name' => 'info',
        // 'level' => LogLevel::INFO,
        // 'channel' => APP_NAME,
        // 'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '_2.txt',
        // 'date_format' => 'd/m/Y H:i:s',
        // 'max_files' => 10,
        // 'file_perms' => 0755,
        // "adapter" => "file"
        // ],
        // [
        // 'name' => 'errorapp',
        // 'level' => LogLevel::ERROR,
        // 'channel' => APP_NAME,
        // 'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '_e2.txt',
        // 'date_format' => 'd/m/Y H:i:s',
        // 'max_files' => 10,
        // 'file_perms' => 0755,
        // "adapter" => "file"
        // ],
        // [
        // 'name' => 'default',
        // 'level' => LogLevel::INFO,
        // 'channel' => 'default',
        // 'filename' => dirname(__DIR__) . '/logs/' . APP_NAME . '_e2.txt',
        // 'date_format' => 'd/m/Y H:i:s',
        // 'max_files' => 10,
        // 'file_perms' => 0755,
        // "adapter" => "file"
        // ]
    ]
];
