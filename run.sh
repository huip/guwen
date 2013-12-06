echo "compile start"
coffee -bc ./data/javascripts/*
echo "coffee complie success"
echo "less compile start"
stylus ./data/stylesheets/*
echo "less compile success"
