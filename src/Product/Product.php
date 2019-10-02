<?php
/**
 * Product class
 */

namespace Elpr\Product;

/**
 * Representation of a product
 */
class Product
{
    /**
     * @var string  $table   The table to work on.
     * @var object  $db   The database object.
     * @var object  $filter   The filter object.
     * @var object $content The content object.
     */

    private $table;
    private $db;
    private $filter;
    private $content;


    /**
     * Constructor to initiate the object with table and db reference
     *
     *
     * @param string $table The table to work on with default.
     * @param object  $db   The database object.
     *
     */

    public function __construct(object $db, string $table = "kmom10_product")
    {
        $this->table = $table;
        $this->db = $db;
        $this->filter = new \Elpr\MyTextFilter\MyTextFilter();
        $this->content = new \Elpr\Content\Content($this->db);
    }

    /**
     * Get all products from table
     *
     * @return object
     */

    public function getAllProducts()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table;";
        $resultset = $this->db->executeFetchAll($sql);
        foreach ($resultset as $value) {
            $value->description = $this->filter->parse($value->description, ["markdown"]);
            $value->description = $this->content->tokenTruncate($value->description, 100);
        }
        return $resultset;
    }

    /**
     * Search for products in tables
     *
     * @param string $search
     * @return object
     */

    public function searchProduct($search)
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE name LIKE ? OR description LIKE ? OR category LIKE ?;";
        $resultset = $this->db->executeFetchAll($sql, array_fill(0, 3, "%" . $search . "%"));
        return $resultset;
    }


    /**
     * Insert product to table
     *
     * @param array with parameters
     * @return true or exception message
     */

    public function create($params)
    {
        $this->db->connect();

        $sql = "INSERT INTO $this->table (name, description, image, category, profile, sunscreen, options, recommended) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        try {
            $this->db->execute($sql, $params);
        } catch (\Exception $e) {
            return $e;
        }
        return true;
    }

    /**
     * Gets latest products from table.
     *
     * @return object
     */

    public function getLatestProduct()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table ORDER BY added LIMIT 4;";
        $product = $this->db->executeFetchAll($sql);
        return $product;
    }

    /**
     * Gets recommended products from table
     *
     * @return object
     */

    public function getRecommendedProduct()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE recommended = 'yes' LIMIT 4;";
        $product = $this->db->executeFetchAll($sql);
        return $product;
    }

    /**
     * Gets one product from the table.
     *
     * @return object
     * @param $id product id
     */

    public function getProduct($id)
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE id = ?;";
        $product = $this->db->executeFetch($sql, [$id]);
        return $product;
    }

    /**
     * Update one product in  the table.
     *
     * @param array $params product information to update
     * @return true or exception message
     */
    public function updateProduct($params)
    {
        $this->db->connect();
        $sql = "UPDATE $this->table SET name = ?, description = ?, image = ?, category = ?, profile = ?, sunscreen = ?, options = ?, recommended = ? WHERE id = ?;";

        try {
            $this->db->execute($sql, $params);
        } catch (\Exception $e) {
            return $e;
        }
        return true;
    }

    /**
     * Delete product from the table.
     *
     * @param int $id Content information to update
     * @return void
     */
    public function deleteProduct($id)
    {

        $this->db->connect();
        $sql = "DELETE FROM $this->table WHERE id = ?;";

        $this->db->execute($sql, [$id]);
    }

    /**
     * Gets all products from the table for the admin view.
     *
     * @return object
     */
    public function adminProduct()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }
}
