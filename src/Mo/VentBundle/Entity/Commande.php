<?php

namespace Mo\VentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Mo\VentBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_cmd", type="date")
     */
    private $dateCmd;

    /**
     * @var string
     *
     * @ORM\Column(name="adress_liv", type="string", length=255)
     */
    private $adressLiv;
    /**
     * @ORM\ManyToOne(targetEntity="Client",inversedBy="commandes")
     * @ORM\JoinColumn(name="id_client",referencedColumnName="id")
     */
    private $client;
    /**
     * @ORM\ManyToMany(targetEntity="Produit",mappedBy="commandes")
     */
    private $produits;
    public function __construct()
    {
        $this->produits=new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateCmd
     *
     * @param \DateTime $dateCmd
     *
     * @return Commande
     */
    public function setDateCmd($dateCmd)
    {
        $this->dateCmd = $dateCmd;

        return $this;
    }

    /**
     * Get dateCmd
     *
     * @return \DateTime
     */
    public function getDateCmd()
    {
        return $this->dateCmd;
    }

    /**
     * Set adressLiv
     *
     * @param string $adressLiv
     *
     * @return Commande
     */
    public function setAdressLiv($adressLiv)
    {
        $this->adressLiv = $adressLiv;

        return $this;
    }

    /**
     * Get adressLiv
     *
     * @return string
     */
    public function getAdressLiv()
    {
        return $this->adressLiv;
    }

    /**
     * Set client
     *
     * @param \Mo\VentBundle\Entity\Client $client
     *
     * @return Commande
     */
    public function setClient(\Mo\VentBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Mo\VentBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add lignesCmd
     *
     * @param \Mo\VentBundle\Entity\Ligne_Commande $lignesCmd
     *
     * @return Commande
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
