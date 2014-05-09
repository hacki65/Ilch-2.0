<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Ilch\Database\Mysql;

class Insert extends QueryBuilder
{
    /** @var  array */
    protected $values;

    /**
     * @param array|null $values values as [name => value]
     * @param string|null $into table without prefix
     */
    public function __construct($values = null, $into = null)
    {
        if (isset($values)) {
            $this->values($values);
        }
        if (isset($into)) {
            $this->into($into);
        }
    }

    /**
     * @param array $values values as [name => value]
     * @return Update
     */
    public function values(array $values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @param $table table without prefix
     * @return Update
     */
    public function into($table)
    {
        $this->table = (string) $table;
        return $this;
    }

    /**
     * @todo remove after updating modules
     * @deprecated
     * @param array $values
     * @return Update
     */
    public function fields(array $values)
    {
        return $this->values($values);
    }

    /**
     * Execute the query builder.
     *
     * @return integer generated autoincrement primary key
     */
    public function execute()
    {
        $this->db->query($this->generateSql());
        return $this->db->getLastInsertId();
    }

    /**
     * Gets delete query builder sql.
     *
     * @return string
     * @throws \RuntimeException
     */
    public function generateSql()
    {
        if (!isset($this->table)) {
            throw new \RuntimeException('table must be set');
        }

        $sql = 'INSERT INTO ' . $this->db->quote('[prefix]_'.$this->table). ' (';
        $sqlFields = $sqlValues = [];

        if (!empty($this->values)) {
            foreach ($this->values as $key => $value) {
                if ($value === null) {
                    continue;
                }

                $sqlFields[] = $this->db->quote($key);
                $sqlValues[] = $this->db->escape($value);
            }
        }

        if (empty($sqlFields)) {
            throw new \RuntimeException('no valid values for insert');
        }

        $sql .= implode(',', $sqlFields);
        $sql .= ') VALUES (';

        $sql .= implode(',', $sqlValues) . ')';

        return $sql;
    }
}
