<?php 

$num_list = isset($num_list) ? intval($num_list) : 3;

//Get a list with most commented articles in the site
$sql = <<<SQL

SELECT 
    cmt_article, COUNT(*) AS total_comments,
    art_title, art_summary, art_thumbnail
FROM comment 
    INNER JOIN article ON cmt_article = art_id 
WHERE 
    cmt_status = 'on' 
AND art_status = 'on' 
AND art_date <= NOW()
GROUP BY cmt_article
ORDER BY total_comments DESC
LIMIT  {$num_list};
SQL;

// execute the querry and stores result in res
$res = $conn->query($sql);

//Variable that stores the html

// Loop to get each register
if ($res->num_rows >0):

    $aside_cmt = '<h3>Artigos + comentados</h3><div class="viewed">';

    while ($most_cmt = $res->fetch_assoc()) :

        if ($most_cmt['total_comments'] == 1) 
            $tot = '1 comentário.';
        else
            $tot = $most_cmt['total_comments'] . ' comentários';
    
        //Build the HTML
        $aside_cmt .= <<<HTML

        <div class="aside" onclick="location.href = 'view.php?id={$most_cmt['cmt_article']}'">
            
            <img src="{$most_cmt['art_thumbnail']}" alt="{$most_cmt['art_title']}">
            <div>
                <h5>{$most_cmt['art_title']}</h5>
                <p><small title="{most_cmt['art_summary']}">{$most_cmt['art_summary']}</small></p>
                <p class="commented"><small>{$tot}</small></p>
            </div>
        </div>
        HTML;
    endwhile;
endif;
;
// Close aside_cmt
$aside_cmt .= '</div>';


// Send to view
echo $aside_cmt

?>