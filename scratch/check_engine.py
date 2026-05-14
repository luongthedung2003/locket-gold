import requests
import json

url = "http://127.0.0.1:8080/api/resolve"
data = {"username": "thedung_106"}

try:
    response = requests.post(url, json=data)
    print(f"Status: {response.status_code}")
    print(f"Response: {response.text}")
except Exception as e:
    print(f"Error: {e}")
