title1="start webserver"
#title2="start npm run watch"
title3="start lamp"
title2="start github commands"

cmd1="symfony server:start --port=4321 --passthru=front.php"
#cmd2="npm run watch"
cmd3="sudo /opt/lampp/lampp start"



gnome-terminal --tab --title="$title1" --command="bash -c '$cmd1; $SHELL'" \
               --tab --title="$title2" \
               --tab --title="$title3" --command="bash -c '$cmd3; $SHELL'"
