<?php

use skrtdev\NovaGram\Message;
use skrtdev\Prototypes\Prototype;

Prototype::addMethod(Message::class, "toHTML", function ($self){
    return $self->getHTMLText();
});
Prototype::addMethod(Message::class, "getHTMLText", function ($self){
    return EntityParser::TextEntitiesToHTML($self->text, $self->entities);
});

// TODO getMarkdownText()

?>
