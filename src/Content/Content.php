<?php
/**
 * Content class handling news and offers. CRUD from database.
 */

namespace Elpr\Content;

/**
 * Class to handle CRUD for content.
 */
class Content
{
    /**
     * @var string  $table   The table to work on.
     * @var object  $db   The database object.
     * @var object  $filter   The database object.
     */

    private $table;
    private $db;
    private $filter;


    /**
     * Constructor to initiate the object with current db object and db table * to work on.
     *
     * @param string $table The table to work on with default.
     * @var object  $db   The database object.
     * @var object  $filter   The database object.
     *
     */

    public function __construct(object $db, string $table = "kmom10_content")
    {
        $this->table = $table;
        $this->db = $db;
        $this->filter = new \Elpr\MyTextFilter\MyTextFilter();
    }

    /**
     * Gets all post from the table.
     *
     * @return object PDO
     */

    public function getAllContent()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table;";
        $resultset = $this->db->executeFetchAll($sql);
        foreach ($resultset as $value) {
            $value->data = $this->filter->parse($value->data, ["markdown"]);
            $value->data = $this->tokenTruncate($value->data, 200);
        }
        return $resultset;
    }


    /**
     * Create a slug of a string, to be used as url.
     *
     * @param string $str the string to format as slug.
     *
     * @return str the formatted slug.
     */

    protected function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(['å','ä'], 'a', $str);
        $str = str_replace('ö', 'o', $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        $slugCount = $this->handleExistingSlug($str);
        $slug = "";

        if ($slugCount > 0) {
            $slug = $str . "-" . $slugCount;
            $slugCount2 = $this->handleExistingSlug($slug);
            if ($slugCount2 > 0) {
                $slug = $str . "-" . $slugCount + $slugCount2;
            }
        }
        return $slug;
    }

    /**
     * Checks and handles if slug is already existing in the table.
     *
     * @param $slug string
     * @return int count
     */
    protected function handleExistingSlug($slug)
    {
        $this->db->connect();
        $sql = "SELECT COUNT(slug) AS count FROM $this->table WHERE slug = ?;";
        $resultset = $this->db->executeFetch($sql, [$slug]);
        return $resultset->count;
    }

    /**
     * Inserts and entry in the table.
     * @param array with parameters.
     *
     * @return int id
     */

    public function create($params)
    {
        $this->db->connect();
        $sql = "INSERT INTO $this->table (title, path, slug, data, type) VALUES (?, ?, ?, ?, ?);";
        $this->db->execute($sql, $params);
        $id = $this->db->lastInsertId();
        return $id;
    }

    /**
     * Gets one post from the table.
     *
     * @return object
     * @param $id Content id
     */

    public function getContent($id)
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE id = ?;";
        $content = $this->db->executeFetch($sql, [$id]);
        $content->data = $this->filter->parse($content->data, ["markdown"]);
        return $content;
    }

    /**
     * Truncates string to nearest word closes to specefied letter count..
     *
     * @return string
     * @param string $string
     * @param int $desiredWidth
     */

    public function tokenTruncate($string, $desiredWidth)
    {
        $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
        $countParts = count($parts);

        $length = 0;
        $lastParts = 0;
        for (; $lastParts < $countParts; ++$lastParts) {
            $length += strlen($parts[$lastParts]);
            if ($length > $desiredWidth) {
                break;
            }
        }
        return implode(array_slice($parts, 0, $lastParts)) . "...";
    }

    /**
     * Gets the three latest posts in the table of specefied type.
     *
     * @return object
     * @param string $type
     */

    public function getLatest($type)
    {
        $this->db->connect();
        $sql = <<<EOD
SELECT *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM $this->table WHERE type = ? ORDER BY created LIMIT 3;
EOD;
        $content = $this->db->executeFetchAll($sql, [$type]);
        foreach ($content as $value) {
            $value->data = $this->filter->parse($value->data, ["markdown"]);
            $value->data = $this->tokenTruncate($value->data, 200);
        }
        return $content;
    }

    /**
     * Update the content in the table.
     *
     * @param $params Content information to update
     * @return void
     */
    public function updateContent($params)
    {
        $this->db->connect();
        $sql = "UPDATE $this->table SET title=?, path=?, slug=?, data=?, type=?, published=? WHERE id = ?;";
        $this->db->execute($sql, $params);
    }

    /**
     * Delete one post from the table.
     *
     * @param int $id
     * @return void
     */
    public function deleteContent($id)
    {
        $this->db->connect();
        $sql = "UPDATE $this->table SET deleted=NOW() WHERE id = ?;";
        $this->db->execute($sql, [$id]);
    }

    /**
     * Gets all post from the table for the admin view.
     *
     * @return object
     */
    public function adminContent()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }

    /**
     * Gets all offers from the table.
     *
     * @return object
     */
    public function offerContent()
    {
        $this->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM $this->table
WHERE type=?
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, ["offer"]);
        foreach ($resultset as $value) {
            $value->data = $this->filter->parse($value->data, ["markdown"]);
            $value->data = $this->tokenTruncate($value->data, 200);
        }
        return $resultset;
    }

    /**
     * Gets all pages from the table.
     *
     * @param string $path
     * @return object
     */
    public function pageGetContent($path)
    {
        $this->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM $this->table
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;
        $resultset = $this->db->executeFetch($sql, [$path, "page"]);
        $resultset->data = $this->filter->parse($resultset->data, ["markdown"]);
        return $resultset;
    }

    /**
     * Gets all post from the table by specefied type.
     *
     * @param string $type
     * @return object
     */
    public function blogContent($type)
    {
        $this->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM $this->table
WHERE type=?
ORDER BY published DESC
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, [$type]);
        foreach ($resultset as $value) {
            $value->data = $this->filter->parse($value->data, ["markdown"]);
            $value->data = $this->tokenTruncate($value->data, 200);
        }
        return $resultset;
    }

    /**
     * Gets specefied post from the table.
     *
     * @param string $path
     * @return object
     */
    public function blogpostGetContent($path)
    {
        $this->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM $this->table
WHERE
    slug = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;
        $resultset = $this->db->executeFetch($sql, [$path]);
        $resultset->data = $this->filter->parse($resultset->data, ["markdown"]);
        return $resultset;
    }

    /**
     * handleExistingPath in the table.
     *
     * @param string $path
     */
    protected function handleExistingPath($path)
    {
        $this->db->connect();
        $sql = "SELECT COUNT(path) AS count FROM $this->table WHERE path = ?;";
        $resultset = $this->db->executeFetch($sql, [$path]);
        return $resultset->count;
    }
}
