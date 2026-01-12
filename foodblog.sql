-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 02:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `CommentText` text NOT NULL,
  `CommentDate` datetime DEFAULT current_timestamp(),
  `UserID` int(11) NOT NULL,
  `RID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `CommentText`, `CommentDate`, `UserID`, `RID`) VALUES
(1, 'Amazing', '2025-12-08 02:51:54', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `LikedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeID`, `UserID`, `RID`, `LikedAt`) VALUES
(7, 1, 5, '2025-12-08 01:35:33'),
(8, 1, 3, '2025-12-08 01:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `RID` int(10) NOT NULL,
  `RName` varchar(50) DEFAULT NULL,
  `RCategory` varchar(50) DEFAULT NULL,
  `RDecsr` text NOT NULL,
  `Rimage` varchar(50) NOT NULL,
  `userid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`RID`, `RName`, `RCategory`, `RDecsr`, `Rimage`, `userid`) VALUES
(1, 'Chicken Wontons in Spicy Chili Sauce', 'dinner', 'How To Make Chicken Wontons with Spicy Sauce\r\nStep 1: Cut Up Your Vegetables.\r\nI like shiitake mushrooms and green onions. I’ve also loved the versions I’ve made with either spinach or bok choy!\r\nStep 2: Sauté the Mushrooms and Wontons.\r\nI usually start with the mushrooms in some sesame oil, and once they’re good to go, I add my wontons.\r\nStep 3: Build the Sauce.\r\nI add chicken broth, a bit of teriyaki sauce, a spoonful of chili oil, and a drizzle of sesame oil. It’s somewhere between a dipping sauce, a soup broth, and a finishing oil. It’s all three in one.\r\nStep 4: Scoop It Into Bowls, Garnish, and Serve.\r\n', 'rec1.jpg', 1),
(2, 'Lemon Herb Pasta Salad with Marinated Chickpeas', 'dinner', 'Prepare marinated chickpeas by combining everything together in a shallow bowl. For the best flavor, allow this to marinate for 8 hours or overnight. But hey, if you don’t have the time, just let it all hang out while you prep the rest of the pasta. It’s all good.\r\nCook pasta according to package directions. Drain. While pasta is hot, toss with marinated chickpeas and allow to cool slightly.\r\nAdd more olive oil (as needed). Add lemon juice and zest and herbs. Season with salt and pepper. Add in Parmesan cheese last so it doesn’t completely melt. Serve warm, cold, or room temp with extra lemon, Parmesan, and herbs as needed!', 'rec2.jpg', 2),
(3, 'The Ultimate Breakfast Sandwich', 'breakfast', 'Toast your croissants for a few minutes in a 350 degree oven, cut side down on a cooking sheet. You can also do this in the toaster if your croissants fit in there.\r\nWhen croissants are toasted and all other ingredients are out and ready, cook up your eggs. SOFT SCRAMBLED, remember?\r\nAssemble sandwiches immediately, while eggs are at their best – a layer of tomato sauce, eggs, cheese, bacon, and guac on top', 'break1.jpg', 2),
(4, 'Swedish Pancakes', 'breakfast', 'Make Pancake Batter: Blend the eggs and milk until doubled in size, about 30 seconds. Add flour, melted butter, sugar, and salt; blend for another 15-20 seconds until combined.\r\nPour and Pan Tilt: Preheat a nonstick or well seasoned cast iron pan over medium heat. Pour about 1/4 cup of pancake batter into the pan with one hand, and immediately tilt the pan with the other hand to spread the batter even wider. This will give you a signature thin lacy edge on your pancake. \r\nCook: Let it sit for about 1 minute or until the pancake is golden brown; use a spatula to pull the edges up and flip the pancake. Cook for another 15-30 seconds on the back side. You can cook to your desired level of doneness; I prefer golden brown on the front side and pale on the back side.\r\nServe: Serve them flat, folded, or rolled, topped with whatever you like: maple syrup, whipped cream, fruit, jams, etc. I like to fold them and serve with lingonberry jam and yogurt!', 'break2.jpg', 1),
(5, 'Pumpkin Shortcakes with Cinnamon Apples and Maple ', 'breakfast', 'Shortcakes: Preheat the oven to 400 degrees. Mix flour, brown sugar, baking powder, pumpkin pie spice, and salt together. Grate the cold butter into the flour and gently stir to coat the specs of butter in the flour. Be careful to not fully incorporate the butter. The goal is to still see specs of cold butter in the dough once the biscuits are ready for baking. Whisk together the milk and pumpkin and gently stir it into the flour mixture. Turn dough out onto a clean counter. The dough will look a bit messy, but do your best to bring it together by patting it down and folding it over about 7 times. Do not overwork the dough. Flatten the dough to a ¾ to 1-inch thick layer. Use a 2 ½-inch biscuit cutter or the opening of a glass to cut out 7 or 8 rounds. Bake for 18-20 minutes until golden brown.\r\n\r\nApples: Heat the butter in a large saucepan over medium heat. Add in the apples, brown sugar, cinnamon, and nutmeg and stir until the apples are coated. Add in the water, and cook the apples for about 10 minutes until soft. Combine the cornstarch with a couple teaspoons of water to make a slurry. Add to the apple mixture, and bring to a boil, stirring until the mixture thickens. Take off the heat (you want these to cool down a bit before you layer them onto the stacks so they don’t melt all the whipped cream).\r\n\r\nMaple Whipped Cream: Using a hand mixer, beat the heavy cream until stiff peaks form. In a separate bowl, beat the cream cheese until smooth. Slowly beat in the maple and cinnamon. Fold the cream cheese mixture into the whipped cream.\r\n\r\nAssemble: Slice the biscuits in half. Add a layer of apples and maple whipped cream and place the other half of the biscuit on top. Top with more apples and whipped cream. Drizzle with the extra sauce from the apples.', 'break3.jpg', 1),
(6, 'Instant Pot Sweet Potato Tortilla Soup', 'dinner', 'Tortilla Soup: Place all soup ingredients in the Instant Pot. Cook on high pressure for 3 minutes. Quick release steam.\r\nTortilla Strips: Cut the tortillas into small strips. Heat the oil in a heavy pan over medium high heat. Working in batches, add tortilla strips and fry in the hot oil for a few minutes until golden and crispy. Remove with tongs, drain on paper towels, and sprinkle with salt.\r\nServe: Stir about half of your tortilla strips into the soup and reserve the remaining half for topping. Top individual bowls with… well… everything! I highly recommend avocado, and definitely don’t forget the lime.', 'rec3.jpg', 2),
(7, 'Spicy Shrimp Tacos with Garlic Cilantro Lime Slaw', 'lunch', 'Sauce: Pulse all the sauce ingredients in a food processor or blender until mostly smooth. Add water if needed to thin.\r\nSlaw: Toss some of the sauce (not all) with the cabbage. We’ll use the leftover sauce to top the tacos.\r\nShrimp: Pat the shrimp dry with paper towels. Toss the shrimp in a small bowl with the spice mix to get it coated. Heat a drizzle of oil a large skillet over medium high heat. Add the shrimp to the hot pan and sauté for 5-8 minutes, flipping occasionally, until the shrimp are cooked through.\r\nAssembly: For the prettiest and easiest-to-eat assembly, go in this order: smashed avocado, slaw, and shrimp. Finish with Cotjia cheese, lime wedges, and extra sauce.', 'lun1.jpg', 1),
(8, 'Simple Mushroom Penne with Walnut Pesto', 'lunch', 'Cook the penne pasta according to package directions. Drain and set aside.\r\nToast the walnuts in a small sauté pan over low heat with no butter or oil – stir and shake the pan until the walnuts are fragrant and toasty (about 5 minutes). In a food processor, combine all the ingredients for the walnut pesto and pulse until mostly smooth.\r\nHeat the butter over medium heat in a wide skillet. Add the mushrooms and saute for 8-10 minutes, until the mushrooms are a deep golden brown. Add the penne pasta to the pan and stir to combine, adding Parmesan, salt, pepper, and fresh parsley or other herbs to taste.\r\nDivide the pasta between 4-6 bowls and top with a generous spoonful of the walnut pesto OR stir the walnut pesto directly into the pasta.', 'lun2.jpg', 1),
(9, 'Chili Crunch Tofu', 'lunch', 'Prep: Preheat the oven to 425 degrees. Line a baking sheet with parchment paper.\r\nPrepping the Tofu: Cut tofu in half so you have two even, flat pieces. Press the moisture out of the tofu, using paper towels or a towel. (The more water you remove, the faster it will crisp up in the oven, but I usually don’t spend more than 5-10 minutes here.) Cut tofu into cubes and transfer to a bowl. Add cornstarch, soy sauce, and olive oil. Toss gently to coat. It doesn’t have to be perfectly smooth, but just try to generally get all the pieces semi-covered.\r\nPrepare Rice: Cook rice according to package instructions. \r\nBake the Tofu: Transfer to the baking sheet and roast for 20-25 minutes, stirring once or twice, to get the tofu evenly browned and crispy.\r\nMake the Sauce: Mix Yum Yum sauce and chili crisp in a small bowl.\r\nMix Tofu and Sauce: When the tofu is done, toss it with several tablespoons of sauce, reserving sauce for topping.\r\nServe: Serve with rice, on a salad, noodles, whatever you like. Dollop with extra sauce if you want, and top with green onions. ', 'lun3.jpg', 1),
(10, 'Salted Caramel Brownies', 'dessert', 'Prep: Preheat oven to 350. Line a flat plate with parchment paper and coat with cooking spray. Line an 8×8 square baking pan with parchment paper and coat with cooking spray.\r\nMake that caramel: place the sugar in a small saucepan over medium high heat. Stir frequently – the sugar will form clumps and eventually become smooth. Remove from heat. Add butter and stir in. Add cream and stir in. Return to heat – let it get smooth and bubbly for another few minutes. Pour the caramel on the parchment-lined plate. Freeze for 20-30 minutes to solidify.\r\nBrownie time: Melt the chocolate and the butter (microwave or double boiler). Whisk in the sugar. Whisk in the eggs and vanilla. Whisk in the flour and salt.\r\nCaramel meets brownie: Cut the cooled caramel into small squares. Stir most of them into the brownie batter and transfer to the pan. Arrange the last few caramel pieces on top of the brownies. Bake for 30 minutes (more or less to taste). Cool in the fridge or freezer for easier cutting. ', 'des1.jpg', 2),
(11, 'Pumpkin Muffins with Maple Cream Cheese Filling', 'dessert', 'Make Muffin Batter: Preheat the oven to 350 degrees. Whisk oil and sugars. Add pumpkin, vanilla, eggs, and milk; whisk until just combined. Add flour, baking soda, spices, and salt; mix until just combined. Pour muffin batter into an oiled or nonstick muffin tin, filling about 3/4ths of the way to the top of each up. \r\nMake Cinnamon Sugar: Mix up the cinnamon sugar topping in a small bowl.\r\nAssemble and Bake: Spoon the cinnamon sugar over each muffin. Bake for 20-24 minutes, or until the tops spring back when gently pressed.\r\nMake Maple Cream Cheese Filling: Add the cream to a small bowl and beat until light and fluffy and stiff peaks form. In a separate bowl, beat the softened cream cheese until smooth. Fold in the whipped cream, using the beaters again to smooth it out if needed. Add the maple syrup and mix until smooth. \r\nFill The Muffins: Once the muffins have cooled, cut a cone out of the center of the muffins using a small paring knife. Using a piping bag, or a plastic bag with the corner snipped off, add the filling to the center hole in the muffins. Fill it all the way to the top (the filling will be exposed at the top – cute).\r\nServe: These are ready to eat as-is! If making ahead, they should be stored in the fridge. They can be eaten at room temp or cold – both delicious!', 'des2.jpg', 2),
(12, 'English Muffin Baklava', 'dessert', 'Preheat the broiler – I use the “Low Broil” setting but every oven will be different for which setting works best.\r\nPulse the nuts in a food processor until finely chopped. Set aside a few spoonfuls of the nuts for topping. Mix the remaining nuts, butter, and brown sugar together in a small bowl.\r\nToast the English muffins on a baking sheet lined with foil until toasty – about 3 minutes.\r\nSpread English muffins with the nutty butter mixture. Return to the oven, a few inches away from the broiler, for 1 minute or until bubbly and slightly caramelized.\r\nTop with a little baby dollop of mascarpone cheese and give it a gentle swoop to melt it in. Finish with extra nuts and honey', 'des3.jpg', 1),
(13, 'Pumpkin Energy Bites', 'snack', 'Pulse all ingredients (except chocolate chips) in a food processor until well-mixed.\r\nAdd chocolate chips and pulse a few more times until they are in small pieces.\r\nScoop mixture and roll into balls. Freeze until solid and store in the freezer or refrigerator. ', 'sn1.jpg', 1),
(14, 'Bacon-Wrapped Dates with Goat Cheese', 'snack', 'Preheat the oven to 350 degrees Fahrenheit. Slice the dates lengthwise on one side to create an opening. Remove the pit.\r\n\r\nUsing a spoon, stuff a small amount of goat cheese into the cavity of each date and press the sides together to close.\r\n\r\nCut the bacon slices in half. Wrap each date with a slice of bacon and secure with a toothpick.\r\n\r\nArrange evenly on a baking sheet with raised edges (otherwise grease will get everywhere) and bake for 10 minutes. Remove the dates and use the toothpick to turn each one so it’s laying on its side. Bake for another 5-8 minutes, until browned to your liking, and turn the dates to the other side and repeat. Remove from the oven, place on a paper towel lined plate, and let stand for 5 minutes before serving.\r\n', 'sn2.jpg', 2),
(15, 'Basic Soft Pretzels', 'snack', 'Make the Dough: In a mixing bowl, gently whisk the warm milk, yeast, brown sugar, butter, and salt. Stir in the flour until a dough forms. Transfer the dough to a floured surface and knead 10-15 times.\r\nLet the Dough Hang Out: Return to the bowl and drizzle with a little oil to prevent sticking. Cover with a cloth or plastic wrap and set aside for an hour to rise.\r\nPretzel-ify: When the dough has risen, punch it back down and divide it into 6-8 sections. Roll each section into a loooong skinny rope. Fold it into a pretzel. Dip into the baking soda solution and place on a parchment-lined baking sheet.\r\nBake: Brush with the beaten egg and sprinkle with salt. Bake at 450 degrees for 10-12 minutes, until golden brown.', 'sn3.jpg', 1),
(16, ' Sheet Pan Jambalaya', 'dinner', 'Preheat the oven to 425 degrees. Add the kielbasa sausage, onion, and bell pepper to a large sheet pan along with the olive oil and 1 teaspoon of Cajun seasoning. Toss the vegetables and sausage to make sure they are well-coated. Transfer the pan to the oven and cook for 10 minutes.\r\nRemove the vegetables and sausage from the oven, add the tomato paste, and stir to thoroughly mix it in with the vegetables. Add the frozen cauliflower rice and remaining teaspoon of Cajun seasoning to the pan. Toss all the ingredients together until the are well-incorporated and return the pan to the oven. Continue to cook for 15-20 minutes, stirring occasionally, until the cauliflower rice is cooked through and most of the liquid has evaporated.\r\nTaste the jambalaya and season with salt and pepper. Add the raw shrimp on top of the jambalaya and drizzle the butter over the top.\r\nReturn the pan to the oven and cook for 5-7 minutes, until the shrimp is cooked through and pink. Garnish with fresh parsley and a squeeze of lemon juice.', 'test.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(10) NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `UPass` varchar(255) DEFAULT NULL,
  `UEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Uname`, `UPass`, `UEmail`) VALUES
(1, 'Giorgos12', '$2y$10$uakIGV58mznSDJsmGFJb2O8jLQhmY2hyVWFqr0nhUkYqLFxi0.Uuy', 'giorgos12@gmail.com'),
(2, 'Maria45', '$2y$10$sthzOskdiEecZZGf9S/z4exnMyjxjzq/UJJPznBr5lilCa3MbZjj2', 'maria45@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RID` (`RID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeID`),
  ADD UNIQUE KEY `user_recipe` (`UserID`,`RID`),
  ADD KEY `RID` (`RID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `fk_recipe_user` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `RID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `recipes` (`RID`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `recipes` (`RID`) ON DELETE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipe_user` FOREIGN KEY (`userid`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
