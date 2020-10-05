<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.
*/
class InlineQuery extends \Telegram\InlineQuery{

    /** @var string Yes */
    public string $inline_query_id;

    /** @var stdClass Yes */
    public stdClass $results;

    /** @var int Optional */
    public int $cache_time;

    /** @var bool Optional */
    public bool $is_personal;

    /** @var string Optional */
    public string $next_offset;

    /** @var string Optional */
    public string $switch_pm_text;

    /** @var string Optional */
    public string $switch_pm_parameter;

    
}

?>
