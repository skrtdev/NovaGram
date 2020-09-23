<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQuery extends \Telegram\InlineQuery{

   public string $inline_query_id;
   public stdClass $results;
   public int $cache_time;
   public bool $is_personal;
   public string $next_offset;
   public string $switch_pm_text;
   public string $switch_pm_parameter;

}

?>