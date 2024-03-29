<?php
    namespace add;
    use DOMDocument;
    function getHTMLFromURL ($data)
    {
        return file_get_contents($data);
    }

    function parseImagesFromHTML ($html)
    {
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $tags = $doc->getElementsByTagName('img');
        $images = [];
        foreach ($tags as $tag) {
            $images[]= $tag->getAttribute('src');
        }
        return $images;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['url'])) {
        $data = $_POST['url'];
        $htm = getHTMLFromURL($data);
        $images = parseImagesFromHTML($htm);
            if (!empty($images)) {
                http_response_code(200);
                echo json_encode($images);
            } else {
                http_response_code(404);
            }
    }



