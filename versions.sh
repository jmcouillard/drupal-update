root=~/domains
output=~/domains/jmcouillard.com/html/ext/versions/versions.json

# Go to root
cd $root;

# Remove current json file
rm $output;

# Create a new json
touch $output;

echo '{"list": [' >> $output

for DIR in $root; do

# This is the file to read to find drupal version
file=$DIR/html/CHANGELOG.txt;

if [ -f $file ]
then

a=0;

c='';
if [[ $count -ge 1 ]]
then
c=',';
fi

while read line
do

# Increment lines count
(( a++ ))

# Output json
if [[ "$line" = Drupal* ]]
then
echo "$c{\"version\": \"$line\", \"file\": \"$file\", \"line\" : \"$a\"}" >> $output;
((count++));
break;
fi

done <$file

fi

done

echo ']}' >> $output
