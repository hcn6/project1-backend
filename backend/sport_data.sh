# Get data from weatherapi.com
API_TOKEN="864dbf6bb86c46749ef43815232803"
LOCATION="United States"
OUTPUT="data/sport.json"

echo "Getting sport data..."
wget -O $OUTPUT "http://api.weatherapi.com/v1/sports.json?key=$API_TOKEN&q=$LOCATION"
echo "Finished sport data"