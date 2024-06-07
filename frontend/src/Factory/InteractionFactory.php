<?php

namespace App\Factory;

use App\Entity\Interaction;
use App\Repository\InteractionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Interaction>
 *
 * @method        Interaction|Proxy                     create(array|callable $attributes = [])
 * @method static Interaction|Proxy                     createOne(array $attributes = [])
 * @method static Interaction|Proxy                     find(object|array|mixed $criteria)
 * @method static Interaction|Proxy                     findOrCreate(array $attributes)
 * @method static Interaction|Proxy                     first(string $sortedField = 'id')
 * @method static Interaction|Proxy                     last(string $sortedField = 'id')
 * @method static Interaction|Proxy                     random(array $attributes = [])
 * @method static Interaction|Proxy                     randomOrCreate(array $attributes = [])
 * @method static InteractionRepository|RepositoryProxy repository()
 * @method static Interaction[]|Proxy[]                 all()
 * @method static Interaction[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Interaction[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Interaction[]|Proxy[]                 findBy(array $attributes)
 * @method static Interaction[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Interaction[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class InteractionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Interaction $interaction): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Interaction::class;
    }
}
