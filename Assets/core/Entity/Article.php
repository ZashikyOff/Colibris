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

    public static function UpdateArticle($id_article ,$nom_article, $description)
    {
        require "config.php";
        try {
            $sql = "UPDATE article SET nom_article = :nom, description = :desc WHERE id_article = :id";
            $query = $lienDB->prepare($sql);
            $query->bindValue(":id", $id_article, PDO::PARAM_INT);
            $query->bindValue(":nom", $nom_article, PDO::PARAM_STR);
            $query->bindValue(":desc", $description, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll();
        } catch (Exception $e) {
            print_r($e);
        }
        return $results;
    }

    public static function CreateArticle($nom_article, $description, $categorie)
    {
        require "config.php";
            //On écrit la requete

            try {

                $sql = "INSERT INTO article (nom_article, description, categorie, date_created, img_path) VALUES(:nom, :desc, :categorie, :date, :bientot);";

                //On prépare la requete
                $query = $lienDB->prepare($sql);


                //On injecte les valeurs
                date_default_timezone_set('Europe/Paris');
                $date = date('d-m-y h:i:s');
                $query->bindParam(":date", $date);
                $query->bindValue(":nom", $nom_article, PDO::PARAM_STR);
                $query->bindValue(":desc", $description, PDO::PARAM_STR);
                $query->bindValue(":categorie", $categorie, PDO::PARAM_INT);
                $query->bindValue(":bientot", "a_venir", PDO::PARAM_STR);


                //On exécute la requete
                if ($query->execute()) {
                    $last_id = $lienDB->lastInsertId();

                    $target_dir = "Assets/core/imgbd/";

                    $target_file = $target_dir . basename($last_id) . ".png";

                    move_uploaded_file($_FILES["image_article"]["tmp_name"], $target_file);

                    $sql = "UPDATE article SET img_path=:chemin WHERE id_article=:last_id";

                    // Préparer la requête
                    $query = $lienDB->prepare($sql);

                    $query->bindParam(":chemin", $target_file, PDO::PARAM_STR);
                    $query->bindParam(":last_id", $last_id, PDO::PARAM_INT);

                    if ($query->execute()) {
                        // traitement des résultats
                        $results = $query->fetch();
                    }

                    echo "Aucune erreur";
                    // header('Location: new_article.php');
                } else {
                    echo " Erreur !!!!!";
                }
            } catch (PDOException | Exception | Error $execption) {
                echo "<br><br>" . $execption->getMessage();
            }
        return $results;
    }

    public static function DeleteArticle($id_article)
    {
        require "config.php";
        try {
            $sql = "DELETE FROM article WHERE id_article = :id";
            $query = $lienDB->prepare($sql);
            $query->bindValue(":id", $id_article, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            print_r($e);
        }
        return true;
    }
}
