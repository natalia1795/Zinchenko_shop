<?php
include_once ROOT.'/components/Db.php';


class News
{


    public static function getNewsItemById($id)
    {
        $db=DB::getConnection();
        $id = intval ($id);


        $result = $db->query('SELECT * FROM news WHERE id='.$id);

       $result->setFetchMode(PDO::FETCH_ASSOC);
       $newsItem =$result->fetch();
        return $newsItem;

    }

    public static function getNewsList()
    {

        $db=DB::getConnection();

        $newsList = array();

        $result = $db->query('SELECT id, title, date, short_content FROM news');
          //  . 'ORDER BY date DESC'
         //   . 'LIMIT 5');

        $i = 0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }
        return $newsList;

    }
}