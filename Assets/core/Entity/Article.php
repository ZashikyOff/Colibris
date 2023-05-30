<?php

namespace Core\Entity;

use \PDO;
use \PDOException;
use \Exception;
use \Error;

class Article
{
    /* attributs (propriete properties) */
    private int $id_article;
    private string $nom_article;
    private string $description;
    private int $slug;
    private int $img_path;
    private int $categorie;
    private int $date_created;

    /** Constructeur */
    public function __construct($id_article = 0, $nom_article = "", $description = "", $slug = 0, $img_path = "", $categorie = 0, $date_created = "")
    {
        $this->id_article = $id_article;
        $this->nom_article = $nom_article;
        $this->description = $description;
        $this->slug = $slug;
        $this->img_path = $img_path;
        $this->categorie = $categorie;
        $this->date_created = $date_created;
    }

    /** Accesseurs */
    // setters magiques
    public function __set($attribut, $valeur)
    {
        $this->$attribut = $valeur;
    }

    // getters magiques
    public function __get($attribut)
    {
        return $this->$attribut;
    }

    public static function AllArticle()
    {
        require "config.php";
        try {
            $sql = "SELECT * FROM article";
            $query = $lienDB->prepare($sql);
            $query->execute();
            $results = $query->fetchAll();
        } catch (Exception $e) {
            print_r($e);
        }
        return $results;
    }

    public static function ArticleByName($nom_article)
    {
        require "config.php";
        try {
            $sql = "SELECT * FROM article WHERE nom_article LIKE :nom";
            $query = $lienDB->prepare($sql);
            $query->bindValue(":nom", "$nom_article%", PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll();
        } catch (Exception $e) {
            print_r($e);
        }
        return $results;
    }

    public static function ArticleByNameAndCategorie($nom_article, $categorie)
    {
        require "config.php";
        try {
            $sql = "SELECT * FROM article WHERE categorie = :categorie AND nom_article LIKE :nom";
            $query = $lienDB->prepare($sql);
            $query->bindValue(":nom", "$nom_article%", PDO::PARAM_STR);
            $query->bindValue(":categorie", $categorie, PDO::PARAM_INT);
            $query->execute();
            $results = $query->fetchAll();
        } catch (Exception $e) {
            print_r($e);
        }
        return $results;
    }

    public static function ArticleByCategory($categorie)
    {
        require "config.php";
        try {
            $sql = "SELECT * FROM article WHERE categorie = :categorie";
            $query = $lienDB->prepare($sql);
            $query->bindValue(":categorie", $categorie, PDO::PARAM_INT);
            $query->execute();
            $results = $query->fetchAll();
        } catch (Exception $e) {
            print_r($e);
        }
        return $results;
    }

    public static function AllCategories()
    {
        require "config.php";
        try {
            $sql = "SELECT * FROM categorie";
            $query = $lienDB->prepare($sql);
            $query->execute();
            $results = $query->fetchAll();
        } catch (Exception $e) {
            print_r($e);
        }
        return $results;
    }
}
