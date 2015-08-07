<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfirmationCommande
 *
 * @ORM\Table(name="confirmation_commande", indexes={@ORM\Index(name="fk_confirmation_commande_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_confirmation_commande_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_confirmation_commande_client1_idx", columns={"ref_societe_client"}), @ORM\Index(name="fk_confirmation_commande_interlocuteur_client1_idx", columns={"ref_interlocuteur_client"})})
 * @ORM\Entity
 */
class ConfirmationCommande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_confirmation_commande", type="string", length=50, nullable=false)
     */
    private $codeConfirmationCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_confirmation_commande", type="date", nullable=false)
     */
    private $dateConfirmationCommande;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmation_envoyee", type="boolean", nullable=false)
     */
    private $confirmationEnvoyee = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, nullable=true)
     */
    private $delaisLivraison;

    /**
     * @var \Application\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_client", referencedColumnName="id")
     * })
     */
    private $refSocieteClient;

    /**
     * @var \Application\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur_client", referencedColumnName="id")
     * })
     */
    private $refInterlocuteurClient;

    /**
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;


}
