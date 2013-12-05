echo "compile start"
coffee -bc ./data/javascripts/*
echo "coffee complie success"
echo "less compile start"
lessc ./data/stylesheets/less/* > ./data/stylesheets/style.css
echo "less compile success"
