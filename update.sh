#Settings
downloadpath="/home/xxxxx/data/drupalversions"
sitepath="/home/xxxxx/domains"
htmlfolder="/html"
scriptdata="/home/xxxxx/data"

# Input for version to dowload
clear
echo "Please enter drupal version to download (ex.: 7.22) : "
read drupalversion

# Download
echo ""
echo "Downloading to $downloadpath/$drupalversion"
echo ""

# Download version
mkdir -p $downloadpath
cd $downloadpath
curl -o drupal-$drupalversion.tar.gz http://ftp.drupal.org/files/projects/drupal-$drupalversion.tar.gz

# Extract
tar -zxf $downloadpath/drupal-$drupalversion.tar.gz

# Input for wbesite to update
echo ""
echo "Please enter sitename to update : "
read sitename
echo ""

# Sync downloaded folder to html folder
rsync -a --progress --exclude='sites/' --exclude='*/.DS_Store' $downloadpath/drupal-$drupalversion/ $sitepath/$sitename$htmlfolder

echo ""
echo "Update complete. You still need to run database updates manually."
echo ""

# Run version script
sh $scriptdata/versions.sh