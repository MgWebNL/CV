<?php

namespace PenD\Docker\Application\Database;

use PDOException;

class Database
{
    private $m_oPDO;

    /**
     * DB::__construct() regel hier de database connectie
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->m_oPDO = $pdo;
    }

    /**
     * DB::saveSql() basis voor insert en update naar de database
     *
     * @param mixed $p_sQuery
     * @return id return de laatste inserted id
     */
    public function saveSQL($p_sQuery)
    {
        try {
            $this->m_oPDO->query($p_sQuery);
            return $this->m_oPDO->lastInsertId();
            $this->m_oPDO = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * DB::selectListSQL()
     * Haalt alles op van het geselecteerde tabel
     *
     * @param mixed $p_sQuery
     * @return arraylist
     */
    public function selectListSQL($p_sQuery)
    { //var_dump($p_sQuery);
        try {
            $oPDOstatement = $this->m_oPDO->query($p_sQuery);
            // $oPDOstatement->getAttribute(PDO::ATTR_EMULATE_PREPARES);
            return $oPDOstatement->fetchall();
            $this->m_oPDO = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * DB::selectSQL()
     * Haalt de rij op van de gevraagde ID
     *
     * @param mixed $p_sQuery
     * @return array
     */
    public function selectSQL($p_sQuery)
    {
        try {
            $oPDOstatement = $this->m_oPDO->query($p_sQuery);
            //$oPDOstatement->getAttribute(PDO::ATTR_EMULATE_PREPARES);
            return $oPDOstatement->fetch();
            $this->m_oPDO = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * DB::deleteSQL()
     * Delete de rij van de gevraagde ID
     *
     * @param mixed $p_sQuery
     * @return void
     */
    public function deleteSQL($p_sQuery)
    {
        try {
            $this->m_oPDO->query($p_sQuery);
            return true;
            $this->m_oPDO = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function delete($p_sTable, $p_sParameters)
    {
        $sQuery = "DELETE FROM " . $p_sTable . " WHERE " . $p_sParameters . "";
        $this->deleteSQL($sQuery);
    }

    public function selectList($p_sSelect, $p_sTable, $p_sConditions)
    {
        $sQuery = "SELECT " . $p_sSelect . " FROM " . $p_sTable . " WHERE " . $p_sConditions . "";
        return $this->selectListSQL($sQuery);
    }

    public function select($p_sSelect, $p_sTable, $p_sConditions)
    {
        $sQuery = "SELECT " . $p_sSelect . " FROM " . $p_sTable . " WHERE " . $p_sConditions . "";
        return $this->selectSQL($sQuery);
    }

    /**
     * DB::save()
     *
     * @param mixed $sTableName
     * @param mixed $aValue
     * @return int
     */
    public function save($sTableName, $aValue, $sPrimaryKey = 'id')
    {
        if (isset($aValue[$sPrimaryKey]) && $aValue[$sPrimaryKey] > 0) {
            // update
            $iID = $aValue[$sPrimaryKey];

            unset($aValue[$sPrimaryKey]);
            unset($aValue["submit"]);

            $sValues = "";
            $i = 1;

            foreach ($aValue as $key => $value) {
                if ($i <= count($aValue)) {
                    if ($key != $sPrimaryKey) {
                        if ($i == count($aValue)) {
                            $sValues .= "`" . $key . "` = '" . $value . "' ";
                        } else {
                            $sValues .= "`" . $key . "` = '" . $value . "', ";
                        }
                    }
                }
                $i++;
            }
            $sQuery = "UPDATE " . $sTableName . " SET " . $sValues . " WHERE id = '" . $iID . "'";
            //echo $sQuery;
        } else {
            // insert
            // echo "insert";
            unset($aValue[$sPrimaryKey]);
            unset($aValue["submit"]);

            $sKeys = "";
            $sValues = "";
            $i = 1;

            foreach ($aValue as $key => $value) {
                if ($i <= count($aValue)) {
                    if ($key != $sPrimaryKey && $key != "submit") {
                        if ($i == count($aValue)) {
                            $sKeys .= "`" . $key . "` ";
                            $sValues .= " '" . $value . "' ";
                        } else {
                            $sKeys .= "`" . $key . "`, ";
                            $sValues .= " '" . $value . "', ";
                        }
                    }
                }
                $i++;
            }
            $sQuery = "INSERT INTO " . $sTableName . " (" . $sKeys . ") VALUES (" . $sValues . ")";
            //echo $sQuery;
        }
        try {
            $this->m_oPDO->query($sQuery);
            return $this->m_oPDO->lastInsertId();
            $this->m_oPDO = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
