<?php
use App\Restorant;
use App\User;
use App\Categories;
use App\Items;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Create Owner
    $owner = new User();
    $owner->name = "Test Owner";
    $owner->email = "owner_test_".Str::random(5)."@example.com";
    $owner->password = Hash::make("secret");
    $owner->api_token = Str::random(80);
    $owner->save();
    
    // Check if role exists
    if (Role::where('name', 'owner')->exists()) {
        $owner->assignRole('owner');
    }

    // Create Restaurant
    $restaurant = new Restorant();
    // Using array direct to test Translatable trait
    $restaurant->setTranslations('name', ['en' => 'Test Restaurant EN', 'ar' => 'مطعم تجريبي']);
    $restaurant->setTranslations('description', ['en' => 'Test Description EN', 'ar' => 'وصف تجريبي']);
    $restaurant->setTranslations('address', ['en' => 'Test Address EN', 'ar' => 'عنوان تجريبي']);
    $restaurant->user_id = $owner->id;
    $restaurant->phone = "12345678";
    $restaurant->subdomain = "test-multi-lang-".Str::random(5);
    $restaurant->logo = "";
    $restaurant->cover = "";
    $restaurant->save();

    // Create Category
    $category = new Categories();
    $category->setTranslations('name', ['en' => 'Food EN', 'ar' => 'طعام']);
    $category->company_id = $restaurant->id;
    $category->save();

    // Create Item
    $item = new Items();
    $item->setTranslations('name', ['en' => 'Pizza EN', 'ar' => 'بيتزا']);
    $item->setTranslations('description', ['en' => 'Cheesy Pizza EN', 'ar' => 'بيتزا بالجبن']);
    $item->price = 10;
    $item->category_id = $category->id;
    $item->image = "";
    $item->save();

    echo "SUCCESS\n";
    echo "Restaurant ID: " . $restaurant->id . "\n";
    echo "Subdomain: " . $restaurant->subdomain . "\n";
    
    // Verify translations
    app()->setLocale('en');
    echo "EN Name: " . $restaurant->name . " | Category: " . $category->name . " | Item: " . $item->name . "\n";
    
    app()->setLocale('ar');
    echo "AR Name: " . $restaurant->name . " | Category: " . $category->name . " | Item: " . $item->name . "\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
