<?php

namespace Yuges\Subscribable\Config;

use TypeError;
use Illuminate\Support\Collection;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Yuges\Reactable\Models\ReactionType;
use Yuges\Reactable\Interfaces\Reactable;
use Yuges\Reactable\Actions\CreateReactionAction;
use Yuges\Reactable\Actions\ToggleReactionAction;
use Illuminate\Support\Facades\Config as ConfigFacade;
use Yuges\Reactable\Interfaces\ReactionType as ReactionTypeInterface;
use Yuges\Reactable\Interfaces\ReactionIcon as ReactionIconInterface;
use Yuges\Reactable\Interfaces\ReactionWeight as ReactionWeightInterface;

class Config
{
    const string NAME = 'subscribable';

    /** @return class-string<Reaction> */
    public static function getReactionClass(mixed $default = null): string
    {
        return self::get('models.reaction.default', $default);
    }

    /** @return class-string<ReactionType> */
    public static function getReactionTypeClass(mixed $default = null): string
    {
        return self::get('models.reaction.type', $default);
    }

    /** @return class-string<Reactor> */
    public static function getReactorDefaultClass(mixed $default = null): string
    {
        return self::get('models.reactor.default', $default);
    }

    /** @return Collection<int, class-string<Reactor>> */
    public static function getReactorAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.reactor.allowed', $default)
        );
    }

    public static function getToggleReactionAction(Reactable $reactable, mixed $default = null): ToggleReactionAction
    {
        return self::getToggleReactionActionClass($default)::create($reactable);
    }

    /** @return class-string<ToggleReactionAction> */
    public static function getToggleReactionActionClass(mixed $default = null): string
    {
        return self::get('actions.toggle', $default);
    }

    public static function getCreateReactionAction(Reactable $reactable, mixed $default = null): CreateReactionAction
    {
        return self::getCreateReactionActionClass($default)::create($reactable);
    }

    /** @return class-string<CreateReactionAction> */
    public static function getCreateReactionActionClass(mixed $default = null): string
    {
        return self::get('actions.create', $default);
    }

    /** @return class-string<ReactionTypeInterface> */
    public static function getReactionTypeEnumClass(mixed $default = null): string
    {
        $class = self::get('types', $default);

        if (! is_subclass_of($class, ReactionTypeInterface::class)) {
            throw new TypeError('Reaction type enum type error');
        }

        return $class;
    }

    /** @return class-string<ReactionIconInterface> */
    public static function getReactionIconEnumClass(mixed $default = null): string
    {
        $class = self::get('icons', $default);

        if (! is_subclass_of($class, ReactionIconInterface::class)) {
            throw new TypeError('Reaction icon enum type error');
        }

        return $class;
    }

    /** @return class-string<ReactionWeightInterface> */
    public static function getReactionWeightEnumClass(mixed $default = null): string
    {
        $class = self::get('weights', $default);

        if (! is_subclass_of($class, ReactionWeightInterface::class)) {
            throw new TypeError('Reaction weight enum type error');
        }

        return $class;
    }

    public static function getPermissionsAnonymous(mixed $default = false): bool
    {
        return self::get('permissions.anonymous', $default);
    }

    public static function getPermissionsDuplicate(mixed $default = false): bool
    {
        return self::get('permissions.duplicate', $default);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return ConfigFacade::get(self::NAME . '.' . $key, $default);
    }
}
