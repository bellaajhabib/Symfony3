<?php

namespace Mo\VentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="Mo\VentBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire", type="float")
     */
    private $prixUnitaire;
    /**
     * @ORM\ManyToMany(targetEntity="Commande",inversedBy="produits")
     * @ORM\JoinTable(name="ligne_commande")
     */
    private $commandes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set prixUnitaire
     *
     * @param float $prixUnitaire
     *
     * @return Produit
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    /**
     * Get prixUnitaire
     *
     * @return float
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }


    /**
     * Add lignesCmd
     *
     * @param \Mo\VentBundle\Entity\Ligne_Commande $lignesCmd
     *
     * @return Produit
     */
    public function addLignesCmd(\Mo\VentBundle\Entity\Ligne_Commande $lignesCmd)
    {
        $this->lignes_cmd[] = $lignesCmd;

        return $this;
    }

    /**
     * Remove lignesCmd
     *
     * @param \Mo\VentBundle\Entity\Ligne_Commande $lignesCmd
     */
    public function removeLignesCmd(\Mo\VentBundle\Entity\Ligne_Commande $lignesCmd)
    {
        $this->lignes_cmd->removeElement($lignesCmd);
    }

    /**
     * Get lignesCmd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignesCmd()
    {
        return $this->lignes_cmd;
    }
}
