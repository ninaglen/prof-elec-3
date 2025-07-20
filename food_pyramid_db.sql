-- Go, Grow, Glow Food Tracker Database Setup
-- Group 13 - Food Pyramid

-- Create the database
CREATE DATABASE IF NOT EXISTS food_pyramid_db;
USE food_pyramid_db;

-- Create the foods table
CREATE TABLE IF NOT EXISTS foods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(100) NOT NULL,
    category ENUM('Go', 'Grow', 'Glow') NOT NULL,
    benefits TEXT NOT NULL,
    serving_size VARCHAR(100) NOT NULL,
    image_url VARCHAR(1024),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert 24 Go, Grow, Glow foods with CC0 image URLs
INSERT INTO foods (food_name, category, benefits, serving_size, image_url) VALUES
-- Go (Energy)
('Brown Rice','Go','Complex carbs for sustained energy','1 cup','https://www.themediterraneandish.com/wp-content/uploads/2024/01/How-to-Cook-Brown-Rice-14.jpg'),
('Oats','Go','Whole grains keep you full longer','1/2 cup dry','https://images.immediate.co.uk/production/volatile/sites/30/2023/08/Porridge-oats-d09fae8.jpg?quality=90&resize=440,400'),
('Banana','Go','Quick energy & potassium for muscles','1 medium','https://static.toiimg.com/photo/122736324.cms'),
('Sweet Potato','Go','Rich in carbs & vitamin A','1 medium','https://img.onmanorama.com/content/dam/mm/en/lifestyle/health/images/2024/11/27/sweet-potato-1.jpg?w=1120&h=583'),
('Whole Wheat Bread','Go','Whole grain energy with fiber','2 slices','https://sallysbakingaddiction.com/wp-content/uploads/2024/01/whole-wheat-sandwich-bread-2.jpg'),
('Quinoa','Go','Complete plant protein with carbs','1 cup cooked','https://www.feastingathome.com/wp-content/uploads/2018/05/Quinoa-11.jpg'),
('Whole Grain Pasta','Go','Complex carbs for endurance','1 cup cooked','https://totaste.com/wp-content/uploads/2022/06/healthy-whole-grain-pasta.jpeg'),
('Corn','Go','Energy and fiber, supports digestion','1 ear','https://food.fnr.sndimg.com/content/dam/images/food/fullset/2023/6/28/fresh-corn-on-the-cob-partially-shucked-on-dark-background.jpg.rend.hgtvcom.1280.1280.85.suffix/1687987003387.webp'),

-- Grow (Protein)
('Chicken Breast','Grow','Lean protein for muscle repair','100 g','https://www.allrecipes.com/thmb/UgUZpaTRGWIHEk57yWMhMEjffiY=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/16160-juicy-grilled-chicken-breasts-ddmfs-5594-hero-3x4-902673c819994c0191442304b40104af.jpg'),
('Eggs','Grow','High-quality complete protein','2 large','https://cdn.britannica.com/94/151894-050-F72A5317/Brown-eggs.jpg'),
('Salmon','Grow','Omega‑3 & protein for cell growth','3 oz','https://cdn-assets-eu.frontify.com/s3/frontify-enterprise-files-eu/eyJvYXV0aCI6eyJjbGllbnRfaWQiOiJmcm9udGlmeS1maW5kZXIifSwicGF0aCI6ImloaC1oZWFsdGhjYXJlLWJlcmhhZFwvZmlsZVwvSGhleHdSaUVCYWJ0b1dFRWpUM1EuanBnIn0:ihh-healthcare-berhad:6Zk6UuetaajSDB-43bdLAoamTKKBCqQFMfjY38nWPbk?format=webp'),
('Tofu','Grow','Plant-based protein & calcium','100 g','https://theplantbasedschool.com/wp-content/uploads/2025/02/fried-tofu-recipe-3.jpg'),
('Greek Yogurt','Grow','Protein and probiotics for gut & muscles','1 cup','https://www.themediterraneandish.com/wp-content/uploads/2025/04/TMD-Homemade-Greek-Yogurt-Edited-1.jpg'),
('Lentils','Grow','Plant protein and fiber','1 cup cooked','https://www.keepingthepeas.com/wp-content/uploads/2022/11/red-lentils-in-wood-bowl-500x375.jpg'),
('Lean Beef','Grow','Iron and protein for blood & muscles','3 oz','https://bbqchamps.com/wp-content/uploads/2021/08/lean-beef-options-Tenderloin-Roast.png'),
('Cottage Cheese','Grow','Casein protein helps muscle recovery','1/2 cup','https://cheesemaking.com/cdn/shop/products/cottage-cheese-recipe-266121.jpg?v=1739766325'),

-- Glow (Vitamins & Minerals)
('Spinach','Glow','Iron, calcium, vitamin K & A','1 cup','https://i0.wp.com/post.healthline.com/wp-content/uploads/2019/05/spinach-1296x728-header.jpg?w=1155&h=1528'),
('Carrot','Glow','Beta-carotene for vision & skin','1 medium','https://www.hhs1.com/hubfs/carrots%20on%20wood-1.jpg'),
('Blueberries','Glow','Antioxidants support immunity','1/2 cup','https://huntersgardencentre.com/wp-content/uploads/2024/07/Blog-Post-Featured-Pic-blueberries.jpg'),
('Broccoli','Glow','Vitamin C and fiber','1 cup','https://snaped.fns.usda.gov/sites/default/files/styles/crop_ratio_7_5/public/seasonal-produce/2018-05/broccoli.jpg.webp?itok=9hD8BBER'),
('Bell Pepper','Glow','High vitamin C for skin health','1 medium','https://www.marthastewart.com/thmb/J6ZqPUqTJY4sKnAIa_oUX9qytak=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/ms-bell-peppers-different-colors-getty-67b956012b7043629ecdb085b25267d7.jpg'),
('Tomato','Glow','Lycopene supports heart & skin health','1 medium','https://www.richardjacksonsgarden.co.uk/wp-content/uploads/2021/04/AdobeStock_554658202_1200px.jpg.webp'),
('Avocado','Glow','Healthy fats & vitamin E for skin','1/2 fruit','https://images.immediate.co.uk/production/volatile/sites/30/2022/07/Avocado-sliced-in-half-ca9d808.jpg?quality=90&resize=440,400'),
('Sweet Bell Peppers','Glow','Rich in vitamins A & C','1 cup','https://bedford.tennessee.edu/wp-content/uploads/sites/162/2020/08/SweetPeppers.jpg');

-- Indexes for performance
CREATE INDEX idx_food_name ON foods(food_name);
CREATE INDEX idx_category ON foods(category);

-- View for unified search
CREATE VIEW food_search AS
SELECT 
    id,
    food_name,
    category,
    benefits,
    serving_size,
    image_url,
    CONCAT(food_name, ' ', category, ' ', benefits, ' ', serving_size) AS search_text
FROM foods;

SELECT * FROM foods;