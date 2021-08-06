<?php 

    include ("../scrapper/simple_html_dom.php");

    function downloadImage($folder, $imageURL){
        exec("mkdir '" . $folder . "'; wget -P '" . $folder . "' -U 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.27 Safari/537.17' ".$imageURL." ");
    }
    function getHTML($url){
        exec("wget -U 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.27 Safari/537.17' ".$url." -O a.html");
        return file_get_contents("a.html");
    }

    getHTML("https://colnect.com/en/gift_cards/list/country/225-United_States_of_America/company/16605-Academy/page/1");
    $html = file_get_html("a.html");

    $numberOfPages = $html -> find (".navigation_box", 0) -> find ("div", 1) -> find ("a");
    $folderName = "pictures/" . $html -> find (".filter_one", 1) -> find ("a", 1) -> plaintext;

    $pictures = $html -> find (".item_thumb");
    foreach($pictures as $pic){
        $imageURL = str_replace("//", "https://", $pic -> find (".lzy", 1) -> getAttribute("data-src"));
        $imageURL = str_replace("/t/", "/b/", $imageURL);
        downloadImage($folderName, $imageURL);
        //echo $imageURL . "\n";
    }

    for ($i = 0; $i < sizeof($numberOfPages) - 2; $i++){
        $otherPagesLinks = "https://colnect.com" . $numberOfPages[$i] -> href . "\n" ;
        getHTML($otherPagesLinks);
        $html = file_get_html("a.html");

        $pictures = $html -> find (".item_thumb");
        foreach($pictures as $pic){
            $imageURL = str_replace("//", "https://", $pic -> find (".lzy", 1) -> getAttribute("data-src"));
            $imageURL = str_replace("/t/", "/b/", $imageURL);
            downloadImage($folderName, $imageURL);
            //echo $imageURL . "\n";
        }


    }


?>