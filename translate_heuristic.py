
import json
import re

file_path = '/home/alzubair/my_projects/qrcode_menus/lang/ar.json'

with open(file_path, 'r') as f:
    data = json.load(f)

# Dictionary for entities
entities = {
    "User": "المستخدم",
    "Driver": "السائق",
    "Item": "العنصر",
    "Items": "العناصر",
    "Restaurant": "المطعم",
    "Restaurants": "المطاعم",
    "Category": "الفئة",
    "City": "المدينة",
    "Cities": "المدن",
    "Plan": "الخطة",
    "Plans": "الخطط",
    "Page": "الصفحة",
    "Pages": "الصفحات",
    "Address": "العنوان",
    "Order": "الطلب",
    "Orders": "الطلبات",
    "Role": "الدور",
    "Permission": "الصلاحية",
    "Client": "العميل",
    "Clients": "العملاء",
    "Coupon": "الكوبون",
    "Coupons": "الكوبونات",
    "Banner": "اللافتة",
    "Banners": "اللافتات",
    "Table": "الطاولة",
    "Tables": "الطاولات",
    "Feature": "الميزة",
    "Features": "الميزات",
    "Testimonial": "التزكية",
    "Testimonials": "التزكيات",
    "Process": "العملية",
    "Processes": "العمليات",
    "Allergen": "مسبب الحساسية",
    "Allergens": "مسببات الحساسية",
    "Menu": "القائمة",
    "Option": "الخيار",
    "Options": "الخيارات",
    "Variant": "المتغير",
    "Variants": "المتغيرات",
    "Extra": "الإضافي",
    "Extras": "الإضافات",
    "Payment": "الدفع",
    "Subscription": "الاشتراك",
    "Invoice": "الفاتورة"
}

# Dictionary for actions (past tense for "was/successfully")
actions_past = {
    "created": "إنشاء",
    "updated": "تحديث",
    "deleted": "حذف",
    "added": "إضافة",
    "removed": "إزالة",
    "imported": "استيراد",
    "deactivated": "تعطيل",
    "activated": "تفعيل",
    "restored": "استعادة",
    "saved": "حفظ",
    "modified": "تعديل"
}

# Actions command/present
actions_command = {
    "Edit": "تعديل",
    "Add": "إضافة",
    "Delete": "حذف",
    "Manage": "إدارة",
    "View": "عرض",
    "Update": "تحديث",
    "Create": "إنشاء",
    "Search": "بحث",
    "Select": "تحديد",
    "Show": "عرض",
    "Hide": "إخفاء",
    "Remove": "إزالة"
}

count = 0

for key, value in data.items():
    # Only translate if untranslated (value matches key) or contains English
    if value != key and not re.search(r'[a-zA-Z]', value):
        continue

    original_key = key
    new_value = key # Start with original

    # Pattern 1: "[Entity] successfully [action]" -> "تم [action] [Entity] بنجاح"
    # Example: "User successfully created." -> "تم إنشاء المستخدم بنجاح."
    match = re.match(r"^(\w+) successfully (\w+)[.!]*$", key)
    if match:
        ent, act = match.groups()
        if ent in entities and act in actions_past:
             new_value = f"تم {actions_past[act]} {entities[ent]} بنجاح."

    # Pattern 2: "[Entity] was [action]" -> "تم [action] [Entity]"
    # Example: "City was added" -> "تم إضافة المدينة"
    if new_value == key:
        match = re.search(r"^(\w+) was (\w+)[.!]*$", key)
        if match:
            ent, act = match.groups()
            if ent in entities and act in actions_past:
                new_value = f"تم {actions_past[act]} {entities[ent]}"

    # Pattern 3: "[Action] [Entity]" -> "[Action_Ar] [Entity_Ar]"
    # Example: "Edit city" -> "تعديل المدينة", "Add new user" -> "إضافة مستخدم جديد" (handling 'new' separately)
    if new_value == key:
        # Handle "Add new [Entity]"
        match = re.match(r"^Add new (\w+)$", key, re.IGNORECASE)
        if match:
            ent = match.group(1)
            # Find closest matching entity (case insensitive)
            for e_key, e_val in entities.items():
                if e_key.lower() == ent.lower():
                    new_value = f"إضافة {e_val} جديد"
                    break
        
        # Handle "[Action] [Entity]"
        if new_value == key:
            match = re.match(r"^(\w+) (\w+)$", key)
            if match:
                act, ent = match.groups()
                if act in actions_command and ent in entities:
                    new_value = f"{actions_command[act]} {entities[ent]}"
                elif act in actions_command and ent + "s" in entities: # Singular action, plural entity? unlikely but maybe "Manage Drivers"
                     new_value = f"{actions_command[act]} {entities[ent+'s']}"
    
    # Pattern 4: "[Entity] Management"
    if new_value == key:
        match = re.match(r"^(\w+) Management$", key)
        if match:
            ent = match.group(1)
            if ent in entities:
                new_value = f"إدارة {entities[ent]}"
            elif ent[:-1] in entities: # Plural s check roughly
                 new_value = f"إدارة {entities[ent[:-1]]}"

    # Pattern 5: "[Entity] name/email/phone"
    if new_value == key:
         match = re.match(r"^(\w+) (name|email|phone)$", key, re.IGNORECASE)
         if match:
             ent, field = match.groups()
             field_map = {"name": "اسم", "email": "بريد", "phone": "هاتف"}
             if ent in entities:
                 new_value = f"{field_map[field.lower()]} {entities[ent]}"

    # Apply translation if changed
    if new_value != key:
        data[key] = new_value
        count += 1

print(f"Heuristically updated {count} keys.")

with open(file_path, 'w', encoding='utf-8') as f:
    json.dump(data, f, indent=4, ensure_ascii=False)
