<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\MarketPrice;
use App\Models\WeatherData;
use App\Models\AiRecommendation;
use App\Models\Review;
use App\Models\Chat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Categories
        $grains = Category::create([
            'name' => 'Grains & Cereals',
            'slug' => 'grains-cereals',
            'description' => 'Wheat, Rice, Barley, Oats, Millet, and other staple crops.',
            'icon' => 'sprout',
        ]);

        $vegetables = Category::create([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
            'description' => 'Fresh farm-picked organic and naturally grown vegetables.',
            'icon' => 'leaf',
        ]);

        $fruits = Category::create([
            'name' => 'Fruits',
            'slug' => 'fruits',
            'description' => 'Delicious fruits sourced directly from orchards.',
            'icon' => 'apple',
        ]);

        $pulses = Category::create([
            'name' => 'Pulses & Lentils',
            'slug' => 'pulses-lentils',
            'description' => 'High-protein lentils, chickpeas, kidney beans, and peas.',
            'icon' => 'bean',
        ]);

        $spices = Category::create([
            'name' => 'Spices & Herbs',
            'slug' => 'spices-herbs',
            'description' => 'Pure and aromatic spices grown in pristine environments.',
            'icon' => 'flame',
        ]);

        // 2. Seed Users (Admin, Farmers, Buyers)
        $admin = User::create([
            'name' => 'Portal Admin',
            'email' => 'admin@agriportal.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'avatar' => null,
            'location' => 'New Delhi',
            'phone' => '9999999999',
            'bio' => 'Fair Trade Agri-Portal Head Administrator.',
        ]);

        $farmer1 = User::create([
            'name' => 'Devinder Singh',
            'email' => 'farmer1@agriportal.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
            'is_verified' => true,
            'avatar' => null,
            'location' => 'Punjab',
            'phone' => '9876543210',
            'bio' => 'Cultivating premium organic rice and wheat using sustainable, nature-friendly practices for 15+ years.',
            'earnings' => 45800.00,
        ]);

        $farmer2 = User::create([
            'name' => 'Ramesh Gowda',
            'email' => 'farmer2@agriportal.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
            'is_verified' => false,
            'avatar' => null,
            'location' => 'Karnataka',
            'phone' => '9876543211',
            'bio' => 'Focusing on high-yield tomato cultivation and organic spices in southern India.',
            'earnings' => 12400.00,
        ]);

        $buyer1 = User::create([
            'name' => 'Aarav Sharma',
            'email' => 'buyer@agriportal.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'avatar' => null,
            'location' => 'Mumbai',
            'phone' => '9876543212',
            'bio' => 'Procurement Officer for OrganicGro Retail Chains, looking for direct partnerships.',
            'wishlist' => [],
        ]);

        // 3. Seed Products
        $p1 = Product::create([
            'name' => 'Premium Basmati Rice (Basmati 370)',
            'description' => 'Extremely aromatic, long-grain basmati rice. Grown with organic compost, aged for 12 months post-harvest to enhance size and fragrance. Ideal for premium dining.',
            'price' => 85.00,
            'quantity' => 1500, // kg
            'harvest_date' => Carbon::now()->subMonths(2),
            'location' => 'Amritsar, Punjab',
            'image_path' => 'basmati_rice.png',
            'farmer_id' => $farmer1->id,
            'category_id' => $grains->id,
            'is_organic' => true,
            'status' => 'available',
        ]);

        $p2 = Product::create([
            'name' => 'Organic Durum Wheat',
            'description' => 'High-protein durum wheat, ideal for making premium semolina and pasta. Harvested using traditional eco-friendly methods.',
            'price' => 42.00,
            'quantity' => 3000, // kg
            'harvest_date' => Carbon::now()->subMonths(1),
            'location' => 'Patiala, Punjab',
            'image_path' => 'durum_wheat.png',
            'farmer_id' => $farmer1->id,
            'category_id' => $grains->id,
            'is_organic' => true,
            'status' => 'available',
        ]);

        $p3 = Product::create([
            'name' => 'Fresh Farm Tomatoes',
            'description' => 'Plump, vine-ripened red tomatoes. Locally harvested and sorted with zero preservative sprays. Perfect for salads and cooking.',
            'price' => 28.00,
            'quantity' => 400, // kg
            'harvest_date' => Carbon::now()->subDays(3),
            'location' => 'Kolar, Karnataka',
            'image_path' => 'fresh_tomatoes.png',
            'farmer_id' => $farmer2->id,
            'category_id' => $vegetables->id,
            'is_organic' => false,
            'status' => 'available',
        ]);

        $p4 = Product::create([
            'name' => 'Himachal Golden Apples',
            'description' => 'Crisp, sweet, and juicy Golden Delicious apples sourced directly from high-altitude orchards in Shimla. Handpicked and packed.',
            'price' => 130.00,
            'quantity' => 600, // kg
            'harvest_date' => Carbon::now()->subDays(10),
            'location' => 'Shimla, Himachal Pradesh',
            'image_path' => 'golden_apples.png',
            'farmer_id' => $farmer1->id,
            'category_id' => $fruits->id,
            'is_organic' => true,
            'status' => 'available',
        ]);

        $p5 = Product::create([
            'name' => 'Dry Red Guntur Chilies',
            'description' => 'Super spicy and vibrant red chilies, sun-dried naturally on sheets. Famous for their intense heat and color.',
            'price' => 190.00,
            'quantity' => 250, // kg
            'harvest_date' => Carbon::now()->subWeeks(3),
            'location' => 'Guntur, Andhra Pradesh',
            'image_path' => 'guntur_chilies.png',
            'farmer_id' => $farmer2->id,
            'category_id' => $spices->id,
            'is_organic' => true,
            'status' => 'available',
        ]);

        // 4. Seed Reviews
        Review::create([
            'product_id' => $p1->id,
            'buyer_id' => $buyer1->id,
            'rating' => 5,
            'comment' => 'The aroma of this basmati rice is spectacular! It cooks beautifully with very long separate grains. Highly recommended verified farmer.',
        ]);

        Review::create([
            'product_id' => $p3->id,
            'buyer_id' => $buyer1->id,
            'rating' => 4,
            'comment' => 'Very fresh tomatoes, delivered promptly. A few were slightly bruised but the quality and taste are excellent.',
        ]);

        // 5. Seed Market Prices
        MarketPrice::create([
            'crop_name' => 'Basmati Rice',
            'category_id' => $grains->id,
            'current_price' => 85.00,
            'prev_price' => 81.50,
            'trend' => 'up',
            'region' => 'Punjab',
            'price_history' => [
                ['date' => '2026-05-15', 'price' => 81.50],
                ['date' => '2026-05-16', 'price' => 82.00],
                ['date' => '2026-05-17', 'price' => 83.10],
                ['date' => '2026-05-18', 'price' => 82.80],
                ['date' => '2026-05-19', 'price' => 84.00],
                ['date' => '2026-05-20', 'price' => 84.50],
                ['date' => '2026-05-21', 'price' => 85.00],
            ],
        ]);

        MarketPrice::create([
            'crop_name' => 'Durum Wheat',
            'category_id' => $grains->id,
            'current_price' => 42.00,
            'prev_price' => 44.50,
            'trend' => 'down',
            'region' => 'Punjab',
            'price_history' => [
                ['date' => '2026-05-15', 'price' => 44.50],
                ['date' => '2026-05-16', 'price' => 44.00],
                ['date' => '2026-05-17', 'price' => 43.50],
                ['date' => '2026-05-18', 'price' => 43.00],
                ['date' => '2026-05-19', 'price' => 42.50],
                ['date' => '2026-05-20', 'price' => 42.10],
                ['date' => '2026-05-21', 'price' => 42.00],
            ],
        ]);

        MarketPrice::create([
            'crop_name' => 'Tomatoes',
            'category_id' => $vegetables->id,
            'current_price' => 28.00,
            'prev_price' => 28.00,
            'trend' => 'stable',
            'region' => 'Karnataka',
            'price_history' => [
                ['date' => '2026-05-15', 'price' => 27.00],
                ['date' => '2026-05-16', 'price' => 27.50],
                ['date' => '2026-05-17', 'price' => 28.00],
                ['date' => '2026-05-18', 'price' => 28.00],
                ['date' => '2026-05-19', 'price' => 28.50],
                ['date' => '2026-05-20', 'price' => 28.20],
                ['date' => '2026-05-21', 'price' => 28.00],
            ],
        ]);

        MarketPrice::create([
            'crop_name' => 'Apples',
            'category_id' => $fruits->id,
            'current_price' => 130.00,
            'prev_price' => 125.00,
            'trend' => 'up',
            'region' => 'Himachal Pradesh',
            'price_history' => [
                ['date' => '2026-05-15', 'price' => 122.00],
                ['date' => '2026-05-16', 'price' => 124.00],
                ['date' => '2026-05-17', 'price' => 125.00],
                ['date' => '2026-05-18', 'price' => 127.00],
                ['date' => '2026-05-19', 'price' => 128.00],
                ['date' => '2026-05-20', 'price' => 130.00],
                ['date' => '2026-05-21', 'price' => 130.00],
            ],
        ]);

        // 6. Seed Weather Data
        WeatherData::create([
            'region' => 'Punjab',
            'temperature' => 38.5,
            'humidity' => 45.0,
            'rainfall' => 2.0,
            'forecast' => [
                ['day' => 'Mon', 'temp' => 39, 'condition' => 'Sunny', 'rain_prob' => 5],
                ['day' => 'Tue', 'temp' => 40, 'condition' => 'Sunny', 'rain_prob' => 0],
                ['day' => 'Wed', 'temp' => 41, 'condition' => 'Sunny', 'rain_prob' => 0],
                ['day' => 'Thu', 'temp' => 38, 'condition' => 'Partly Cloudy', 'rain_prob' => 20],
                ['day' => 'Fri', 'temp' => 36, 'condition' => 'Showers', 'rain_prob' => 60],
            ],
            'alerts' => [
                ['severity' => 'warning', 'type' => 'heatwave', 'message' => 'High temperatures expected between 12:00 PM and 4:00 PM. Keep crops well-irrigated.'],
            ],
        ]);

        WeatherData::create([
            'region' => 'Karnataka',
            'temperature' => 29.0,
            'humidity' => 78.0,
            'rainfall' => 25.4,
            'forecast' => [
                ['day' => 'Mon', 'temp' => 28, 'condition' => 'Thunderstorms', 'rain_prob' => 90],
                ['day' => 'Tue', 'temp' => 29, 'condition' => 'Heavy Rain', 'rain_prob' => 80],
                ['day' => 'Wed', 'temp' => 30, 'condition' => 'Showers', 'rain_prob' => 70],
                ['day' => 'Thu', 'temp' => 31, 'condition' => 'Cloudy', 'rain_prob' => 30],
                ['day' => 'Fri', 'temp' => 31, 'condition' => 'Partly Cloudy', 'rain_prob' => 10],
            ],
            'alerts' => [
                ['severity' => 'danger', 'type' => 'heavy_rainfall', 'message' => 'Heavy rainfall alert for next 48 hours. Secure tomato trellises and clear drainage channels.'],
            ],
        ]);

        WeatherData::create([
            'region' => 'Himachal Pradesh',
            'temperature' => 18.2,
            'humidity' => 50.0,
            'rainfall' => 0.0,
            'forecast' => [
                ['day' => 'Mon', 'temp' => 19, 'condition' => 'Sunny', 'rain_prob' => 0],
                ['day' => 'Tue', 'temp' => 18, 'condition' => 'Sunny', 'rain_prob' => 0],
                ['day' => 'Wed', 'temp' => 17, 'condition' => 'Partly Cloudy', 'rain_prob' => 10],
                ['day' => 'Thu', 'temp' => 16, 'condition' => 'Cloudy', 'rain_prob' => 20],
                ['day' => 'Fri', 'temp' => 15, 'condition' => 'Sunny', 'rain_prob' => 0],
            ],
            'alerts' => [],
        ]);

        // 7. Seed AI Recommendations
        AiRecommendation::create([
            'soil_type' => 'clay',
            'region' => 'Punjab',
            'season' => 'kharif',
            'recommended_crops' => [
                ['crop_name' => 'Basmati Rice', 'expected_yield' => '4.2 tons/hectare', 'market_demand_score' => 9.5, 'description' => 'Clay soil retains water perfectly, which is critical for rice cultivation. Given current rising market trends, Basmati is highly profitable.'],
                ['crop_name' => 'Sorghum (Jowar)', 'expected_yield' => '2.5 tons/hectare', 'market_demand_score' => 7.8, 'description' => 'Excellent secondary option if water logging is lower. Good local feed demand.'],
            ],
            'market_demand_index' => 'high',
        ]);

        AiRecommendation::create([
            'soil_type' => 'loamy',
            'region' => 'Karnataka',
            'season' => 'all',
            'recommended_crops' => [
                ['crop_name' => 'Hybrid Tomatoes', 'expected_yield' => '12.0 tons/hectare', 'market_demand_score' => 8.2, 'description' => 'Loamy soil offers ideal aeration and nutrient retention. A continuous demand in metropolitan hubs makes tomatoes a reliable cash crop.'],
                ['crop_name' => 'Green Bell Peppers', 'expected_yield' => '8.0 tons/hectare', 'market_demand_score' => 8.0, 'description' => 'High market value in restaurants and urban retail markets. Responds well to drip irrigation in loamy soil.'],
            ],
            'market_demand_index' => 'medium',
        ]);

        AiRecommendation::create([
            'soil_type' => 'sandy',
            'region' => 'Maharashtra',
            'season' => 'zaid',
            'recommended_crops' => [
                ['crop_name' => 'Watermelon (Kiran)', 'expected_yield' => '15.0 tons/hectare', 'market_demand_score' => 9.0, 'description' => 'Sandy soil warms up quickly and drains efficiently. Kiran watermelon has massive demand during hot summer months.'],
                ['crop_name' => 'Organic Peanuts', 'expected_yield' => '1.8 tons/hectare', 'market_demand_score' => 7.5, 'description' => 'Allows easy root penetration and pod development in loose sandy soils.'],
            ],
            'market_demand_index' => 'high',
        ]);

        // 8. Seed Chat
        Chat::create([
            'participants' => [$buyer1->id, $farmer1->id],
            'messages' => [
                [
                    'sender_id' => $buyer1->id,
                    'message' => 'Hello Devinder, I am interested in purchasing 500kg of Basmati Rice. Is it available for immediate dispatch?',
                    'created_at' => Carbon::now()->subHours(2)->toIso8601String(),
                ],
                [
                    'sender_id' => $farmer1->id,
                    'message' => 'Hello Aarav! Yes, the Basmati 370 is stored in dry bags and ready for dispatch. I can ship it by tomorrow morning.',
                    'created_at' => Carbon::now()->subHours(1)->toIso8601String(),
                ],
                [
                    'sender_id' => $buyer1->id,
                    'message' => 'Excellent. I will place the order through the portal now. Please accept it so we can initiate shipment.',
                    'created_at' => Carbon::now()->subMinutes(10)->toIso8601String(),
                ]
            ],
            'last_message_at' => Carbon::now()->subMinutes(10),
        ]);
    }
}
