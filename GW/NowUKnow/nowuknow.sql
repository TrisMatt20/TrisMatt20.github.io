-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 02:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalnuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `followID` int(11) NOT NULL,
  `followedID` int(11) NOT NULL,
  `followerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1100) NOT NULL,
  `dateUploaded` datetime NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `userID` int(11) NOT NULL,
  `tagID` int(11) DEFAULT NULL,
  `ratingID` int(11) DEFAULT NULL,
  `isAnnouncement` enum('YES','NO') DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `title`, `description`, `dateUploaded`, `attachment`, `userID`, `tagID`, `ratingID`, `isAnnouncement`) VALUES
(28, 'How do you create a beautiful Watercolor Painting with soft and vibrant effects?', 'Materials Needed:\r\n    - Watercolor paints\r\n    - Brushes (round brush is versatile) Watercolor paper\r\n    - Water container\r\n    - issue or cloth for blotting\r\n\r\nSteps:\r\n    1. Prepare the Paper: Lightly sketch your subject (optional).\r\n\r\n    2. Wet the Paper: Wet the area where you’ll paint for a \r\n        soft look or keep it dry for sharp lines.\r\n\r\n    3. Mix Colors: Add a little water to your paint to make it \r\n        flow. Adjust for lighter or darker shades.\r\n\r\n    4. Start Light: Paint light colors first; layer darker colors \r\n        on top once dry.\r\n    5. Blend: While the paint is wet, blend for smooth \r\n        transitions.\r\n\r\n    6. Details: Use a small brush for final details when the \r\n        base is dry.\r\n\r\n    7. Dry: Let it dry completely before erasing pencil marks \r\n        or framing.\r\n', '2025-01-24 19:01:50', 'Water Color.jpg', 3, 5, NULL, 'NO'),
(29, 'How to lower blood pressure without medication?', 'Step 1: Eat a heart-healthy diet, such as the DASH diet, which includes fruits, vegetables, and low-fat foods.\r\n\r\nStep 2: Reduce salt (sodium) intake to less than 1,500–2,300 mg per day.\r\n\r\nStep 3: Exercise regularly, aiming for at least 30 minutes of moderate activity (e.g., walking or cycling).\r\n\r\nStep 4: Maintain a healthy weight to ease pressure on your heart.\r\n\r\nStep 5: Limit alcohol consumption and avoid smoking.\r\n\r\nStep 6: Practice relaxation techniques to lower stress levels.\r\n\r\nStep 7: Monitor your blood pressure at home and visit your doctor for regular checkups.\r\n', '2025-01-24 19:03:28', 'Blood Pressure.jpg', 3, 6, NULL, 'NO'),
(30, 'What’s the best way to cook Garlic Butter Shrimp with a juicy and buttery taste?', 'Ingredients:\r\n- 500g shrimp (peeled and deveined)\r\n- 3 tbsp butter\r\n- 4 garlic cloves (minced)\r\n- 2 tbsp lemon juice\r\n- 1 tbsp chopped parsley\r\n- Salt and pepper to taste\r\n\r\nBasic Instructions:\r\n1. Prepare the Ingredients: Clean the shrimp and mince the garlic.\r\n\r\n2. Cook Garlic: Melt butter in a pan, add garlic, and sauté until fragrant.\r\n\r\n3. Add Shrimp: Cook shrimp for 2-3 minutes on each side until pink.\r\n\r\n4. Add Lemon Juice: Drizzle lemon juice over shrimp and mix.\r\n\r\n5. Season and Garnish: Season with salt and pepper, then garnish with parsley.\r\n\r\n', '2025-01-24 19:05:24', 'Butter Shrimp.jpg', 4, 4, NULL, 'NO'),
(33, 'How to build a website?', 'Step 1: Choose a purpose for your website (e.g., portfolio, blog, or e-commerce).\r\n\r\nStep 2: Select a platform like WordPress, Wix, or code from scratch using HTML, CSS, and JavaScript.\r\n\r\nStep 3: Buy a domain name and hosting service (e.g., GoDaddy, Bluehost).\r\n\r\nStep 4: Design your site layout and add pages (e.g., Home, About, Contact).\r\n\r\nStep 5: Add content, such as text, images, and videos, based on your sites purpose.\r\n\r\nStep 6: Optimize your website for SEO and mobile devices.\r\n\r\nStep 7: Test the site thoroughly and publish it for users to access.\r\n', '2025-01-24 19:19:02', 'Technology 1.png', 4, 1, NULL, 'NO'),
(34, 'What are the basic steps to master Sketching and Drawing?', 'Materials:\r\n- Pencil (HB for light lines, 2B or 4B for shading)\r\n- Eraser\r\n- Sketchbook or plain paper\r\n\r\nSteps:\r\n1. Start with Basic Shapes\r\n- Break down your subject into simple shapes (circles, rectangles, triangles) to create the structure.\r\n\r\n2. Light Sketching\r\n- Use light strokes to outline the subject. This makes it easier to erase and adjust as needed.\r\n\r\n3. Define the Outline\r\n- Refine the shapes into detailed outlines, gradually building the form of your subject.\r\n4. Add Details\r\n- Draw smaller features (like facial features, patterns, or textures).\r\n\r\n5. Shading\r\n- Identify the light source and add shadows and highlights using smooth pencil strokes. Use hatching, cross-hatching, or blending to create depth.\r\n\r\n6. Finishing Touches\r\n- Clean up stray lines with an eraser and darken the key areas for contrast.\r\n', '2025-01-24 19:22:42', 'Sketch.jpg', 5, 5, NULL, 'NO'),
(35, 'How to write a good essay?', 'Step 1: Understand the essay prompt and research your topic thoroughly.\r\n\r\nStep 2: Create an outline with an introduction, body paragraphs, and a conclusion.\r\n\r\nStep 3: Write a strong thesis statement to guide your essays argument.\r\n\r\nStep 4: Support your points with evidence, examples, and citations.\r\n\r\nStep 5: Proofread your essay for grammar, spelling, and clarity before submitting.\r\n', '2025-01-24 19:24:22', 'Educ 5.jpg', 5, 2, NULL, 'NO'),
(36, 'How can you prepare a quick and healthy Vegetable Stir-Fry?', 'Ingredients:\r\n- 2 cups mixed vegetables (e.g., broccoli, carrots, bell peppers)\r\n- 2 tbsp soy sauce\r\n- 1 tbsp sesame oil\r\n- 2 garlic cloves (minced)\r\n- 1 tsp grated ginger\r\n\r\nBasic Instructions:\r\n1. Prepare the Vegetables: Wash and chop vegetables.\r\n\r\n2. Heat Oil: Heat sesame oil in a pan or wok.\r\n\r\n3. Cook Aromatics: Add garlic and ginger, stir-fry until fragrant.\r\n\r\n4. Add Vegetables: Stir-fry the vegetables for 5-7 minutes.\r\n\r\n5. Season: Add soy sauce and toss until well combined.\r\n', '2025-01-24 19:26:36', 'Vegetable Stir Fry.jpg', 6, 4, NULL, 'NO'),
(37, 'How to protect your computer from viruses?', 'Step 1: Install reputable antivirus software and keep it updated.\r\n\r\nStep 2: Enable your computers firewall for extra protection.\r\n\r\nStep 3: Avoid clicking on suspicious links or downloading files from untrusted sources.\r\n\r\nStep 4: Regularly update your operating system and software to patch vulnerabilities.\r\n\r\nStep 5: Use strong, unique passwords and enable two-factor authentication.\r\n\r\nStep 6: Be cautious with USB devices and scan them before use.\r\n\r\nStep 7: Back up important data to an external drive or cloud service.\r\n', '2025-01-24 19:27:41', 'Technology 2.jpg', 6, 1, NULL, 'NO'),
(38, 'How can you start with Oil Painting and blend colors like a pro?', 'Materials:\r\n- Oil paints\r\n- Canvas or primed surface\r\n- Brushes (flat and round)\r\n- Palette\r\n- Palette knife\r\n- Linseed oil or painting medium\r\n- Rags or paper towels\r\n- Odorless thinner (for cleaning brushes)\r\n\r\nSteps:\r\n1. Prepare Your Canvas:\r\n- Use a pre-primed canvas or apply gesso if needed. Let it dry completely.\r\n\r\n2. Sketch the Composition:\r\n- Lightly sketch the outline of your subject using a pencil or thin paint.\r\n\r\n3. Block in the Colors:\r\n- Use a palette knife or a brush to apply large areas of base colors. Start with thin layers mixed with a bit of medium.\r\n\r\n4. Build Layers:\r\n- Add more paint for details and textures. Oil paints dry slowly, so you can blend and work on transitions smoothly.\r\n\r\n5. Add Highlights and Shadows:\r\n- Focus on creating depth by layering lighter and darker tones. Use a small brush for finer details.\r\n\r\n6. Finishing Touches:\r\n- Refine edges and enhance contrasts. Step back to assess your work and make final adjustments.\r\n\r\n7. Dry and Clean Up:\r\n- Allow the painting to dry in a ventilated area. Clean brushes with thinner or soapy water.', '2025-01-24 19:29:59', 'Oil Painting.jpg', 7, 5, NULL, 'NO'),
(39, 'How to create a morning routine?', 'Step 1: Decide what you want to achieve in the morning (e.g., productivity, relaxation).\r\n\r\nStep 2: Wake up at the same time daily to establish consistency.\r\n\r\nStep 3: Include healthy habits like stretching, drinking water, or eating breakfast.\r\n\r\nStep 4: Set aside time for priorities, such as planning your day or exercising.\r\n\r\nStep 5: Avoid distractions like social media until your routine is complete.\r\n', '2025-01-24 19:32:00', 'Lifestyle 1.jpg', 7, 3, NULL, 'NO'),
(40, 'What are the steps to cook a creamy Pasta Carbonara?', 'Ingredients:\r\n- 200g spaghetti\r\n- 100g bacon (diced)\r\n- 2 eggs\r\n- ½ cup grated Parmesan cheese\r\n- 2 garlic cloves (minced)\r\n- Salt and pepper to taste\r\n\r\nBasic Instructions:\r\n1. Cook Pasta: Boil spaghetti until al dente. Drain and set aside.\r\n\r\n2. Cook Bacon: Sauté bacon and garlic in a pan until crispy.\r\n\r\n3. Mix Sauce: Beat eggs with Parmesan cheese.\r\n\r\n4. Combine: Add hot pasta to the bacon, remove from heat, and quickly mix in the egg mixture.\r\n\r\n5. Season: Add salt and pepper to taste.\r\n', '2025-01-24 19:33:40', 'Pasta.jpg', 8, 4, NULL, 'NO'),
(41, 'How to troubleshoot a slow internet connection?', 'Step 1: Restart your modem and router to refresh the connection.\r\n\r\nStep 2: Test your internet speed using tools like Speedtest.net to diagnose issues.\r\n\r\nStep 3: Check for multiple devices or apps hogging bandwidth.\r\n\r\nStep 4: Move closer to your router or use a wired Ethernet connection.\r\n\r\nStep 5: Update your router firmware or change its location for better signal strength.\r\n\r\nStep 6: Contact your internet service provider (ISP) if the problem persists.\r\n\r\nStep 7: Consider upgrading your internet plan or router for higher speeds.\r\n', '2025-01-24 19:34:31', 'Technology 3.jpg', 8, 1, NULL, 'NO'),
(42, 'What are the tips to improve your Calligraphy skills?', 'Materials:\r\n- Calligraphy pen (fountain pen, dip pen, or brush pen)\r\n- Smooth paper\r\n- Ink (if using a dip pen)\r\n- Pencil for guidelines (optional)\r\n\r\nSteps:\r\n1. Choose Your Tool\r\n- Select a pen based on your preferred style (e.g., brush pen for modern calligraphy, dip pen for traditional scripts).\r\n\r\n2. Practice Basic Strokes\r\n- Start with upstrokes (light pressure) and downstrokes (heavy pressure). Focus on	 maintaining consistent pressure.\r\n\r\n3. Learn the Alphabet\r\n- Practice letters individually, paying attention to their forms and connections.\r\n\r\n4. Create Guidelines\r\n- Lightly draw horizontal lines on paper to maintain consistent letter height and slant.\r\n\r\n5. Combine Letters\r\n- Practice writing simple words, focusing on smooth transitions between letters.\r\n\r\n6. Experiment with Styles\r\n- Try different scripts (e.g., Gothic, Italic, or Modern) and vary line thickness for creative flair.\r\n\r\n7. Final Touches\r\n- Erase guidelines if used and review your work for consistency.\r\n', '2025-01-24 19:37:07', 'Calligraphy.jpg', 9, 5, NULL, 'NO'),
(43, 'How to save money effectively?', 'Step 1: Track your expenses to understand where your money is going.\r\n\r\nStep 2: Set a realistic budget and stick to it.\r\n\r\nStep 3: Cut unnecessary spending by prioritizing needs over wants.\r\n\r\nStep 4: Set aside a portion of your income for savings or an emergency fund.\r\n\r\nStep 5: Use apps or tools to help you manage your finances and track progress.\r\n', '2025-01-24 19:38:26', 'Lifestyle 2.jpg', 9, 3, NULL, 'NO'),
(44, 'How do you make an authentic Chicken Adobo (Filipino style)?', 'Ingredients:\r\n- 500g chicken (cut into pieces)\r\n- 3 tbsp soy sauce\r\n- 3 tbsp vinegar\r\n- 4 garlic cloves (smashed)\r\n- 2 bay leaves\r\n- ½ tsp black peppercorns\r\n- 1 cup water\r\n\r\nBasic Instructions:\r\n1. Marinate Chicken: Mix chicken with soy sauce and garlic; marinate for 30 minutes.\r\n2. Cook Chicken: In a pan, brown the chicken pieces.\r\n3. Simmer: Add vinegar, bay leaves, peppercorns, and water. Simmer for 25 minutes.\r\n4. Reduce Sauce: Allow the sauce to thicken slightly before serving.\r\n', '2025-01-24 19:39:55', 'Adobo.jpg', 10, 4, NULL, 'NO'),
(45, 'How to back up your data?', 'Step 1: Choose a backup method: cloud storage (e.g., Google Drive, iCloud) or external storage (e.g., HDD, SSD).\r\n\r\nStep 2: Identify important files, such as documents, photos, and videos, for backup.\r\n\r\nStep 3: Use built-in backup tools like Windows Backup or macOS Time Machine for automation.\r\n\r\nStep 4: Schedule regular backups to ensure updated copies of your data.\r\n\r\nStep 5: Encrypt sensitive files before backing them up for added security.\r\n\r\nStep 6: Test the restore process periodically to ensure your backups work.\r\n\r\nStep 7: Store a copy of your backup in a secure, off-site location.\r\n', '2025-01-24 19:41:03', 'Technology 4.jpg', 10, 1, NULL, 'NO'),
(46, 'How do you create stunning artwork using Digital Painting techniques?', 'Tools:\r\n- Digital drawing tablet (e.g., Wacom, iPad with Apple Pencil)\r\n- Software (e.g., Photoshop, Procreate, Krita, or Clip Studio Paint)\r\n\r\nSteps:\r\n1. Set Up Your Canvas\r\n- Open your digital art software and create a canvas (e.g., 1920x1080 px at 300 DPI).\r\n\r\n2. Choose Your Brushes\r\n- Use soft round brushes for blending, hard round brushes for details, and textured brushes for effects.\r\n\r\n3. Sketch the Outline\r\n- Use a thin brush to sketch lightly on a separate layer.\r\n\r\n4. Block in Colors\r\n- Create a new layer under the sketch and fill in base colors using large brushes.\r\n\r\n5. Add Shadows and Highlights\r\n- Use a soft brush to paint shadows and highlights, focusing on the light source and depth.\r\n6. Blend Colors\r\n- Use blending tools or low-opacity brushes to smooth transitions between colors.\r\n\r\n7. Add Details\r\n- Zoom in and use smaller brushes for fine details like textures, patterns, or highlights.\r\n\r\n8. Refine and Adjust\r\n- Adjust brightness, contrast, or colors using your soft', '2025-01-24 19:46:48', 'Digital Painting.jpg', 11, 5, NULL, 'NO'),
(47, 'How to maintain a healthy work-life balance?', 'Step 1: Set boundaries by defining work hours and sticking to them.\r\n\r\nStep 2: Schedule time for hobbies, exercise, and spending with loved ones.\r\n\r\nStep 3: Avoid overcommitting and learn to say no when needed.\r\n\r\nStep 4: Take breaks during work to avoid burnout and improve productivity.\r\n', '2025-01-24 19:47:54', 'Lifestyle 3.png', 11, 3, NULL, 'NO'),
(48, 'What’s the secret to making delicious Fried Rice?', 'Ingredients:\r\n- 2 cups cooked rice\r\n- 2 eggs (beaten)\r\n- 1 cup mixed vegetables\r\n- 2 tbsp soy sauce\r\n- 2 garlic cloves (minced)\r\n\r\nBasic Instructions:\r\n1. Prepare Ingredients: Mince garlic and beat eggs.\r\n\r\n2. Cook Garlic: Sauté garlic in a pan.\r\n\r\n3. Scramble Eggs: Push garlic aside and scramble eggs.\r\n\r\n4. Combine: Add rice and mixed vegetables.\r\n\r\n5. Season: Add soy sauce and stir-fry for 3-5 minutes.\r\n', '2025-01-24 19:50:12', 'Fried Rice.jpg', 12, 4, NULL, 'NO'),
(49, 'How to learn coding as a beginner?', 'Step 1: Choose a programming language based on your goals (e.g., Python for data science, JavaScript for web development).\r\n\r\nStep 2: Start with online tutorials or platforms like Codecademy, freeCodeCamp, or YouTube.\r\n\r\nStep 3: Practice writing simple programs, like a calculator or todo list.\r\n\r\nStep 4: Join coding communities like GitHub or Stack Overflow to ask questions and collaborate.\r\n\r\nStep 5: Work on small projects to apply what you have learned in real world scenarios.\r\n\r\nStep 6: Take online courses or read books for more advanced concepts.\r\n\r\nStep 7: Keep practicing and building more complex projects to enhance your skills.\r\n', '2025-01-24 19:52:12', 'Technology 5.png', 12, 1, NULL, 'NO'),
(50, 'What’s the process for designing eye-catching visuals in Graphic Design?', 'Tools:\r\n- Software (e.g., Adobe Photoshop, Illustrator, Canva, Figma)\r\n- Fonts, images, and vector assets (free resources like Unsplash or Pexels for images)\r\n\r\nSteps:\r\n1. Define Your Purpose\r\n- Understand your project’s goal (e.g., poster, logo, social media post) and audience.\r\n\r\n2. Set Up Your Workspace\r\n- Open your chosen software and create a canvas with the right dimensions (e.g., 1080x1080 px for Instagram).\r\n\r\n3. Choose a Color Palette\r\n- Select 2 to 4 harmonious colors that fit the theme. Tools like Adobe Color can help.\r\n\r\n4. Pick Fonts and Typography\r\n- Use 1 to 2 complementary fonts. Ensure readability by balancing text size and weight.\r\n\r\n5. Create a Layout', '2025-01-24 19:54:45', 'Graphic Design.jpg', 13, 5, NULL, 'NO'),
(51, 'How to declutter your home?', 'Step 1: Start with one area or room to avoid feeling overwhelmed.\r\n\r\nStep 2: Sort items into categories: keep, donate, recycle, or throw away.\r\n\r\nStep 3: Use storage solutions to organize the items you decide to keep.\r\n\r\nStep 4: Make decluttering a regular habit to prevent clutter from building up again.\r\n', '2025-01-24 19:57:25', 'Lifestyle 4.jpg', 13, 3, NULL, 'NO'),
(52, 'How do you make a delicious and easy French Toast?', 'Ingredients:\r\n- 4 slices bread\r\n- 2 eggs\r\n- ½ cup milk\r\n- 1 tbsp sugar\r\n- ½ tsp cinnamon\r\n\r\nBasic Instructions:\r\n1. Prepare Mixture: Whisk eggs, milk, sugar, and cinnamon.\r\n\r\n2. Dip Bread: Coat each slice of bread in the mixture.\r\n\r\n3. Cook: Fry bread in a buttered pan until golden on both sides.\r\n', '2025-01-24 19:59:12', 'French Toast.jpg', 14, 4, NULL, 'NO'),
(53, 'How to improve study habits?', 'Step 1: Set a consistent schedule to study at the same time daily.\r\n\r\nStep 2: Create a distraction-free study environment with all necessary materials.\r\n\r\nStep 3: Use active study methods like summarizing, teaching others, or practicing problems.\r\n\r\nStep 4: Take short breaks every 25 to 50 minutes to avoid burnout.\r\n\r\nStep 5: Review and revise regularly to retain information better.\r\n', '2025-01-24 20:00:01', 'Educ 1.jpg', 14, 2, NULL, 'NO'),
(54, 'How to lose weight safely and effectively?', 'Step 1: Set realistic goals for your weight loss journey (e.g., 1 to 2 pounds per week).\r\n\r\nStep 2: Follow a balanced diet with plenty of vegetables, lean proteins, whole grains, and healthy fats.\r\n\r\nStep 3: Track your calories and portion sizes to avoid overeating.\r\n\r\nStep 4: Exercise regularly, combining cardio (e.g., walking, jogging) and strength training.\r\n\r\nStep 5: Stay hydrated and avoid sugary drinks.\r\nStep 6: Get enough sleep (7 to 9 hours per night) to support your metabolism.\r\n\r\nStep 7: Stay consistent and avoid fad diets for sustainable progress.\r\n', '2025-01-24 20:02:27', 'Lose Weight.jpg', 15, 6, NULL, 'NO'),
(55, 'How do you make a flavorful Homemade Chicken Curry at home?', 'Ingredients:\r\n- 500g chicken (cut into bite-sized pieces)\r\n- 2 tbsp cooking oil\r\n- 1 onion (finely chopped)\r\n- 3 garlic cloves (minced)\r\n- 1 tsp fresh ginger (grated)\r\n- 2 tomatoes (chopped)\r\n- 2 tbsp curry powder\r\n- 1 cup coconut milk\r\n- 1 cup water\r\n- 1 potato (peeled and cubed)\r\n- Salt and pepper to taste\r\n- Fresh coriander leaves (for garnish, optional)\r\n________________________________________\r\n\r\nBasic Instructions:\r\n1. Prepare the Ingredients: Chop the chicken, onion, garlic, ginger, tomatoes, and potato.\r\n\r\n2. Cook Aromatics: Heat oil in a pan. Sauté the onion, garlic, and ginger until soft and fragrant.\r\n\r\n3. Add Chicken: Add the chicken pieces to the pan and cook until they are lightly browned.\r\n\r\n4. Add Tomatoes and Curry Powder: Stir in the chopped tomatoes and curry powder. Cook for 2 minutes.\r\n\r\n5. Add Liquid and Potatoes: Pour in the coconut milk and water. Add the cubed potato. Mix well.\r\n\r\n6. Simmer: Reduce the heat and simmer for 20-25 minutes until the chicken is cook', '2025-01-24 20:04:38', 'Chicken Curry.jpg', 15, 4, NULL, 'NO'),
(56, 'What are the steps to cook a fluffy and tasty Omelette?', 'Ingredients:\r\n- 2 eggs\r\n- 1 tbsp milk\r\n- ¼ cup chopped vegetables\r\n- 2 tbsp grated cheese\r\n- Salt and pepper to taste\r\n\r\nBasic Instructions:\r\n1. Whisk Eggs: Beat eggs with milk, salt, and pepper.\r\n\r\n2. Cook Veggies: Sauté vegetables in a pan.\r\n\r\n3. Make Omelette: Pour egg mixture into the pan, add cheese, and fold when set.\r\n', '2025-01-24 20:06:38', 'Omelette.jpg', 20, 4, NULL, 'NO'),
(57, 'How to prepare for exams?', 'Step 1: Start early and create a study plan based on the exam syllabus.\r\n\r\nStep 2: Focus on understanding key concepts rather than rote memorization.\r\n\r\nStep 3: Practice past papers or mock tests to familiarize yourself with the exam format.\r\n\r\nStep 4: Identify weak areas and spend extra time improving them.\r\n\r\nStep 5: Get enough sleep before the exam day to stay focused and alert.\r\n', '2025-01-24 20:07:29', 'Educ 2.gif', 20, 2, NULL, 'NO'),
(58, 'How to boost your immune system naturally?', 'Step 1: Eat a nutrient-rich diet, including fruits, vegetables, nuts, and seeds.\r\n\r\nStep 2: Take foods rich in vitamins C and D, zinc, and antioxidants (e.g., oranges, spinach, almonds).\r\n\r\nStep 3: Exercise regularly to improve circulation and immunity.\r\n\r\nStep 4: Manage stress through relaxation techniques like meditation or yoga.\r\n\r\nStep 5: Get at least 7 to 8 hours of quality sleep to help your body repair.\r\n\r\nStep 6: Avoid smoking and limit alcohol consumption.\r\n\r\nStep 7: Stay hydrated and practice good hygiene, such as handwashing.\r\n', '2025-01-24 20:09:39', 'Immune System.jpg', 3, 6, NULL, 'NO'),
(59, 'How can you assemble flavorful and easy Beef Tacos?', 'Ingredients:\r\n- 300g ground beef\r\n- 1 tbsp taco seasoning\r\n- Taco shells\r\n- Lettuce, cheese, salsa (for topping)\r\n\r\nBasic Instructions:\r\n1. Cook Beef: Sauté ground beef until browned.\r\n\r\n2. Season: Add taco seasoning and mix well.\r\n\r\n3. Assemble: Fill taco shells with beef, lettuce, cheese, and salsa.\r\n', '2025-01-24 20:16:56', 'Beef Tacos.jpg', 4, 4, NULL, 'NO'),
(60, 'How to stay motivated in school?', 'Step 1: Set clear and achievable goals for your studies.\r\n\r\nStep 2: Break large tasks into smaller, manageable ones to avoid feeling overwhelmed.\r\n\r\nStep 3: Reward yourself for completing tasks to stay positive and motivated.\r\n\r\nStep 4: Surround yourself with supportive peers or mentors who encourage you.\r\n\r\nStep 5: Remember why your education is important and how it connects to your future goals.\r\n', '2025-01-24 20:18:58', 'Educ 3.jpg', 5, 2, NULL, 'NO'),
(61, 'How do you make a perfect Grilled Cheese Sandwich with a crispy crust?', 'Ingredients:\r\n- 2 slices bread\r\n- 2 slices cheese\r\n- 1 tbsp butter\r\n\r\nBasic Instructions:\r\n1. Butter Bread: Spread butter on one side of each bread slice.\r\n\r\n2. Assemble: Place cheese between the unbuttered sides.\r\n\r\n3. Grill: Cook in a pan until golden and cheese melts.\r\n', '2025-01-24 20:21:12', 'Grilled Cheese.jpg', 6, 4, NULL, 'NO'),
(62, 'How to improve mental health and reduce stress?', 'Step 1: Practice mindfulness techniques like deep breathing, meditation, or journaling.\r\n\r\nStep 2: Exercise regularly to release endorphins and reduce stress.\r\n\r\nStep 3: Connect with loved ones or a support system to share feelings.\r\n\r\nStep 4: Maintain a consistent sleep routine for better emotional stability.\r\n\r\nStep 5: Limit screen time and take breaks from social media when needed.\r\n\r\nStep 6: Seek professional help, such as therapy, if stress or mental health issues persist.\r\n\r\nStep 7: Set boundaries to avoid overcommitment and prioritize self-care.\r\n', '2025-01-24 20:24:53', 'Mental Health.jpg', 7, 6, NULL, 'NO'),
(63, 'How to manage time effectively as a student?', 'Step 1: Prioritize tasks by creating a daily or weekly to-do list.\r\n\r\nStep 2: Use a planner or apps to track assignments, deadlines, and study time.\r\n\r\nStep 3: Avoid procrastination by starting with small, easy tasks to build momentum.\r\n\r\nStep 4: Allocate time for breaks, hobbies, and relaxation to maintain balance.\r\n', '2025-01-24 20:29:54', 'Educ 4.jpg', 8, 2, NULL, 'NO'),
(64, 'What’s the recipe for soft and sweet Banana Pancakes?', 'Ingredients:\r\n- 1 ripe banana\r\n- 2 eggs\r\n- ½ cup flour\r\n- 1 tsp baking powder\r\n\r\nBasic Instructions:\r\n1. Mash Banana: Mash banana in a bowl.\r\n\r\n2. Mix Batter: Combine banana with eggs, flour, and baking powder.\r\n\r\n3. Cook Pancakes: Pour batter into a pan and cook until golden on both sides.\r\n', '2025-01-24 20:38:58', 'Banana Pancake.jpg', 9, 4, NULL, 'NO'),
(65, 'Maintenance Alert', 'Scheduled maintenance on [date] from [time] to [time]. Site may be down. Thanks for your patience!', '2025-01-24 20:43:19', '', 0, NULL, NULL, 'YES'),
(66, 'Update Complete', 'System upgrade done! Enjoy improved performance. Thanks for waiting!', '2025-01-24 20:44:05', '', 0, NULL, NULL, 'YES'),
(67, 'Service Interruption', 'Temporary issues affecting some services. Fix in progress. Stay tuned!', '2025-01-24 20:44:21', '', 0, NULL, NULL, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ratingID` int(11) NOT NULL,
  `ratingValue` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `savedbookmarks`
--

CREATE TABLE `savedbookmarks` (
  `bookmarkID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savedbookmarks`
--

INSERT INTO `savedbookmarks` (`bookmarkID`, `postID`, `userID`) VALUES
(3, 5, 1),
(4, 4, 1),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagID` int(11) NOT NULL,
  `tags` varchar(50) NOT NULL,
  `tagImg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagID`, `tags`, `tagImg`) VALUES
(1, 'Technology', 'assets/imgs/Technology.jpg'),
(2, 'Education', 'assets/imgs/Technology.jpg'),
(3, 'Lifestyle', 'assets/imgs/Lifestyle.jpg'),
(4, 'Cooking', 'assets/imgs/Cooking.jpg'),
(5, 'Art', 'assets/imgs/Art.jpg'),
(6, 'Health', 'assets/imgs/Health.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `profilePicture` varchar(100) DEFAULT 'defaultProfile.png',
  `coverPhoto` varchar(100) DEFAULT 'defaultCover.png',
  `userType` varchar(5) NOT NULL DEFAULT 'user',
  `phoneNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `userName`, `email`, `password`, `birthday`, `profilePicture`, `coverPhoto`, `userType`, `phoneNumber`) VALUES
(2, 'Sophia', 'Harrison', 'adminSophie', 'sophie.harrison@example.com', 'sophie123', '1995-08-14', NULL, NULL, 'admin', '2147483647'),
(3, 'Olivia', 'Smith', 'livSmith', 'olivia.smith@example.com', 'olivia123', '1992-03-22', NULL, NULL, 'user', '2147483647'),
(4, 'Emma', 'Johnson', 'emmaJ', 'emma.johnson@example.com', 'emma123', '1990-10-05', NULL, NULL, 'user', '2147483647'),
(5, 'Ava', 'Williams', 'avaWill', 'ava.williams@example.com', 'ava123', '1993-02-11', NULL, NULL, 'user', '2147483647'),
(6, 'Isabella', 'Brown', 'isabellaB', 'isabella.brown@example.com', 'isabella123', '1994-07-18', NULL, NULL, 'user', '2147483647'),
(7, 'Mia', 'Davis', 'miaDavis', 'mia.davis@example.com', 'mia123', '1996-01-25', NULL, NULL, 'user', '2147483647'),
(8, 'Amelia', 'Martinez', 'ameliaMart', 'amelia.martinez@example.com', 'amelia123', '1991-05-12', NULL, NULL, 'user', '2147483647'),
(9, 'John', 'Doe', 'johnDoe', 'john.doe@example.com', 'John123&', '1985-12-07', NULL, NULL, 'user', '2147483647'),
(10, 'Michael', 'Smith', 'michaelSmith', 'michael.smith@example.com', 'michael123', '1992-04-25', NULL, NULL, 'user', '2147483647'),
(11, 'David', 'Johnson', 'davidJohnson', 'david.johnson@example.com', 'david123', '1988-11-30', NULL, NULL, 'user', '2147483647'),
(12, 'James', 'Brown', 'jamesBrown', 'james.brown@example.com', 'james123', '1995-02-14', 'wallpaperflare.com_wallpaper (4).jpg', 'wallpaperflare.com_wallpaper (3).jpg', 'user', '2147483647'),
(13, 'William', 'Taylor', 'williamTaylor', 'william.taylor@example.com', 'william123', '1990-06-18', NULL, NULL, 'user', '2147483647'),
(14, 'Robert', 'Williams', 'robertWilliams', 'robert.williams@example.com', 'robert123', '1993-12-07', NULL, NULL, 'user', '2147483647'),
(15, 'CHARLIE', 'PUTH', 'charlieeee', 'cp@example.com', 'charlie0&', '2004-05-05', 'wallpaperflare.com_wallpaper (7).jpg', 'wallpaperflare.com_wallpaper (3).jpg', 'user', '0'),
(20, 'Toven', 'Lief', 'T0V3N', 'toven@example.com', 'Toven00&', '2004-05-05', 'wallpaperflare.com_wallpaper (4).jpg', 'wallpaperflare.com_wallpaper (8).jpg', 'user', '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visitID` int(6) NOT NULL,
  `page` varchar(50) NOT NULL,
  `dateTime` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visitID`, `page`, `dateTime`) VALUES
(1, 'HOME', '2025-01-21 01:45:56'),
(2, 'HOME', '2025-01-21 01:48:15'),
(3, 'HOME', '2025-01-21 02:04:27'),
(4, 'HOME', '2025-01-21 02:10:25'),
(5, 'HOME', '2025-01-21 02:46:13'),
(6, 'HOME', '2025-01-21 02:50:50'),
(7, 'HOME', '2025-01-21 02:51:10'),
(8, 'HOME', '2025-01-21 02:54:18'),
(9, 'HOME', '2025-01-21 03:08:04'),
(10, 'HOME', '2025-01-21 03:54:23'),
(11, 'HOME', '2025-01-21 08:38:46'),
(12, 'HOME', '2025-01-21 08:39:55'),
(13, 'HOME', '2025-01-21 08:40:56'),
(14, 'HOME', '2025-01-21 08:41:52'),
(15, 'HOME', '2025-01-21 08:43:58'),
(16, 'HOME', '2025-01-21 08:44:42'),
(17, 'HOME', '2025-01-21 08:46:14'),
(18, 'HOME', '2025-01-21 08:47:38'),
(19, 'HOME', '2025-01-21 08:48:08'),
(20, 'HOME', '2025-01-21 08:53:13'),
(21, 'HOME', '2025-01-21 08:54:31'),
(22, 'HOME', '2025-01-21 08:55:31'),
(23, 'HOME', '2025-01-21 08:56:15'),
(24, 'HOME', '2025-01-21 08:56:33'),
(25, 'HOME', '2025-01-21 09:00:23'),
(26, 'HOME', '2025-01-21 09:01:00'),
(27, 'HOME', '2025-01-21 09:08:01'),
(28, 'HOME', '2025-01-21 09:09:01'),
(29, 'HOME', '2025-01-21 09:16:01'),
(30, 'HOME', '2025-01-21 09:21:20'),
(31, 'HOME', '2025-01-21 09:24:18'),
(32, 'HOME', '2025-01-21 09:28:00'),
(33, 'HOME', '2025-01-21 09:28:26'),
(34, 'HOME', '2025-01-21 09:33:16'),
(35, 'HOME', '2025-01-21 09:37:29'),
(36, 'HOME', '2025-01-21 09:38:44'),
(37, 'HOME', '2025-01-21 15:09:32'),
(38, 'HOME', '2025-01-21 15:12:20'),
(39, 'HOME', '2025-01-21 15:13:36'),
(40, 'HOME', '2025-01-21 15:16:02'),
(41, 'HOME', '2025-01-21 17:10:38'),
(42, 'HOME', '2025-01-21 17:10:49'),
(43, 'HOME', '2025-01-21 17:11:01'),
(44, 'HOME', '2025-01-21 17:11:13'),
(45, 'HOME', '2025-01-21 17:11:26'),
(46, 'HOME', '2025-01-21 17:12:49'),
(47, 'HOME', '2025-01-21 17:33:57'),
(48, 'HOME', '2025-01-21 17:34:02'),
(49, 'HOME', '2025-01-21 17:35:01'),
(50, 'HOME', '2025-01-21 17:35:54'),
(51, 'HOME', '2025-01-21 17:36:21'),
(52, 'HOME', '2025-01-21 17:37:09'),
(53, 'HOME', '2025-01-21 22:27:03'),
(54, 'HOME', '2025-01-21 22:27:26'),
(55, 'HOME', '2025-01-21 22:27:30'),
(56, 'HOME', '2025-01-21 22:27:39'),
(57, 'HOME', '2025-01-21 22:27:46'),
(58, 'HOME', '2025-01-21 22:28:02'),
(59, 'HOME', '2025-01-21 22:37:24'),
(60, 'HOME', '2025-01-21 22:40:11'),
(61, 'HOME', '2025-01-21 22:41:49'),
(62, 'HOME', '2025-01-21 22:41:51'),
(63, 'HOME', '2025-01-21 22:41:58'),
(64, 'HOME', '2025-01-21 23:35:39'),
(65, 'HOME', '2025-01-21 23:35:42'),
(66, 'HOME', '2025-01-22 00:13:20'),
(67, 'HOME', '2025-01-22 00:37:00'),
(68, 'HOME', '2025-01-22 00:37:08'),
(69, 'HOME', '2025-01-22 00:56:38'),
(70, 'HOME', '2025-01-22 01:00:57'),
(71, 'HOME', '2025-01-22 02:47:04'),
(72, 'HOME', '2025-01-22 02:47:54'),
(73, 'HOME', '2025-01-22 02:48:03'),
(74, 'HOME', '2025-01-22 02:48:33'),
(75, 'HOME', '2025-01-22 02:48:56'),
(76, 'HOME', '2025-01-22 02:49:57'),
(77, 'HOME', '2025-01-22 02:54:47'),
(78, 'HOME', '2025-01-22 02:55:09'),
(79, 'HOME', '2025-01-22 02:57:34'),
(80, 'HOME', '2025-01-22 13:45:04'),
(81, 'HOME', '2025-01-22 13:47:31'),
(82, 'HOME', '2025-01-22 14:08:44'),
(83, 'HOME', '2025-01-22 14:08:49'),
(84, 'HOME', '2025-01-22 14:09:17'),
(85, 'HOME', '2025-01-22 14:09:39'),
(86, 'HOME', '2025-01-22 14:18:59'),
(87, 'HOME', '2025-01-22 14:19:47'),
(88, 'HOME', '2025-01-22 14:38:19'),
(89, 'HOME', '2025-01-22 14:39:50'),
(90, 'HOME', '2025-01-22 14:40:45'),
(91, 'HOME', '2025-01-22 14:44:10'),
(92, 'HOME', '2025-01-22 14:59:46'),
(93, 'HOME', '2025-01-22 14:59:52'),
(94, 'HOME', '2025-01-22 15:00:35'),
(95, 'HOME', '2025-01-22 15:00:44'),
(96, 'HOME', '2025-01-22 15:00:47'),
(97, 'HOME', '2025-01-22 15:01:40'),
(98, 'HOME', '2025-01-22 15:02:22'),
(99, 'HOME', '2025-01-22 15:15:28'),
(100, 'HOME', '2025-01-22 15:21:18'),
(101, 'HOME', '2025-01-22 15:21:23'),
(102, 'HOME', '2025-01-22 15:21:25'),
(103, 'HOME', '2025-01-22 15:40:17'),
(104, 'HOME', '2025-01-22 15:40:42'),
(105, 'HOME', '2025-01-22 15:41:18'),
(106, 'HOME', '2025-01-22 15:43:58'),
(107, 'HOME', '2025-01-22 15:44:22'),
(108, 'HOME', '2025-01-22 15:44:39'),
(109, 'HOME', '2025-01-22 15:46:26'),
(110, 'HOME', '2025-01-22 15:48:16'),
(111, 'HOME', '2025-01-22 15:52:42'),
(112, 'HOME', '2025-01-22 16:00:17'),
(113, 'HOME', '2025-01-22 16:00:54'),
(114, 'HOME', '2025-01-22 16:01:31'),
(115, 'HOME', '2025-01-22 16:01:31'),
(116, 'HOME', '2025-01-22 16:03:10'),
(117, 'HOME', '2025-01-22 16:06:48'),
(118, 'HOME', '2025-01-22 16:07:39'),
(119, 'HOME', '2025-01-22 16:07:51'),
(120, 'HOME', '2025-01-22 16:08:59'),
(121, 'HOME', '2025-01-22 16:11:37'),
(122, 'HOME', '2025-01-22 16:15:14'),
(123, 'HOME', '2025-01-22 16:19:47'),
(124, 'HOME', '2025-01-22 16:20:18'),
(125, 'HOME', '2025-01-22 16:21:04'),
(126, 'HOME', '2025-01-22 20:25:51'),
(127, 'HOME', '2025-01-22 20:26:30'),
(128, 'HOME', '2025-01-22 20:27:07'),
(129, 'HOME', '2025-01-22 20:28:04'),
(130, 'HOME', '2025-01-22 20:28:12'),
(131, 'HOME', '2025-01-22 20:28:44'),
(132, 'HOME', '2025-01-22 20:28:52'),
(133, 'HOME', '2025-01-22 20:29:15'),
(134, 'HOME', '2025-01-22 20:30:58'),
(135, 'HOME', '2025-01-22 20:32:32'),
(136, 'HOME', '2025-01-22 20:32:40'),
(137, 'HOME', '2025-01-22 20:32:56'),
(138, 'HOME', '2025-01-22 20:33:03'),
(139, 'HOME', '2025-01-22 20:33:20'),
(140, 'HOME', '2025-01-22 20:33:37'),
(141, 'HOME', '2025-01-22 20:34:14'),
(142, 'HOME', '2025-01-22 20:34:21'),
(143, 'HOME', '2025-01-22 20:34:27'),
(144, 'HOME', '2025-01-22 20:35:31'),
(145, 'HOME', '2025-01-22 20:41:51'),
(146, 'HOME', '2025-01-22 20:42:41'),
(147, 'HOME', '2025-01-22 20:43:40'),
(148, 'HOME', '2025-01-22 20:44:14'),
(149, 'HOME', '2025-01-22 20:45:00'),
(150, 'HOME', '2025-01-22 20:47:36'),
(151, 'HOME', '2025-01-22 20:47:36'),
(152, 'HOME', '2025-01-22 20:48:01'),
(153, 'HOME', '2025-01-22 20:59:42'),
(154, 'HOME', '2025-01-22 21:03:25'),
(155, 'HOME', '2025-01-22 21:03:27'),
(156, 'HOME', '2025-01-22 21:04:24'),
(157, 'HOME', '2025-01-22 21:05:59'),
(158, 'HOME', '2025-01-22 21:07:46'),
(159, 'HOME', '2025-01-22 21:09:27'),
(160, 'HOME', '2025-01-22 21:09:48'),
(161, 'HOME', '2025-01-22 21:12:57'),
(162, 'HOME', '2025-01-22 21:13:06'),
(163, 'HOME', '2025-01-22 21:13:49'),
(164, 'HOME', '2025-01-22 21:16:59'),
(165, 'HOME', '2025-01-22 21:18:13'),
(166, 'HOME', '2025-01-22 21:19:43'),
(167, 'HOME', '2025-01-22 21:23:06'),
(168, 'HOME', '2025-01-22 21:23:23'),
(169, 'HOME', '2025-01-22 21:25:38'),
(170, 'HOME', '2025-01-22 21:29:08'),
(171, 'HOME', '2025-01-22 21:29:58'),
(172, 'HOME', '2025-01-22 21:30:15'),
(173, 'HOME', '2025-01-22 21:30:37'),
(174, 'HOME', '2025-01-22 21:31:47'),
(175, 'HOME', '2025-01-22 21:40:47'),
(176, 'HOME', '2025-01-22 21:43:27'),
(177, 'HOME', '2025-01-22 21:43:36'),
(178, 'HOME', '2025-01-22 21:45:08'),
(179, 'HOME', '2025-01-22 21:45:47'),
(180, 'HOME', '2025-01-22 21:45:58'),
(181, 'HOME', '2025-01-22 22:12:24'),
(182, 'HOME', '2025-01-22 22:12:36'),
(183, 'HOME', '2025-01-22 22:13:13'),
(184, 'HOME', '2025-01-22 22:13:14'),
(185, 'HOME', '2025-01-22 22:15:43'),
(186, 'HOME', '2025-01-22 22:17:51'),
(187, 'HOME', '2025-01-22 22:18:11'),
(188, 'HOME', '2025-01-22 22:18:43'),
(189, 'HOME', '2025-01-22 22:18:56'),
(190, 'HOME', '2025-01-22 22:19:59'),
(191, 'HOME', '2025-01-22 22:21:24'),
(192, 'HOME', '2025-01-22 22:21:40'),
(193, 'HOME', '2025-01-22 22:21:40'),
(194, 'HOME', '2025-01-22 22:22:52'),
(195, 'HOME', '2025-01-22 22:24:01'),
(196, 'HOME', '2025-01-22 22:25:06'),
(197, 'HOME', '2025-01-22 22:25:28'),
(198, 'HOME', '2025-01-22 22:26:14'),
(199, 'HOME', '2025-01-22 22:27:15'),
(200, 'HOME', '2025-01-22 22:27:41'),
(201, 'HOME', '2025-01-22 22:29:55'),
(202, 'HOME', '2025-01-22 22:30:34'),
(203, 'HOME', '2025-01-22 22:31:14'),
(204, 'HOME', '2025-01-22 22:33:46'),
(205, 'HOME', '2025-01-22 22:34:51'),
(206, 'HOME', '2025-01-22 22:35:19'),
(207, 'HOME', '2025-01-22 22:37:07'),
(208, 'HOME', '2025-01-22 22:37:59'),
(209, 'HOME', '2025-01-22 22:38:11'),
(210, 'HOME', '2025-01-22 22:39:02'),
(211, 'HOME', '2025-01-22 22:39:28'),
(212, 'HOME', '2025-01-22 22:40:31'),
(213, 'HOME', '2025-01-22 22:41:38'),
(214, 'HOME', '2025-01-22 22:42:58'),
(215, 'HOME', '2025-01-22 22:43:38'),
(216, 'HOME', '2025-01-22 22:45:49'),
(217, 'HOME', '2025-01-22 22:46:15'),
(218, 'HOME', '2025-01-22 22:46:26'),
(219, 'HOME', '2025-01-22 22:48:40'),
(220, 'HOME', '2025-01-22 22:50:48'),
(221, 'HOME', '2025-01-22 22:52:12'),
(222, 'HOME', '2025-01-22 23:00:11'),
(223, 'HOME', '2025-01-22 23:01:13'),
(224, 'HOME', '2025-01-22 23:04:51'),
(225, 'HOME', '2025-01-22 23:06:15'),
(226, 'HOME', '2025-01-22 23:07:06'),
(227, 'HOME', '2025-01-22 23:08:12'),
(228, 'HOME', '2025-01-22 23:12:14'),
(229, 'HOME', '2025-01-22 23:13:43'),
(230, 'HOME', '2025-01-22 23:14:59'),
(231, 'HOME', '2025-01-22 23:17:43'),
(232, 'HOME', '2025-01-22 23:17:52'),
(233, 'HOME', '2025-01-22 23:18:02'),
(234, 'HOME', '2025-01-22 23:20:40'),
(235, 'HOME', '2025-01-22 23:24:20'),
(236, 'HOME', '2025-01-22 23:27:26'),
(237, 'HOME', '2025-01-22 23:27:58'),
(238, 'HOME', '2025-01-22 23:29:21'),
(239, 'HOME', '2025-01-22 23:31:38'),
(240, 'HOME', '2025-01-22 23:32:26'),
(241, 'HOME', '2025-01-22 23:34:42'),
(242, 'HOME', '2025-01-22 23:35:27'),
(243, 'HOME', '2025-01-22 23:36:18'),
(244, 'HOME', '2025-01-22 23:36:27'),
(245, 'HOME', '2025-01-22 23:36:40'),
(246, 'HOME', '2025-01-22 23:37:01'),
(247, 'HOME', '2025-01-22 23:38:00'),
(248, 'HOME', '2025-01-22 23:39:21'),
(249, 'HOME', '2025-01-22 23:44:53'),
(250, 'HOME', '2025-01-22 23:45:05'),
(251, 'HOME', '2025-01-22 23:45:22'),
(252, 'HOME', '2025-01-22 23:46:22'),
(253, 'HOME', '2025-01-22 23:47:15'),
(254, 'HOME', '2025-01-22 23:49:17'),
(255, 'HOME', '2025-01-22 23:50:07'),
(256, 'HOME', '2025-01-22 23:51:02'),
(257, 'HOME', '2025-01-22 23:52:17'),
(258, 'HOME', '2025-01-22 23:53:13'),
(259, 'HOME', '2025-01-22 23:54:31'),
(260, 'HOME', '2025-01-22 23:56:50'),
(261, 'HOME', '2025-01-22 23:59:23'),
(262, 'HOME', '2025-01-23 00:01:54'),
(263, 'HOME', '2025-01-23 00:03:00'),
(264, 'HOME', '2025-01-23 00:03:13'),
(265, 'HOME', '2025-01-23 00:03:45'),
(266, 'HOME', '2025-01-23 00:06:02'),
(267, 'HOME', '2025-01-23 00:08:08'),
(268, 'HOME', '2025-01-23 00:10:57'),
(269, 'HOME', '2025-01-23 00:14:19'),
(270, 'HOME', '2025-01-23 00:23:24'),
(271, 'HOME', '2025-01-23 00:25:10'),
(272, 'HOME', '2025-01-23 00:26:07'),
(273, 'HOME', '2025-01-23 00:45:57'),
(274, 'HOME', '2025-01-23 00:46:44'),
(275, 'HOME', '2025-01-23 00:49:39'),
(276, 'HOME', '2025-01-23 00:50:22'),
(277, 'HOME', '2025-01-23 00:51:11'),
(278, 'HOME', '2025-01-23 00:51:35'),
(279, 'HOME', '2025-01-23 00:51:42'),
(280, 'HOME', '2025-01-23 00:52:12'),
(281, 'HOME', '2025-01-23 00:53:24'),
(282, 'HOME', '2025-01-23 00:54:42'),
(283, 'HOME', '2025-01-23 00:57:15'),
(284, 'HOME', '2025-01-23 00:57:24'),
(285, 'HOME', '2025-01-23 00:57:27'),
(286, 'HOME', '2025-01-23 00:58:28'),
(287, 'HOME', '2025-01-23 00:59:18'),
(288, 'HOME', '2025-01-23 00:59:19'),
(289, 'HOME', '2025-01-23 01:01:31'),
(290, 'HOME', '2025-01-23 01:03:22'),
(291, 'HOME', '2025-01-23 01:06:02'),
(292, 'HOME', '2025-01-23 01:06:59'),
(293, 'HOME', '2025-01-23 01:12:29'),
(294, 'HOME', '2025-01-23 01:16:48'),
(295, 'HOME', '2025-01-23 01:17:08'),
(296, 'HOME', '2025-01-23 01:17:43'),
(297, 'HOME', '2025-01-23 01:22:26'),
(298, 'HOME', '2025-01-23 01:23:12'),
(299, 'HOME', '2025-01-23 01:26:56'),
(300, 'HOME', '2025-01-23 01:49:56'),
(301, 'HOME', '2025-01-23 01:50:08'),
(302, 'HOME', '2025-01-23 01:51:42'),
(303, 'HOME', '2025-01-23 01:52:10'),
(304, 'HOME', '2025-01-23 01:53:28'),
(305, 'HOME', '2025-01-23 01:55:40'),
(306, 'HOME', '2025-01-23 01:57:58'),
(307, 'HOME', '2025-01-23 01:58:18'),
(308, 'HOME', '2025-01-23 01:58:40'),
(309, 'HOME', '2025-01-23 01:58:51'),
(310, 'HOME', '2025-01-23 01:58:59'),
(311, 'HOME', '2025-01-23 02:00:45'),
(312, 'HOME', '2025-01-23 02:00:58'),
(313, 'HOME', '2025-01-23 02:01:58'),
(314, 'HOME', '2025-01-23 02:04:10'),
(315, 'HOME', '2025-01-23 02:05:14'),
(316, 'HOME', '2025-01-23 02:06:20'),
(317, 'HOME', '2025-01-23 02:06:37'),
(318, 'HOME', '2025-01-23 02:06:37'),
(319, 'HOME', '2025-01-23 02:07:48'),
(320, 'HOME', '2025-01-24 18:40:47'),
(321, 'HOME', '2025-01-24 18:41:02'),
(322, 'HOME', '2025-01-24 18:41:17'),
(323, 'HOME', '2025-01-24 18:57:29'),
(324, 'HOME', '2025-01-24 18:57:40'),
(325, 'HOME', '2025-01-24 19:01:50'),
(326, 'HOME', '2025-01-24 19:01:50'),
(327, 'HOME', '2025-01-24 19:03:28'),
(328, 'HOME', '2025-01-24 19:03:28'),
(329, 'HOME', '2025-01-24 19:03:54'),
(330, 'HOME', '2025-01-24 19:05:24'),
(331, 'HOME', '2025-01-24 19:05:24'),
(332, 'HOME', '2025-01-24 19:07:15'),
(333, 'HOME', '2025-01-24 19:07:50'),
(334, 'HOME', '2025-01-24 19:07:52'),
(335, 'HOME', '2025-01-24 19:09:25'),
(336, 'HOME', '2025-01-24 19:10:25'),
(337, 'HOME', '2025-01-24 19:10:31'),
(338, 'HOME', '2025-01-24 19:11:08'),
(339, 'HOME', '2025-01-24 19:11:23'),
(340, 'HOME', '2025-01-24 19:12:17'),
(341, 'HOME', '2025-01-24 19:12:17'),
(342, 'HOME', '2025-01-24 19:12:29'),
(343, 'HOME', '2025-01-24 19:13:36'),
(344, 'HOME', '2025-01-24 19:14:23'),
(345, 'HOME', '2025-01-24 19:14:34'),
(346, 'HOME', '2025-01-24 19:14:39'),
(347, 'HOME', '2025-01-24 19:15:21'),
(348, 'HOME', '2025-01-24 19:15:31'),
(349, 'HOME', '2025-01-24 19:15:31'),
(350, 'HOME', '2025-01-24 19:15:49'),
(351, 'HOME', '2025-01-24 19:15:55'),
(352, 'HOME', '2025-01-24 19:19:02'),
(353, 'HOME', '2025-01-24 19:19:02'),
(354, 'HOME', '2025-01-24 19:19:28'),
(355, 'HOME', '2025-01-24 19:21:02'),
(356, 'HOME', '2025-01-24 19:22:42'),
(357, 'HOME', '2025-01-24 19:22:42'),
(358, 'HOME', '2025-01-24 19:24:10'),
(359, 'HOME', '2025-01-24 19:24:22'),
(360, 'HOME', '2025-01-24 19:24:22'),
(361, 'HOME', '2025-01-24 19:25:08'),
(362, 'HOME', '2025-01-24 19:26:36'),
(363, 'HOME', '2025-01-24 19:26:36'),
(364, 'HOME', '2025-01-24 19:27:41'),
(365, 'HOME', '2025-01-24 19:27:41'),
(366, 'HOME', '2025-01-24 19:27:59'),
(367, 'HOME', '2025-01-24 19:29:59'),
(368, 'HOME', '2025-01-24 19:29:59'),
(369, 'HOME', '2025-01-24 19:32:00'),
(370, 'HOME', '2025-01-24 19:32:00'),
(371, 'HOME', '2025-01-24 19:32:21'),
(372, 'HOME', '2025-01-24 19:33:40'),
(373, 'HOME', '2025-01-24 19:33:40'),
(374, 'HOME', '2025-01-24 19:34:31'),
(375, 'HOME', '2025-01-24 19:34:31'),
(376, 'HOME', '2025-01-24 19:35:11'),
(377, 'HOME', '2025-01-24 19:37:07'),
(378, 'HOME', '2025-01-24 19:37:07'),
(379, 'HOME', '2025-01-24 19:38:26'),
(380, 'HOME', '2025-01-24 19:38:26'),
(381, 'HOME', '2025-01-24 19:38:45'),
(382, 'HOME', '2025-01-24 19:39:55'),
(383, 'HOME', '2025-01-24 19:39:55'),
(384, 'HOME', '2025-01-24 19:41:03'),
(385, 'HOME', '2025-01-24 19:41:03'),
(386, 'HOME', '2025-01-24 19:44:19'),
(387, 'HOME', '2025-01-24 19:46:48'),
(388, 'HOME', '2025-01-24 19:46:48'),
(389, 'HOME', '2025-01-24 19:47:54'),
(390, 'HOME', '2025-01-24 19:47:54'),
(391, 'HOME', '2025-01-24 19:48:14'),
(392, 'HOME', '2025-01-24 19:50:12'),
(393, 'HOME', '2025-01-24 19:50:12'),
(394, 'HOME', '2025-01-24 19:51:21'),
(395, 'HOME', '2025-01-24 19:51:39'),
(396, 'HOME', '2025-01-24 19:52:12'),
(397, 'HOME', '2025-01-24 19:52:12'),
(398, 'HOME', '2025-01-24 19:52:47'),
(399, 'HOME', '2025-01-24 19:54:45'),
(400, 'HOME', '2025-01-24 19:54:45'),
(401, 'HOME', '2025-01-24 19:57:25'),
(402, 'HOME', '2025-01-24 19:57:25'),
(403, 'HOME', '2025-01-24 19:57:57'),
(404, 'HOME', '2025-01-24 19:59:12'),
(405, 'HOME', '2025-01-24 19:59:12'),
(406, 'HOME', '2025-01-24 20:00:01'),
(407, 'HOME', '2025-01-24 20:00:01'),
(408, 'HOME', '2025-01-24 20:00:33'),
(409, 'HOME', '2025-01-24 20:01:22'),
(410, 'HOME', '2025-01-24 20:02:27'),
(411, 'HOME', '2025-01-24 20:02:27'),
(412, 'HOME', '2025-01-24 20:04:38'),
(413, 'HOME', '2025-01-24 20:04:38'),
(414, 'HOME', '2025-01-24 20:05:31'),
(415, 'HOME', '2025-01-24 20:06:38'),
(416, 'HOME', '2025-01-24 20:06:38'),
(417, 'HOME', '2025-01-24 20:07:29'),
(418, 'HOME', '2025-01-24 20:07:29'),
(419, 'HOME', '2025-01-24 20:08:23'),
(420, 'HOME', '2025-01-24 20:09:39'),
(421, 'HOME', '2025-01-24 20:09:39'),
(422, 'HOME', '2025-01-24 20:14:01'),
(423, 'HOME', '2025-01-24 20:14:53'),
(424, 'HOME', '2025-01-24 20:16:00'),
(425, 'HOME', '2025-01-24 20:16:56'),
(426, 'HOME', '2025-01-24 20:16:56'),
(427, 'HOME', '2025-01-24 20:17:40'),
(428, 'HOME', '2025-01-24 20:18:04'),
(429, 'HOME', '2025-01-24 20:18:58'),
(430, 'HOME', '2025-01-24 20:18:58'),
(431, 'HOME', '2025-01-24 20:20:10'),
(432, 'HOME', '2025-01-24 20:21:12'),
(433, 'HOME', '2025-01-24 20:21:12'),
(434, 'HOME', '2025-01-24 20:22:30'),
(435, 'HOME', '2025-01-24 20:23:53'),
(436, 'HOME', '2025-01-24 20:24:15'),
(437, 'HOME', '2025-01-24 20:24:53'),
(438, 'HOME', '2025-01-24 20:24:53'),
(439, 'HOME', '2025-01-24 20:28:42'),
(440, 'HOME', '2025-01-24 20:29:54'),
(441, 'HOME', '2025-01-24 20:29:54'),
(442, 'HOME', '2025-01-24 20:35:33'),
(443, 'HOME', '2025-01-24 20:38:58'),
(444, 'HOME', '2025-01-24 20:38:58'),
(445, 'HOME', '2025-01-24 20:40:13'),
(446, 'HOME', '2025-01-24 20:43:28'),
(447, 'HOME', '2025-01-24 20:44:24'),
(448, 'HOME', '2025-01-24 20:47:09'),
(449, 'HOME', '2025-01-24 20:48:44'),
(450, 'HOME', '2025-01-24 20:48:58'),
(451, 'HOME', '2025-01-24 20:49:22'),
(452, 'HOME', '2025-01-24 20:49:44'),
(453, 'HOME', '2025-01-24 20:50:55'),
(454, 'HOME', '2025-01-24 20:51:17'),
(455, 'HOME', '2025-01-24 20:51:56'),
(456, 'HOME', '2025-01-24 20:54:04'),
(457, 'HOME', '2025-01-24 21:02:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`followID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ratingID`);

--
-- Indexes for table `savedbookmarks`
--
ALTER TABLE `savedbookmarks`
  ADD PRIMARY KEY (`bookmarkID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visitID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `followID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `savedbookmarks`
--
ALTER TABLE `savedbookmarks`
  MODIFY `bookmarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visitID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
