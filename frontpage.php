<?php

require_once 'db.php';

   $sql = "SELECT * FROM  CmsTabel where publish=true ORDER BY date DESC  ";
   $stmt = $db->prepare($sql);
   $stmt->execute();
   $div =  "<section class='posts'>";
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $titel = htmlspecialchars($row["titel"]);
      $content = htmlspecialchars($row["content"]);
      $link = ($row["link"]);
      $image = '../admin/images/' . htmlspecialchars($row["image"]);
      $id = htmlspecialchars($row["id"]);
      $created_at = htmlspecialchars($row["date"]);
      $date = date_format(date_create($created_at), "Y/m/d");
      $text = '<p>' . implode("</p>\n\n<p>", explode("\n", trim($content))) . '</p>';
      parse_str(parse_url($link, PHP_URL_QUERY), $url_vars);
      $youtubeID = $url_vars['v'];
      $div .= "
      <div class='frontpage'>
      <h2 class='title'>$titel</h2>
      <div class='text'>$text </div>
      <div class=image>
      <img src=" . $image . " style='height:300px; width:300px; padding: 20px;'/ >
      </div>
      <iframe width='420' height='315' padding: 10px
       src='http://www.youtube.com/embed/$youtubeID?autoplay=1'>
        </iframe>
       <div class='date'>Last published date:$date</div>
      </div>";
   }
   echo $div .= "</section>";