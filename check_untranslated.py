
import json

file_path = '/home/alzubair/my_projects/qrcode_menus/lang/ar.json'

with open(file_path, 'r') as f:
    data = json.load(f)

untranslated = []
for key, value in data.items():
    # Basic check: if value matches key, or value contains no Arabic characters
    if key == value:
        untranslated.append(key)

print(f"Total untranslated keys: {len(untranslated)}")
print("Sample of untranslated keys:")
for k in untranslated[:50]:
    print(f"- {k}")
