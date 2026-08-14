<?php

declare(strict_types=1);

use Arkitect\ClassSet;
use Arkitect\CLI\Config;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\IsInterface;
use Arkitect\Expression\ForClasses\IsReadonly;
use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\NotHaveAttribute;
use Arkitect\Expression\ForClasses\NotImplement;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\Rule;
use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Entity;
use Hub\Shared\Application\Bus\CommandHandler;
use Hub\Shared\Application\Bus\QueryHandler;
use Symfony\Component\Messenger\Envelope;

/**
 * Arkitect police la *forme*, deptrac police la *direction* (`deptrac-couches.yaml`,
 * `deptrac-contextes.yaml`). Les deux sont nommés côte à côte au §7 du plan pour une raison précise :
 * « l'allow-list a besoin d'un outil qui peut vérifier ce qu'une classe *est*, pas seulement ce vers quoi
 * elle pointe ».
 */
return static function (Config $config): void {
    $src = ClassSet::fromDir(__DIR__.'/src');

    $config->add(
        $src,

        // -------------------------------------------------------------------------------------------
        // Le préalable à toutes les autres règles
        //
        // deptrac et Arkitect ancrent leurs sélecteurs sur `Hub\`. Une classe laissée sous un autre
        // namespace — un reste de recette Flex en `App\`, par exemple — passe donc à travers *toutes* les
        // règles de frontière sans en violer aucune.
        //
        // Ce n'est pas hypothétique et ce n'est pas un incident unique : `src/Schedule.php`, la recette de
        // `symfony/scheduler`, a été supprimée puis **est revenue toute seule** quand un `composer require`
        // a rejoué les recettes. Un fichier que Flex peut réécrire n'est jamais définitivement supprimé ;
        // ce qui tient dans le temps, c'est une règle qui le redétecte à chaque passage. Le remplaçant
        // légitime est `Hub\Shared\Infrastructure\Scheduler\HubSchedule`.
        // -------------------------------------------------------------------------------------------

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('*'))
            ->should(new ResideInOneOfTheseNamespaces('Hub\*'))
            ->because('une classe hors de `Hub\\` est une classe qu\'aucune règle de frontière ne couvre'),

        // -------------------------------------------------------------------------------------------
        // La forme du domaine
        // -------------------------------------------------------------------------------------------

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\Model'))
            ->should(new IsFinal())
            ->because('un modèle du domaine étendu est un invariant qu\'une sous-classe peut contourner'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\Model'))
            ->should(new IsReadonly())
            ->because('un objet du domaine mutable rend l\'endroit du changement impossible à situer'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\ValueObject'))
            ->should(new IsFinal())
            ->because('un objet valeur est sa valeur ; le sous-classer casse l\'égalité'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\ValueObject'))
            ->should(new IsReadonly())
            ->because('un objet valeur qui peut changer après sa construction n\'en est pas un'),

        // -------------------------------------------------------------------------------------------
        // Les dépôts
        // -------------------------------------------------------------------------------------------

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\Repository'))
            ->should(new IsInterface())
            ->because('le domaine déclare le contrat de persistance ; Infrastructure l\'implémente'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\Repository'))
            ->should(new HaveNameMatching('*Repository'))
            ->because('un nom qui ne dit pas ce que la chose est, est un nom que la revue doit deviner'),

        // -------------------------------------------------------------------------------------------
        // L'allow-list de `Domain` — plan.md §7
        //
        // deptrac vérifie déjà la direction. Ceci vérifie ce qu'une classe *est* : qu'aucune classe du
        // domaine n'implémente une interface Doctrine ni ne porte un attribut de mappage, ce qui est la
        // façon dont Doctrine entre dans un domaine sans qu'aucune dépendance directe n'apparaisse.
        // -------------------------------------------------------------------------------------------

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\*'))
            ->should(new NotDependsOnTheseNamespaces(['Doctrine']))
            ->because('« rien dans Domain n\'implémente une interface Doctrine » — plan.md §7'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\*'))
            ->should(new NotHaveAttribute(Entity::class))
            ->because('le mappage est en XML dans Infrastructure/Doctrine/Mapping, pas en attributs ici'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\*'))
            ->should(new NotHaveAttribute(Embeddable::class))
            ->because('le mappage est en XML dans Infrastructure/Doctrine/Mapping, pas en attributs ici'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\*'))
            ->should(new NotDependsOnTheseNamespaces(['Symfony\Component\Validator']))
            ->because('« symfony/validator n\'entre jamais dans Domain » : un validateur produit une liste '
                .'de violations destinée à l\'usager, un domaine produit un échec d\'invariant, et les deux '
                .'sont confondus dès qu\'un seul outil est chargé de faire les deux — plan.md §7'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\*'))
            ->should(new NotDependsOnTheseNamespaces([
                'Symfony\Component\DependencyInjection',
                'Symfony\Component\HttpFoundation',
                'Symfony\Component\HttpKernel',
                'Symfony\Component\Messenger',
                'Symfony\Component\Serializer',
                'Symfony\Component\Form',
                'Symfony\Component\Security',
                'Symfony\Bundle',
            ]))
            ->because('« aucun conteneur, aucune configuration, aucune E/S, aucun autowiring » — le test '
                .'étroit d\'admission de l\'allow-list de Domain, plan.md §7'),

        // -------------------------------------------------------------------------------------------
        // Les frontières que le §7 nomme ailleurs
        // -------------------------------------------------------------------------------------------

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Application\*'))
            ->should(new NotDependsOnTheseNamespaces(['Doctrine\ORM', 'Doctrine\DBAL']))
            ->because("l'application parle au domaine par des interfaces ; Doctrine vit dans Infrastructure"),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Contracts\*'))
            ->should(new NotDependsOnTheseNamespaces(['Doctrine', 'Symfony\Component\Messenger']))
            ->because('un Contracts est ce que les autres contextes importent : il ne porte que des types'),

        // Une commande retourne void et l'appelant génère l'identifiant (decisions/0011). La signature
        // `void` n'est pas vérifiable ici ; ce qui l'est, c'est qu'un gestionnaire soit bien étiqueté.
        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Application\Command\*'))
            ->andThat(new HaveNameMatching('*Handler'))
            ->should(new Implement(CommandHandler::class))
            ->because('sans le marqueur, un gestionnaire atterrit sur le bus par défaut et perd sa transaction'),

        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Application\Query\*'))
            ->andThat(new HaveNameMatching('*Handler'))
            ->should(new Implement(QueryHandler::class))
            ->because('sans le marqueur, un gestionnaire de requête atterrit sur le bus transactionnel'),

        // Le domaine ne connaît pas Messenger. Un événement de domaine est un fait, pas un message.
        Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('Hub\*\Domain\Event\*'))
            ->should(new NotImplement(Envelope::class))
            ->because('un événement de domaine est un fait du domaine, pas une enveloppe de transport'),
    );
};
