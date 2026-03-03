<?php

function embedVideo(
     string $ytLink,
     int $height = 500,
     int $width = 500
) {
     echo "<iframe 
               src=\"$ytLink\" 
               height=\"$height\" 
               width=\"$width\">
          </iframe>";
}

embedVideo(
     "https://www.youtube.com/embed/NsMKvVdEPkw",
     500,
     300
);