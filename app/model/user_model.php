<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;

class postModel
{
    private $db;
    private $table = 's_status';

    private $response;

    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }



    public function countPostByUser()
    {
		try
		{
			$result = array();

      $stm = $this->db->prepare(
        "SELECT user_nicename, COUNT(status_content) AS 'Total post'
        FROM slim.s_status
        INNER JOIN slim.s_users ON slim.s_status.user_id = slim.s_users.ID
        GROUP BY user_nicename
        "
      );

			//$stm = $this->db->prepare("SELECT * FROM $this->table");
			$stm->execute();

			$this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();

            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }


    public function countPostByDate()
    {
		try
		{
			$result = array();

      $stm = $this->db->prepare(
        "SELECT status_time, COUNT(status_time) AS 'Total post'
        FROM slim.s_status
        GROUP BY status_time
        "
      );

			//$stm = $this->db->prepare("SELECT * FROM $this->table");
			$stm->execute();

			$this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();

            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }



    public function GetAll()
    {
		try
		{
			$result = array();

      $stm = $this->db->prepare(
        "SELECT user_nicename, status_content, status_time
        FROM slim.s_status
        INNER JOIN slim.s_users ON slim.s_status.user_id = slim.s_users.ID;"
      );

			//$stm = $this->db->prepare("SELECT * FROM $this->table");
			$stm->execute();

			$this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();

            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }

    public function Get($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
			$stm->execute(array($id));

			$this->response->setResponse(true);
            $this->response->result = $stm->fetch();

            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }


}
