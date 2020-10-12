# Extending NovaGram

NovaGram has a JS-like Prototypes System, that you can use in order to extend the library  

## Add new Methods

Let's make a sort of breakpoint for debugging your code.

```php
use skrtdev\NovaGram\Bot;

Bot::addMethod("breakpoint", function ($self) {
    $self->breakpoint_n ??= 0; // initialize the property
    $self->debug("Breakpoint n.{$self->breakpoint_n}");
    $self->breakpoint_n++; // increment the property
});

// usage:
$Bot->breakpoint();
```

The 1st parameter is the method name, the 2nd is the method itself, in form of Closure (anonymus function).  
The arguments passed to the Closure are `$self` (the instance of the Object - _like $this_) and all the other arguments passed to the method

```php
use skrtdev\NovaGram\Bot;

Bot::addMethod("breakpoint", function ($self, $text) {
    $self->breakpoint_n ??= 0; // initialize the property
    $self->debug("Breakpoint n.{$self->breakpoint_n}: $text");
    $self->breakpoint_n++; // increment the property
});

// usage:
$Bot->breakpoint("sample text");
```

With prototypes you can only add methods, not modify behaviour of existent methods.
