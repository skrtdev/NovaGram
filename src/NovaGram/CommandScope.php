<?php

namespace skrtdev\NovaGram;

use Generator;
use JetBrains\PhpStorm\ExpectedValues;
use JetBrains\PhpStorm\Pure;

class CommandScope
{
    public string $type;

    /**
     * @var string[]|null
     */
    public ?array $language_codes = null;

    /**
     * @var int[]|null
     */
    public ?array $chat_ids = null;

    /**
     * @var int[]|null
     */
    public ?array $user_ids = null;

    public function __construct(
        #[ExpectedValues(['default', 'all_private_chats', 'all_group_chats', 'all_chat_administrators', 'chat', 'chat_administrators', 'chat_member'])]
        string $type = null,
        string|array|null $language_code = null,
        int|array|null $chat_id = null,
        int|array|null $user_id = null,
    )
    {
        $this->language_codes = is_array($language_code) ? $language_code : [$language_code];
        $this->chat_ids = is_array($chat_id) ? $chat_id : [$chat_id];
        $this->user_ids = is_array($user_id) ? $user_id : [$user_id];
        if(isset($chat_id)){
            if(isset($user_id)) $type = 'chat_member';
            else $type ??= 'chat';
        }
        $this->type = $type ?? 'default';
    }

    #[Pure]
    public function getFilter(): Filter
    {
        $user_id = $this->user_ids === [null] ? null : $this->user_ids;
        $chat_id = $this->chat_ids === [null] ? null : $this->chat_ids;
        $language_code = $this->language_codes === [null] ? null : $this->language_codes;

        if($this->type === 'all_private_chats') return new Filter(null, null, $language_code, true);
        if(in_array($this->type, ['all_group_chats', 'all_chat_administrators', 'chat_administrators'])) return new Filter(null, $chat_id, $language_code, false, true);

        return new Filter($user_id, $chat_id, $language_code);
    }

    public function getScopes(): Generator
    {
        foreach ($this->language_codes as $language_code) {
            foreach ($this->chat_ids as $chat_id) {
                foreach ($this->user_ids as $user_id) {
                    yield [
                        'scope' => [
                            'type' => $this->type,
                            'chat_id' => $chat_id,
                            'user_id' => $user_id,
                        ],
                        'language_code' => $language_code,
                    ];
                }
            }
        }
    }

}