<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneBordereauLivraison
 *
 * @ORM\Table(name="ligne_bordereau_livraison", indexes={@ORM\Index(name="fk_bordereau_livraison_ligne_ligne1_idx", columns={"ref_ligne_affaire"}), @ORM\Index(name="ref_bordereau", columns={"ref_bordereau"})})
 * @ORM\Entity
 */
class LigneBordereauLivraison
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite_livree", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $quantiteLivree;

    /**
     * @var integer
     *
     * @ORM\Column(name="reste_a_livrer", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $resteALivrer;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_a_livrer", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $totalALivrer;

    /**
     * @var \Application\Entity\BordereauLivraison
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\BordereauLivraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_bordereau", referencedColumnName="id", nullable=true)
     * })
     */
    private $refBordereau;

    /**
     * @var \Application\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refLigneAffaire;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantiteLivree
     *
     * @param integer $quantiteLivree
     * @return LigneBordereauLivraison
     */
    public function setQuantiteLivree($quantiteLivree)
    {
        $this->quantiteLivree = $quantiteLivree;
    
        return $this;
    }

    /**
     * Get quantiteLivree
     *
     * @return integer 
     */
    public function getQuantiteLivree()
    {
        return $this->quantiteLivree;
    }

    /**
     * Set resteALivrer
     *
     * @param integer $resteALivrer
     * @return LigneBordereauLivraison
     */
    public function setResteALivrer($resteALivrer)
    {
        $this->resteALivrer = $resteALivrer;
    
        return $this;
    }

    /**
     * Get resteALivrer
     *
     * @return integer 
     */
    public function getResteALivrer()
    {
        return $this->resteALivrer;
    }

    /**
     * Set totalALivrer
     *
     * @param integer $totalALivrer
     * @return LigneBordereauLivraison
     */
    public function setTotalALivrer($totalALivrer)
    {
        $this->totalALivrer = $totalALivrer;
    
        return $this;
    }

    /**
     * Get totalALivrer
     *
     * @return integer 
     */
    public function getTotalALivrer()
    {
        return $this->totalALivrer;
    }

    /**
     * Set refBordereau
     *
     * @param \Application\Entity\BordereauLivraison $refBordereau
     * @return LigneBordereauLivraison
     */
    public function setRefBordereau(\Application\Entity\BordereauLivraison $refBordereau = null)
    {
        $this->refBordereau = $refBordereau;
    
        return $this;
    }

    /**
     * Get refBordereau
     *
     * @return \Application\Entity\BordereauLivraison 
     */
    public function getRefBordereau()
    {
        return $this->refBordereau;
    }

    /**
     * Set refLigneAffaire
     *
     * @param \Application\Entity\LigneAffaire $refLigneAffaire
     * @return LigneBordereauLivraison
     */
    public function setRefLigneAffaire(\Application\Entity\LigneAffaire $refLigneAffaire = null)
    {
        $this->refLigneAffaire = $refLigneAffaire;
    
        return $this;
    }

    /**
     * Get refLigneAffaire
     *
     * @return \Application\Entity\LigneAffaire 
     */
    public function getRefLigneAffaire()
    {
        return $this->refLigneAffaire;
    }
}
