# Get data from weatherapi.com
API_TOKEN="864dbf6bb86c46749ef43815232803"
LOCATION="Cleveland"
OUTPUT="data/weather.json"

echo "Getting weather data..."
wget -O $OUTPUT "http://api.weatherapi.com/v1/current.json?key=$API_TOKEN&q=$LOCATION"
echo "Finished weather data"
