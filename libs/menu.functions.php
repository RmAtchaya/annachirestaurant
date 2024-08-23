<?php
// PROJECT RELATED FUNCTIONS
class PHP_fun 
{
	function getConfig()
	{
           //include("menu.config.php");
            include "masterConfig.php";

            global $dbhost;
            global $dbdatabase;
            global $dbuser;
            global $dbpass;

			$this->SITE_URL = "";
			$this->DB_SERVER    = $dbhost;
			$this->DB_USER      = $dbuser;
			$this->DB_PASS      = $dbpass;
			$this->DB_NAME      = $dbdatabase;
	}
	
	function __construct()
	{
			$this->getConfig();
			$Conn = mysql_connect($this->DB_SERVER, $this->DB_USER, $this->DB_PASS);
			if (!$Conn)
			
				die("Error: ".mysql_errno($Conn).":- ".mysql_error($Conn));
			$DB_select = mysql_select_db($this->DB_NAME, $Conn);
			if (!$DB_select)
				die("Error: ".mysql_errno($Conn).":- ".mysql_error($Conn));
	}

	function select_row($sql)
	{
			//echo $sql . "<br />";
		if ($sql!="")
		{
				$result = mysql_query($sql) or die("Error: ".mysql_errno().":- ".mysql_error());
				if ($result)
				{
					while($row = mysql_fetch_array($result))
						$data[] = $row;
				}
				return $data;
		}
	}

	function recordCount($sql)
	{
		if ($sql!="")
		{
			$result = mysql_query($sql) or die("Error: ".mysql_errno().":- ".mysql_error());
			if ($result)
			{
				$cnt = mysql_num_rows($result);
				return $cnt;
			}
		}
	}

	function createProductUrl($url)
	{
		$url = trim($url);
		if ($url != "")
		{
			$url = trim(str_replace(" ","-",$url));
			//return $url.".html";
			return $url;
		}
	}

    function getLink($linkType, $linkID)
    {
            //
            //        Page / Link Type
            //        1 = Articles;
            //        2 = News;
            //        3 = Blog;
            //        4 = Contacts
            //        5 = Services
            //        6 = Products
            //

         $link = "#";
         switch($linkType)
         {
                case "1":
                    $link = "pages.php?aid=" . $linkID;
                    break;

                case "2":
                    $link = "news.php";
                    break;

                case "3":
                    $link = "blog.php";
                    break;

                case "4":
                    $link = "contact.php";
                    break;

                case "5":
                    $link = "services.php";
                    break;

                case "6":
                    $link = "products.php";
                    break;

        }
        return $link;
   }

	function getChild($id)
	{
		$this->getConfig();
		$menu = "";
		$str = "";
		$s = "select id, menuLabel, parentID, linkID, linkType from menu where parentID = '$id' AND active = 1 order by sorder ASC ";
		$res = $this->select_row($s);

        if($this->recordCount($s) > 0)
        {
           $menu .= "<ul class=sub-menu>";
        }

		for ($i=0;$i<count($res);$i++)
		{
	         if($res[$i][linkType] == '6') //Products
             {
                  $menu .= $str . "<li> <a href='products_info.php?pid=". $res[$i][linkID] . "'>" . $res[$i][menuLabel] . "</a>"  ;
             }
             elseif($res[$i][linkType] == '5') //Services
             {
                  $menu .= $str . "<li> <a href='services_info.php?sid=" . $res[$i][linkID] . "'>" . $res[$i][menuLabel] . "</a>"  ;
             }
             else //Others
             {
                  $menu .= $str . "<li> <a href='". getLink($res[$i][linkType], $res[$i][linkID]) . "'>" . $res[$i][menuLabel] . "</a>"  ;
     	     }
			 
			$menu .= $this->getChild($res[$i][id]);
            $menu .=  "</li>";

		}

	    if($this->recordCount($s) > 0)
        {
           $menu .= "</ul>";
        }
		return $menu;
	}
	function getMenu($parentid)
	{
		$this->getConfig();
		$menu = "";

        if($parentid == 0)
        {
           $s = "select id, menuLabel, parentID, linkID, linkType from menu where (parentID = '$parentid' OR parentID = '' OR parentID IS NULL )AND active = 1 ORDER BY sorder ASC";
        }
        else
        {
          $s = "select id, menuLabel, parentID, linkID, linkType from menu where parentID = '$parentid' AND active = 1 ORDER BY sorder ASC";
        }
        $res = $this->select_row($s);
		ob_start();
?>
<?php
	for ($i=0; $i<count($res); $i++)
	{
?>
     <li>
		    <? echo "<a href='". getLink($res[$i][linkType], $res[$i][linkID])   ."'>" . $res[$i][menuLabel] . "</a>"; ?>
            <? echo $this->getChild($res[$i][id])?>
	 </li>
<?php
    }
?>
<?php
		$menu = ob_get_contents();
		ob_end_clean();
		return $menu;
	}
}//class PHP_fun()
?>	