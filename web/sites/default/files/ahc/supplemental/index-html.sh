#!/bin/sh

# Use this file like this: 
# sudo bash -c 'ls -I index-html.sh -I script.sh | ./index-html.sh > index.html'
#
# exclude other files by adding more like "-I index-html.sh" 
# (-I means "ignore") 

echo '<html><body><h1>Austin History Center - Supplemental Files</h1><ul>'
sed 's/^.*/<li><a href="&">&<\/a><\/li>/'
echo '</ul></body></html>'
