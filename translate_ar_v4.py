
import json
import re

file_path = '/home/alzubair/my_projects/qrcode_menus/lang/ar.json'

with open(file_path, 'r') as f:
    data = json.load(f)

translations = {
    # Customer/Driver/User Fields
    "Customer name": "اسم العميل",
    "Customer email": "بريد العميل",
    "Customer phone": "هاتف العميل",
    "Driver name": "اسم السائق",
    "Driver email": "بريد السائق",
    "Driver phone": "هاتف السائق",
    "User name": "اسم المستخدم",
    "User email": "بريد المستخدم",
    "User phone": "هاتف المستخدم",
    "Custom note": "ملاحظة خاصة",
    
    # Validation / Prompts
    "Please select address first.": "يرجى اختيار العنوان أولاً.",
    "Please select table.": "يرجى اختيار الطاولة.",
    "Please enter phone number.": "يرجى إدخال رقم الهاتف.",
    "Please wait": "يرجى الانتظار",
    "Please subscribe to a plan first": "يرجى الاشتراك في خطة أولاً",
    "There is not enough PHP memory_limit. Please refer to docs on how to increase to at least 512MB": "ذاكرة PHP غير كافية. يرجى مراجعة الوثائق لزيادتها إلى 512 ميجابايت على الأقل.",
    
    # Order Status / Notifications
    "Your order has been accepted. We are now working on it!": "تم قبول طلبك. نحن نعمل عليه الآن!",
    "Your order is ready for delivery. Expect us soon.": "طلبك جاهز للتوصيل. انتظرنا قريباً.",
    "Your order is ready for pickup. We are expecting you.": "طلبك جاهز للاستلام. نحن بانتظارك.",
    "Unfortunately your order is rejected. There where issues with the order and we need to reject it. Pls contact us for more info.": "للأسف تم رفض طلبك لوجود مشاكل. يرجى الاتصال بنا للمزيد من المعلومات.",
    "Your order has been accepted": "تم قبول طلبك",
    "We are now working on it!": "نحن نعمل عليه الآن!",
    "There is new order for you.": "يوجد طلب جديد لك.",
    "There is new order assigned to you.": "تم تعيين طلب جديد لك.",
    "Your order is ready.": "طلبك جاهز.",
    "Order rejected": "تم رفض الطلب",
    "Order notification": "إشعار الطلب",
    "Order items": "عناصر الطلب",
    "Order reviews": "تقييمات الطلب",
    "reviews": "التقييمات",
    "Rating has been removed": "تم إزالة التقييم",
    "Automatically approved by admin": "تمت الموافقة تلقائياً بواسطة المسؤول",
    "Automatically apprved by admin": "تمت الموافقة تلقائياً بواسطة المسؤول", # Handling typo in source
    
    # Options & Variants
    "Variants for": "متغيرات لـ",
    "New variant for": "متغير جديد لـ",
    "Variant has been added": "تم إضافة المتغير",
    "Edit variant": "تعديل المتغير",
    "Variant has been updated": "تم تحديث المتغير",
    "Variant has been removed": "تم إزالة المتغير",
    "Options for": "خيارات لـ",
    "New option for": "خيار جديد لـ",
    "Option has been added": "تم إضافة الخيار",
    "Edit option": "تعديل الخيار",
    "Option has been updated": "تم تحديث الخيار",
    "Option has been removed": "تم إزالة الخيار",
    "No options values selected": "لم يتم تحديد قيم للخيارات",
    "First, you will need to add some options. Add the item first option now": "أولاً، تحتاج لإضافة بعض الخيارات. أضف الخيار الأول للعنصر الآن",
    
    # Restaurant / Frontend
    "All restaurants delivering to your address": "جميع المطاعم التي توصل لعنوانك",
    "All restaurants": "جميع المطاعم",
    "Popular restaurants": "مطاعم شائعة",
    "Popular restaurants near you": "مطاعم شائعة بالقرب منك",
    "Featured restaurants": "مطاعم مميزة",
    "The selected restaurant is not active at this moment!": "المطعم المحدد غير نشط حالياً!",
    "You can't add items from other restaurant!": "لا يمكنك إضافة عناصر من مطعم آخر!",
    "Cart clear.": "تم إفراغ السلة.",
    "where you can find": "حيث يمكنك أن تجد",
    
    # Errors & Misc
    "The current password field does not match your password": "حقل كلمة المرور الحالية لا يطابق كلمة مرورك",
    "Areas": "المناطق",
    "Settings not allowed to be updated in DEMO mode!": "لا يسمح بتحديث الإعدادات في الوضع التجريبي!",
}

# Apply Translations
count = 0
for key, value in data.items():
    if key in translations:
        # Update if not already translated or if matches English
        if data[key] == key or data[key] in translations:
             data[key] = translations[key]
             count += 1
    
    # Heuristic for "Variants for [Item]"
    elif "Variants for" in key and "Variants for" not in data[key]:
        data[key] = key.replace("Variants for", "متغيرات لـ")
        count += 1
    elif "Options for" in key and "Options for" not in data[key]:
        data[key] = key.replace("Options for", "خيارات لـ")
        count += 1

print(f"Updated {count} keys in V4 batch.")

with open(file_path, 'w', encoding='utf-8') as f:
    json.dump(data, f, indent=4, ensure_ascii=False)
