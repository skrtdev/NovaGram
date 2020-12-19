<?php declare(strict_types=1);

namespace Monolog\Handler;

use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Logger;
use skrtdev\NovaGram\Bot;

/**
 * Send to a Telegram Chat
 *
 * @author Gaetano Sutera <gaetanosutera@yahoo.it>
 */
class TelegramHandler extends AbstractProcessingHandler
{
    protected Bot $Bot;

    /**
     * @param string     $token          Telegram Bot Token that will be used for sending log messages
     * @param int        $chat_id        Chat where the logs will be sent
     * @param int|string $level          The minimum logging level at which this handler will be triggered
     * @param bool       $bubble         Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(
        string $token,
        protected int $chat_id,
        $level = Logger::DEBUG,
        bool $bubble = true
    )
    {
        parent::__construct($level, $bubble);
        $this->Bot = new Bot($token, mode: Bot::NONE, parse_mode: "HTML");
    }


    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LineFormatter('[%datetime%] %channel%.%level_name%: %message% %context% %extra%');
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record): void
    {
        $message = "<pre>".htmlspecialchars((string) $record['formatted'])."</pre>";
        $this->Bot->sendMessage($this->chat_id, $message);
    }
}
