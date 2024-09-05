import sys
import requests

# print("Using Python interpreter:", sys.executable)

def get_lat_lng(api_key, address):

    url = f'https://maps.googleapis.com/maps/api/geocode/json?address={address}&key={api_key}'
    response = requests.get(url)
    data = response.json()

    if data['status'] == 'OK':

        lat = data['results'][0]['geometry']['location']['lat']
        lng = data['results'][0]['geometry']['location']['lng']
        return lat, lng
    
    else:
        return None, None

if __name__ == "__main__":

    api_key = 'AIzaSyCLA-y_KIn9AEARY-0tvo18SRsctgVx67Q'

    address = sys.argv[1]

    lat, lng = get_lat_lng(api_key, address)

    if lat and lng:
        print(f"{lat},{lng}")
    else:
        # 無効な住所の場合はエラーメッセージを表示
        print("Invalid address")