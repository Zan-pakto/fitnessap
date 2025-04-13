-- Create the database
CREATE DATABASE IF NOT EXISTS fitness_db;
USE fitness_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    profile_image VARCHAR(255),
    gender ENUM('male', 'female', 'other') NOT NULL,
    date_of_birth DATE,
    height DECIMAL(5,2), -- in cm
    weight DECIMAL(5,2), -- in kg
    fitness_goal ENUM('weight_loss', 'muscle_gain', 'endurance', 'flexibility', 'general_fitness') NOT NULL,
    activity_level ENUM('sedentary', 'light', 'moderate', 'active', 'very_active') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Workout plans table
CREATE TABLE IF NOT EXISTS workout_plans (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    difficulty_level ENUM('beginner', 'intermediate', 'advanced') NOT NULL,
    duration_days INT NOT NULL,
    image_url VARCHAR(255),
    target_goal ENUM('weight_loss', 'muscle_gain', 'endurance', 'flexibility', 'general_fitness') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Exercises table
CREATE TABLE IF NOT EXISTS exercises (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    muscle_group VARCHAR(50),
    difficulty_level ENUM('beginner', 'intermediate', 'advanced') NOT NULL,
    video_url VARCHAR(255),
    image_url VARCHAR(255),
    equipment_needed BOOLEAN DEFAULT FALSE,
    equipment_type VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Workout plan exercises (junction table)
CREATE TABLE IF NOT EXISTS workout_plan_exercises (
    workout_plan_id INT,
    exercise_id INT,
    sets INT NOT NULL,
    reps INT NOT NULL,
    rest_time INT NOT NULL, -- in seconds
    order_in_workout INT NOT NULL,
    FOREIGN KEY (workout_plan_id) REFERENCES workout_plans(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id),
    PRIMARY KEY (workout_plan_id, exercise_id)
);

-- User progress table
CREATE TABLE IF NOT EXISTS user_progress (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    workout_plan_id INT,
    exercise_id INT,
    completed_sets INT,
    completed_reps INT,
    weight_used DECIMAL(5,2),
    date_completed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (workout_plan_id) REFERENCES workout_plans(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);

-- User measurements table
CREATE TABLE IF NOT EXISTS user_measurements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    weight DECIMAL(5,2), -- in kg
    body_fat_percentage DECIMAL(4,2),
    chest_cm DECIMAL(5,2),
    waist_cm DECIMAL(5,2),
    hips_cm DECIMAL(5,2),
    biceps_cm DECIMAL(5,2),
    thighs_cm DECIMAL(5,2),
    measurement_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- User goals table
CREATE TABLE IF NOT EXISTS user_goals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    goal_type ENUM('weight', 'measurement', 'workout', 'nutrition') NOT NULL,
    target_value DECIMAL(10,2),
    target_date DATE,
    is_completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample workout plans
INSERT INTO workout_plans (name, description, difficulty_level, duration_days, image_url, target_goal) VALUES
('Beginner Workout', 'Start your fitness journey with easy-to-follow exercises', 'beginner', 30, 'beginner_workout.jpg', 'general_fitness'),
('Intermediate Workout', 'Take your fitness to the next level', 'intermediate', 45, 'intermediate_workout.webp', 'muscle_gain'),
('Advanced Workout', 'Push your limits with high-intensity exercises', 'advanced', 60, 'advanced_workout.webp', 'endurance'),
('Weight Loss Program', 'Focus on fat burning and cardio exercises', 'intermediate', 30, 'weight_loss_workout.jpg', 'weight_loss'),
('Flexibility Routine', 'Improve your flexibility and mobility', 'beginner', 21, 'flexibility_workout.jpg', 'flexibility'); 