<?php

namespace App\Domain\WriteModel\Pokemon\AddPokemon;

use App\Domain\WriteModel\Pokemon\Pokemon;
use App\Domain\WriteModel\Pokemon\PokemonRepository;
use App\Infrastructure\Attribute\AsCommandHandler;
use App\Infrastructure\CQRS\CommandHandler;
use App\Infrastructure\CQRS\DomainCommand;

#[AsCommandHandler]
class AddPokemonCommandHandler implements CommandHandler
{
    public function __construct(
        private PokemonRepository $pokemonRepository
    )
    {
    }

    public function handle(DomainCommand $command): void
    {
        assert($command instanceof AddPokemon);

        $this->pokemonRepository->add(Pokemon::create(
            $command->getUuid(),
            $command->getId(),
            $command->getName(),
            $command->getBaseExperience(),
            $command->getHeight(),
            $command->getWeight(),
            $command->getAbilities(),
            $command->getMoves(),
            $command->getTypes(),
            $command->getStats(),
            $command->getSprites()
        ));
    }

}