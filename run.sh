echo "compile start"
coffee -bc ./
echo "coffee complie success"
echo "less compile start"
stylus ./data/stylesheets/*
echo "less compile success"
