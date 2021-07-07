# Extending NovaGram

NovaGram has a JS-like Prototypes System, that you can use in order to extend the library  

## Add new Methods

Let's make a sort of breakpoint for debugging your code.

```php
use skrtdev\NovaGram\Bot;

Bot::addMethod("breakpoint", function () {
    $this->breakpoint_n ??= 0; // initialize the property
    $this->debug("Breakpoint n.{$this->breakpoint_n}");
    $this->breakpoint_n++; // increment the property
});

// usage:
$Bot->breakpoint();
```

The 1st parameter is the method name, the 2nd is the method itself, in form of Closure (anonymous function).  
The arguments passed to the Closure are all the arguments passed to the method.  
Inside the Closure, `$this` refers to the instance of the Object - in this case instance of `skrtdev\NovaGram\Bot`.  

```php
use skrtdev\NovaGram\Bot;

Bot::addMethod("breakpoint", function ($text) {
    $this->breakpoint_n ??= 0; // initialize the property
    $this->debug("Breakpoint n.{$this->breakpoint_n}: $text");
    $this->breakpoint_n++; // increment the property
});

// usage:
$Bot->breakpoint("sample text");
```

With prototypes you can only add methods, not modify behaviour of existent methods.
