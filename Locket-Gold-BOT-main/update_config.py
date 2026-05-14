"""Script to extract tokens from apii.txt and update config.py"""
import re

# Read apii.txt
with open("apii.txt", "r", encoding="utf-8") as f:
    api_content = f.read()

# Extract values using regex
fetch_token = re.search(r'"fetch_token":\s*"([^"]+)"', api_content).group(1)
app_transaction = re.search(r'"app_transaction":\s*"([^"]+)"', api_content).group(1)
hash_params = re.search(r"'x-post-params-hash':\s*\"([^\"]+)\"", api_content).group(1)
hash_headers = re.search(r"'x-headers-hash':\s*\"([^\"]+)\"", api_content).group(1)

print(f"fetch_token length: {len(fetch_token)}")
print(f"app_transaction length: {len(app_transaction)}")
print(f"hash_params: {hash_params}")
print(f"hash_headers: {hash_headers}")

# Read config.py
with open("app/config.py", "r", encoding="utf-8") as f:
    config_content = f.read()

# Build new TOKEN_SETS
new_token_sets = f'''TOKEN_SETS = [
    {{
        "fetch_token": "{fetch_token}",
        "app_transaction": "{app_transaction}",
        "hash_params": "{hash_params}",
        "hash_headers": "{hash_headers}",
        "is_sandbox": False,
    }},
]'''

# Replace TOKEN_SETS block
config_content = re.sub(
    r'TOKEN_SETS = \[.*?\]', 
    new_token_sets, 
    config_content, 
    flags=re.DOTALL
)

# Set NUM_WORKERS to 1 (only 1 token set)
config_content = config_content.replace("NUM_WORKERS = 2", "NUM_WORKERS = 1")

# Write updated config
with open("app/config.py", "w", encoding="utf-8") as f:
    f.write(config_content)

print("\n✅ config.py updated successfully!")
print(f"- TOKEN_SETS: 1 token set configured")
print(f"- NUM_WORKERS: 1")
print(f"- is_sandbox: False")
