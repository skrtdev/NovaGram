<?php

namespace skrtdev\NovaGram;

use Closure;
use skrtdev\Telegram\Type;

class Handler
{
    protected Closure $handler;

    protected ?Closure $filter = null;

    /**
     * Handler constructor.
     * @param callable $handler
     * @param callable|FilterInterface|callable[]|FilterInterface[]|null $filter
     */
    public function __construct(callable $handler, $filter = null)
    {
        $this->handler = $handler;
        if(isset($filter)){
            $this->filter = self::normalizeFilter($filter);
        }
    }

    /**
     * @param FilterInterface[] $filters
     * @return Closure
     */
    public static function orFilter(array $filters): Closure
    {
        return function(Type $object) use ($filters) {
            foreach ($filters as $filter) {
                if ($filter->handle($object)) {
                    return true;
                }
            }
            return false;
        };
    }

    public static function normalizeFilter($filter){
        if($filter instanceof FilterInterface){
            $filter = [$filter, 'handle'];
            #$filter = Closure::fromCallable([$filter, 'handle']);
        }
        elseif(is_array($filter)){
            $filters = &$filter;
            foreach ($filters as $key => &$filter) {
                if($filter === null) unset($filters[$key]);
                $filter = self::normalizeFilter($filter);
            }
            unset($filter);
            $filter = function(Type $object) use ($filters) {
                foreach ($filters as $filter) {
                    if(!$filter($object)){
                        return false;
                    }
                }
                return true;
            };
        }
        return $filter;
    }

    public static function sumFilters(...$array): array {
        $result = [];
        foreach ($array as $item) {
            if(isset($item)){
                $result = [...$result, ...is_array($item) ? self::sumFilters(...$item) : [$item]];
            }
        }
        return $result;
    }

    public function filter(Type $object): bool {
        return !isset($this->filter) || ($this->filter)($object);
    }

    public function handle(Type $object): void {
        ($this->handler)($object);
    }

}