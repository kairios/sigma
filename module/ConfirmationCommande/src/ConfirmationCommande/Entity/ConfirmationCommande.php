<?php

namespace ConfirmationCommande\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfirmationCommande
 *
 * @ORM\Table(name="confirmation_commande", indexes={@ORM\Index(name="fk_confirmation_commande_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_confirmation_commande_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_confirmation_commande_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_confirmation_commande_interlocuteur_client1_idx", columns={"ref_interlocuteur"})})
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
     * @ORM\Column(name="numero_affaire", type="string", length=30, nullable=false)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="code_confirmation", type="string", length=50, nullable=false)
     */
    private $codeConfirmation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_confirmation", type="date", nullable=false)
     */
    private $dateConfirmation;

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, nullable=true)
     */
    private $delaisLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=50, nullable=true)
     */
    private $referenceCommandeClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="date", nullable=true)
     */
    private $dateEnvoi;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Affaire\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;

    /**
     * @var \Client\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="\Client\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;


}
