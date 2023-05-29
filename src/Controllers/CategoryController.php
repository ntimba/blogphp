<?php 

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Models\Category;
use Ntimbablog\Portfolio\Models\CategoryManager;

use Ntimbablog\Portfolio\Helpers\StringUtil;
use \InvalidArgumentException;

class CategoryController
{
    private array $errors = [];

    protected const EMPTY_VALUES = "Remplissez tous les champs";
    protected const CATEGORY_EXISTS = "La catégorie choisi existe";

    public function insertCategory(array $categoryData) : void
    {
        $stringUtil = new StringUtil();
        $categoryManager = new CategoryManager();

        // Créer la catégorie par défaut
        $this->insertDefaultCategory();
        
        // Créer une catégorie depuis le formulaire
        if( 
            isset( $categoryData['category_name'] ) && !empty($categoryData['category_name'])  &&
            isset( $categoryData['category_description'] ) && !empty($categoryData['category_description'])  &&
            isset( $categoryData['category_parent_id'] )
            )
        { 
            
            $categoryName = htmlspecialchars( $categoryData['category_name'] );
            $stringUtil = new StringUtil();
            $categorySlug = $stringUtil->removeStringsSpaces( $categoryName );
            $categoryDescription = htmlspecialchars( $categoryData['category_description'] );
            $categoryIdParent = (int) htmlspecialchars( $categoryData['category_parent_id'] ); // id recupéré depuis le value du formulaire

            if( $categoryIdParent === 0) 
            {
                $categoryIdParent = NULL;
            }

            // Créer l'objet 
            $category = new Category([
                'name' => $categoryName,
                'slug' => $categorySlug,
                'description' => $categoryDescription,
                'idParent' => $categoryIdParent
            ]);

            // Créer une nouvelle catégorie
            if(! $categoryManager->getCategoryId( $category->getName() ) ) {
                $categoryManager->insertCategory($category);
            }else{
                $this->errors[] = self::CATEGORY_EXISTS;
            }

        }else{
            if( isset( $categoryData['submit'] ) ) {
                $this->errors[] = self::EMPTY_VALUES;
            }
        }
                
        $categories = $categoryManager->getCategories();

        require( './views/backend/insertcategory.php' );

    }

    public function insertDefaultCategory() : void
    {
        $categoryManager = new CategoryManager();
        $defaultCategory = new Category([
            'name' => 'default',
            'slug' => 'default',
            'description' => 'Ceci est une catégorie par défaut',
            'idParent' => NULL
        ]);

        if(!$categoryManager->getCategoryId($defaultCategory->getName()) ) 
        {
            $categoryManager->insertCategory($defaultCategory);
        }
    }

    public function createDefaultCategory() : void
    {

    }
}

