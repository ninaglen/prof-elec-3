# 🥗 Go, Grow, and Glow Food Database Web Application

**Group 3 - Go, Grow, and Glow Nutrition Database**

A fun and educational web application for managing and exploring healthy foods classified into Go, Grow, and Glow categories. Built with PHP and MySQL.

## 🌟 Features

### Core Functionality
- **Food Category Database**: 24+ food items across Go, Grow, and Glow categories
- **Search & Filter**: Search by food name, category, or benefits
- **Pagination**: View 10 food cards per page with intuitive navigation
- **Category Icons**: Visual icons for each food group (🍞 Go, 🍗 Grow, 🍎 Glow)
- **Responsive Design**: Works across devices and screen sizes
- **Image Integration**: Real food photos with graceful fallback

## 🚀 Quick Start

### Prerequisites
- **Web Server**: Apache/Nginx with PHP
- **PHP**: 7.4 or higher
- **MySQL**: 5.7 or higher
- **Browser**: Chrome, Firefox, Safari, Edge

### Installation Steps

1. **Clone/Download the Project**
   ```bash
   git clone <repository-url>
   ```

2. **Set Up Database**
   - Create MySQL database `food_pyramid_db`
   - Import schema:
   ```sql
   mysql -u root -p food_pyramid_db < database_setup.sql
   ```

3. **Configure Database Connection**
   - Edit `config/database.php`
   - Update credentials:
   ```php
   define('DB_NAME', 'food_pyramid_db');
   ```

4. **Deploy to Server**
   - Upload files to document root
   - Open in browser via `http://localhost/g3_nutrition/`

## 📁 Project Structure

```
GOGROWGLOW3/
├── index.php               # Main food listing with search & pagination
├── database_setup.sql      # SQL schema and sample food data
│
├── config/
│   └── database.php        # DB connection logic
│
├── classes/
│   └── FoodGroup.php       # Food data class
│
└── assets/
    └── css/
        └── style.css       # Beautiful modern styling
```

## 🍽️ Features Explained

### 1. **Food Categories**
- **Go Foods (🍞)**: Energy providers (rice, bread)
- **Grow Foods (🍗)**: Body builders (meat, egg, fish)
- **Glow Foods (🍎)**: Immunity boosters (fruits, veggies)

### 2. **Smart Search**
- By food name or benefit keyword
- Real-time category filter
- Pagination with 10 items per page

### 3. **UI/UX Design**
- **Grid Cards**: Each food in its own interactive card
- **Modal Popups**: Click to view full food info
- **Responsive Layout**: Works on phones, tablets, desktops

## 🔧 Customization

### Change Design
- Modify `assets/css/style.css`
- Adjust card/grid styles or animations

### Backend Enhancements
- Use `classes/FoodGroup.php` for extending DB logic

## 🎨 Icons Legend
- 🍞 Go = Energy
- 🍗 Grow = Protein
- 🍎 Glow = Vitamins/Fiber

## 🚀 Future Ideas
- User login + favorites
- Nutrient breakdown
- Quiz mode (Is it Go, Grow, or Glow?)
- API access for mobile

## 🛠️ Troubleshooting

1. **DB Not Connecting**
   - Check credentials in `database.php`
   - Ensure MySQL is running

2. **Images Not Loading**
   - Verify image URL is correct
   - Use `.svg` fallback emoji

3. **CSS Not Applying**
   - Check path to `style.css`
   - Clear browser cache

## 📝 License

Educational use only — Group 3 Project

## 👥 Contributors

**Group 3 - Go, Grow, and Glow Nutrition Team**
- PHP/MySQL Fullstack Nutrition Database
- Fun, visual, and educational
- Built with ❤️ for kids and curious eaters
