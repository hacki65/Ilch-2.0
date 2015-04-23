<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Faq\Mappers;

use Modules\Faq\Models\Category as CategoryModel;

defined('ACCESS') or die('no direct access');

class Category extends \Ilch\Mapper
{
    /**
     * Gets categorys.
     *
     * @param array $where
     * @return CategoryModel[]|null
     */
    public function getCategories($where = array())
    {
        $categoryArray = $this->db()->select('*')
            ->from('faq_cats')
            ->where($where)
            ->execute()
            ->fetchRows();

        if (empty($categoryArray)) {
            return null;
        }

        $categorys = array();

        foreach ($categoryArray as $categoryRow) {
            $categoryModel = new CategoryModel();
            $categoryModel->setId($categoryRow['id']);
            $categoryModel->setTitle($categoryRow['title']);
         
            $categorys[] = $categoryModel;
        }

        return $categorys;
    }

    /**
     * Returns user model found by the id or false if none found.
     *
     * @param  int $id
     * @return false|CategoryModel
     */
    public function getCategoryById($id)
    {
        $cats = $this->getCategories(array('id' => $id));
        return reset($cats);
    }

    /**
     * Inserts or updates category model.
     *
     * @param CategoryModel $category
     */
    public function save(CategoryModel $category)
    {
        $fields = array
        (
            'title' => $category->getTitle()
        );

        if ($category->getId()) {
            $this->db()->update('faq_cats')
                ->values($fields)
                ->where(array('id' => $category->getId()))
                ->execute();
        } else {
            $this->db()->insert('faq_cats')
                ->values($fields)
                ->execute();
        }
    }

    /**
     * Deletes category with given id.
     *
     * @param integer $id
     */
    public function delete($id)
    {
        $this->db()->delete('faq_cats')
            ->where(array('id' => $id))
            ->execute();
    }
}
